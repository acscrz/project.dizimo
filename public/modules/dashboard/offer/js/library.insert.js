
$(document).ready(function () {

    $('.ui.dropdown.dropdown-offer').dropdown({
        apiSettings: {
            url: base_url + 'dashboard/offer/dropdown',
            cache: false
        }
    });

    var modal = $('.ui.small.modal.modal-offer').modal({
        closable: false,
        autofocus: false,
        onDeny: function () {
            form.form('clear');
        }
    }).modal('attach events', '.ui.button.button-offer', 'show');


    var form = $('.ui.form.form-offer').submit(function (e) {
        //e.preventDefault(); usually use this, but below works best here.
        return false;
    }).form({
        fields: {
            value_offer: {
                identifier: 'value_offer',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Por favor informe um valor'
                    }
                ]
            },
            id_type_offer: {
                identifier: 'id_type_offer',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Por favor informe o tipo da oferta'
                    }
                ]
            }
        },
        onSuccess: function () {
            $.ajax({
                type: 'POST',
                url: base_url + 'dashboard/offer/insert',
                data: form.serialize(),
                success: function (e) {
                    $('.table-offer').DataTable().ajax.reload();
                },
                complete: function (jqXHR, textStatus) {
                    form.form('clear');
                }
            });
        }
    });

});

