function tabs(e,number) {
    document.getElementById("cinema").style.left = -number*33.33+"%";
}
function tabs1(e,number) {
    document.getElementById("cinema1").style.left = -number*556+"px";
}

$( document ).ready(function() {
    new WOW().init();
});

var mybutton = document.getElementById("myBtn");
window.onscroll = function() {scrollFunction()};
function scrollFunction() {
    var height = $(window).scrollTop();
    if (height > 100) {
        $('#myBtn').fadeIn();
    } else {
        $('#myBtn').fadeOut();
    }
}
function topFunction() {
    $("#myBtn").click(function(event) {
        event.preventDefault();
        $("html, body").animate({ scrollTop: 0 }, "slow");
        return false;
    });
};
$('.main-menu').mouseenter(function(){
    $(this).find('.sub-menu').slideDown("slow");
});
$('.main-menu').mouseleave(function(){
    $(this).find('.sub-menu').slideUp();
});