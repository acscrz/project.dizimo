$(document).ready(function () {
    
    function insert(pathname) {
        $.ajax({
            type: 'POST',
            url: base_url + 'account/tutorial/insert',
            data: {pathname: pathname}
        });
    }

    $.ajax({
        type: 'POST',
        url: base_url + 'account/tutorial/ajax',
        data: {pathname: window.location.pathname},
        success: function (e) {
            var intro = introJs();

            intro.setOptions({
                steps: e
            });

            intro.start();

            intro.oncomplete(function () {
                insert(window.location.pathname);
            });

            intro.onexit(function () {
                insert(window.location.pathname);
            });
        }
    });

});