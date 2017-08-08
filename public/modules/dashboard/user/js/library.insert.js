$(document).ready(function () {

    var modal = $('.ui.small.modal.modal-user').modal({
        closable: false,
        autofocus: false,
        onDeny: function () {
            form.form('clear');
        },
        onApprove: function () {
            form.submit();
            return false;
        }
    }).modal('attach events', '.ui.button.button-user', 'show');

    var form = $('.ui.form.form-user').submit(function (e) {
        //e.preventDefault(); usually use this, but below works best here.
        return false;
    }).form({
        fields: {
            cpf: {
                identifier: 'cpf',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Por favor informe o CPF'
                    }
                ]
            },
            username: {
                identifier: 'username',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Por favor informe o nome completo'
                    }
                ]
            },
            date_birth: {
                identifier: 'date_birth',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Por favor informe a data de nascimento'
                    }
                ]
            },
            email: {
                identifier: 'email',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Por favor informe um e-mail'
                    },
                    {
                        type: 'email',
                        prompt: 'Por favor informe um e-mail válido'
                    }
                ]
            },
            mobile: {
                identifier: 'mobile',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Por favor informe um nº de celular'
                    }
                ]
            }
        },
        onSuccess: function () {
            $.ajax({
                type: 'POST',
                url: base_url + 'dashboard/user/insert',
                data: form.serialize(),
                success: function (e) {
                    window.location.reload();
                }
            });
        }
    });
});

