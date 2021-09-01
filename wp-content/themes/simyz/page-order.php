<?php
/*
Template Name: order

*/
get_header();
?>
<div class="wrapper">
<div class="order">
<div class="woocommerce">
        <span><?php echo do_shortcode( '[woocommerce_checkout]' ) ?></span>

</div>
</div>
</div>