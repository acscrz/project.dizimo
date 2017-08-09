
$(document).ready(function () {

    var table = $('.table-offer').DataTable();

    $('.table-offer').on('click', '.button-delete', function () {
        var row = table.row($(this).parents('tr')).data();
        var $this = $(this);

        $(this).alert({
            type: 'confirm',
            content: 'Tem certeza que deseja excluir essa oferta?',
            onApprove: function () {
                $.ajax({
                    type: 'POST',
                    url: base_url + 'dashboard/offer/delete',
                    data: {id_offer: row[ 0 ]},
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

