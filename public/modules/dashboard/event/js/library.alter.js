
$(document).ready(function () {
    
    var form = $('.ui.form.form-process-alter').submit(function (e) {
        //e.preventDefault(); usually use this, but below works best here.
        return false;
    }).form({
        fields: {
            number_process: {
                identifier: 'number_process',
                rules: [
                    {
                        type: 'empty',
                        prompt: 'Por favor informe o número do processo'
                    }
                ]
            }
        },
        onSuccess: function () {
            $.ajax({
                type: 'POST',
                url: base_url + 'account/process/alter',
                data: form.serialize(),
                success: function (e) {
                    window.location.reload();
                }
            });
        }
    });
});

