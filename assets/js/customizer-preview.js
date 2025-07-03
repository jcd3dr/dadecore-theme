(function($){
    wp.customize('dadecore_accent_color', function(value) {
        value.bind(function(newval) {
            document.documentElement.style.setProperty('--color-accent', newval);
        });
    });
    wp.customize('dadecore_accent_secondary_color', function(value) {
        value.bind(function(newval) {
            document.documentElement.style.setProperty('--color-accent-secondary', newval);
        });
    });
    wp.customize('dadecore_bg_color', function(value) {
        value.bind(function(newval) {
            document.documentElement.style.setProperty('--color-dark-blue-bg', newval);
        });
    });
    wp.customize('dadecore_header_bg_color', function(value) {
        value.bind(function(newval) {
            document.documentElement.style.setProperty('--header-bg-color', newval);
        });
    });
    wp.customize('dadecore_header_text_color', function(value) {
        value.bind(function(newval) {
            document.documentElement.style.setProperty('--header-text-color', newval);
        });
    });

    wp.customize('dadecore_logo_position', function(value){
        value.bind(function(newval){
            $('#masthead').removeClass('logo-left logo-center').addClass('logo-' + newval);
        });
    });
    wp.customize('dadecore_nav_alignment', function(value){
        value.bind(function(newval){
            $('#masthead').removeClass('nav-left nav-center nav-right').addClass('nav-' + newval);
        });
    });
    wp.customize('dadecore_enable_sticky_header', function(value){
        value.bind(function(newval){
            $('#masthead').toggleClass('no-sticky', ! newval);
        });
    });
    wp.customize('dadecore_blog_sidebar', function(value){
        value.bind(function(newval){
            if(newval){
                $('.content-with-sidebar .widget-area').show();
            } else {
                $('.content-with-sidebar .widget-area').hide();
            }
        });
    });
    wp.customize('dadecore_footer_show_widgets', function(value){
        value.bind(function(newval){
            if(newval){
                $('.footer-widgets-area').show();
            } else {
                $('.footer-widgets-area').hide();
            }
        });
    });

    wp.customize('dadecore_404_custom_title', function(value) {
        value.bind(function(newval) {
            $('.error-404 .page-title, .error-404.not-found h1').text(newval);
        });
    });
    wp.customize('dadecore_404_custom_message', function(value) {
        value.bind(function(newval) {
            $('.error-404 p').first().text(newval);
        });
    });
    wp.customize('dadecore_footer_custom_text', function(value) {
        value.bind(function(newval) {
            $('.custom-footer-text').text(newval);
        });
    });
})(jQuery);
