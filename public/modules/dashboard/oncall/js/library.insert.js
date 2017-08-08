
$(document).ready(function () {

    $('.ui.dropdown.dropdown-user').dropdown({
        apiSettings: {
            url: base_url + 'dashboard/user/dropdown',
            cache: false
        }
    });

    var modal = $('.ui.small.modal.modal-oncall').modal({
        closable: false,
        autofocus: false,
        onDeny: function () {
            form.form('clear');
        },
        onApprove: function () {
            form.submit();
            return false;
        }
    }).modal('attach events', '.ui.button.button-oncall', 'show');


    var form = $('.ui.form.form-oncall').submit(function (e) {
        //e.preventDefault(); usually use this, but below works best here.
        return false;
    }).form({
        fields: {
            id_user: {
                identifier: 'id_user',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Por favor informe o CPF do plantonista'
                    }
                ]
            },
            password1: {
                identifier: 'password1',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Por favor informe uma senha para o plantonista'
                    }
                ]
            },
            match: {
                identifier: 'password2',
                rules: [
                    {
                        type: 'match[password1]',
                        prompt: 'As senhas não conferem!'
                    }
                ]
            }
        },
        onSuccess: function () {
            $.ajax({
                type: 'POST',
                url: base_url + 'dashboard/user/update',
                data: form.serialize(),
                success: function (e) {
                    window.location.reload();
                }
            });
        }
    });
});

