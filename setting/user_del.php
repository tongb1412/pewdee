<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$id = $_POST['id'];
$sql_delete="delete from tb_user where empid= '$id'";
mysql_query($sql_delete);
echo '||setting/user_list.php'.'||'.$id.'||DEL';
?>