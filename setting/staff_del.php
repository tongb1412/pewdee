<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$sid = $_POST['id'];
$sql_delete="delete from tb_staff where staffid= '$sid'";
mysql_query($sql_delete);
echo '||setting/employee.php'.'||'.$cid.'||DEL';
?>