<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<? 
include('../class/config.php'); 
$did = $_POST['did'];
if($_POST['mode']=='off'){
	$sql = "Update tb_druge Set status='OUT' Where did='$did'";
	mysql_query($sql);
	
} else {
	$sql = "Update tb_druge Set status='IN' Where did='$did'";
	mysql_query($sql);
	
}
echo '||daily_report/drug_out.php'.'||'.$_POST['mode'].'||DEL||บันทึกข้อมูลเรียบร้อยแล้ว';
?>