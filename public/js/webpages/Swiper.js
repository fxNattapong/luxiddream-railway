// START SLIDER
const swiper = new Swiper('.swiper', {
    loop: true,
    speed: 300,
    spaceBetween: 100,
    
    // autoplay: {
    //     delay: 2500,
    //     disableOnInteraction: false,
    // },

    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
  
    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
  
    // And if we need scrollbar
    scrollbar: {
        el: '.swiper-scrollbar',
    },
});
// END SLIDER