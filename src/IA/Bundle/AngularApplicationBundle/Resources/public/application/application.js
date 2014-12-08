/*
 * 
 * AngularJs Application
 */
define([],
function(){
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
         * Clear Template Cache
         */
        $rootScope.$on('$viewContentLoaded', function() {
           $templateCache.removeAll();
        });
       
       
       /*
        * Load Routes
        */
        $http.get('routes').success(function (data) {
            angular.forEach(data.routes, function(route, key) {
                this.when(route.name, {
                    templateUrl: route.templateUrl,
                    controller: route.controller,
                    isFree: route.isFree
                });
            }, $routeProviderReference);
            $routeProviderReference.otherwise({redirectTo: data.default});
            $route.reload();
        });

    }]);
    
    return app; 
});

