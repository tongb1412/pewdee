<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$tid = $_POST['id'];
$cid = $_POST['cid'];
$sql_delete="delete from tb_course_detail where tid = '$tid' and cid = '$cid' ";
mysql_query($sql_delete);
echo '||setting/course_treatment_list.php'.'||'.$_POST['cid'].'||DEL';
?>