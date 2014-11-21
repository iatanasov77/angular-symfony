require(
    [
        'ia/application',
        'ia/services/Base',
        'application/services/Contacts',
        'application/controllers/Contacts',
        'application/controllers/EditContact',

        'application/services/Pages',
        'application/controllers/Pages',
        'application/controllers/EditPage'
    ],
    function() {
        angular.bootstrap("#IAAngularApplication", ['IAAngularApplication']);
    }
);
