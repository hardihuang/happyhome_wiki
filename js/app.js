var app = angular.module('app', [])


//所有controller都可以get到的data放在这里.,当初以为只放navfilter要用的data，就命名为了这个，后来又放了很多其他的东西,
app.factory('NavFilter', function(){
	return {
		//navfilter的search条件放在search这个array里
		search: {},

	}
});

//从后台api获取文件数据
app.factory('wikiContent', function($http){

	function getContents() {
		return $http.get('./api/data.php');
	}
	return {
		getContents: getContents
	}
});

//content的ng-repeat完成后打开popover
app.directive('popover', function ($timeout) {
    return {
        restrict: 'A',
        link: function(scope, element, attr) {
            if (scope.$last === true) {
                $timeout(function() {
                    $('[data-toggle="popover"]').popover({
						 container: 'body',
						 html: 'true'
					});
                });
                if(scope.$parent.isManage){
                	scope.manageBtn();
                }

            }
        }
    };
});