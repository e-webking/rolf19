$(document).ready(function() {
    new Mmenu( document.querySelector( '#menu' ) );
        document.addEventListener( 'click', ( evnt ) => {
            let anchor = evnt.target.closest( 'a[href^="#/"]' );
            if ( anchor ) {
                alert('Thank you for clicking, but that\'s a demo link.');
                evnt.preventDefault();
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
    "href": "https://www.rolf-benz.haus/"
  }
})});