

define(['ia/application'], function(app) {
    app.controller('ContactsController', 
        ['$scope', '$location', 'ContactsService', 
        function($scope, $location, service) {
            $scope.messagesView = ENV.assetsPath + "/application/templates/messages.html";
            $scope.gridControlsView = ENV.assetsPath + "/application/templates/gridControls.html";
            $scope.paginationView = ENV.assetsPath + "/application/templates/pagination.html";

            $scope.request = {
                orderBy: 'firstName',
                orderDir: 'ASC',
                search: null,
                ipp: 5,
                page: 1
            };


            $scope.range;                  // Pagination range
            $scope.totalItems = 0;         // Total Count of Items
            $scope.contacts = [];

            $scope.Math = window.Math;



            /*
             * Get Contacts from service
             * 
             * Get Contacts and init pagination params
             */
            $scope.getContacts = function()
            {
                var promise = service.getItems($scope.request);
                
                promise.then(function(response) {
                    //console.log(response);
                    $scope.totalItems = response.countTotal;
                    var range = [];
                    for( var i = 1; i <= Math.ceil( $scope.totalItems / $scope.request.ipp ); i++ ) {
                        range.push(i);
                    }
                    $scope.range = range;
                    $scope.contacts = response.entities;
                }, function(response) {
                  // error
                });
                
                 
            };
            $scope.getContacts();
            

            /*
             * Change Paginator Page
             */
            $scope.setPage = function( page ) 
            {
                $scope.request.page = page;
                getContacts();
            }

            /*
             * Change Order Column or Direction
             */
            $scope.setOrder = function( orderBy )
            {
                if($scope.request.orderBy == orderBy) {
                    $scope.request.orderDir = $scope.request.orderDir == 'ASC' ? 'DESC' : 'ASC';
                } else {
                    $scope.request.orderBy = orderBy;
                }

                getContacts();
            }

            /*
             * Remove a Contact
             */
            $scope.removeContact = function( id )
            {
                service.remove(id).then(function(response) {
                    $scope.message = {text: 'Remove Success!', type: 'info'};

                    getContacts();
                }, function(response) {
                  // error
                });
            }

            /*
             * Go to add / edit contact form
             */
            $scope.editContact = function( id )
            {
                $location.path("edit-contact/"+id);
            }

            /*
             * Listen on recieve message from add / edit contact form
             */
            $scope.$on("updateSuccess", function (args) {
                $scope.message = {text: 'Update Success!', type: 'info'};
                console.log($scope.message);
            });
        }]
    ); 
});
