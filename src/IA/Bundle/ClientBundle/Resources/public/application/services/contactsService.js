
app.service('contactsService', function ($http, $q) {
    
    // Return public API.
    return({
        getContact: getContact,
        getContacts: getContacts,
        saveContact: saveContact,
        removeContact: removeContact,
    });

    
    function getContact(id) 
    {
        var request = $http({
            method: "get",
            url: "detail/"+id,
        });
         
        return request.then( handleSuccess, handleError );
    }

    function getContacts(request) 
    {
        alert("EHO");
        var request = $http({
            method: "post",
            url: "contacts",
            data: request
        });
         
        return( request.then( handleSuccess, handleError ) );
    }

    function saveContact( contact )
    {
        var request = $http({
            method: "post",
            url: "contacts/save",
            data: contact
        });
 
        return request.then( handleSuccess, handleError);
    }
 
    function removeContact( id ) 
    {
        var request = $http({
            method: "get",
            url: "contacts/delete/"+id,
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
