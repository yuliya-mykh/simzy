<?php


get_header('login');
?>
<div class="dashboard">
<div class="wrapper">
<div class="hello-first">
<p><?php echo "Hello, ". wp_get_current_user()->user_login;?></p>
</div>
<div class="dashboard-title">
    
    <div class="header_logo">
                        <a href="<?php echo get_home_url(); ?>" class="header_logo_link">
                        <img src="<?php the_field ('logo_black', 'options') ?>" alt="logo" class="haeder_logo_pic">
                        </a>
    </div>
<div class="dashbord_caption"><?php the_title() ?></div>    
</div>
<div class="hello">
<div class="addsite"><a href="#popup_AddSite" class="popup-link">Add site</a></div>    
<p><?php echo "Hello, ". wp_get_current_user()->user_login;?></p>

</div>

<?php
echo do_shortcode( '[theme-my-login show_links="0"]' );
?>
<div class="addsites">
<?php
global $wpdb;
$user_count = $wpdb->get_var( "SELECT COUNT(*) FROM users;" );
//echo '<p>Количество пользователей равно: ' . $user_count . '</p>';
$user_id = apply_filters( 'determine_current_user', false );
$sites = $wpdb->get_results( "SELECT domain_name FROM websites WHERE user_id = $user_id" );
$site_num=0;
foreach ( $sites as $site ) {
    ?>
    <div class="addsites__row">
                <div class="addsities__num">/0<?php echo ++$site_num ?></div>
                <div class="addsities__name"><a href="<?php echo $site->domain_name; ?>"><?php echo $site->domain_name;?></a></div>
                <div class="addsites__links">
                    
                    <div class="removesite">
                    <a href="#popup_del" class="popup-link del_site_link"></a>
                    </div>
                </div>
    </div>
    <?php
}



?>



<div class="exit"><a href="https://simyz.com/logout/?_wpnonce=f20663e096">EXIT DASHBOARD</a></div>           
</div>

</div>



<div id="popup_del" class="popup">
        <div class="popup__body">
            <div class="popup__content">
                <a href="#!" class="popup__close close-popup">close</a>
                <div class="popup__title">
                    do you really <br> want to <span>delete</span> <br> the site?
                </div>
                <div class="popup__links">
                <form ><input type="hidden" id="input_site_name" class="input_site_name" name="site_for_del" value="">
                <button class="del_site yes">Yes, i do</button></form>
                    
                    <a href="#!" class="no close-popup">NO, i don`t</a>
                </div>


            </div>
        </div>
</div>
<div id="popup_AddSite" class="popup">
        <div class="popup__body">
            <div class="popup__content">
                <a href="#!" class="popup__close close-popup">close</a>
                <p class="title_popup">Enter url of your site </p>
                <?php
                echo do_shortcode( '[contact-form-7 id="435" title="Add site"]' );
                ?>
                


            </div>
        </div>
</div>
</div>
<?php
get_footer();
