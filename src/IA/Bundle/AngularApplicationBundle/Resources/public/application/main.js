

var assetsPath = '/bundles/iaangularapplication'

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
            ]
        }
    }
});


require(['application/application'],
    function() {
        'use strict';
        angular.bootstrap(document, ['IAAngularApplication']);
    }
);