/* 
Top menu scrolling effect. Adding custom classes and company logo width on scroll.
*/

$(window).on("scroll", function () {
    if ($(window).scrollTop()) {
        $('nav').addClass('white');
        $('nav').addClass('nav-shrink');
        document.getElementById("logo").style.width = "50px";

    }

    else {
        $('nav').removeClass('white');
        $('nav').removeClass('nav-shrink');
        document.getElementById("logo").style.width = "80px";

    }
})

/*
Main image paralax effect on scroll.
*/
var box = $(document),
    bgAnimate = $('div.hero-image');

box.on('scroll', function () {
    var boxAnimate = box.scrollTop();
    bgAnimate.css('background-position', '0' + -boxAnimate / 4 + 'px');
});
