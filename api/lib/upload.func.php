<?php 

//单文件上传
function uploadFile($fileName,$name,$path="../upload/files",$allowExt=array("gif","jpeg","png","jpg","pdf","doc","docx","ppt","pptx","mp4","zip"),$maxSize=157286400,$imgFlag=false){
	
	if(!file_exists($path)){
		mkdir($path,0777,true);
	}
	$i=0;
	$files[0]=$_FILES[$fileName];
	if(!($files&&is_array($files))){
		return ;
	}
	foreach($files as $file){
		if($file['error']===UPLOAD_ERR_OK){
			$ext=getExt($file['name']);
			//检测文件的扩展名
			if(!in_array($ext,$allowExt)){
				exit("上传图片为非法文件类型");
			}
			//校验是否是一个真正的图片类型
			if($imgFlag){
				if(!getimagesize($file['tmp_name'])){
					exit("上传图片不是真正的图片类型");
				}
			}
			//上传文件的大小
			if($file['size']>$maxSize){
				exit("文件过大");
			}
			if(!is_uploaded_file($file['tmp_name'])){
				exit("上传文件不是通过HTTP POST方式上传上来的");
			}
			// $now=getdate();
			// $now=$now['year'].'-'.$now['mon'].'-'.$now['mday'].'_';
			// $filename=$now.$file['name'];
			$filename = $name.'_'.time().'.'.$ext;
			$filename=iconv("UTF-8","gb2312", $filename);
			$destination=$path."/".$filename;
			if(move_uploaded_file($file['tmp_name'], $destination)){
				$filename=iconv("gb2312","UTF-8", $filename);
				$file['name']=$filename;
				unset($file['tmp_name'],$file['size'],$file['type']);
				$uploadedFiles[$i]=$file;
				$i++;
			}
		}else{
			switch($file['error']){
					case 1:
						$msg="上传图片超过了配置文件上传文件的大小";//UPLOAD_ERR_INI_SIZE
						break;
					case 2:
						$msg="上传图片超过了表单设置上传文件的大小";			//UPLOAD_ERR_FORM_SIZE
						break;
					case 3:
						$msg="上传图片文件部分被上传";//UPLOAD_ERR_PARTIAL
						break;
					case 4:
						$msg="没有图片文件被上传";//UPLOAD_ERR_NO_FILE
						break;
					case 6:
						$msg="没有找到临时目录";//UPLOAD_ERR_NO_TMP_DIR
						break;
					case 7:
						$msg="文件不可写";//UPLOAD_ERR_CANT_WRITE;
						break;
					case 8:
						$msg="由于PHP的扩展程序中断了文件上传";//UPLOAD_ERR_EXTENSION
						break;
				}
				echo $msg;
			}
	}
	return @$uploadedFiles;
}

function getDirSize($path){
	$totalsize = 0;
	$totalcount = 0;
	$dircount = 0;
	if ($handle = opendir($path)){
		while (false !== ($file = readdir($handle))){
			$nextpath = $path . '/' .$file;
			if($file != '.' && $file != '..' && !is_link($nextpath)){
				if(is_dir($nextpath)){
					$dircount++;
					$result = getDirSize($nextpath);
					$totalsize += $result['size'];
					$totalcount += $result['count'];
					$dircount += $result['dircount'];
				}elseif(is_file($nextpath)){
					$totalsize += filesize($nextpath);
					$totalcount++;
				}
			}
		}
	}
	closedir($handle);
	$total['size'] = $totalsize;
	$total['count'] = $totalcount;
	$total['dircount'] = $dircount;
	return $total;
}

function sizeFormate($size){
	$sizeStr='';
	if($size<1024){
		return $size." bytes";
	}else if($size<(1024*1024)){
		$size=round($size/1024,1);
		return $size." KB";
	}else if($size<(1024*1024*1024)){
		$size=round($size/(1024*1024),1);
		return $size." MB";
	}else{
		$size=round($size/(1024*1024*1024),1);
		return $size." GB";
	}

}