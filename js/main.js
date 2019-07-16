jQuery(document).ready(function($){
    
    // NavBar Menu Collapse
    $('.dropdown').on('mouseenter',function(){
        $(this).addClass('open',500);
    });
    $('.dropdown').on('mouseleave',function(){
        $(this).removeClass('open',500);
    });

    // Back-top Button
    $('.back-top').on('click',function() {
        $('html,body').animate({scrollTop: 0}, 700);
    });

    // Search Form Collabse
    $('.searchform i').on('click',function(){
        var Width = $('.searchform .form-control').width() != '0' ? '0' : '100';
        $('.searchform .form-control').css('width',Width + '%');
    });

    $('.searchform input:text').addClass('form-control').attr('placeholder','Hit enter to search');
    $('select, input:text').addClass('form-control');
    // Wrap Iframe
    $('iframe').wrap('<div class="iframe-container"></div>');

    $('.gallery br').remove();
    $('<br style="clear:both;">').insertAfter('.gallery');
    $('<br style="clear:both;">').insertBefore('.aladdin-social');

    $('.gallery:has(.gallery-item)').wrapInner('<div class="owl-carousel owl-theme owl-carousel-3"></div>');


    // social media icons menu
    $('.social-media li a').each(function(index){
        var html_str = $(this).html().toLowerCase();
        if(html_str == 'facebook'){
            $(this).html('<i class="fab fa-facebook-f"></i>');
        }
        if(html_str == 'twitter'){
            $(this).html('<i class="fab fa-twitter"></i>');
        }
        if(html_str == 'instagram'){
            $(this).html('<i class="fab fa-instagram"></i>');
        }
        if(html_str == 'pinterest'){
            $(this).html('<i class="fab fa-pinterest-p"></i>');
        }
        if(html_str == 'google'){
            $(this).html('<i class="fab fa-google"></i>');
        }
        if(html_str == 'youtube'){
            $(this).html('<i class="fab fa-youtube"></i>');
        }
        if(html_str == 'codepen'){
            $(this).html('<i class="fab fa-codepen"></i>');
        }
        if(html_str == 'email'){
            $(this).html('<i class="far fa-envelope"></i>');
        }
        if(html_str == 'github'){
            $(this).html('<i class="fab fa-github"></i>');
        }
        if(html_str == 'linkedin'){
            $(this).html('<i class="fab fa-linkedin-in"></i>');
        }
        
        

    });
    $('.social-media li a').attr('target','_blank'); 

    // Slider Area Header
    $('#owl-carousel-1').owlCarousel({
        loop:true,
        margin:0,
        autoplay: true,
        autoPlaySpeed: 2000,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:3
            }
        }
    });

    // Slider Area Related Posts
    $('#owl-carousel-2').owlCarousel({
        loop:true,
        margin:1,
        autoplay: true,
        autoPlaySpeed: 2000,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:3
            }
        }
    });

    $('.owl-carousel-3').owlCarousel({
        loop:true,
        margin:1,
        autoplay: true,
        autoPlaySpeed: 2000,
        responsive:{
            0:{
                items:1
            }
        }
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
      });

    // alert($('.header').offset().top + 5);
    // alert($(window).scrollTop()+2);
    // on scroll
    var i = 0, j = 0,
    navBar = $('.navbar'),
    header = $('.header'),
    navBar_hight = navBar.outerHeight(true),
    after_navBar_margin = navBar.next().css('margin-top'),
    sidebar = $('.right-sidebar'),
    footer_offset = $('.footer').offset().top,
    sidebar_margin = sidebar.css('margin-top');
  $(window).scroll(function() {
        i = $(this).scrollTop();
        // Back Top Button
        if ($(this).scrollTop() >= 800) {
            $('.back-top').css('right','40px');
        }else{
            $('.back-top').css('right','-55px');
        }
        
        // Navbar
        if($(this).scrollTop() > header.outerHeight(true)){
            navBar.addClass('navbar-fixed-top');
            navBar.next().css('margin-top', navBar_hight + parseInt(after_navBar_margin,10));
        }
        else{
            navBar.removeClass('navbar-fixed-top');
            navBar.next().css('margin-top', after_navBar_margin);
        }
        if ($(this).scrollTop() < j) {
            j = $(this).scrollTop();
            navBar.css("top", "0");
        }
        else if ($(this).scrollTop() > 200) {
            j = $(this).scrollTop();
            navBar.css("top", "-100px");
        }
        // Floating Right Sidebar
        if($(window).width() > 991){
            if(i > sidebar.outerHeight() && i + 360 < footer_offset){
            
                sidebar.css('margin-top',i - sidebar.outerHeight());
            }else{
                sidebar.css('margin-top', sidebar_margin);
            }
        }


  }); //End on scroll


});