$(document).ready(function () {

    var form = $('.ui.form.form-event');

    var table = $('.table-event').DataTable({
        ajax: base_url + 'dashboard/event/ajax',
        columnDefs: [
            {
                searchable: false,
                orderable: false,
                targets: 0,
                visible: false
            },
            {
                targets: 1
            },
            {
                orderable: false,
                className: 'right aligned',
                render: function (data, type, row) {
                    return (parseInt(data) === 1 ? '<h5 class="ui red header">FECHADO</h5>' : '<h5 class="ui green header">ABERTO</h5>');
                },
                targets: 2
            },
            {
                searchable: false,
                orderable: false,
                className: 'right aligned',
                render: function (data, type, row) {
                    return '<button class="ui mini basic button button-details">DETALHES</button>';
                },
                targets: -1
            }

        ],
        order: [[ 1, "desc" ]]
    });


    $('.table-event tbody').on('click', '.button-details', function () {
        var row = table.row($(this).parents('tr')).data();

        window.location.href = base_url + 'dashboard/tithe?q=' + row[0];
    });


    $('.table-process tbody').on('click', '.button-alter', function () {
        var row = table.row($(this).parents('tr')).data();

        $('.ui.form.form-process-alter input[name="id_process"]').val(row[ 0 ]);

        $('.ui.form.form-process-alter input[name="number_process"]').val(row[ 1 ]);

        $('.ui.small.modal.modal-process-alter').modal({
            closable: false,
            onDeny: function () {
                form.form('clear');
            },
            onApprove: function () {
                form.submit();
                return false;
            }
        }).modal('show');


    });

});