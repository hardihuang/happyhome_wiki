app.controller('upload', ['$scope', 'NavFilter' ,'$timeout', function($scope, NavFilter,$timeout){
	$scope.uploadIncluded=function(){
		$('#uploadModal').on('hide.bs.modal', function (event){
			$scope.clearForm();
			$scope.$parent.isEdit = false;
        });
	}
	

	$scope.$parent.clearForm = function(){
		$('#uploadModal').find('.modal-title').html("上传新资料 ");
		$("#upload_file").val("").tooltip('hide');
		$("#upload_img").val("");
		$("#upload_title").val("").tooltip('hide');
		$("#upload_description").val("");
		$("#upload_subject").val("").find('option').removeAttr('selected');
		$("#upload_grade").val("").find('option').removeAttr('selected');
		$("#upload_term").val("").find('option').removeAttr('selected');
		$("#upload_type").val("").find('option').removeAttr('selected');
		$("#uploadProgress").width("0").hide;
		$("#uploadPregressWrap").hide();
		$("#status").hide();
		console.log('clean');
	}

	$scope.$parent.isEdit = false;

	$scope.uploadValidate = function(){
		var title=$('#upload_title');
		var file=$('#upload_file');
		if(title.val()==""){
			title.tooltip('show');
			title.on('click',function(){
			  title.tooltip('hide');
			})
			// alert('请填写资料名称后再提交！');
			return;
		}
	if(file.val()=="" && !$scope.$parent.isEdit){
			file.tooltip('show')
			// alert('请选择资料文件后再提交！');
			file.on('click',function(){
			  file.tooltip('hide');
			})
			return;
		}
		$scope.uploadFile($scope.$parent.isEdit);
	};

	$scope.uploadFile = function(type){
		$('#uploadPregressWrap').show();

		var file = _("upload_file").files[0];
		var img = _("upload_img").files[0];
		var title = $("#upload_title").val();
		var description = $("#upload_description").val();
		var subject = $("#upload_subject").val();
		var grade = $("#upload_grade").val();
		var term = $("#upload_term").val();
		var type = $("#upload_type").val();
		var fileName = $('#upload_subject option:selected').text()
			+'-'+$('#upload_grade option:selected').text()
			+'-'+$('#upload_term option:selected').text()
			+'-'+$('#upload_type option:selected').text()
			+'-'+title;

		// alert(file.name+" | "+file.size+" | "+files.type);
		var formdata = new FormData();
		if($scope.$parent.isEdit){
			formdata.append("id",$scope.$parent.editId);
		}
		formdata.append("file", file);
		formdata.append("img", img);
		formdata.append("title", title);
		formdata.append("description", description);
		formdata.append("subject", subject);
		formdata.append("grade", grade);
		formdata.append("term", term);
		formdata.append("type", type);
		formdata.append("fileName", fileName);

		var ajax = new XMLHttpRequest();
		ajax.upload.addEventListener("progress", progressHandler, false);
		ajax.addEventListener("load", completeHandler, false);
		ajax.addEventListener("error", errorHandler, false);
		ajax.addEventListener("abort", abortHandler, false);
		if($scope.$parent.isEdit){
			ajax.open("POST", "api/edit.php");
		}else{
			ajax.open("POST", "api/insert.php");
		}
		ajax.send(formdata);

		function progressHandler(event){
		  // _("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
		  var percent = (event.loaded / event.total) * 100;
		  $("#uploadProgress").width(Math.round(percent)+"%");
		  // _("status").innerHTML ="已经上传了 "+ Math.round(percent)+"% 请稍等...";
		}
		function completeHandler(event){
		  _("status").innerHTML = event.target.responseText;
		  $("#uploadProgress").width("100%");
		  setTimeout("$('#uploadModal').modal('hide')",1000);
		  $('#uploadProgress').removeClass('active');
		  // $timeout(NavFilter.clearForm,1000);
		  $scope.$parent.getData();

		  if($scope.$parent.isEdit){
		  	alertMsg="修 改 成 功！";
		  }else{
		  	alertMsg="添 加 成 功！";
		  }
		  $scope.infoAlert(alertMsg,1000);
		  
		}
		function errorHandler(event){
		  $("#status").innerHTML = "Upload Failed";
		}
		function abortHandler(event){
		  $("#status").innerHTML = "Upload Aborted";
		}
	};


}]);
