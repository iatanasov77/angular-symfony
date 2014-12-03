define(['ia/application'], function(app) {
    app.controller('EditPageController', 
        ['$rootScope', '$scope', '$location', '$routeParams', 'PagesService', 
    
        function($rootScope, $scope, $location, $routeParams, service) {
       
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
            
            console.log($scope.tinymceOptions);

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
});
