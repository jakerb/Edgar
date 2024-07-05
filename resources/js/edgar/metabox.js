edgar.factory('fieldService', () => {

    var service = {
        activeField: null,
        fields: [],
        createField: () => {
            let random = false;
            const sec = Date.now() * 1000 + Math.random() * 1000;
            const id = sec.toString(16).replace(/\./g, "").padEnd(14, "0");
            let field_id = `field_${id}${random ? `${Math.trunc(Math.random() * 100000000)}`:""}`;
            return new EdgarFieldModel({
                id: field_id
            });
        },
        getFieldTypes: (type_slug, res) => {
            return new Promise((res, rej) => {

                let url = edgar_js.admin_url;
                let args = {
                    action: 'edgar_field_type',
                    type: type_slug 
                };

                jQuery.post(url, args, (response) => {

                    response = JSON.parse(response);

                    if(response.success) {

                        res(response.field_types.map((item) => {
                            return new EdgarFieldTypeModel(item);
                        }));

                    }

                    return rej(response);

                });

            });
        },
        getFields: (res) => { 

            return new Promise((res, rej) => {

                let url = edgar_js.admin_url;
                let args = {
                    action: 'edgar_fields',
                    id: edgar_js.post_id
                };

                jQuery.post(url, args, (response) => {

                    response = JSON.parse(response);

                    if(response.success) {

                        res(response.fields.map((item) => {
                            return new EdgarFieldModel(item);
                        }))
                    }

                    return rej(response);

                });

            });

        },
        field: (field) => {
            if(field) {
                service.activeField = field;
            }
    
            return service.activeField;
        }
    };

    return service;
    
});



edgar.controller('metaboxTabContainer', ['$scope', 'fieldService', function($scope, fieldService) {

    $scope.active = 'field';
    $scope.switch = (tab) => {
        $scope.active = tab;
    }

}]);

edgar.controller('metaboxFieldList', ['$scope', '$timeout', 'fieldService', async function($scope, $timeout, fieldService) {
    
    $scope.active = null;
    $scope.fields = [];

    $scope.select = (id) => {
        $timeout(() => {
            $scope.active = $scope.fields.find((item) => {
                return item.id == id;
            });
            
            fieldService.field($scope.active);
            $scope.$root.$broadcast('activeField', true);

        });
    };

    $scope.create = () => {
        let new_field = fieldService.createField();
        $scope.fields.push(new_field);
        $scope.select($scope.fields[$scope.fields.length-1].id);
    };

    if($scope.fields.length > 0) {
        $scope.select($scope.fields[0].id);
    }

}]);

edgar.controller('metaboxField', ['$scope', '$timeout', 'fieldService', async function($scope, $timeout, fieldService) {

    $scope.$on('activeField', function(event,data){
        $timeout(() => {
            $scope.field = fieldService.field();
            $scope.field_type = $scope.getFieldType($scope.field.type);
        })
    });

    $scope.field_types = await fieldService.getFieldTypes();
    $scope.field_type = null;

    $scope.getFieldType = (type_slug) => {
        $scope.field_type = $scope.field_types.find((type) => {
            return type.slug == type_slug;
        });

        return $scope.field_type;
    };  



}]);