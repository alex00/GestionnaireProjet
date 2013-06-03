/**
 * Created with JetBrains PhpStorm.
 * User: SUPINTERNET
 * Date: 30/05/13
 * Time: 23:51
 * To change this template use File | Settings | File Templates.
 */

function toolBarController(id){
    var toolBarAdmin = toolBar.getInstance();

    if (toolBarAdmin.doing)
        return false;

    var infos = toolBarAdmin.getParams(id);

    toolBarAdmin.doing = true;
    toolBarAdmin.current_button = id;

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
            animateRepresent(toolBarAdmin, infos);
        }

    }
    else {
        animateOpen(toolBarAdmin, infos);
    }

    return true;

}

function animateOpen (toolBarAdmin, infos) {
    $('#toolBar').animate({
        'height': infos[0]
    }, 1500, function(){
        $("#toolBar").load(infos[1]);
        $("#toolBar ").animate({
            'opacity': '10'
        }, 1500);
        $("#submitSeperateTopAndContent").animate({
            'opacity': '10'
        }, 1500, function(){
            toolBarAdmin.doing = false;
            toolBarAdmin.position = 1;
            toolBarAdmin.last_button = toolBarAdmin.current_button;
        });
    });
}

function animateRepresent (toolBarAdmin, infos){
    $("#toolBar ").animate({
        'opacity': '0',
        'height': infos[0]
    },1000, function(){
        $("#toolBar").load(infos[1]);
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