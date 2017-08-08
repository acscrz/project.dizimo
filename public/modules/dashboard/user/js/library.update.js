
$(document).ready(function () {

    var table = $('.table-user').DataTable();

    $('.table-user tbody').on('click', '.button-details', function () {
        var row = table.row($(this).parents('tr')).data();

        $('.form-details input[name="id_user"]').val(row[0]);
        $('.form-details input[name="cpf"]').val(row[1]);
        $('.form-details input[name="username"]').val(row[2]);
        $('.form-details input[name="date_birth"]').val(row[3]);
        
        $('.form-details input[name="email"]').val();
        $('.form-details input[name="mobile"]').val();

        var modal = $('.ui.small.modal.modal-details').modal({
            closable: false,
            autofocus: false,
            onDeny: function () {
                form.form('clear');
            },
            onApprove: function () {
                form.submit();
                return false;
            }
        }).modal('show');
    });

    var form = $('.ui.form.form-details').submit(function (e) {
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
                url: base_url + 'dashboard/user/update',
                data: form.serialize(),
                success: function (e) {
                    window.location.reload();
                }
            });
        }
    });
});

