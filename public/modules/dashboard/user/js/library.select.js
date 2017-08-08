$(document).ready(function () {

    $('input[name="cpf"]').mask('999.999.999-99');
    
    
    $('input[name="mobile"]').mask('(99) 99999-999?9', {placeholder: ' '});
    
    var form = $('.ui.form.form-user');

    var table = $('.table-user').DataTable({
        ajax: base_url + 'dashboard/user/ajax',
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
                    return '<button class="ui mini basic button button-details">DETALHES</button>';
                },
                targets: -1
            }
        ]
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