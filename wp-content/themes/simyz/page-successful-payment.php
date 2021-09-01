<?php


get_header('login');
?>
<div class="signup">
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



<div class="login_form singup">

<div class="message">
<div class="message__body">
<h1>Your payment has <span>been sent</span></h1>
<p>Thank you!</p> 

</div>
<div class="message__link"><a href="http://simyz.com/dashboard">GO MY PAGE</a></div>
</div>





</div>

</div>
</div>
</div>
<?php
get_footer();
