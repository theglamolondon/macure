var app = angular.module("app", []);

app.controller("planningCtrl", function($scope){
    $scope.dateOfWeek = null;
    $scope.planning = "Sidoine est happy";
    $scope.bonsTravaux = BTofWeek;

    //gestion de l'affichage du formulaire
    $scope.showPlanning = false;
    
    $scope.pannifier = function (arg) {
        console.log(arg);
    }
});

app.directive("planning",function () {
    return{
        restrict : 'A',
        replace : true,
        transclude : true,
        
    }
})