document.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const datatablesSimple = document.getElementById('datatablesSimple');
    if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple);
    }

        // var table = document.getElementById('datatablesSimpleSettings');
        //
        // var dataTable = new simpleDatatables.DataTable(table, {
        //     "aLengthMenu": [[60, 50, 75], [25, 50, 75, "All"]],
        //     'pageLength': 100,
        //     "iDisplayLength": 20,
        //     'searching': true,
        //
        //
        // });


});
