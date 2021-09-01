<?php
/*
Template Name: post for blog
Template Post Type: post
*/
get_header();
?>

        <div class="wrapper">
            <div class="post">
                <div class="post__title">
                    <div class="post__date"><?php the_time('F')?><span><?php the_time('j. Y') ?></span></div>
                    <div class="post__desk">
                            <h1 class="caption">
                                
                                <?php $category = get_the_category();
                                
                                echo $category[0]->name;?> 
                                :
                                <?php the_title() ?>
                                
                            </h1>
                            <div class="category"><?php the_category(); ?></div>
                            <div class="author"><?php the_field ('author') ?></div>
                    </div>   
                </div>
                <div class="post__img"><img src="<?php the_field ('post_img') ?>" alt=""></div>
                <div class="post__body"><?php the_content() ?>
                </div>
            

                <div class="morePosts">
                    <div class="morePosts__caption">more</div>


<?php 
// параметры по умолчанию
$posts = get_posts( array(
	'numberposts' => 3,
	'category'    => 0,
	'orderby'     => 'date',
	'order'       => 'DESC',
	'post_type'   => 'post',
	'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
) );

foreach( $posts as $post ){
	setup_postdata($post);
    // формат вывода the_title() ...
    ?>

<div class="morePosts__item">
                        <div class="morePosts__item_date">/<?php the_time('Y') ?></div>
                        <div class="morePosts__item_name"><a href="<?php the_permalink() ?>"><?php the_title() ?></a>  </div>
                        <div class="morePosts__item_cat"><?php the_category(); ?></div>
                    </div>

    <?php
}

wp_reset_postdata(); // сброс

?>

                    

                </div>
            </div>
        </div>
    


        <?php
get_footer();
