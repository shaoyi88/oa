/**
 * Created by cheaboar on 2015/6/28.
 */

serviceModule = angular.module('serviceApp', ['ngResource']);

serviceModule.controller('serviceCtrl', ['$scope', '$resource', function($scope, $resource){

    $scope.appPageIndex = 1;
    $scope.appointments = new Array();

    appointment =  $resource('get_appointment?type=:type&page=:page', {});

    $scope.clickLoadAppointment = function(type, $event){
        var eventParent = $($event.target.parentNode);
        var sublimes = eventParent.siblings();
        sublimes.each(function(index){
            $(sublimes[index]).removeClass('current');
        });
        eventParent.addClass('current');


        $scope.loadAppointment(type);
    }
    
    $scope.loadAppointment = function(type){

        var result = appointment.query({type:type, page:$scope.appPageIndex}, function(){
            for(var i=0; i < result.length; i++){
                result[i]['address'] = result[i]['provinceName'] + ' ' + result[i]['cityName'] + ' ' + result[i]['areaName'] + ' '+ result[i]['address'];
                //result[i]['address'] = process_address(result[i]);
                if(result[i].state == 1000){
                    result[i]['button'] = '确认';
                    result[i]['btnClass'] = 'btn-primary';
                }else if(result[i].state == 2000){
                    result[i]['button'] = '已处理';
                    result[i]['btnClass'] = 'disabled ';
                }else if(result[i].state == 3000){
                    result[i]['button'] = '已签约';
                    result[i]['btnClass'] = 'disabled ';
                }else if(result[i].state == -1){
                    result[i]['button'] = '已取消';
                    result[i]['btnClass'] = 'disabled ';
                }
            }
            $scope.appointments = result;
        });



    }

    $scope.changeStatus = function(index){
        if($scope.appointments[index].state == 1000){
            change = $resource('change_to_processed');
            change.id = $scope.appointments[index].id;
            console.log(change.id);
            var result = change.get({id: $scope.appointments[index].id},function(){
                if(result.status == 200){
                    $scope.appointments[index].state = 2000;
                    $scope.appointments[index]['contact_time'] = result.contact_time;
                    $scope.appointments[index].button = '已处理';
                    $scope.appointments[index].btnClass = 'disabled';
                }else{
                    console.log(result);
                }
            });
        }
    }

    $scope.loadAppointment('all');
}])
