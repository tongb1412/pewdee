<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?
include('../class/config.php');
$lno = $_POST['lno'];
$did = $_POST['did'];

$sql_delete="delete from tb_temp_drugeinstock where did= '$did' and lno='$lno'";
mysql_query($sql_delete);
echo '||stock/temp_instock_list.php'.'||'.$lno.'||DEL';

?>