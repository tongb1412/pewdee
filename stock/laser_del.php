<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$lid = $_POST['id'];
$sql_delete="delete from tb_laser where lid= '$lid'";
mysql_query($sql_delete);
echo '||stock/laser_list.php'.'||Laser||DEL';
?>