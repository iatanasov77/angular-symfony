
app.service('pagesService', function ($http, $q) {
    
    // Return public API.
    return({
        getPage: getPage,
        getPages: getPages,
        savePage: savePage,
        removePage: removePage,
    });

    
    function getPage(id) 
    {
        var request = $http({
            method: "get",
            url: "pages/"+id,
        });
         
        return request.then( handleSuccess, handleError );
    }

    function getPages(request) 
    {
        var request = $http({
            method: "post",
            url: "pages",
            data: request
        });
         
        return( request.then( handleSuccess, handleError ) );
    }

    function savePage( page )
    {
        var request = $http({
            method: "post",
            url: "pages/save",
            data: page
        });
 
        return request.then( handleSuccess, handleError);
    }
 
    function removePage( id ) 
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
