var toolBar = (function() {
    var constructeur = function() {

        // quelques propriétés
        this.locate = {HeaderAction: {sizeSmall: 120,sizeLarge: 485, position: 0}};
        this.doing = false;
        this.template_folder = "/js/toolBar/";
        this.alerting = false;
        this.alert_type = false;


        this.infosToolBar = { template:
                                    { addProjectLink: this.template_folder+'addProject.html.twig',
                                      addTicketLink: this.template_folder+'addTicket.html.twig',
                                      addRoadmapLink: this.template_folder+'addRoadmap.html.twig',
                                      addMemberLink: this.template_folder+'addMember.html.twig',
                                      addServiceLink: this.template_folder+'addService.html.twig',
                                      addAnnounceLink: this.template_folder+'addAnnounce.html.twig'
                                    },
                              submit:
                                    { project: '/new-project',
                                      ticket: '/new-ticket',
                                      roadmap: '/new-roadmap',
                                      membre: '/new-member',
                                      service: '/new-service',
                                      announce: '/new-announce'
                                    },
                              messageSuccess:
                                    { ticket: '<img src="/img/check.png" title="Added" alt="Added" /> Ticket Added',
                                      roadmap: '<img src="/img/check.png" title="Added" alt="Added" /> Roadmap Added',
                                      membre: '<img src="/img/check.png" title="Added" alt="Added" /> Invitation Sended',
                                      service: '<img src="/img/check.png" title="Added" alt="Added" /> Service Added',
                                      announce: '<img src="/img/check.png" title="Added" alt="Added" /> Announce Added'
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






