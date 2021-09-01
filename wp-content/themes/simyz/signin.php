<?php


get_header('login');
?>
<div class="wrapper">
<div class="login-body">
    <div class="login-left">
    <div class="header_logo">
                        <a href="<?php echo get_home_url(); ?>" class="header_logo_link">
                        <img src="<?php the_field ('logo', 'options') ?>" alt="logo" class="haeder_logo_pic">
                        </a>
    </div>
    <div class="login-img">
        <img src="<?php the_field ('login_img', 'options') ?>" alt="">
    </div>
</div>



<div class="login_form">
<div class="member">Not a member?<a href="http://simyz/sign-up/"> Sign up now</a></div>
<div class="logo_title"><?php the_title() ?></div>
<?php
echo do_shortcode( '[theme-my-login show_links="0"]' );
?>
</div>

</div>
</div>
<?php
get_footer();