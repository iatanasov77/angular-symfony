
app.service('pagesService', function ($http, $q) {
    
    // Return public API.
    return({
        getItem: getItem,
        getItems: getItems,
        save: save,
        remove: remove,
    });

    
    function getItem(id) 
    {
        var request = $http({
            method: "get",
            url: "pages/"+id,
        });
         
        return request.then( handleSuccess, handleError );
    }

    function getItems(request) 
    {
        var request = $http({
            method: "post",
            url: "pages",
            data: request
        });
         
        return( request.then( handleSuccess, handleError ) );
    }

    function save( page )
    {
        var request = $http({
            method: "post",
            url: "pages/save",
            data: page
        });
 
        return request.then( handleSuccess, handleError);
    }
 
    function remove( id ) 
    {
        var request = $http({
            method: "get",
            url: "pages/delete/"+id,
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

});
