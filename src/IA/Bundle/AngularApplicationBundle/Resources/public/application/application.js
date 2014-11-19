
/*
 * 
 * AngularJs Application
 */
define([
        'application/services/Contacts',
        'application/controllers/Contacts',
        'application/controllers/EditContact'
    ],
 
function(ContactsService, ContactsController, EditContactController){
    angular.module('config', []).constant('ENV', ENV);
    angular.module('exceptionOverride', []).factory('$exceptionHandler', function () {
        return function (exception, cause) {
            exception.message += ' (caused by "' + cause + '")';
            throw exception;
        };
    });
    
    var $routeProviderReference;
    var app = angular.module('IAAngularApplication', ['ngRoute', 'config', 'exceptionOverride', 'ui.tinymce']);
    
    app.config(['$routeProvider', function ($routeProvider) {
        $routeProviderReference = $routeProvider;
    }]);
    
    app.run(['$rootScope', '$http', '$route', '$templateCache', function ($rootScope, $http, $route, $templateCache) {
        /*
         * Clear Template Caache
         */
       $rootScope.$on('$viewContentLoaded', function() {
           //$templateCache.removeAll();
       });
       
       $http.get('/routes').success(function (data) {

            var j = 0,
                    currentRoute;

            for (; j < data.routes.length; j++) {

                currentRoute = data.routes[j];

                $routeProviderReference.when(currentRoute.name, {
                    templateUrl: currentRoute.templateUrl,
                    controller: currentRoute.controller,
                    isFree: currentRoute.isFree
                });

            }

            $routeProviderReference.otherwise({redirectTo: data.default});

            $route.reload();

        });

    }]);
    
    
    app.factory('contactsService', ContactsService);
    app.controller('ContactsController', ContactsController);
    app.controller('EditContactController', EditContactController);
    
});

