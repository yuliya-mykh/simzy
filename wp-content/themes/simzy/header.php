<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painful so he an comfort is manners</title>
 
<?php wp_head(); ?>
</head>
<body>
            <header class="header">
            
    
                <div class="header_wrapper">
                    <div class="header_logo">
                        <a href="<?php echo get_home_url(); ?>" class="header_logo_link">
                        <img src="<?php the_field ('logo', 'options') ?>" alt="logo" class="haeder_logo_pic">
                        </a>
                    </div>
                    <div class="header_nav_all">
                        <nav class="header_nav">
							<?php
						wp_nav_menu( [
                                'theme_location'  => '',
                                'menu'            => 'Header Menu', 
                                'container'       => 'ul', 
                                'container_class' => 'header_list', 
                                'container_id'    => '',
                                'menu_class'      => 'header_list', 
                                'menu_id'         => '',
                                'echo'            => true,
                                'fallback_cb'     => 'wp_page_menu',
                                'before'          => '',
                                'after'           => '',
                                'link_before'     => '',
                                'link_after'      => '',
                                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                'depth'           => 0,
                                'walker'          => '',
							] );
							?>
                        </nav>
                        <div class="header_burger burger">
                            <span class="burger_line burger_line_first"></span>
                            <span class="burger_line burger_line_second"></span>
                            <span class="burger_line burger_line_third"></span>
                        </div>
                    </div>
                </div>
              
        </header>
