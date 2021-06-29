<?php
/**
 * Plugin Name:       WP "How To" Bot
 * Description:       Handle the basics with this plugin.
 * Version:           1.0.0
 * Author:            vsv
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wp_simyz_chat
 * Domain Path:       /languages
 *
 **/

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists('Simyz_Chat') ) {

class Simyz_Chat {

	private const SERVER_API = 'http://192.168.0.170:4040/wp_bot_servlet/wp_bot_servlet';

	private const OPTION_NAME = 'wp_simyz_chat_username';

	function __construct() {
		register_activation_hook( __FILE__, array( $this, 'activation' ) );
		add_action( 'admin_init', array( $this, 'admin_init' ) );
		add_action( 'wp_ajax_simyzchat_check_status', array( $this, 'check_status' ) );
		add_action( 'wp_ajax_simyzchat_chat_submit', array( $this, 'chat_submit' ) );
		add_action( 'wp_ajax_simyzchat_chat_has_helped', array( $this, 'chat_has_helped' ) );
		add_action( 'wp_ajax_simyzchat_register', array( $this, 'register_user' ) );
	}

	function check_status() {
		global $wpdb;

		if ( wp_doing_ajax() )
			check_ajax_referer( plugin_basename( __FILE__ ), 'simyzchat_ajax_nonce_field' );

		$option_username = get_option( self::OPTION_NAME );
		if ( empty( $option_username ) ) {
			$args = array(
				'body' => array(
					'get_website_status' => true,
					'domain_name'        => $_SERVER['HTTP_HOST']
				)
			);
			$response = $this->remote_post( $args );
			$option_username = $response ? $response->login : 'null';
			update_option( self::OPTION_NAME, $option_username );
		}

		$result = $wpdb->get_row( "SELECT * FROM `{$wpdb->prefix}simyzchat_questions` WHERE `is_open` = 1", ARRAY_A );
		wp_send_json_success( array(
			'user'      => $option_username,
			'questions' => $result,
		) );
	}

	function chat_submit() {
		global $wpdb;

		if ( wp_doing_ajax() )
			check_ajax_referer( plugin_basename( __FILE__ ), 'simyzchat_ajax_nonce_field' );

		$chat_message = preg_replace( "/[^a-zа-я\s]/iu", "", sanitize_text_field( $_POST['chat_message'] ) );
		if ( ! empty( $chat_message ) ) {
			$result = $wpdb->get_row( $wpdb->prepare(
				"SELECT * FROM `{$wpdb->prefix}simyzchat_questions` WHERE `question` = %s", $chat_message
			), ARRAY_A );

			if ( $result ) {
				$wpdb->update( $wpdb->prefix . 'simyzchat_questions',
					array( 'is_open' => 1 ),
					array( 'id' => $result['id'] ),
					array( '%d' ),
					array( '%d' )
				);

				wp_send_json_success( array(
					'answer'        => $result['answer'],
					'question'      => $result['question'],
					'user_actions'  => $result['user_actions'],
					'question_id'   => $result['id']
				) );
			} else {
				$args = array(
					'body' => array(
						'question'      => $chat_message,
						'user'          => get_option( self::OPTION_NAME ),
						'domain_name'   => $_SERVER['HTTP_HOST']
					)
				);

				$response = $this->remote_post( $args );
				if ( $response ) {
					$answer       = $response->answer;
					$user_actions = json_encode( is_null( $response->user_actions ) ? array() : $response->user_actions );

					$wpdb->insert( $wpdb->prefix . 'simyzchat_questions',
						array(
							'question'      => $chat_message,
							'answer'        => $answer,
							'user_actions'  => $user_actions,
							'is_open'       => 1,
						),
						array( '%s', '%s', '%s', '%d' )
					);

					wp_send_json_success( array(
						'answer'        => $answer,
						'question'      => $chat_message,
						'user_actions'  => $user_actions,
						'question_id'   => $wpdb->insert_id
					) );
				} else {
					wp_send_json_error( array(
						'message' => __( 'Server error. Please try again later.', 'wp_simyz_chat' )
					) );
				}
			}
		} else {
			wp_send_json_error( array(
				'message' => __( 'The field cannot be empty.', 'wp_simyz_chat' )
			) );
		}
	}

	function chat_has_helped() {
		global $wpdb;

		if ( wp_doing_ajax() )
			check_ajax_referer( plugin_basename( __FILE__ ), 'simyzchat_ajax_nonce_field' );

		$has_helped  = absint( $_POST['has_helped'] );
		$question_id = absint( $_POST['question_id'] );

		$question = $wpdb->get_var( $wpdb->prepare(
			"SELECT `question` FROM `{$wpdb->prefix}simyzchat_questions` WHERE `id` = %d", $question_id
		) );

		$args = array(
			'body' => array(
				'question'      => $question,
				'user'          => get_option( self::OPTION_NAME ),
				'domain_name'   => $_SERVER['HTTP_HOST'],
				'has_helped'    => $has_helped,
				'answer_id'     => $question_id,
			)
		);

		$response = $this->remote_post( $args );
		if ( $response ) {
			$wpdb->update( $wpdb->prefix . 'simyzchat_questions',
				array( 'is_open' => 0, 'has_helped' => $has_helped ),
				array( 'id' => $question_id ),
				array( '%d', '%d' ),
				array( '%d' )
			);

			wp_send_json_success( array(
				'message' => $response->has_helped
			) );
		} else {
			wp_send_json_error( array(
				'message' => __( 'Server error. Please try again later.', 'wp_simyz_chat' )
			) );
		}
	}

	function register_user() {
		if ( wp_doing_ajax() )
			check_ajax_referer( plugin_basename( __FILE__ ), 'simyzchat_ajax_nonce_field' );

		update_option( self::OPTION_NAME, '' );

		wp_send_json_success();
	}

	private function remote_post( $args = array() ) {
		$args['sslverify'] = false;
		$args['timeout'] = 30;
		$response = wp_remote_post( self::SERVER_API, $args );
		$response = json_decode( $response['body'] );
		if ( ! empty( $response ) &&
		     ! empty( $response->status ) &&
		     'success' == $response->status &&
		     ! empty( $response->data )
		) {
			return $response->data[0];
		} else {
			return false;
		}
	}

	function activation() {
		global $wpdb;

		if ( ! get_option( self::OPTION_NAME ) )
			add_option( self::OPTION_NAME );

		$sql = "CREATE TABLE IF NOT EXISTS `" . $wpdb->prefix . "simyzchat_questions` (
			id int NOT NULL AUTO_INCREMENT,
			question text NOT NULL,
            answer text DEFAULT NULL,
            user_actions text DEFAULT NULL,
            is_open boolean DEFAULT false,
            has_helped boolean DEFAULT NULL,
            time datetime DEFAULT CURRENT_TIMESTAMP,
			UNIQUE KEY id (id),
			KEY question (question),
			KEY is_open (is_open),
			KEY time (time)
		);";
		$wpdb->query( $sql );

		register_uninstall_hook( __FILE__, array( $this, 'uninstall' ) );
	}

	function uninstall() {
		global $wpdb;

		delete_option( self::OPTION_NAME );
		$wpdb->query( "DROP TABLE IF EXISTS `" . $wpdb->prefix . "simyzchat_questions`;" );
	}

	function admin_init() {
		$plugin_info = get_plugin_data( __FILE__ );

		$script_vars = array(
			'nonce'         => wp_create_nonce( plugin_basename( __FILE__ ) ),
			'site_url'      => plugins_url( '', __FILE__ ),
			'register'      => __( 'Register', 'wp_simyz_chat' ),
			'chat_message'  => __( 'How Are You?!..', 'wp_simyz_chat' ),
			'it_helped'     => __( 'It helped', 'wp_simyz_chat' ),
			'it_didnt'      => __( 'It didn\'t', 'wp_simyz_chat' )
		);
		wp_enqueue_script( 'simyzchat_script', plugins_url( 'js/script.js', __FILE__ ), array( 'jquery' ), $plugin_info['Version'] );
		wp_localize_script( 'simyzchat_script', 'simyzchat_ajax', $script_vars );

		wp_enqueue_style( 'simyzchat_stylesheet', plugins_url( 'css/style.css', __FILE__ ), false, $plugin_info["Version"] );
	}

}

new Simyz_Chat();

} // class_exists check