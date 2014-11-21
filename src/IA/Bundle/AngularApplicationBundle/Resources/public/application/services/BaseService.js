
define(['ia/application'], function(app) {
    app.factory('BaseService', ['$http', '$q', function($http, $q) {

        var baseUrl;
        
        // Return public API.
        return({
            getItem: getItem,
            getItems: getItems,
            save: save,
            remove: remove
        });


        function getItem(id) 
        {
            var request = $http({
                method: "get",
                url: baseUrl + "/detail/"+id,
            });

            return request.then( handleSuccess, handleError );
        }

        function getItems(request) 
        {
            var request = $http({
                method: "post",
                url: baseUrl,
                data: request
            });

            return( request.then( handleSuccess, handleError ) );
        }

        function save( item )
        {
            var request = $http({
                method: "post",
                url: baseUrl + "/save",
                data: item
            });

            return request.then( handleSuccess, handleError);
        }

        function remove( id ) 
        {
            var request = $http({
                method: "get",
                url: baseUrl + "/delete/" + id,
            });

            return request.then( handleSuccess, handleError );
        }


        // ---
        // PRIVATE METHODS.
        // --- 


        function handleError( response ) 
        {
            if (!angular.isObject( response.data ) || !response.data.message) {
                return( $q.reject( "An unknown error occurred." ) );
            }

            // Otherwise, use expected error message.
            return $q.reject( response.data.message );
        }

        function handleSuccess( response ) 
        {
            return response.data;
        }

    }]);

    //return contactsService;
});
