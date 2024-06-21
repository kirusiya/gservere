$(document).ready(function(){
    
    if($('.responsive-data-table')[0]){

        $('.responsive-data-table').DataTable({
            "PaginationType": "bootstrap",
            "ordering": false,
            responsive: true,
            dom: '<"tbl-top clearfix"lfr>,t,<"tbl-footer clearfix"<"tbl-info pull-left"i><"tbl-pagin pull-right"p>>',
            "language": {
                "lengthMenu": "Showing _MENU_ records per page",
                "zeroRecords": "Sorry, nothing was found.",
                "info": "Mostrando _PAGE_ de _PAGES_",
                "infoEmpty": "No records found",
                "infoFiltered": "(filtrado de _MAX_ registros)",
                "search": "Search:",
                "loadingRecords": "Uploads...",
                "processing": "Procesando...",
                "emptyTable": "There are no records to display on this page",
                "paginate": {
                    "first":      "First",
                    "last":       "Last",
                    "next":       "Next",
                    "previous":   "Previous"
                },
                "aria": {
                    "sortAscending":  ": Enabled to sort columns ascending",
                    "sortDescending": ": Enabled to sort columns descending"
                }
            }
        });

    }

}); /* ready */