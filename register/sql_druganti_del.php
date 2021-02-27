<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$id = $_POST['id'];
$hn = $_POST['hn'];
$url = $_POST['url'];
$sql_delete="delete from tb_druganti where did= '$id' and hn='$hn' ";
mysql_query($sql_delete);
echo '||'.$url.'||'.$hn.'||DEL';
?>