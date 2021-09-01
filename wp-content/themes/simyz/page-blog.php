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
                    'style'              => none,
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
                        <li><a href="http://simyz.com/blog" class="all">All</a></li>
                        <li><?php wp_list_categories($args);?></li>
                        
                        
                    </ul>
                </div>
                <div class="blog__body">

                <?php 
                /*
                // параметры по умолчанию
                $posts = get_posts( array(
                    'numberposts' => 0,
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

                    <div class="blog__post">
                        <div class="blog__post_img"><a href="<?php the_permalink() ?>"><img src="<?php the_field ('post_img') ?>" alt=""></a></div>
                        <div class="blog__post_name"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></div>
                        <div class="blog__post_cat"><?php the_category(); ?></div>
                    </div>

                    <?php
                }
                
                wp_reset_postdata(); // сброс

                   

the_posts_pagination();

 ?>

<div class="pag"></div>
111111
<?php
$query = new WP_Query( [
	'post_type'      => 'post',
	'posts_per_page' => 10,
	'paged'          => get_query_var( 'page' ),
] );

// Обрабатываем полученные в запросе продукты, если они есть
if ( $query->have_posts() ) {

	while ( $query->have_posts() ) {
		$query->the_post();

		// выводим заголовок
		the_title();
	}

	wp_reset_postdata();
}

// Выводим пагинацию, если продуктов больше запрошенного количество
echo paginate_links( [
	'base'    => user_trailingslashit( wp_normalize_path( get_permalink() .'/%#%/' ) ),
	'current' => max( 1, get_query_var( 'page' ) ),
	'total'   => $query->max_num_pages,
] );
*/ 
?>
<?php/*
  if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } else if ( get_query_var('page') ) {$paged = get_query_var('page'); } else {$paged = 1; }

    $args = array(
        'post_type'         => 'post',
        'post_status'       => 'publish',
        'paged'             => $paged,
        'posts_per_page'    => 10
    );
    $temp = $wp_query;
    $wp_query= null;
    $wp_query = new WP_Query($args);
    while ($wp_query -> have_posts()) : $wp_query -> the_post();
    ?>
    <div class="blog__post">
    <div class="blog__post_img"><a href="<?php the_permalink() ?>"><img src="<?php the_field ('post_img') ?>" alt=""></a></div>
    <div class="blog__post_name"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></div>
    <div class="blog__post_cat"><?php the_category(); ?></div>
</div>
<?php
    endwhile;
?>
    <div class="cat-pagination">
    <?php wp_pagenavi( array( 'query' => $queryall ) ); ?>
</div>
<?php
    the_posts_pagination( array('mid_size' => 3) );

    $wp_query = null;
    $wp_query = $temp;
    wp_reset_query();
    
?>
*/
?>
<?php

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$args = array(
    'posts_per_page' => -1, //исправить на количество выводимых записей при пагинации
    'paged'          => $paged,
    'offset' => 0,
    
    'post_status' => 'publish'
);
$queryall = new WP_Query($args);

if ($queryall->have_posts()) :  
    while ($queryall->have_posts()) : $queryall->the_post();

    ?>

                    <div class="blog__post">
                        <div class="blog__post_img"><a href="<?php the_permalink() ?>"><img src="<?php the_field ('post_img') ?>" alt=""></a></div>
                        <div class="blog__post_name"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></div>
                        <div class="blog__post_cat"><?php the_category(); ?></div>
                    </div>

                                        

                    <?php
 endwhile;
endif;
 ?>
 <!--
<div class="cat-pagination">
    <?php// wp_pagenavi( array( 'query' => $queryall ) ); ?>
</div>
-->

                </div>
            </div>
        </div>
    


        <?php
get_footer();
