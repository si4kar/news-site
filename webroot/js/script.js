$(document).ready(function(){
    $('.bxslider').bxSlider({
        mode: 'horizontal',
        moveSlides: 1,
        slideMargin: 40,
        infiniteLoop: true,
        slideWidth: 660,
        minSlides: 3,
        maxSlides: 3,
        speed: 800
    });
});



$(function(){
    $('.bxslider').bxSlider({
        mode: 'fade',
        captions: true,
        slideWidth: 600
    });
});