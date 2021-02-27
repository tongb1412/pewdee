<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$lno = $_POST['lno'];
$lid = $_POST['lid'];
$sql_delete="delete from tb_temp_laserinstock where lno='$lno' and lid='$lid' ";
mysql_query($sql_delete);
echo '||'.$url.'||'.$lno.'||DEL';
?>