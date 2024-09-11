$(function() {
    var $fileName = 'Data Absensi Karyawan 2024';
    $("#example1").DataTable({
        "paging": true,
        "lengthChange": true,
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
                title: 'Data Absensi Karyawan 2024',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                }
            },
            {
                extend: 'excel',
                filename: $fileName,
                title: 'Data Absensi Karyawan 2024',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                }
            }
        ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

});
                                 