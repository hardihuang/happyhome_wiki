<?php 
require_once 'include.php';

header('Content-type:text/json;charset=utf8');
// echo json_encode(getAllContents());

function getAllContents(){
	$sql="select c.id,c.title,c.description,c.date,c.img,c.file,g.name as grade,s.name as subject,t.name as type,te.name as term from hh_content as c left join hh_grade as g on c.grade=g.id left join hh_subject as s on c.subject = s.id left join hh_type as t on c.type = t.id left join hh_term as te on c.term = te.id order by c.date desc";
	$rows=fetchAll($sql);
	return $rows;
}

$output=array();
$data = getDirSize('../upload/files');

//文件总数
$output[0][0]=$data['count'];
//文件总大小
$output[0][1]=sizeFormate($data['size']);

$output[1]=getAllContents();
echo json_encode($output);
