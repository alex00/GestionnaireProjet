
function toolBarController(id, contextRight ) {

    var toolBarAdmin = toolBar.getInstance();


    if (toolBarAdmin.doing || !toolBarAdmin.locate[id])
        return false;

    toolBarAdmin.doing = true;
    toolBarAdmin.current_button = id;

    var parent = $("#"+id).parent();
    var links = $(parent).children(".headerAdminLinks");

    if( contextRight == 'home')
        var size = 120;
    else if (contextRight == 1 || contextRight == 2 || contextRight == 3)
        var size = toolBarAdmin.locate[id]['right'][contextRight]['sizeLarge'];

    if (toolBarAdmin.locate[id].position == 0) {

        $(parent).animate({
            'min-width': '+='+size
        }, 1000, function () {

            links.css('display', 'block').animate({'opacity': 10}, 800);
            toolBarAdmin.doing = false;
            toolBarAdmin.locate[id].position = 1;
        });

    }
    else {
        $(links).animate({
            'opacity': 0
        }, 800, function () {
            $(links).css("display","none");
            $(parent).animate({
                'min-width': '-='+size}, 1000, function(){
                toolBarAdmin.doing = false;
                toolBarAdmin.locate[id].position = 0;
                })
        });
    }


};


function toolBarLinks(id, name_project, code_project) {

    var toolBarAdmin = toolBar.getInstance();

    if (!toolBarAdmin.infosToolBar.template[id])
        return false;
    else
        var url = toolBarAdmin.infosToolBar.template[id];

    $.get(url, function(data) {

        data = data.replace('[project_name]',name_project);
        data = data.replace('[project_code]',code_project);

        $('<div id="modalHeaders" class="modal hide fade">' + data + '</div>').modal();

    });

};


function toolBarSubmit (id, id_project,  name_project) {
    var toolBarAdmin = toolBar.getInstance();

    if (!toolBarAdmin.infosToolBar.submit[id])
        return false;
    else{
        if (id_project != null)
            var url = '/'+name_project+toolBarAdmin.infosToolBar.submit[id];
        else
            var url = toolBarAdmin.infosToolBar.submit[id];
    }

    switch (id){
        case 'project':
            var name = $("#nameProject").val();
            var desc = $("#descProject").val();

            url += '/'+name+'/'+desc;

        break;

        case 'ticket':
            var name = $("#nameTicket").val();
            var desc = $("#descTicket").val();
            var assigned = $("#assignedTicket").val();
            var deadline = $("#deadlineTicket").val();
            deadline = deadline.replace('/','-');
            var priority = $("#priorityTicket").val();
            var tracker = $("#trackerTicket").val();
            var roadmap = $("#roadmapTicket").val();

            if (roadmap == '')
                roadmap = 0;

        break;

        case 'roadmap':
            var name = $("#nameRoadmap").val();
            var desc = $("#descRoadmap").val();

            url += '/'+name+'/'+desc+'/'+id_project;
        break;
        case 'announce':
            var name = $("#nameAnnounce").val();
            var desc = $("#descAnnounce").val();

            url += '/'+name+'/'+desc+'/'+id_project;
        break;
        case 'service':
            var name = $("#nameService").val();

            url += '/'+name+'/'+id_project;
        break;
        case 'membre':
            var mail1 = $("#loginMember1").val();
            if (mail1 == '')
                mail1 = null;
            var mail2 = $("#loginMember2").val();
            if (mail2 == '')
                mail2 = null;
            var mail3 = $("#loginMember3").val();
            if (mail3 == '')
                mail3 = null;
            var mail4 = $("#loginMember4").val();
            if (mail4 == '')
                mail4 = null;
            var mail5 = $("#loginMember5").val();
            if (mail5 == '')
                mail5 = null;
            url += '/'+mail1+'/'+mail2+'/'+mail3+'/'+mail4+'/'+mail5+'/'+id_project;
        break;
    }

    if (id == 'ticket'){
        $.post(url,{name: name, desc: desc, assigned: assigned, deadline: deadline, priority: priority, tracker: tracker, roadmap: roadmap, id: id_project }).success(function(){

            var code = $("#modalReferer").val();

            toolBarAdmin.alerting = true;
            toolBarAdmin.alert_type = id;

            window.location.href = '/'+code;
            return;
        });
    }
    else{
        $.post(url).success(function(){

                var code = $("#modalReferer").val();

                if (id == 'project')
                    code = name.toLowerCase().replace(/ /g,"-");

                window.location.href = '/'+code;
                return;

        });
    }

}

function toolBarAlert(id){
    var toolBarAdmin = toolBar.getInstance();

    if (!toolBarAdmin.infosToolBar.messageSuccess[id])
        return false;
    else
        var msg = toolBarAdmin.infosToolBar.messageSuccess[id];

    $("#alertHeader").val('false');
    $("#headerAlert").html(msg)
        .animate({
            'opacity': 10
            }, 800, function () {

            setTimeout(function(){
                $("#headerAlert").animate({
                        'opacity': 0
                    }, 800, function () {
                    $("#headerAlert").html('');
                });
                toolBarAdmin.alerting = false;
                toolBarAdmin.alert_type = false;
            },5000);
        });

}

