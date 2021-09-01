<?php

get_header();
?>



        <div class="wrapper">
        <div class="blog">
                <h1 class="blog__title">search</h1>
                <p>Search Results for: " <?php the_search_query() ?> "</p>

                <div class="blog__body">  

 <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
 <div class="blog__post">
    
    <div class="blog__post_name"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></div>
    <div class="blog__post_cat"><?php the_category(); ?></div>
</div>

 <?php endwhile; else: ?>
 <p>Nothing Found</p>
 <?php endif;?>
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
