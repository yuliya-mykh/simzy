
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
    $('.menu-item').click(function(){
        
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


(function($){
    $(document).ready(function() {
        $('.question_title').click(function(event){
        if($('.faq__questions').hasClass('one')){
            $('.question_title').not($(this)).removeClass('active');
            $('.question_text').not($(this).next()).slideUp(300);

        }
            $(this).toggleClass('active').next().slideToggle(300);
        });
      });
      


})(jQuery);

(function($){      

    $('#slider_review').each(function () {

        // Создаем карусель
        var owl = $(this).find('.owl-carousel').owlCarousel({
            items: 1,
            loop: true,
            //nav: true,
            
            autoplay:true,
            
        });
      
     
        // При клике по кнопке Вправо
        $(this).find('.review-item-next').on('click', function () {
          // Перематываем карусель вперед
          owl.trigger('next.owl.carousel');
        });





      
      });



(function($){
    $(document).ready(function () {
        //Convert address tags to google map links - Michael Jasper 2012
        $('address').each(function () {
           var link = "<a href='http://maps.google.com/maps?q=" + encodeURIComponent( $(this).text() ) + "' target='_blank'>" + $(this).text() + "</a>";
           $(this).html(link);
        });
     });

})
})(jQuery);






//popup start
const popupLinks = document.querySelectorAll('.popup-link');
const body=document.querySelector('body');
const lockPadding=document.querySelectorAll('.lock-padding');

let unlock = true;

const timeout = 800;

if(popupLinks.length>0){
    for (let index=0; index < popupLinks.length; index++) {
        const popupLink=popupLinks[index];
        popupLink.addEventListener("click", function (e){
            const popupName=popupLink.getAttribute('href').replace('#','');
            const curentPopup = document.getElementById(popupName);
            popupOpen(curentPopup);
            e.preventDefault();

        });
    }
}
const popupCloseIcon=document.querySelectorAll('.close-popup');
if (popupCloseIcon.length>0){
    for (let index=0; index<popupCloseIcon.length; index++){
        const el = popupCloseIcon[index];
        el.addEventListener('click', function(e){
            popupClose(el.closest('.popup'));
            e.preventDefault();
        });
    }
}

function popupOpen(curentPopup){
    if (curentPopup && unlock){
        const popupActive = document.querySelector('.popup.open');
        if (popupActive){
            popupClose(popupActive, false);
        } else {
            bodyLock();
        }
        curentPopup.classList.add('open');
        curentPopup.addEventListener("click", function(e){
            if(!e.target.closest('.popup__content')){
                popupClose(e.target.closest('.popup'));
            }
        });
        
    }
}

function popupClose(popupActive, doUnlock = true){
    if (unlock) {
        popupActive.classList.remove('open');
        if(doUnlock){
            bodyUnlock();
        }
    }
}

function bodyLock(){
    const lockPaddingValue = window.innerWidth-document.querySelector('.wrapper').offsetWith+'px';
    
    if(lockPadding.length>0){
        for (let index=0; index<lockPadding.length; index++){
            const el=lockPadding[index];
            el.style.paddingRight=lockPaddingValue;
        }
    }
    body.style.paddingRight=lockPaddingValue;
    body.classList.add('lock');

    unlock=false;
    setTimeout(function(){
        unlock=true;
    }, timeout);
}

function bodyUnlock(){
    setTimeout(function(){
        if (lockPadding.length>0){
            for (let index=0; index< lockPadding.length; index++){
                const el=lockPadding[index];
                el.style.paddingRight='0px';

            }
        }   
        body.style.paddingRight='0px';
        body.classList.remove('lock');
    }, timeout);

    unlock=false;
    setTimeout(function(){
        unlock=true;

    }, timeout);
}

document.addEventListener('keydown',function(e){
    if(e.UIEvent.which===27){
        const popupActive=document.querySelector('.popup.open');
        popupClose(popupActive);
    }
});

(function(){
    if (!Element.prototype.closest){
        Element.prototype.closest=function(css){
            var node=this;
            while(node){
                if (node.matches(css)) return node;
                else node = node.parentElement;
            }
            return null;
        };
    }
})();
(function(){
    if (!Element.prototype.matches){
        Element.prototype.matches=Element.prototype.MatchesSelector ||
        Element.prototype.webkitMatchesSelector ||
        Element.prototype.mozMatchesSelector ||
        Element.prototype.msMatchesSelector;
        
    }
})();




//popup end

$('.del_site_link').click(function (e) {
    e.preventDefault();
    let siteName=$(this).parent().parent().parent().children(1).children().attr('href');
    console.log(siteName);
    $('.input_site_name').val(siteName);
});

    $('.yes').click(function (e) {
let site_for_del = $('#input_site_name').val();
console.log('asd');
console.log(site_for_del);

        e.preventDefault();
        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            method: 'POST',
            data: {
                action: 'del_site_from_table',
                site_for_del: site_for_del

            },
            success: function(response) {
            console.log('Запрос успешно отправился, получаем ответ', response);
            location.reload();
            },
            error: function(XHR) {
            console.log('Ошибка запроса', XHR);
            }
        });
        

    });








(function($){ 




var textarea = document.querySelector('textarea');

textarea.addEventListener('keyup', function(){
  if(this.scrollTop > 0){
    this.style.height = this.scrollHeight + "px";
  }
});
});




