<?php
/**
 * The template for displaying all single posts
 *

 */
get_header();
?>

<div id="primary" class="content-area">
		<div id="main" class="site-main">
			<div class="plans_page">
			<div class="intro_plans">
            <span class="ring one"></span>
            <span class="ring two"></span>
            <span class="ring tree"></span>
                <div class="wrapper intro_cont">
                    <div></div>
                    <div class="intro_text">
                            <h1 class="plans_caption"><?php the_field ('title_plans') ?></h1>
                            <div class="plans_caption_link">VIEW  <span></span> unlimited plan</div>
                            
                    </div> 
                </div>
            </div>





			</div>
		</div><!-- #main -->
</div><!-- #primary -->
                        
<div class="our_plans">
    <div class="wrapper">
            <div class="our_plans__caption"><?php the_field ('our_plans_caption') ?>
            </div>
            

<?php

// проверяем есть ли в повторителе данные
if( have_rows('plan_block') ):

 	// перебираем данные
    while ( have_rows('plan_block') ) : the_row();
?>
        <div class="our_plans__blok">


            <div class="blok_num"><?php the_sub_field ('plan_number') ?></div>    
                    
            <div class="blok_name"><?php the_sub_field ('plan_name') ?></div>   
                

            <div class="blok_desk">  
                
            
                <?php
                // проверяем есть ли в повторителе данные
            if( have_rows('specification_item') ):

             	// перебираем данные
            while ( have_rows('specification_item') ) : the_row();
            ?>
                        <div class="specification"> 
                            
                        <?php
		
                            // переменные
                            $item = get_sub_field('specification_item_title');	

                            if( $item ): ?>
                                <div class="specification_name"><?php echo $item['specification_item_name'] ?>  </div>
                                    <?php if( $item['specification_item_check'] ): ?>
                                    
                                    <div class="specification_check">+</div>
                                    <?php else: ?>
                                    <div class="specification_check">-</div>  
                                    <?php endif; ?>  
                                
                            <?php endif; ?>
                        </div>
                        

            <?php endwhile; 
            else :

                // вложенных полей не найдено

            endif;

            ?>


            <div class="total">
                    <?php
                    
                    // переменные
                    $total = get_sub_field('total');	
            if( $total ): ?>
                            <div class="total__cap"><?php echo $total['total_title'] ?>  </div>
                            <div class="total__sum"><?php echo $total['total_sum'] ?>  </div>
            <?php endif; ?>
            </div>
            <div class="order_plan all_links"><a href="<?php the_sub_field ('order_plan_link') ?>">order <span></span>this plan</a></div>


        </div>
            </div>

    <?php endwhile; 
else :

    // вложенных полей не найдено

endif;

?>


    </div>
</div>
                
                
                    
                        
                    

            
    <div class="clients">
        <div class="wrapper">
            <div class="clients__caption">
                <?php the_field ('clients_title') ?>               
            </div>
            <div class="clients__body">
                <div class="clients__body_gif"><img src="<?php the_field ('clients_img') ?>  " alt=""></div>
                <div class="clients__brands">
                
                <?php
// проверяем есть ли в повторителе данные 
if( have_rows('brands') ):

             	// перебираем данные
            while ( have_rows('brands') ) : the_row();
            ?>
                <p><?php the_sub_field ('brand_name') ?></p>      
                        

            <?php endwhile; 
            else :
// вложенных полей не найдено

endif;
?>

                
                </div>
            </div>
            
        </div>
    </div>
    <div class="review">
        <div class="wrapper review_content" id="slider_review">
            <div class="review__caption">
            <?php the_field ('review_title') ?>    
            </div>

            <div class="owl-carousel owl-carousel_review " >

            <?php
// проверяем есть ли в повторителе данные 
if( have_rows('slider_item') ):

             	// перебираем данные
            while ( have_rows('slider_item') ) : the_row();
            ?>
            <div class="review__body" > 
                    
                            
                    <div class="review__body_img">
                        <img src="<?php the_sub_field ('review_img') ?>">
                    </div>
                    <div class="review__body_desc">
                        <div class="review__body_text"><?php the_sub_field ('review_text') ?></div>
                        <div class="review__body_name"><?php the_sub_field ('review_writer_name') ?></div>
                        <div class="review__body_occupation"><?php the_sub_field ('review_writer_occupation') ?></div>
                        
                    </div>
            </div>

            <?php endwhile; 
            else :
// вложенных полей не найдено

endif;
?>


</div>
            
            
            <div class="link_nextReview carusel_link review-item-next next">READ<span></span>NEXT</div>        
        </div>
    </div>
    <div class="faq">
        <div class="wrapper">
            <div class="faq__caption">
            <?php the_field ('faq_title') ?>
            </div>
            <div class="faq__questions one">
                <style>
                    .faq__questions::after {
                        content: url(<?php the_field ('faq_img_cursor') ?>);
                        position: absolute;
                        top: -60px;
                        left: 60%;
                }
                </style>

<?php
// проверяем есть ли в повторителе данные 
if( have_rows('question') ):

             	// перебираем данные
            while ( have_rows('question') ) : the_row();
            ?>
                        
                    
                    <div class="faq__question">
                    <div class="question_title">
                        <div class="question_title_num"><?php the_sub_field ('question_number')?> </div>
                        <div class="question_title_text"><?php the_sub_field ('question_name')?> </div>
                    </div>
                    <div class="question_text ques"><div class="quest"><p><?php the_sub_field ('question_body')?> </p></div></div>
                </div>   

            <?php endwhile; 
            else :
// вложенных полей не найдено

endif;
?>





            </div>
        </div>
    </div>



<?php
get_footer('form');
