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
        changeDate();
    }

    function getBTofWeek (newVal,oldVal,scope){
        if(newVal != null){
            var d = newVal.split('/');
            $.getJSON(
                BTofWeekUrl.replace(regexY,d[2]).replace(regexM,d[1]).replace(regexD,d[0]),
                function (data)
                {
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
                            data[i].descriptionpanne,
                            data[i].equipe ? data[i].equipe.id : null,
                            data[i].equipe ? data[i].equipe.nom : null
                        ));
                    }

                    $scope.$apply(function () {
                        $scope.bonsTravaux = temp;
                    });
                }
            );
        }
    };

    function changeDate ()
    {
        var dd = $("#btDay").val();
        var d;
        if(dd != undefined)
            d = moment(dd,'DD/MM/AAAA');
        else
            d = moment();

        if($scope.planning.dimanche == null){
            $scope.planning.dimanche = new Day(d.format('DD/MM/YYYY'),null);
            $scope.planning.lundi = new Day(d.format('DD/MM/YYYY'),null);
            $scope.planning.mardi = new Day(d.format('DD/MM/YYYY'),null);
            $scope.planning.mercredi = new Day(d.format('DD/MM/YYYY'),null);
            $scope.planning.jeudi = new Day(d.format('DD/MM/YYYY'),null);
            $scope.planning.vendredi = new Day(d.format('DD/MM/YYYY'),null);
            $scope.planning.samedi = new Day(d.format('DD/MM/YYYY'),null);
        }

        $scope.planning.dimanche.date = moment(dd,'DD/MM/AAAA').add(-(parseInt(d.format('d'))-1)+(0-1) ,'d').format('DD/MM/YYYY');
        $scope.planning.lundi.date = moment(dd,'DD/MM/AAAA').add(-(parseInt(d.format('d'))-1)+(1-1) ,'d').format('DD/MM/YYYY');
        $scope.planning.mardi.date = moment(dd,'DD/MM/AAAA').add(-(parseInt(d.format('d'))-1)+(2-1) ,'d').format('DD/MM/YYYY');
        $scope.planning.mercredi.date = moment(dd,'DD/MM/AAAA').add(-(parseInt(d.format('d'))-1)+(3-1) ,'d').format('DD/MM/YYYY');
        $scope.planning.jeudi.date = moment(dd,'DD/MM/AAAA').add(-(parseInt(d.format('d'))-1)+(4-1) ,'d').format('DD/MM/YYYY');
        $scope.planning.vendredi.date = moment(dd,'DD/MM/AAAA').add(-(parseInt(d.format('d'))-1)+(5-1) ,'d').format('DD/MM/YYYY');
        $scope.planning.samedi.date = moment(dd,'DD/MM/AAAA').add(-(parseInt(d.format('d'))-1)+(6-1) ,'d').format('DD/MM/YYYY');

        //Recherche des BT déjà plannifiés
        var dateEng = d.format('DD/MM/YYYY').split('/');
        $.getJSON(
            BTofWeekUrl.replace(regexY,dateEng[2]).replace(regexM,dateEng[1]).replace(regexD,dateEng[0]),
            function (data)
            {
                $scope.$apply(function () {
                    //reset Plan Day
                    $scope.planning.dimanche.plan = new PlanDay(null);
                    $scope.planning.lundi.plan = new PlanDay(null);
                    $scope.planning.mardi.plan = new PlanDay(null);
                    $scope.planning.mercredi.plan = new PlanDay(null);
                    $scope.planning.jeudi.plan = new PlanDay(null);
                    $scope.planning.vendredi.plan = new PlanDay(null);
                    $scope.planning.samedi.plan = new PlanDay(null);
                });

                for(var i in data)
                {
                    if(data[i].dateplannification )
                    {
                        var bt = new BonTravaux(
                            data[i].id,
                            data[i].numerobon,
                            moment(data[i].dateexecution).format('DD/MM/YYYY'),
                            data[i].dateplannification,
                            data[i].urgence_id,
                            data[i].descriptionpanne,
                            data[i].equipe ? data[i].equipe.id : null,
                            data[i].equipe ? data[i].equipe.nom : null
                        );

                        $scope.$apply(function () {
                            switch (moment(data[i].dateplannification).format('DD/MM/YYYY'))
                            {
                                case $scope.planning.dimanche.date : $scope.planning.dimanche.plan = new PlanDay(bt);
                                    break;
                                case $scope.planning.lundi.date :    $scope.planning.lundi.plan = new PlanDay(bt);
                                    break;
                                case $scope.planning.mardi.date :    $scope.planning.mardi.plan = new PlanDay(bt);
                                    break;
                                case $scope.planning.mercredi.date : $scope.planning.mercredi.plan = new PlanDay(bt);
                                    break;
                                case $scope.planning.jeudi.date :    $scope.planning.jeudi.plan = new PlanDay(bt);
                                    break;
                                case $scope.planning.vendredi.date : $scope.planning.vendredi.plan = new PlanDay(bt);
                                    break;
                                case $scope.planning.samedi.date :   $scope.planning.samedi.plan = new PlanDay(bt);
                                    break;

                            }
                        });
                    }
                }
            }
        );
    }

    $scope.$watch('dateOfWeek',getBTofWeek,true);
    $scope.$watch('btDay',changeDate,true);
});

app.directive("macurePlanning",function () {
    return{
        restrict : 'AE',
        scope : false,
        transclude : true,
        replace : true,
        templateUrl : TemplatePlanninng,
        link : function (scope, element, attrs) {
            $('#btDay').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_4",
                language:'fr',
                locale: {
                    format: 'DD/MM/YYYY' }
            });
            scope.programBT = function (bt) {
                bt.dateplannification = scope.btDay;
                bt.equipe.id = $("#equipetravaux_id").val();
                bt.equipe.nom = $("#equipetravaux_id option:selected").text();

                switch (scope.btDay){
                    case scope.planning.dimanche.date : scope.planning.dimanche.plan == null ?
                                                        scope.planning.dimanche.plan = new PlanDay(bt) : scope.planning.dimanche.plan.setBT(bt);
                                                        break;
                    case scope.planning.lundi.date :    scope.planning.lundi.plan == null ?
                                                        scope.planning.lundi.plan = new PlanDay(bt) : scope.planning.lundi.plan.setBT(bt);
                                                        break;
                    case scope.planning.mardi.date :    scope.planning.mardi.plan == null ?
                                                        scope.planning.mardi.plan = new PlanDay(bt) : scope.planning.mardi.plan.setBT(bt);
                                                        break;
                    case scope.planning.mercredi.date : scope.planning.mercredi.plan == null ?
                                                        scope.planning.mercredi.plan = new PlanDay(bt) : scope.planning.mercredi.plan.setBT(bt);
                                                        break;
                    case scope.planning.jeudi.date :    scope.planning.jeudi.plan == null ?
                                                        scope.planning.jeudi.plan = new PlanDay(bt) : scope.planning.jeudi.plan.setBT(bt);
                                                        break;
                    case scope.planning.vendredi.date : scope.planning.vendredi.plan == null ?
                                                        scope.planning.vendredi.plan = new PlanDay(bt) : scope.planning.vendredi.plan.setBT(bt);
                                                        break;
                    case scope.planning.samedi.date :   scope.planning.samedi.plan == null ?
                                                        scope.planning.samedi.plan = new PlanDay(bt) : scope.planning.samedi.plan.setBT(bt);
                                                        break;

                }
            }
        }
    }
});