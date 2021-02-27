<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$vn = $_POST['vn'];
$did = $_POST['did'];
$sql_delete="delete from tb_drugerec where vn= '$vn' and did='$did'";
mysql_query($sql_delete);
echo '||register/sale_druge_list.php'.'||'.$vn.'||DEL||'.$sql_delete;
?>