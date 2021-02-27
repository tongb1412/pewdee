<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$vn = $_POST['vn'];
$did = $_POST['did'];

$sql = "delete from tb_drugerec  Where vn='$vn' and did='$did' ";
mysql_query($sql);

echo '||doctor/doctor_form.php'.'||'.$vn.'||DEL||DEL';
?>