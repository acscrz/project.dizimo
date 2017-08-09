
$(document).ready(function () {

    var table = $('.table-tithe').DataTable();

    $('.table-tithe').on('click', '.button-delete', function () {
        var row = table.row($(this).parents('tr')).data();
        var $this = $(this);

        $(this).alert({
            type: 'confirm',
            content: 'Tem certeza que deseja excluir esse plantão?',
            onApprove: function () {
                $.ajax({
                    type: 'POST',
                    url: base_url + 'dashboard/tithe/delete',
                    data: {id_tithe: row[ 0 ]},
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

