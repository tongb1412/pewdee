<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$pid = $_POST['id'];
$sql_delete="delete from tb_package where pid= '$pid'";
mysql_query($sql_delete);
echo '||setting/package.php'.'||'.$cid.'||DEL';
?>