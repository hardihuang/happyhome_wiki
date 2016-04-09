app.controller('alert', ['$scope','$rootScope', function($scope, $rootScope){
	$rootScope.isManage = false;
	
	$rootScope.manageBtn = function(){
      $('.mamage_btn').show();
      $('#manageAlert').show();
      $rootScope.isManage = true;
    }

    $rootScope.manageBtnHide = function(){
      $('.mamage_btn').hide();
      $('#manageAlert').hide();
      $rootScope.isManage = false;
    };
    
    $rootScope.infoAlert = function(str,time){
      var alert = $('#info-alert');
      alert.find("center").html(str);
      alert.delay(time).fadeIn().delay( 1500 ).fadeOut();

    }
}]);