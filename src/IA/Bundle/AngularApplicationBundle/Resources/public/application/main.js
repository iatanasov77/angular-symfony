require(
    [
        'application/application',
        'application/services/Contacts',
        'application/controllers/Contacts',
        'application/controllers/EditContact',

        'application/services/Pages',
        'application/controllers/Pages',
        'application/controllers/EditPage'
    ],
    function(app,
            ContactsService,
            ContactsController,
            EditContactController,
            PagesService,
            PagesController,
            EditPageController) {
        'use strict';
        
        app.factory('contactsService', ContactsService);
        app.controller('ContactsController', ContactsController);
        app.controller('ContactEditController', EditContactController);
    
        app.factory('pagesService', PagesService);
        app.controller('PagesController', PagesController);
        app.controller('PageEditController', EditPageController);
        
        angular.bootstrap("#IAAngularApplication", ['IAAngularApplication']);
    }
);
