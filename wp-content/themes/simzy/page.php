<?php
/*
Template Name: page-home
*/

get_header();
?>

<div class="main">
            
            <div class="intro">
                <div class="wrapper intro_cont">
                    <div></div>
                    <div class="intro_text">
                            <h1 class="main_caption"><?php the_field ('main_title') ?></h1>
                            <style>
                                .main_caption span{
                                color:<?php the_field ('main_title_span_color') ?>;
                            }
                            </style>
                    </div> 
                </div>
            </div>
            <section class="studio" id="studio">
                <div class="wrapper">
                    
                        <div class="studio_caption all_caption">
                            <p class="number_section">01</p>
                            <h2 class="caption_name"><?php the_field ('title_1') ?></h2>
                        </div>
                        <div class="studio_content">
                            <p class="cont_part1"><?php the_field ('text_1_left') ?></p>
                            <p class="cont_part2"><?php the_field ('text_1_right') ?></p>
                        </div>
                        <div class="studio_data">
                            <img src="<?php the_field ('img_studio') ?>" alt="studio" class="studio_img">
                            <div class="studio_count">
                                <div class="line1">
                                   

                                    <?php
                                    $design_place = get_field('design_place');	
                                     if( $design_place ): ?>
                                        <div id="design_place" class="design_place">
                                                    <p class="count"><?php echo $design_place['quantity_1']; ?></p>
                                                    <p class="name"><?php echo $design_place['description_1']; ?></p>
                                            
                                            
                                        </div>
                                    <?php endif; ?>

                                    <?php
                                    $years_old = get_field('years_old');	
                                     if( $years_old ): ?>
                                        <div id="years_old" class="years_old">
                                                    <p class="count"><?php echo $years_old['quantity_2']; ?></p>
                                                    <p class="name"><?php echo $years_old['description_2']; ?></p>
                                            
                                            
                                        </div>
                                    <?php endif; ?>   
                                   
                                </div>
                                    
                                    
                                <div class="line2">

                                <?php
                                    $designer = get_field('designer');	
                                     if( $designer ): ?>
                                        <div id="designer" class="designer">
                                                    <p class="count"><?php echo $designer['quantity_3']; ?></p>
                                                    <p class="name"><?php echo $designer['description_3']; ?></p>
                                            
                                            
                                        </div>
                                    <?php endif; ?> 
                                    
                                    <?php
                                    $projects = get_field('projects');	
                                     if( $projects ): ?>
                                        <div id="projects" class="projects">
                                                    <p class="count"><?php echo $projects['quantity_4']; ?></p>
                                                    <p class="name"><?php echo $projects['description_4']; ?></p>
                                            
                                            
                                        </div>
                                    <?php endif; ?> 
                                    
                                    
                                </div>
                            </div>
                        </div>
                    
                </div>
            </section>
            <section class="service" id="service">
                <div class="wrapper">
                        <div class="service_caption all_caption">
                            <p class="number_section">02</p>
                            <h2 class="caption_name"><?php the_field ('title_2') ?></h2>
                        </div>
                        <div class="service_data">
                            <div class="service_img">
                                <img src="<?php the_field ('service_img') ?>" alt="service">
                            </div>
                            <div class="service_content">
                                <p> <span><?php the_field ('indention') ?></span><?php the_field ('service_text') ?></p>
                            </div>
                        </div>
                    
                    <div class="service_list">
                        <div class="service_item">

<?php

// проверяем есть ли в повторителе данные
if( have_rows('service_item') ):

 	// перебираем данные
    while ( have_rows('service_item') ) : the_row();
?>
       <div class="service_item_name">
        <p class="item_number"><?php the_sub_field ('item_number') ?></p>
        <p class="item_name"><?php the_sub_field ('item_name') ?></p>
                                
        <img class="service_img_item" src="<?php the_sub_field ('item_img') ?>">
         </div>                  

<?php endwhile; 
else :

    // вложенных полей не найдено

endif;

?>



                         
                        </div>
                        
                    </div>
                </div>
            </section>
            <section class="skills">
                <div class="wrapper">
                    <div class="skills_caption all_caption">
                        <div class="skills_caption_left-part">
                            <p class="number_section">03</p>
                            <h2 class="skills_caption_name"><?php the_field ('title_3') ?></h2>  
                        </div>
                        <div class="skills_caption_right-part">
                            <p class="skills_caption_text">
                            <?php the_field ('subtitle') ?>
                            </p>
                        </div>
                    </div>
                    <div class="skills_carousel">
                        <div id="js-carousel-skills">

                            
                            <div class="owl-carousel">

<?php                           
// проверяем есть ли в повторителе данные
if( have_rows('carousel') ):

 	// перебираем данные
    while ( have_rows('carousel') ) : the_row();
?>
       <?php if( get_sub_field('atr_new') ): ?>
	
        <div class="carousel-item "><div class="carousel_item_in cool_item"><img src="<?php the_sub_field ('carousel_item') ?>" class="carousel-item_img col_img"></div></div>
       <?php else: ?>

        <div class="carousel-item"><div class="carousel_item_in"><img src="<?php the_sub_field ('carousel_item') ?>" class="carousel-item_img"></div></div> 

        <?php endif; ?>
       
<?php endwhile; 
else :

    // вложенных полей не найдено

endif;

?>
   
                            </div>

                            <div class="carousel-item-next"><div class="next_skills">VIEW <span class="next_skills_line"></span> next skills</div></div>
                          
                          </div>
                    </div>
                </div>
            </section>
            
            <section class="work" id="works">
                <div class="wrapper">
                    <div class="work_caption all_caption">
                        <p class="number_section">04</p>
                        <h2 class="caption_name"><?php the_field ('title_4') ?></h2>
                    </div>
<?php                           
// проверяем есть ли в повторителе данные
if( have_rows('work_example') ):

 	// перебираем данные
    while ( have_rows('work_example') ) : the_row();
?>
       <div class="work_example">
                            <div class="work_content">
                                <img src="<?php the_sub_field ('project_img') ?>" alt="Task Management" class="link_img">
                                <div class="work_link"><a href="<?php the_sub_field ('project_link') ?>" id="link_img_a1">VIEW <span class="work_link_line"></span> the project</a></div>
                                <div class="work_name"><p><?php the_sub_field ('project_name') ?></p></div>
                                <div class="work_description"><p><?php the_sub_field ('project_desc') ?></p></div>
                                <div class="work_date"><p><?php the_sub_field ('project_date') ?></p></div>
                                
                            </div>
                        </div>
       
<?php endwhile; 
else :

    // вложенных полей не найдено

endif;

?>
                    
                       
                    
                </div>
            </section>

            <div class="contact_form">
                <div class="wrapper">
                    <div class="contact_form_caption">For any enquiries, or just to say hello</div>
                  <!--<?php echo do_shortcode('[contact-form-7 id="147" title="Contact Form"]'); ?> -->
                    <div class="form">
                        <div></div>
                        <div class="contacts">
                            <div class="email_form">
                                <p class="email">Email</p>
                                <div class="write_to_us">
                                    <a href="mailto:hello@simyz.com"><p>hello@simyz.com</p><img src="<?php echo get_template_directory_uri(); ?>/img/courser_write_to_us.png" alt="write_to_us" class="button_write_to_us"></a>
                                </div>
                            </div>
                            <div class="phone_form">
                                <p class="phone">Phone</p>
                                <div class="phone_to_us">
                                    <a href="tel:+380990000000"><p>+38 099 000 00 00</p></a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
    </div>
<?php
get_footer();
