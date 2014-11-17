angular.module('config', []).constant('ENV', ENV);
angular.module('exceptionOverride', []).factory('$exceptionHandler', function () {
    return function (exception, cause) {
        exception.message += ' (caused by "' + cause + '")';
        throw exception;
    };
});

var $routeProviderReference;
var app = angular.module('addressBook', ['config']);

app.config(['$routeProvider', function ($routeProvider) {
    $routeProviderReference = $routeProvider;
}]);


app.run(['$rootScope', '$http', '$route', '$templateCache', function ($rootScope, $http, $route, $templateCache) {
    
    /*
     * Clear Template Caache
     */
    $rootScope.$on('$viewContentLoaded', function() {
        $templateCache.removeAll();
    });

    /*
     * Load Client-side Routes
     */
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





