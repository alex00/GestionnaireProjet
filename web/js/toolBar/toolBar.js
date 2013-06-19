var toolBar = (function() {
    var constructeur = function() {

        // quelques propriétés
        this.locate = {HeaderAction: {sizeSmall: 120,sizeLarge: 361, position: 0}};
        this.doing = false;
        this.template_folder = "/js/toolBar/";


        this.infosToolBar = { template:
                                    { addProjectLink: this.template_folder+'addProject.html.twig',
                                      addTicketLink: this.template_folder+'addTicket.html.twig',
                                      addRoadmapLink: this.template_folder+'addRoadmap.html.twig',
                                      addMemberLink: this.template_folder+'addMember.html.twig',
                                      addAnnounceLink: this.template_folder+'addAnnounce.html.twig'
                                    }
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






