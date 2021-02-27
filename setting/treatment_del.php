<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$tid = $_POST['id'];
$sql_delete="delete from tb_treatment where tid= '$tid'";
mysql_query($sql_delete);
echo '||setting/treatment.php'.'||'.$tid.'||DEL';
?>