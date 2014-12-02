require(
    [
        'ia/application',
        'ia/services/Base',
        'ia/services/Contacts',
        'ia/controllers/Contacts',
        'ia/controllers/EditContact',

        'application/services/Pages',
        'application/controllers/Pages',
        'application/controllers/EditPage',
        
        
        'IA/Users/Controller/Users',
        'IA/Users/Controller/EditUser',
        'IA/Users/Service/Users'
    ],
    function() {
        angular.bootstrap("#IAAngularApplication", ['IAAngularApplication']);
    }
);
