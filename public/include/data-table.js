$(function() {
    var $fileName = 'Data Admin';
    $("#example1").DataTable({
        "paging": true,
        "lengthChange": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        language: {
            searchPlaceholder: "Search"
        },
        "buttons": [{
                extend: 'csv',
                filename: $fileName,
                title: 'Data Admin',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                }
            },
            {
                extend: 'excel',
                filename: $fileName,
                title: 'Data Admin',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                }
            },
            {
                extend: 'print',
                filename: $fileName,
                title: 'Data Admin',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                }
            }
        ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

});
                                 