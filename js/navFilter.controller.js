app.controller('nav-filter', ['$scope', 'NavFilter', function($scope, NavFilter){
	$scope.NavFilter = NavFilter;


	//用来存储显示在nav各标签上的标题名称
	$scope.subjectTitle =  "科目";
	$scope.gradeTitle =  "年级";
	$scope.termTitle = "学期";
	$scope.typeTitle = "类型";

	$scope.selectSubject = function(title){
		$scope.subjectTitle = title;
		if(title==="科目"){
			delete this.NavFilter.search.subject;
		}else{
			$scope.NavFilter.search.subject=title;
		}
	};
	$scope.selectGrade = function(title){
		$scope.gradeTitle = title;
		if(title==="年级"){
			delete this.NavFilter.search.grade;
		}else{
			$scope.NavFilter.search.grade=title;
		}
	};
	$scope.selectTerm = function(title){
		$scope.termTitle = title;
		if(title==="学期"){
			delete this.NavFilter.search.term;
		}else{
			$scope.NavFilter.search.term=title;
		}
	};
	$scope.selectType = function(title){
		$scope.typeTitle = title;
		if(title==="类型"){
			delete this.NavFilter.search.type;
		}else{
			$scope.NavFilter.search.type=title;
		}
	};
    

}]);