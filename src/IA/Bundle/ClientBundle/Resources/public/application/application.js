angular.module('config', []).constant('ENV', ENV);
angular.module('exceptionOverride', []).factory('$exceptionHandler', function () {
    return function (exception, cause) {
        exception.message += ' (caused by "' + cause + '")';
        throw exception;
    };
});

var app = angular.module('addressBook', ['config']);

app.config(function ($routeProvider) {
    $routeProvider
        .when('/contacts',
            {
                controller: 'ContactsController',
                templateUrl: ENV.assetsPath + '/application/templates/contacts.html'
            })
        .when('/add-contact',
            {
                controller: 'ContactEditController',
                templateUrl: ENV.assetsPath + '/application/templates/editContact.html'
            })
        .when('/edit-contact/:contactId',
            {
                controller: 'ContactEditController',
                templateUrl: ENV.assetsPath + '/application/templates/editContact.html'
            })
        .otherwise({ redirectTo: '/contacts' });
});






