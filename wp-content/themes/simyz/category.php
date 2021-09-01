<?php

get_header();
?>

        <div class="wrapper">
        <div class="blog">
                <h1 class="blog__title">blog</h1>
                <div class="blog__catMenu">

                <?php $args = array(
                    'show_option_all'    => '',
                    'show_option_none'   => __('No categories'),
                    'orderby'            => 'name',
                    'order'              => 'ASC',
                    'style'              => 'list',
                    'show_count'         => 0,
                    'hide_empty'         => 1,
                    'use_desc_for_title' => 0,
                    'hierarchical'       => 0,
                    'title_li'           => '',
                    'number'             => NULL,
                    'echo'               => 1,
                    'depth'              => 0,
                    'current_category'   => 0,
                    'pad_counts'         => 0,
                    'taxonomy'           => 'category',
                    'walker'             => 'Walker_Category',
                    'hide_title_if_empty' => false,
                    'separator'          => '',
                );?>
                    <ul>
                        <!--<li><a href="http://simyz.com/blog" class="notAll">All</a></li>-->
                        <?php wp_list_categories($args);?>
                        
                        
                    </ul>
                </div>
                <div class="blog__body">

                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>


                <!-- Цикл WordPress -->
                <div class="blog__post">
                        <div class="blog__post_img"><a href="<?php the_permalink() ?>"><img src="<?php the_field ('post_img') ?>" alt=""></a></div>
                        <div class="blog__post_name"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></div>
                        <div class="blog__post_cat"><?php the_category(); ?></div>
                    </div>


                        <?php endwhile; ?>

                        
                        <?php endif; ?>
                    
                        
                    
                </div>
                <div class="pagin"><?php 
                    the_posts_pagination( array(
                        'mid_size' => 2,
                        'prev_text'=> __('<'),
	                    'next_text'=> __('>'),
                    ) ); 
                    ?></div>
            </div>
        </div>
    


        <?php
get_footer();
