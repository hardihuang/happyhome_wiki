<?php 
require_once 'include.php';


$arr=$_POST;
// return print_r($arr);
$id=$arr['id'];
$sql="select * from hh_content where id=$id";
$data=fetchOne($sql);


$oldFile=$data['file'];
$oldImg=$data['img'];
$newName=$arr['fileName'];


//temp start----------------------------------

//temp end----------------------------------


// edit prep start
$prep['title']=$arr['title'];
$prep['description']=$arr['description'];
// $prep['date']=date('o-m-d H:i:s');
$prep['subject']=$arr['subject'];
$prep['grade']=$arr['grade'];
$prep['term']=$arr['term'];
$prep['type']=$arr['type'];

update('hh_content',$prep,"id=$id");
// edit prep end

// edit file start
$filePath='../upload/files/';
if(isset($_FILES['file'])){
	// delete old file
	$oldFile=iconv("UTF-8","gb2312", $oldFile);
	$file=$filePath.$oldFile;
	if(file_exists($file)){
		unlink($file);
	}
	// upload new file
	$uploadFile=uploadFile('file',$newName,$filePath);
	if($uploadFile&&is_array($uploadFile)){
		$newFileName=$uploadFile[0]['name'];
	}else{
		echo "上传文件失败";
		return;
	}
}else{
	//rename the file
	$ext=getExt($oldFile);
	$newFileName=$newName.'_'.time().'.'.$ext;
	$newFileName=iconv("UTF-8","gb2312", $newFileName);
	$oldFile=iconv("UTF-8","gb2312", $oldFile);
	
	rename($filePath.$oldFile,$filePath.$newFileName);
	$newFileName=iconv("gb2312","UTF-8", $newFileName);
}

//insert the new file name to the database
update('hh_content',array('file'=>$newFileName),"id=$id");
// edit file end

// edit img start
$imgPath='../upload/thumb/';
if(isset($_FILES['img'])){
	if($oldImg!="default.jpg"){
		if($_FILES['img']['error']!=4){
			// delete old img
			$oldImg=iconv("UTF-8","gb2312", $oldImg);
			$img=$imgPath.$oldImg;
			if(file_exists($img)){
				unlink($img);
			}
			//upload new img
			$uploadFile=uploadFile('img',$newName,$imgPath,array("jpg","jpeg","gif","png"),157286400);
			if($uploadFile&&is_array($uploadFile)){
				$newImgName=$uploadFile[0]['name'];
				$src=$imgPath.$newImgName;
				$src=iconv("UTF-8","gb2312", $src);
				thumb($src,$src,150);

			}
		}
	}elseif($oldImg=="default.jpg"){
		if($_FILES['img']['error']!=4){
			$uploadFile=uploadFile('img',$newName,$imgPath,array("jpg","jpeg","gif","png"),157286400);
			if($uploadFile&&is_array($uploadFile)){
				$newImgName=$uploadFile[0]['name'];
				$src=$imgPath.$newImgName;
				$src=iconv("UTF-8","gb2312", $src);
				thumb($src,$src,150);

			}
		}
	}
	
}else{
	// rename img
	if($oldImg!='default.jpg'){
		$ext=getExt($oldImg);
		$newImgName=$newName.'_'.time().'.'.$ext;
		$newImgName=iconv("UTF-8","gb2312", $newImgName);
		$oldImg=iconv("UTF-8","gb2312", $oldImg);

		rename($imgPath.$oldImg,$imgPath.$newImgName);
		$newImgName=iconv("gb2312","UTF-8", $newImgName);
	}else{
		print_r("no need to change! old pic is default.jpg");
		$newImgName="default.jpg";
	}
}

//insert the new img name to the database
update('hh_content',array('img'=>$newImgName),"id=$id");
return print_r($newImgName);
// edit img end