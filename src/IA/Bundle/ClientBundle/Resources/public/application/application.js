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


app.run(['$rootScope', '$http', '$route', function ($rootScope, $http, $route) {

    $http.get('/routes').success(function (data) {

        var j = 0,
                currentRoute;

        for (; j < data.routes.length; j++) {

            currentRoute = data.routes[j];

            $routeProviderReference.when(currentRoute.name, {
                templateUrl: ENV.assetsPath + currentRoute.templateUrl,
                controller: currentRoute.controller,
                isFree: currentRoute.isFree
            });

        }

        $routeProviderReference.otherwise({redirectTo: data.default});

        $route.reload();

    });

}]);





