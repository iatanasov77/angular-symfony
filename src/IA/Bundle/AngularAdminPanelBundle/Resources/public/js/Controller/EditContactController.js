
define(['ia/application'], function(app) {
    app.controller('EditContactController', 
        ['$rootScope', '$scope', '$location', '$routeParams', 'contactsService', 
        
        function($rootScope, $scope, $location, $routeParams, contactsService) {
            var contactId = $routeParams.contactId ? parseInt($routeParams.contactId, 10) : 0;
            var contactPromise = contactsService.getContact(contactId);

            contactPromise.then(function(data) {
                $scope.contact = data;  
            }, function(data) {
              // error
            });

            //$scope.contact = {phones: [{phoneNumber:'', desciption: ''}]};

           /*
            * Save a contact
            */
            $scope.saveContact = function () {
                contactsService.saveContact($scope.contact).then(function(response) {
                    //success
                    $rootScope.$broadcast("updateSuccess");
                    $scope.contact = null;
                    $location.path('/contacts');
                }, function(response) {
                  // error
                });
            };

            /*
             * Add a phone row to form
             */
            $scope.addPhone = function() {
                $scope.contact.phones.push({phoneNumber:'', desciption: ''});
            };

            /*
             * Remove a phone row from form
             */
            $scope.removePhone = function(index) {
                $scope.contact.phones.splice(index,1);
            };
        }
    ]);
});

