$(".flexislider").each(function(index, element){
    
    var $data = $(this).attr('data-uid');
    var $speed = $(this).attr('data-speed');
    var swiper = new Swiper(".swiper-" + $data, {
        slidesPerView: 1,
        spaceBetween: 30,
        effect: 'fade',
        speed: 1500,
        loop: true,
        enabled: true,
        autoplay: {
            delay: $speed,
            disableOnInteraction: true,
            pauseOnMouseEnter: true,
        },
        keyboard: {
            enabled: true,
        }
    });
});

var swiper = new Swiper('.swiper-container', {
        slidesPerView: 1,
        spaceBetween: 30,
        keyboard: {
            enabled: true,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
});

window.addEventListener("load", function(){
window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "#323232",
      "text": "#ffffff"
    },
    "button": {
      "background": "#f1d600"
    }
  },
  "content": {
    "message": "Um unsere Website für Sie optimal zu gestalten verwenden wir Cookies. Weitere Informationen/Datenschutzerklärung",
    "dismiss": "OK",
    "link": "Lern mehr",
    "href": "https://www.rolf-benz.haus/datenschutz"
  }
})});

/*
$(document).ready(function() {
    $("#menu").mmenu();
   // new Mmenu( document.querySelector( '#menu' ) );
        
});
*/
document.addEventListener(
    "DOMContentLoaded", function() {
    new Mmenu("#menu", {
       // options
    }, {
       // configuration
       classNames: {
          fixedElements: {
             fixed: "fix",
             sticky: "stick"
          }
       }
    })});
   
$(document).ready(function(){
    $('#tx-indexedsearch-searchbox-sword').on('blur', function (){
       if ($('#tx-indexedsearch-searchbox-sword').val()!='') {
          $('#top-search-lbl').html(''); 
       }
    });
    
    var hovertitle;
    var hoversrc;
    $('.icon-mouse-event').on('mouseenter', function (){
     
        hovertitle = $(this).find('img').attr('src');
        hoversrc = $(this).find('img').attr('data-title');
        $(this).find('img').attr('src', hoversrc);
        $(this).find('img').attr('data-title', hovertitle);
        
    });
    $('.icon-mouse-event').on('mouseleave', function (){
        hoversrc = $(this).find('img').attr('data-title');
        hovertitle = $(this).find('img').attr('src');
        $(this).find('img').attr('src', hoversrc);
        $(this).find('img').attr('data-title', hovertitle);
    });
    var nicon = '/typo3conf/ext/armaimeos/Resources/Public/Icons/info-button-black.png';
    var hicon = '/typo3conf/ext/armaimeos/Resources/Public/Icons/info-button-white.png';
    var mouseX, mouseY;
    
    $(document).mousemove(function(e) {
        mouseX = e.pageX;
        mouseY = e.pageY;
    }); 
    
    
    $('.arminfo').on('click', function(){
       $(this).css("background-image", "url(" + hicon + ")");
       $(this).siblings('.arm-aimeos-info').show();
       
    });
    $('.arm-aimeos-info').on('click', function (){
       $(this).hide(); 
       $('.arminfo').css("background-image", "url(" + nicon + ")");
    });
    
    $('.contact-form').submit(function(event){
        $(this).find('.cta').addClass('disabled');
       // $(this).find('.cta').attr('disabled', true);
    });
    

    $('.openinmodal').on('click', function(){
        var eluid = $(this).attr('data-uid');
        document.getElementById('img-'+eluid).src = $(this).attr("src");
        $('#my-'+eluid).show();
        document.getElementById('caption-'+eluid).innerHTML = this.alt;
    });
    
    $('.modalclose').on ('click', function (){
        var eluid = $(this).attr('data-uid');
        $('#my-'+eluid).hide();
    });
});