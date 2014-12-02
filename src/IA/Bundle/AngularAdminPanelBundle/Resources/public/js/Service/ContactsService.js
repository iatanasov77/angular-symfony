
define(['ia/application', 'ia/services/Base'], function(app) {
    app.factory('ContactsService', function (BaseService, $sce) {
        var ContactsService = Object.create(BaseService);
        ContactsService.baseUrl = '/contacts';

        return ContactsService;
    }); 
});
