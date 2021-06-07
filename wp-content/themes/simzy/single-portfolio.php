<?php
/**
 * The template for displaying all single posts
 *

 */
get_header();
?>

<div id="primary" class="content-area">
		<main id="main" class="site-main">
<div class="portfolio_page">
	<div class="wrapper">
		<h2 class="portfolio_title"><?php the_field ('project_title') ?></h2>
		<div class="grid_content">
			<div class="subtitle"><?php the_field ('project_subtitle') ?></div>
			<div class="description"><?php the_field ('project_description') ?></div>
			<div class="project_date"><?php the_field ('project_date') ?></div>
		</div>
			<?php                           
// проверяем есть ли в повторителе данные
if( have_rows('views') ):

 	// перебираем данные
    while ( have_rows('views') ) : the_row();
?>
<div class="view_project">
      		<div class="number"><?php the_sub_field ('view_number') ?></div>
			<div class="view"><?php the_sub_field ('view') ?></div>
			<div class="view_img"><img src="<?php the_sub_field ('view_img') ?>" ></div>
</div>			
			
      
<?php endwhile; 
else :

    // вложенных полей не найдено

endif;

?>
		
		<?php
                                    $more = get_field('more');	
                                     if( $more ): ?>
                                        <div class="more">
                                                    <p class="number"><?php echo $more['more_number']; ?></p>
                                                    <p class="more_caption"><?php echo $more['more_title']; ?></p>
   
                                            
                                        </div>
									<?php endif; ?> 
									
		
		<?php
		                                   // проверяем есть ли в повторителе данные
if( have_rows('more_project_links') ):

	// перебираем данные
   while ( have_rows('more_project_links') ) : the_row();
?>		<a href="<?php the_sub_field ('more_project_link') ?>" class="more_project_link">
			  <div class="more_links">
		   <div class="more_links_date"><?php the_sub_field ('more_project_link_date') ?></div>
		   <div class="more_links_name"><?php the_sub_field ('more_project_link_name') ?></div>
		   <div class="more_links_img"><img src="<?php the_sub_field ('more_project_link_img') ?>"></div>
		   <div class="more_links_description"><?php the_sub_field ('more_project_link_description') ?></div>
	   </div>          
	   </a>
<?php endwhile; 
else :

   // вложенных полей не найдено

endif;

?>      


		
			
		
	</div>
</div>
			






		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();
