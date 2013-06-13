var toolBar = (function() {
    var constructeur = function() {

        // quelques propriétés
        this.position = 0;
        this.doing = false;
        this.last_button = false;
        this.current_button = false;
        this.template_folder = "/js/toolBar/";

        this.infosToolBar = { addProject:
                                    { height: 200,
                                      submit: true,
                                      template: this.template_folder+'addProject.html.twig' },

                                addTask:
                                    { height: 300,
                                      submit: true,
                                      template: this.template_folder+'addTask.html.twig' },

                                addTicket:
                                { height: 400,
                                    submit: true,
                                    template: this.template_folder+'addTicket.html.twig' },

                                addMember:
                                { height: 400,
                                    submit: true,
                                    template: this.template_folder+'addMember.html.twig' },

                                modifProject:
                                    { height: 200,
                                      submit: true,
                                      template: this.template_folder+'modifProject.html.twig' },

                                modifTask:
                                    { height: 300,
                                      submit: true,
                                      template: this.template_folder+'modifTask.html.twig' },

                                modifAccount:
                                    { height: 300,
                                      submit: true,
                                      template: this.template_folder+'modifAccount.html.twig' },

                                showGant:
                                    { height: 200,
                                      submit: false,
                                      template: this.template_folder+'showGant.html.twig' }};

        this.getParams = function (id){

            if (!this.infosToolBar[id]){
                return false;
            }

            return this.infosToolBar[id];

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






