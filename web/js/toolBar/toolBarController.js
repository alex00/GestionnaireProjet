
function toolBarController(id, homeContext) {

    var toolBarAdmin = toolBar.getInstance();


    if (toolBarAdmin.doing || !toolBarAdmin.locate[id])
        return false;

    toolBarAdmin.doing = true;
    toolBarAdmin.current_button = id;

    var parent = $("#"+id).parent();
    var links = $(parent).children(".headerAdminLinks");

    if( homeContext == true)
        var size = 'sizeSmall';
    else
        var size = 'sizeLarge';

    if (toolBarAdmin.locate[id].position == 0) {

        $(parent).animate({
            'min-width': '+='+toolBarAdmin.locate[id][size]
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
                'min-width': '-='+toolBarAdmin.locate[id][size]}, 1000, function(){
                toolBarAdmin.doing = false;
                toolBarAdmin.locate[id].position = 0;
                })
        });
    }


};


function toolBarLinks(id) {
    var toolBarAdmin = toolBar.getInstance();

    if (!toolBarAdmin.infosToolBar.template[id])
        return false;
    else
        var url = toolBarAdmin.infosToolBar.template[id];

    toolBarAdmin.memberRow = 0;


    $.get(url, function(data) {

        if (toolBarAdmin.infosToolBar.template[id] == '/js/toolBar/addTicket.html.twig')
            $('<div id="modalHeadersLarge" class="modal hide fade">' + data + '</div>').modal();
        else
            $('<div id="modalHeaders" class="modal hide fade">' + data + '</div>').modal();

    });
};



/*
function toolBarAddMember(id) {
    var toolBarAdmin = toolBar.getInstance();

    if (toolBarAdmin.memberRow > 3)
        return false;

    var row = '<tr id="lastRowAddProject"><td></td><td colspan="2"><input type="text" name="membersProject[]" id="memberProject"/></td><td class="addMember"><span id="arrowMemberAddProject" onclick="javascript:toolBarAddMember(\'lastRowAddProject\');">+</span></td></tr>';
    $("#arrowMemberAddProject").remove();
    $("#"+id).after(row).attr('id','');
    toolBarAdmin.memberRow++;

    if (toolBarAdmin.memberRow == 4)
        $("#arrowMemberAddProject").remove();


}*/
