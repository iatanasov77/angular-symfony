var assetsPath = 'bundles/iaangularapplication'

/*
 * 
 * RequireJs Config Paths
 */
require.config({
    paths: {
        angular:         assetsPath + '/vendor/angular/angular.min.js',
        angular_tinymce: assetsPath + '/vendor/angular/ui/tinymce.js',
        tinyMCE:         assetsPath + '/vendor/tinymce/tinymce.min.js',
        
    }
});



/*
 * 
 * AngularJs Config Module
 */
define([], function() {
    function config($routeProvider, $rootScope, $http, $route, $templateCache) {
        /*
         * Clear Template Caache
         */
        $rootScope.$on('$viewContentLoaded', function() {
            //$templateCache.removeAll();
        });

        /*
         * Load Client-side Routes
         */
        $http.get('/routes').success(function(data) {
            var currentRoute;

            for (var j = 0; j < data.routes.length; j++) {
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
    }
    config.$inject = ['$routeProvider', '$rootScope', '$http', '$route', '$templateCache'];

    return config;
});



define(['app/config',
  'app/ideasDataSvc',
  'app/ideasHomeController',
  'app/ideaDetailsController'],
 
  function(config, ideasDataSvc, ideasHomeController, ideaDetailsController){
    var app = angular.module('IAAngularApplication', ['ui.tinymce']);
    app.run(config);
    
    app.factory('ideasDataSvc',ideasDataSvc);
    app.controller('ideasHomeController', ideasHomeController);
    app.controller('ideaDetailsController',ideaDetailsController);
    
});


/*
var $routeProviderReference;
var app = angular.module('addressBook', ['ui.tinymce']);

app.config(['$routeProvider', function ($routeProvider) {
    $routeProviderReference = $routeProvider;
}]);


app.run(['$rootScope', '$http', '$route', '$templateCache', function ($rootScope, $http, $route, $templateCache) {
    
    
    $rootScope.$on('$viewContentLoaded', function() {
        //$templateCache.removeAll();
    });

    
    $http.get('/routes').success(function (data) {
        var currentRoute;

        for (var j = 0; j < data.routes.length; j++) {
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
*/




