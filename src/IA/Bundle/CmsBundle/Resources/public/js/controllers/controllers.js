
app.controller('PagesController', [
    '$rootScope', '$scope', '$location', 'pagesService',
    function ($rootScope, $scope, $location, pagesService) {
    
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
        $scope.getPages = function()
        {
            var promise = pagesService.getPages($scope.request);
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
        $scope.getPages();

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
            contactsService.removeContact(id).then(function(response) {
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
    }
]);

app.controller('PageEditController', [
    '$rootScope', '$scope', '$location', '$routeParams', 'pagesService',
    function ($rootScope, $scope, $location, $routeParams, service) {
        $scope.tinymceOptions = {
            theme: "modern",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor"
            ],
            toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            toolbar2: "print preview media | forecolor backcolor emoticons",
            image_advtab: true,
            height: "200px",
            width: "650px"
        };
        
        var id = $routeParams.id ? parseInt($routeParams.id, 10) : 0;
        var promise = service.getItem(id);
        
        promise.then(function(data) {
            $scope.item = data;  
        }, function(data) {
          // error
        });

        //$scope.contact = {phones: [{phoneNumber:'', desciption: ''}]};
       
       /*
        * Save a contact
        */
        $scope.save = function () {
            service.save($scope.item).then(function(response) {
                //success
                $rootScope.$broadcast("updateSuccess");
                $scope.item = null;
                $location.path('/pages');
            }, function(response) {
              // error
            });
        };
        
     
    }
]);
