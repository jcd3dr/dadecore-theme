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
