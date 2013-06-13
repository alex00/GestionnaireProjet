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
    $("#DashboardSubMenu").addClass(" current");


    $(".Collapsable").click(function () {

        $(this).parent().children().toggle();
        $(this).toggle();

    });
} );
