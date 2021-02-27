<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<? 
include('../class/config.php'); 
$cn = $_POST['cn'];

if($_POST['mode']=='off'){
	$sql = "Update tb_patient Set stayin='OFF' Where hn='$cn'";
	mysql_query($sql);
	
} else {
	$sql = "Update tb_patient Set stayin='REG' Where hn='$cn'";
	mysql_query($sql);
	
}
echo '||daily_report/patient_out.php'.'||'.$_POST['mode'].'||DEL||บันทึกข้อมูลเรียบร้อยแล้ว';
?>