
define(['ia/application'], function(app) {
    app.factory('ContactsService', ['$http', '$q', 'BaseService', function($http, $q, BaseService) {
        var baseUrl = '/contacts';

        var ContactsService = function() {
            BaseService.apply(this, arguments);
        };
        ContactsService.prototype = new BaseService();
        
        return ContactsService;
    }]);
});
