
$(document).ready(function () {
    
    var modal = $('.ui.small.modal.modal-event-close').modal({
        closable: false,
        autofocus: false,
        onDeny: function () {
            form.form('clear');
        },
        onApprove: function () {
            form.submit();
            return false;
        }
    }).modal('attach events', '.ui.button.button-event-close', 'show');

    
    var form = $('.ui.form.form-event-close').submit(function (e) {
        //e.preventDefault(); usually use this, but below works best here.
        return false;
    }).form({
        onSuccess: function () {
            $.ajax({
                type: 'POST',
                url: base_url + 'dashboard/event/update',
                data: form.serialize(),
                success: function (e) {
                    window.location.reload();
                }
            });
        }
    });
});

