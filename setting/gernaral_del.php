<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$id = $_POST['id'];
$sql_delete="delete from tb_gernaral where id= '$id'";
mysql_query($sql_delete);
echo '||setting/gernaral_list.php'.'||'.$_POST['mode'].'||DEL';
?>