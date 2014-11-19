var assetsPath = '/bundles/iaangularapplication';
var cmsAssetsPath = '/bundles/iacms';


/*
 * 
 * RequireJs Config Paths
 */
require.config({
    paths: {
        'application/application':             assetsPath + '/application/application',
        'application/controllers/Contacts':    assetsPath + '/application/controllers/ContactsController',
        'application/controllers/EditContact': assetsPath + '/application/controllers/EditContactController',
        'application/services/Contacts':       assetsPath + '/application/services/ContactsService',
        'application/controllers/Pages':       cmsAssetsPath + '/js/controllers/PagesController',
        'application/controllers/EditPage':    cmsAssetsPath + '/js/controllers/EditPageController',
        'application/services/Pages':          cmsAssetsPath + '/js/services/PagesService',
        
        /*
         * Vendor Paths
         */
        'angular/angular':         assetsPath + '/vendor/angular/angular.min',
        'angular/route':           '//ajax.googleapis.com/ajax/libs/angularjs/1.3.0/angular-route',
        'angular/ui/tinymce':      assetsPath + '/vendor/angular/ui/tinymce',
        'tinyMCE':                 assetsPath + '/vendor/tinymce/tinymce.min',
    },
    shim: {
        'angular/ui/tinymce':
        {
            deps: 
            [
                'angular/angular', 
                'tinyMCE'
            ]
        },
        
        'application/application': 
        {
            deps: 
            [
                'angular/angular', 
                'angular/route',
                'angular/ui/tinymce'
            ],
            exports: "app"
        }
    }
});




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
        
        angular.bootstrap(document, ['IAAngularApplication']);
    }
);