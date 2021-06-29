
(function($){

  
/*	var $page = $('html, body');
$('a[href*="#"]').click(function() {
    $page.animate({
        scrollTop: $($.attr(this, 'href')).offset().top
    }, 400);
    return false;
});*/

$(document).ready(function() {
    $('.menu-burger_header').click(function() {
        $('.menu-burger_header').toggleClass('open-menu');
        $('.header_nav').toggleClass('open-menu');
    });
});

    $('#js-carousel-skills').each(function () {

        // Создаем карусель
        var owl = $(this).find('.owl-carousel').owlCarousel({
            items: 6,
            loop: true,
            //nav: true,
            margin:31,
            autoplay:true,
            responsive:{ //Адаптивность. Кол-во выводимых элементов при определенной ширине.
                1024:{
                    margin:15,
                },
                768:{
                    items:6
                },
                200:{
                    items:3
                }
            }
        });
      
     
        // При клике по кнопке Вправо
        $(this).find('.carousel-item-next').on('click', function () {
          // Перематываем карусель вперед
          owl.trigger('next.owl.carousel');
        });





      
      });

      $('.burger').click(function(e) {
        e.preventDefault();
        $('.header_nav').addClass('header_nav_active');
      }); 
    
    $('.header_nav-close').click(function(e){
        e.preventDefault();
        $('.header_nav').removeClass('header_nav_active');
    });
    $('.header_list li a').click(function(e){
        e.preventDefault();
        $('.header_nav').removeClass('header_nav_active');
    });



}) (jQuery);    
    function isClickable( obj, newTab ){
        var $this = obj,
            link = $this.find('a:first'),
            href = link.attr('href'),
            target = link.attr('target');

        if (href == undefined) {
            return;
        }
        if (target == '_blank' || newTab) {
            window.open(href);
        } else {
            window.location.href = href;
        }
    }


(function($){
    $(document).ready(function() {
        moveLink();
      });
      
      $(window).resize(function() {
        moveLink();
      });
      function moveLink() {  
    if ($(window).width() <= 767) {
        $('.work_content').on('click', function (evt) {
            if (!$(evt.target).is('a')) {
                isClickable($(this));
            }
        });
    }
}

})(jQuery);
      





