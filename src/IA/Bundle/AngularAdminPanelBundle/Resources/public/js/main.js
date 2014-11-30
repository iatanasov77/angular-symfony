require(
    [
        'ia/application',
        'ia/services/Base',
        'ia/services/Contacts',
        'ia/controllers/Contacts',
        'ia/controllers/EditContact',

        'application/services/Pages',
        'application/controllers/Pages',
        'application/controllers/EditPage'
    ],
    function() {
        angular.bootstrap("#IAAngularApplication", ['IAAngularApplication']);
    }
);
