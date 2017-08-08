$(document).ready(function () {

    var form = $('.ui.form.form-user');

    var table = $('.table-oncall').DataTable({
        ajax: base_url + 'dashboard/oncall/ajax',
        columnDefs: [
            {
                searchable: false,
                orderable: false,
                targets: 0,
                visible: false
            },
            {
                orderable: false,
                targets: 1
            },
            {
                orderable: false,
                targets: 2
            },
            {
                orderable: false,
                targets: 3
            },
            {
                searchable: false,
                orderable: false,
                className: 'right aligned',
                render: function ( data, type, row ) {
                        return '<button class="ui mini basic red button disabled">EXCLUIR PLANTONISTA</button>';
                },
                targets: -1
            }
        ]
    });
    
    
    $('.table-process tbody').on( 'click', '.button-details', function () {
        var row = table.row( $(this).parents('tr') ).data();
        
        window.location.href = base_url + 'account/process/details?q=' + row[0] + '&process=' + row[1];
    });
    
    
    $('.table-process tbody').on( 'click', '.button-alter', function () {
        var row = table.row( $(this).parents('tr') ).data();
        
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