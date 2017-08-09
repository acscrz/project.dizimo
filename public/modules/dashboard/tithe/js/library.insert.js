
$(document).ready(function () {
    
    $('.ui.dropdown.dropdown-user').dropdown({
        apiSettings: {
            url: base_url + 'dashboard/user/dropdown?q={query}',
            cache: false
        }
    });

    var modal = $('.ui.small.modal.modal-tithe').modal({
        closable: false,
        autofocus: false,
        onDeny: function () {
            form.form('clear');
        },
        onApprove: function () {
            form.submit();
            return false;
        }
    }).modal('attach events', '.ui.button.button-tithe', 'show');

    var form = $('.ui.form.form-tithe').submit(function (e) {
        //e.preventDefault(); usually use this, but below works best here.
        return false;
    }).form({
        fields: {
            id_user: {
                identifier: 'id_user',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Por favor informe um dizimista'
                    }
                ]
            }
        },
        onSuccess: function () {
            $.ajax({
                type: 'POST',
                url: base_url + 'dashboard/tithe/insert',
                data: form.serialize(),
                success: function (e) {
                    window.location.reload();
                }
            });
        }
    });

});

