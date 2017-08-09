$(document).ready(function () {

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
                        return '<button class="ui mini basic red button button-remove">REMOVER PLANTONISTA</button>';
                },
                targets: -1
            }
        ]
    });
    
});