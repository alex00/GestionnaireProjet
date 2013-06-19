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

    $('.modal-body > form').validate({
        onKeyup : true,
        sendForm : false,
        eachValidField : function() {

            $(this).closest('div').removeClass('error').addClass('success');
        },
        eachInvalidField : function() {

            $(this).closest('div').removeClass('success').addClass('error');
        },
        description : {
            age : {
                required : '<div class="alert alert-error">Required</div>',
                pattern : '<div class="alert alert-error">Pattern</div>',
                conditional : '<div class="alert alert-error">Conditional</div>',
                valid : '<div class="alert alert-success">Valid</div>'
            }
        }
    });

} );
