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
    "href": "https://www.rolf-benz.haus/"
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
});