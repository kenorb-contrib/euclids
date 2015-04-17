// JS File

var $ = jQuery;

$(document).ready(function(){
    $("#to-top").click(function(){
        $("html, body").animate({ scrollTop: 0 }, 'slow');
    });

    $('<div id="slider_buttons-wrap"><div id="slider_buttons"></div></div>').insertAfter("#slider-wrap");
    $("#block-views-home-page-slider-block").find(".slider_button").each(function () {
        var html = $(this).wrap('<p/>').parent().html();
        $("#slider_buttons").append(html);
        $(this).unwrap().remove();
    });

    $("#slider_buttons").find(".slider_button").first().addClass("active");



    /* Home page banner function */
    $("#block-views-home-page-slider-block .view-content").flexslider({
        animation: "slide",
        useCSS: false,
        smoothHeight: true,
        animationLoop: true,
        itemWidth: 1020,
        itemMargin: 0,
        minItems: 1,
        maxItems: 1,
        slideshowSpeed: 5000,
        after: function(slider){
            console.log(slider);
        }
    });
});
