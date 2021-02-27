<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$cid = $_POST['id'];
$sql_delete="delete from tb_course where cid= '$cid'";
mysql_query($sql_delete);
echo '||setting/course.php'.'||'.$cid.'||DEL';
?>