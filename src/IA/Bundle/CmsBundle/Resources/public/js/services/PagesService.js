define(['ia/application', 'ia/services/Base'], function(app) {
    app.factory('PagesService', function (BaseService, $sce) {
        var PagesService = Object.create(BaseService);
        PagesService.baseUrl = 'service/pages';

        return PagesService;
    }); 
});