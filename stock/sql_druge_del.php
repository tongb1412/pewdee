<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$lno = $_POST['lno'];
$did = $_POST['did'];
$sql_delete="delete from tb_temp_drugeinstock where lno='$lno' and did='$did' ";
mysql_query($sql_delete);
echo '||'.$url.'||'.$lno.'||ADD||'.$sql_delete;
?>