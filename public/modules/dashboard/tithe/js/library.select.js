$(document).ready(function () {

    var form = $('.ui.form.form-tithe');

    var table = $('.table-tithe').DataTable({
        ajax: base_url + 'dashboard/tithe/ajax',
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
                className: 'right aligned',
                targets: 2
            },
            {
                className: 'right aligned',
                targets: 3
            },
            {
                searchable: false,
                orderable: false,
                className: 'right aligned',
                render: function (data, type, row) {
                    return '<button class="ui mini red basic button button-delete">REMOVER</button>';
                },
                targets: -1
            }
        ],
        order: [[ 3, "desc" ]]
    });

});