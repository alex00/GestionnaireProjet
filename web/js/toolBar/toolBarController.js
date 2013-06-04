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
        $("#toolBar").load(infos.template);
        $("#toolBar ").animate({
            'opacity': '10'
        }, 1500, function(){
            toolBarAdmin.doing = false;
            toolBarAdmin.position = 1;
            toolBarAdmin.last_button = toolBarAdmin.current_button;
        });
        if (buttons === true){
            $("#submitSeperateTopAndContent").animate({
                'opacity': '10'
            }, 1500);
        }
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
        $('#toolBar').empty();
    }).animate({
            'height': '0'
        }, 1500, function(){
            toolBarAdmin.position = 0;
            toolBarAdmin.doing = false;
        });
}