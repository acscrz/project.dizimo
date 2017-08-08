$(document).ready(function () {
    
    $('.form-user').submit(function (event) {
        return false;
    }).form({
        inline: true,
        fields: {
            firstname: {
                identifier: 'firstname',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Por favor, informe este campo'
                    }
                ]
            },
            lastname: {
                identifier: 'lastname',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Por favor, informe este campo'
                    }
                ]
            }
        },
        onSuccess: onFormAlter
    });

    function onFormAlter() {
        $.ajax({
            type: 'POST',
            url: base_url + 'account/user/alter',
            data: $('.form-user').serialize(),
            complete: function () {
                window.location.reload();
            }
        });
    }

});