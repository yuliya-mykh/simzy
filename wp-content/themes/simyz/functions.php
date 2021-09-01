<?php

function simyz_assets() {
	wp_enqueue_style( 'owlcarousel', get_template_directory_uri().'/css/owl.carousel.min.css' );
	wp_enqueue_style( 'owlcarouseltheme', get_template_directory_uri().'/css/owl.theme.default.min.css' );
	wp_enqueue_style( 'maincss', get_template_directory_uri().'/css/style.css' );
	wp_enqueue_style( 'mainnewcss', get_template_directory_uri().'/css/main.css' );
	

	wp_enqueue_script( 'jqueryscript', get_template_directory_uri().'/js/jquery-3.6.0.min.js', [], '1.0.0', true );
	wp_enqueue_script( 'owlcarouselscript', get_template_directory_uri().'/js/owl.carousel.min.js', [], '1.0.0', true );
	wp_enqueue_script( 'mainscript', get_template_directory_uri().'/js/script.js', [], '1.0.0', true );
	


}

add_action( 'wp_enqueue_scripts', 'myajax_data', 99 );
function myajax_data(){

	// Первый параметр 'twentyfifteen-script' означает, что код будет прикреплен к скрипту с ID 'twentyfifteen-script'
	// 'twentyfifteen-script' должен быть добавлен в очередь на вывод, иначе WP не поймет куда вставлять код локализации
	// Заметка: обычно этот код нужно добавлять в functions.php в том месте где подключаются скрипты, после указанного скрипта
	wp_localize_script( 'mainscript', 'myajax',
		array(
			'url' => admin_url('admin-ajax.php')
		)
	);

}
add_action( 'wp_enqueue_scripts', 'simyz_assets' );


remove_filter( 'the_content', 'wpautop' );remove_filter( 'the_content', 'wpautop' );


add_action( 'after_setup_theme', 'theme_register_nav_menu' );
function theme_register_nav_menu() {
	register_nav_menu( 'primary', 'Primary Menu' );
	add_theme_support( 'woocommerce' ); 
}

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();
	
}

add_filter( 'get_search_form', 'my_search_form' );
function my_search_form( $form ) {

	$form = '
	<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
		<label class="screen-reader-text" for="s">Search:</label>
		<input type="text" value="' . get_search_query() . '" name="s" id="s" />
		<input type="submit" id="searchsubmit" value="Search" />
	</form>';

	return $form;
}


add_action( 'after_setup_theme', 'create_table' );

function create_table() {
	global $wpdb;

	require_once ABSPATH . 'wp-admin/includes/upgrade.php';



	$sql_questions = "CREATE TABLE IF NOT EXISTS questions ( 
		id int(11) NOT NULL AUTO_INCREMENT, 
		question varchar(511) COLLATE utf8mb4_unicode_ci NOT NULL, 
		answer text COLLATE utf8mb4_unicode_ci NOT NULL, 
		user_actions_simulation_path varchar(4096) COLLATE utf8mb4_unicode_ci NOT NULL, 
		success_count int(11) NOT NULL, 
		fails_count int(11) NOT NULL, 
		time int(11) NOT NULL, 
		taken_from_url varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL, 
		PRIMARY KEY (id), 
		UNIQUE KEY question (question), 
		KEY time (time) 
	  ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;"; 
	   
	   $sql_users = "CREATE TABLE IF NOT EXISTS users ( 
		id int(11) NOT NULL, 
		login varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL, 
		pass varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
		kyka varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
		plan varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '', 
		requests_count int(11) NOT NULL DEFAULT 1, 
		UNIQUE KEY id (id), 
		UNIQUE KEY login (login), 
		KEY kyka (kyka) 
	  ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;"; 
	   
	   $sql_votes = "CREATE TABLE IF NOT EXISTS votes ( 
		user_id int(11) NOT NULL, 
		question_id int(11) NOT NULL, 
		UNIQUE KEY user_id (user_id,question_id) 
	  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;"; 
	   
	   $sql_websites = "CREATE TABLE IF NOT EXISTS websites ( 
		user_id int(11) NOT NULL, 
		domain_name varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL, 
		KEY user_id (user_id),
		UNIQUE KEY domain_name (user_id,domain_name)
	  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";



	dbDelta($sql_questions);
	dbDelta($sql_users);
	dbDelta($sql_votes);
	dbDelta($sql_websites);


}

add_action('switch_theme', 'del_tables');

function del_tables(){
	global $wpdb;

$wpdb->query( "DROP TABLE IF EXISTS questions" );
$wpdb->query( "DROP TABLE IF EXISTS users" );
$wpdb->query( "DROP TABLE IF EXISTS votes" );
$wpdb->query( "DROP TABLE IF EXISTS websites" );

}

add_action('woocommerce_payment_complete', 'add_user_after_payment');

function add_user_after_payment($order_id){
	global $wpdb;
	$current_user = wp_get_current_user();
	$user_login=$current_user->user_login;
	$user_id=$current_user->ID;
	$order = wc_get_order( $order_id );
	$order_items = $order->get_items();
	foreach( $order_items as $item_id => $item ){
		$item_data = $item->get_data();
		$plan_id=$item_data['product_id'];
	}	
	$wpdb->insert( 'users', ['id'=>$user_id, 'login'=>$user_login, 'plan'=>$plan_id]);
}


add_action('wpcf7_submit', 'add_sites');

function add_sites(){
	global $wpdb;
	if (isset($_REQUEST['url-site'])) {
		// выполнять добавление
	$site_name = sanitize_text_field( $_POST['url-site']);
	$user_id = apply_filters( 'determine_current_user', false );
	if ($site_name!=''){
	$wpdb->insert( 'websites', ['user_id'=>$user_id, 'domain_name'=>$site_name]);
	}

	} 


}

add_action('wp_ajax_del_site_from_table', 'delete_row_ajax'); 

function delete_row_ajax() { 
	
	global $wpdb;
	$site_name = sanitize_text_field( $_POST['site_for_del']);
	$user_id = apply_filters( 'determine_current_user', false );
	$wpdb->delete( 'websites', ['user_id'=>$user_id, 'domain_name'=>$site_name]);
	
	} 
			
