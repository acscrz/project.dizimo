
$(document).ready(function () {

    var table = $('.table-oncall').DataTable();

    $('.table-oncall').on('click', '.button-delete', function () {
        var row = table.row($(this).parents('tr')).data();
        var $this = $(this);

        $(this).alert({
            type: 'confirm',
            content: 'Tem certeza que deseja excluir esse processo?',
            onApprove: function () {
                $.ajax({
                    type: 'POST',
                    url: base_url + 'dashboard/oncall/delete',
                    data: {id_user: row[ 0 ]},
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

