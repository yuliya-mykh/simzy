<footer class="contact_form">
        <span class="ring one"></span>
        <span class="ring two"></span>
        <span class="ring tree"></span>
        <div class="wrapper">
            <div class="contact_form_caption"><?php the_field ('contacts_title', 'options') ?></div>
            <div class="form">
                
                <div class="contacts">
                    <p>Adress</p>
                    <div class="adress_blok">
                        
                        <address><?php the_field ('address', 'options') ?></address>
                        <div class="phone"><a href="tel:<?php the_field ('phone', 'options') ?>"><?php the_field ('phone', 'options') ?></a></div>
                    </div>
                    <br>
                    <div class="form_link"><a href="#popup" class="popup-link">WRITE <span></span> TO US</a></div>
                    <div class="form_popup">
                            
                                <div id="popup" class="popup">
                                        <div class="popup__body">
                                            <div class="popup__content">
                                                <a href="#!" class="popup__close close-popup">close</a>
                                                <?php echo do_shortcode( '[contact-form-7 id="156" title="Contact-Form"]' ) ?>

                                            </div>
                                        </div>
                                    </div>
                    </div>
                    

                </div>
                <div class="map"><iframe src="<?php the_field ('map', 'options') ?>" style="border:0;" height="380" width="100%" allowfullscreen="" loading="lazy"></iframe></div>
            </div>
        </div>
    
</footer>
		</div>
		
	<?php wp_footer(); ?>	

</body>
</html>


