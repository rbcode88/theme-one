/* 
Top menu scrolling effect. Adding custom classes and company logo width on scroll.
*/

// $(window).on("scroll", function () {
//     if ($(window).scrollTop()) {
//         $('nav').addClass('white');
//         $('nav').addClass('nav-shrink');
//         document.getElementById("logo").style.width = "50px";

//     }

//     else {
//         $('nav').removeClass('white');
//         $('nav').removeClass('nav-shrink');
//         document.getElementById("logo").style.width = "80px";

//     }
// })

/*
Main image paralax effect on scroll.
*/
var box = $(document),
    bgAnimate = $('div.hero-image');

box.on('scroll', function () {
    var boxAnimate = box.scrollTop();
    bgAnimate.css('background-position', '0' + -boxAnimate / 4 + 'px');
});

// var boxOne = $(document),
//     bgAnimateOne = $('div.page-featured-image');

// boxOne.on('scroll', function () {
//     var boxAnimateOne = boxOne.scrollTop();
//     bgAnimateOne.css('background-position', '0' + -boxAnimateOne / 4 + 'px');
// });


/*
Initialize Aos
*/
AOS.init();

/*
Navigation toggle efects
*/

$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        $('.overlay').addClass('active');
    });
    $('.dismiss, .overlay').on('click', function() {
        $('#sidebar').removeClass('active');
        $('.overlay').removeClass('active');
    });
});
