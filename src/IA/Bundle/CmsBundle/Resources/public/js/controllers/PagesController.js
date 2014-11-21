define(['ia/application'], function(app){
    app.controller('PagesController', 
        ['$rootScope', '$scope', '$location', 'PagesService', 
        function($rootScope, $scope, $location, pagesService) {

            $scope.messagesView = ENV.assetsPath + "/application/templates/messages.html";
            $scope.gridControlsView = ENV.assetsPath + "/application/templates/gridControls.html";
            $scope.paginationView = ENV.assetsPath + "/application/templates/pagination.html";

            $scope.request = {
                orderBy: 'title',
                orderDir: 'ASC',
                search: null,
                ipp: 5,
                page: 1
            };


            $scope.range;                  // Pagination range
            $scope.totalItems = 0;         // Total Count of Items
            $scope.pages = [];

            $scope.Math = window.Math;



            /*
             * Get Contacts from service
             * 
             * Get Contacts and init pagination params
             */
            $scope.getItems = function()
            {
                var promise = pagesService.getItems($scope.request);
                promise.then(function(response) {
                    $scope.totalItems = response.countTotal;
                    var range = [];
                    for( var i = 1; i <= Math.ceil( $scope.totalItems / $scope.request.ipp ); i++ ) {
                        range.push(i);
                    }
                    $scope.range = range;
                    $scope.pages = response.entities;
                }, function(response) {
                  // error
                });
            }
            $scope.getItems();

            /*
             * Change Paginator Page
             */
            $scope.setPage = function( page ) 
            {
                $scope.request.page = page;
                $scope.getItems();
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

                $scope.getItems();
            }

            /*
             * Remove a Contact
             */
            $scope.removeContact = function( id )
            {
                pagesService.remove(id).then(function(response) {
                    $scope.message = {text: 'Remove Success!', type: 'info'};

                    $scope.getItems();
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

