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

    wp.customize('dadecore_404_custom_title', function(value) {
        value.bind(function(newval) {
            $('.error-404 .page-title, .error-404 not-found h1').text(newval);
        });
    });
    wp.customize('dadecore_404_custom_message', function(value) {
        value.bind(function(newval) {
            $('.error-404 p').first().text(newval);
        });
    });
})(jQuery);
