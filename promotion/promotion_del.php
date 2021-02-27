<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$id = $_POST['id'];
$sql_delete="delete from promotion where proid= '$id'";
mysql_query($sql_delete);
echo '||promotion/promotion_list.php'.'||'.$id.'||DEL';
?>