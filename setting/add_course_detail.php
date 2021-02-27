<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$cid = $_POST['cid'];
$tid = $_POST['tid'];
$tname = $_POST['tname'];
$qty = $_POST['qty'];
$price = $_POST['price'];
$uprice = $_POST['uprice'];


if($_POST['type']!='edit'){
	$sql = "insert into tb_course_detail  values('$cid','$tid','$tname','$qty','$price','$uprice')";	
	mysql_query($sql);	
	
} else {
	$sql = "Update tb_course_detail Set qty='$qty',price='$price' Where tid='$tid' and cid='$cid'";
	mysql_query($sql);
}

echo '||setting/course_treatment_list.php'.'||'.$cid.'||DEL||บันทึกข้อมูลเรียบร้อยแล้ว';
?>