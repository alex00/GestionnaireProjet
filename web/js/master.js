$(document).ready(function() {

    $('#tableMyTickets').dataTable();
    $('#dashboardAnnonceTable').dataTable();
    $('#dashboardMemberTable').dataTable();
    $('#allTicketsProject').dataTable();

    $('.roadmapTable').dataTable( {
        "bFilter": true,
        "bSort": false,
        "bAutoWidth": false
    } );


    var toolBarAdmin = toolBar.getInstance();

    if (toolBarAdmin.alerting){
        toolBarAlert(toolBarAdmin.alert_type);
    }

} );
