<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$id = $_POST['id'];
$cid = $_POST['cid'];
$sql_delete="delete from tb_package_detail where id = '$id' and pid = '$cid' ";
mysql_query($sql_delete);
echo '||setting/package_treatment_list.php'.'||'.$_POST['cid'].'||DEL';
?>