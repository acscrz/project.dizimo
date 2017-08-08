
$(document).ready(function () {
    var modal = $('.ui.small.modal.modal-event').modal({
        closable: false,
        autofocus: false,
        onDeny: function () {
            form.form('clear');
        },
        onApprove: function () {
            form.submit();
            return false;
        }
    }).modal('attach events', '.ui.button.button-event', 'show');


    var form = $('.ui.form.form-event').submit(function (e) {
        //e.preventDefault(); usually use this, but below works best here.
        return false;
    }).form({
        fields: {
            date_event: {
                identifier: 'date_event',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Por favor informe a data do plantão'
                    }
                ]
            },
            time_event: {
                identifier: 'time_event',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Por favor informe a hora do plantão'
                    }
                ]
            }
        },
        onSuccess: function () {
            $.ajax({
                type: 'POST',
                url: base_url + 'dashboard/event/insert',
                data: form.serialize(),
                success: function (e) {
                    window.location.reload();
                }
            });
        }
    });
});

