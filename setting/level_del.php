<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$id = $_POST['id'];
$sql_delete="delete from tb_level where velid= '$id'";
mysql_query($sql_delete);
echo '||setting/level_list.php'.'||'.$id.'||DEL';
?>