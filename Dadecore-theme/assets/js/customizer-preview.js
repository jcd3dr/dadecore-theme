document.addEventListener('DOMContentLoaded', function(){
    wp.customize('dadecore_accent_color', function(value){
        value.bind(function(to){
            document.documentElement.style.setProperty('--color-green-tech', to);
        });
    });
});
