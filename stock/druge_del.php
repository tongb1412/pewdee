<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$did = $_POST['id'];
$sql_delete="delete from tb_druge where did= '$did'";
mysql_query($sql_delete);
echo '||stock/druge_list.php'.'||Druge||DEL';
?>