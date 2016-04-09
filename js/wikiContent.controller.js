app.controller('wiki-content', ['$scope', 'NavFilter', 'wikiContent' , '$rootScope', function($scope, NavFilter, wikiContent, $rootScope){
	$scope.NavFilter = NavFilter;
	$scope.contents;
	$scope.analyze;

	$scope.$parent.getData = function(){
		wikiContent.getContents().success(function(data){
			$scope.num=data[0][0];
			$scope.size=data[0][1];
			$scope.contents = data[1];
			
		}).error(function(error){
			console.log(error);
		});
	};

	//delete content
	$scope.deleteContent = function(){
		$('#deleteModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var name = button.data('delete_name') // Extract info from data-* attributes
			var id = button.data('delete_id');	
			$scope.deleteId = id;
			var modal = $(this);
			modal.find('.modal-body p').html("资料名："+name);
		});
	}
	$scope.deleteContentGo = function(id){
		var DOMid='#wiki_'+id;
		$('#DOMid').hide();
		$('#deleteModal').modal('hide');

		//ajax pass id to backend php script and delete the file
		$.post("api/delete.php",{id:id});
		$scope.$parent.getData();
		$scope.infoAlert("删 除 成 功！");
	}

	// edit content
	$scope.editContent = function(){
		$scope.$parent.isEdit = true;
		$scope.clearForm();
		$('#uploadModal').on('show.bs.modal', function(event){
			var button = $(event.relatedTarget)
			var id = button.data('edit_id');
			var title=button.data('edit_title');
			var description=button.data('edit_description');
			var subject=button.data('edit_subject');
			var grade=button.data('edit_grade');
			var term=button.data('edit_term');
			var type=button.data('edit_type');
			var file=button.data('edit_file');
			var img=button.data('edit_img');
			$scope.$parent.editId = id;
			var modal = $(this);
			if($scope.$parent.isEdit){
				modal.find('.modal-title').html("修改资料: "+title);
				modal.find('.modal-body #uploadForm #upload_title').val(title);
				modal.find('.modal-body #uploadForm #upload_description').val(description);
				modal.find('.modal-body #uploadForm #upload_subject option[name="'+subject+'"]').attr('selected',true);
				modal.find('.modal-body #uploadForm #upload_grade option[name="'+grade+'"]').attr('selected',true);
				modal.find('.modal-body #uploadForm #upload_term option[name="'+term+'"]').attr('selected',true);
				modal.find('.modal-body #uploadForm #upload_type option[name="'+type+'"]').attr('selected',true);

				modal.find('.modal-body #uploadForm #upload_file_text').html('留空则为原文件');
				modal.find('.modal-body #uploadForm #upload_img_text').html('留空则为原配图');

			}else{
				modal.find('.modal-title').html("上传新资料 ");
				modal.find('.modal-body #uploadForm #upload_file_text').html('请选择您要上传的文件');
				modal.find('.modal-body #uploadForm #upload_img_text').html('请为文件添加一张图片');

			}
			
			
		});
	}

}]);