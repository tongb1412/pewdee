<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$hn = $_POST['id'];
$sql = "select hn from tb_vst where hn='$hn'";
$str = mysql_query($sql);
$n = mysql_num_rows($str);
if(empty($n)){
	$sql_delete="delete from tb_patient where hn= '$hn'";
	mysql_query($sql_delete);
	echo '||register/patient_list.php'.'||Register||DEL';
} else {
echo '||register/patient_list.php'.'||Register||ADD||ไม่สามารถลบข้อมูลได้ เนื่องจากมีประวัติการรักษา';
}

?>