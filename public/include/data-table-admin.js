$(function() {
    var $fileName = 'Profile';
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "paging": false,
        "ordering": false,
        language: {
            searchPlaceholder: "Search"
        },
        "buttons": [{
                extend: 'csv',
                filename: $fileName,
                title: 'Profile'
            },
            {
                extend: 'excel',
                filename: $fileName,
                title: 'Profile'
            },
            {
                extend: 'print',
                filename: $fileName,
                title: 'Profile'
            }
        ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

});
                                            