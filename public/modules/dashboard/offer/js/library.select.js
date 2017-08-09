$(document).ready(function () {

    var table = $('.table-offer').DataTable({
        ajax: base_url + 'dashboard/offer/ajax',
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
                searchable: false,
                orderable: false,
                className: 'right aligned',
                render: function (data, type, row) {
                    return '<button class="ui mini red basic button button-delete">REMOVER</button>';
                },
                targets: -1
            }

        ]
    });

});