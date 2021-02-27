<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$vn = $_POST['vn'];
$lid = $_POST['lid'];

$sql = "delete from tb_labrec  Where vn='$vn' and lid='$lid' ";
mysql_query($sql);

echo '||doctor/doctor_form.php'.'||'.$vn.'||DEL||DEL';
?>