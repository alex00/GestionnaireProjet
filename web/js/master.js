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

    $(".headerActions").click(function(){
        $(this).modal({
            backdrop: true,
            keyboard: true,
            show: true,
            remote: '/js/modal.html.twig'
        });
        $(this).modal('show');
    });


} );
