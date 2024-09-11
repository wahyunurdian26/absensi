$(function() {
    var $fileName = 'Data Karyawan';
    $("#example1").DataTable({
        "paging": true,
        "lengthChange": false,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        language: {
            searchPlaceholder: "Search"
        },
        "buttons": [{
                extend: 'csv',
                filename: $fileName,
                title: 'Data Karyawan',
                exportOptions: {
                    columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                }
            },
            {
                extend: 'excel',
                filename: $fileName,
                title: 'Data Karyawan',
                exportOptions: {
                    columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                }
            },
            {
                extend: 'print',
                filename: $fileName,
                title: 'Data Karyawan',
                exportOptions: {
                    columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                }
            }
        ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

});
                                 