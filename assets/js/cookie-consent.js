(function(){
    const banner = document.getElementById('cookie-consent');
    if(!banner) return;
    const btn = document.getElementById('cookie-accept');
    if(localStorage.getItem('dc_cookie_consent')){
        banner.remove();
        window.dataLayer = window.dataLayer || [];
        dataLayer.push({'consent': 'granted'});
        return;
    }
    banner.classList.remove('hide');
    btn.addEventListener('click', function(){
        localStorage.setItem('dc_cookie_consent', '1');
        banner.remove();
        window.dataLayer = window.dataLayer || [];
        dataLayer.push({'consent': 'granted'});
    });
})();
