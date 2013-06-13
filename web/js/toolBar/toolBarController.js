function toolBarController(id){
    var toolBarAdmin = toolBar.getInstance();

    if (toolBarAdmin.doing)
        return false;

    var infos = toolBarAdmin.getParams(id);

    toolBarAdmin.doing = true;
    toolBarAdmin.current_button = id;

    if (!infos.submit)
        var buttons = false;
    else
        var buttons = true;

    if (toolBarAdmin.current_button == 'cancelToolBar'){
        animateClose(toolBarAdmin);
        return true;
    }

    if (toolBarAdmin.current_button == 'submitToolBar'){
        alert(toolBarAdmin.last_button);
        return true;
    }

    if (toolBarAdmin.position == 1){
        if (toolBarAdmin.current_button == toolBarAdmin.last_button){
            animateClose(toolBarAdmin);
        }
        else{
            animateRepresent(toolBarAdmin, infos, buttons);
        }

    }
    else {
        animateOpen(toolBarAdmin, infos, buttons);
    }

    return true;

}

function animateOpen (toolBarAdmin, infos, buttons) {


    $('#toolBar').animate({
        'height': infos.height
    }, 1500, function(){
        if (buttons === true){

            $("#submitSeperateTopAndContent").css("visibility",'visible');
            $("#submitSeperateTopAndContent").animate({
                'opacity': '10'
            }, 1500);
        }
        $("#toolBar").load(infos.template);
        $("#toolBar ").animate({
            'opacity': '10'
        }, 1500, function(){
            toolBarAdmin.doing = false;
            toolBarAdmin.position = 1;
            toolBarAdmin.last_button = toolBarAdmin.current_button;
        });
    });
}

function animateRepresent (toolBarAdmin, infos, buttons){
    if (buttons === true){
        $("#submitSeperateTopAndContent").animate({
            'opacity': '10'
        }, 1500);
    }
    else {
        $("#submitSeperateTopAndContent").animate({
            'opacity': '0'
        }, 1500);

    }

    $("#toolBar ").animate({
        'opacity': '0',
        'height': infos.height
    },1000, function(){
        $("#toolBar").load(infos.template);


        }).animate({
            'opacity': '10'
        }, 1500, function(){
            toolBarAdmin.doing = false;
            toolBarAdmin.last_button = toolBarAdmin.current_button;
        });


}

function animateClose (toolBarAdmin){
    $("#submitSeperateTopAndContent ").animate({
        'opacity': '0'
    }, 1000);
    $('#toolBar').animate({
        'opacity': '0'
    }, 1000, function(){
        $("#submitSeperateTopAndContent").css("visibility",'hidden');
        $('#toolBar').empty();
    }).animate({
            'height': '0'
        }, 1500, function(){
            toolBarAdmin.position = 0;
            toolBarAdmin.doing = false;
        });
}

function plusMailMember (){

    $("#plusMailMember").remove();
    var html = '<p id="newMemberMail" ><input type="email" name="mailInvitMember" /><button id="plusMailMember" class="btn"><i class="icon-plus"></i></button></p>';

    $("#lastMailMember").after(html).attr("id","mailMember");
    $("#newMemberMail").attr("id","lastMailMember");

}