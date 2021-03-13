<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
require('../class/permission_user.php'); 
$did = $_POST['id'];
$company_code = $_SESSION['company_code'];
$sql_delete="delete from tb_druge where did= '$did' and company_code = '$company_code' ";
mysql_query($sql_delete);
echo '||stock/druge_list.php'.'||Druge||DEL';
?>