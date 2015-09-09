$(document).ready(function(){
        
    $(".owl-carousel").owlCarousel({
        loop : true,
        responsive : {
            0 : {
                items : 1,
                nav : true,
            }
        },
        navText : ["&lt;","&gt;"],
        autoplay: true,
        autoplayTimeout : 20000,
    });
});