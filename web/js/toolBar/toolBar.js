var toolBar = (function() {
    var constructeur = function() {

        // quelques propriétés
        this.position = 0;
        this.doing = false;
        this.last_button = false;
        this.current_button = false;

        this.id = ['recapPictos','modifProject','addTask','showGant','modifTask','modifAccount','createProject'];

        this.template_folder = "http://localhost/src/views/formToolBar/";

        this.currentToolBar = [['100',this.template_folder+'recapPictos.html.twig'],
                                ['300',this.template_folder+'modifProject.html.twig'],
                                ['200',this.template_folder+'addTask.html.twig'],
                                ['200',this.template_folder+'showGant.html.twig'],
                                ['200',this.template_folder+'modifTask.html.twig'],
                                ['400',this.template_folder+'modifAccount.html.twig'],
                                ['200',this.template_folder+'createProject.html.twig']];

        this.getParams = function (id){

            if (!this.inArray(id,this.id)){
                return false;
            }

            var num = this.id.indexOf(id);
            var params = this.currentToolBar[num];

            return params;
        }

        this.inArray = function(needle, haystack) {
            var length = haystack.length;
            for(var i = 0; i < length; i++) {
                if(haystack[i] == needle) return true;
            }
            return false;
        }

    }



    this.instance = null;
    return new function() {
        this.getInstance = function() {
            if (this.instance == null) {
                this.instance = new constructeur();
                this.instance.constructeur = null;
            }

            return this.instance;
        }
    }
})();






