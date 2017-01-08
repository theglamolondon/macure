var app = angular.module("app", []);

app.controller("planningCtrl", function($scope){
    $scope.dateOfWeek = null;
    $scope.planning = new WeekPlan();
    $scope.btSelected = null;
    $scope.btDay = null;

    $scope.bonsTravaux = BTofWeek;

    var regexY = new RegExp("(_y_)","g");
    var regexM = new RegExp("(_m_)","g");
    var regexD = new RegExp("(_d_)","g");

    //gestion de l'affichage du formulaire
    $scope.showPlanning = true;
    
    $scope.plannifier = function (arg) {
        $scope.btSelected = arg;
        $scope.showPlanning = !$scope.showPlanning;
    }

    function getBTofWeek (newVal,oldVal,scope){
        if(newVal != null){
            var d = newVal.split('/');
            $.getJSON(
                BTofWeekUrl.replace(regexY,d[2]).replace(regexM,d[1]).replace(regexD,d[0]),
                function (data) {
                    var temp = [];
                    for(var i in data)
                    {
                        var exDate = data[i].dateexecution.split('-');
                        temp.push(new BonTravaux(
                            data[i].id,
                            data[i].numerobon,
                            (exDate[2]+"/"+exDate[1]+"/"+exDate[0]),
                            data[i].dateplannification,
                            data[i].urgence_id,
                            data[i].descriptionpanne
                        ));
                    }

                    $scope.$apply(function () {
                        $scope.bonsTravaux = temp;
                    });
                }
            );
        }
    }
    function changeCalendar() {

    }


    $scope.$watch('dateOfWeek',getBTofWeek,true);
    $scope.$watch('btDay',changeCalendar,true);
});

app.directive("macurePlanning",function () {
    return{
        restrict : 'A',
        replace : true,
        transclude : true,
    }
})