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

    var memberTab = 0;
    memberTab = $("#memberTab").val();

    $( "#tabs" ).tabs({active: memberTab});

    var alertHeader = $("#alertHeader").val();

    if (alertHeader != 'false'){

        toolBarAlert(alertHeader);
    }

} );

function selectProject(code){
    window.location.href = '/'+code;
}


function changeModal(id, login, right, tab, current_service){

    $("#nameUserChangeMember").html(login);
    $("#idUserChangeMember").val(id);
    $("#idTabService").val(tab);

    $("#serviceChange"+current_service).attr('selected','selected');

    if (right == 'User'){
        $("#roleChangeMember").removeAttr('disabled');
        $("#serviceChangeMember").removeAttr('disabled');

        $("#userRoleChangeMember").attr('selected','selected');
    }
    else if (right == 'Admin'){

        $("#roleChangeMember").removeAttr('disabled');
        $("#serviceChangeMember").removeAttr('disabled');

        $("#adminRoleChangeMember").attr('selected','selected');
    }
    else if (right == 'Creator'){
        $("#creatorRoleChangeMember").attr('selected','selected');
        $("#roleChangeMember").attr('disabled','disabled');

    }
}

function changeMemberInformations (project_code, project_id){

    var user_id = $("#idUserChangeMember").val();
    var id_tab = $("#idTabService").val();

    var services = $("#serviceChangeMember");
    var service_id = services[0][services[0].selectedIndex].value;

    var rights = $("#roleChangeMember");
    var right = rights[0][rights[0].selectedIndex].value;

    $.post('/change-member-informations/',{user_id: user_id, service_id: service_id, project_id: project_id, id_tab: id_tab, right: right }).success( function() {

        window.location.href = '/'+project_code+'/organization';
        return;
    });
}

function changeTimeTicket(code, ticket_code, ticket_id){

    var spend = $("#changeSpendTime").val();
    var progress = $("#changeProgress").val();

    $.post('/change-time-ticket',{spend: spend, progress: progress, ticket_id: ticket_id }).success(function(){

        window.location.href = '/'+code+'/ticket/'+ticket_code;
        return;
    });

}

function clearNotifs(){

    $.post('/clear-notifications').success(function(){
        return;
    });

}