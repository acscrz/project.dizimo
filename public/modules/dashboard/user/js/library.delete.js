$(document).ready(function () {

    $(document).on('click', '.button-delete', function () {
        var $this = $(this);

        $(this).alert({
            type: 'confirm',
            content: 'Tem certeza que deseja excluir esse processo?',
            onApprove: function () {
                $.ajax({
                    type: 'POST',
                    url: base_url + 'dashboard/user/delete',
                    data: {id_user: $('.modal-details .button-delete').data('id')},
                    beforeSend: function (xhr) {
                        $this.addClass('loading');
                    },
                    success: function (e) {
                        window.location.reload();
                    }
                });
            }
        });
    });

});

