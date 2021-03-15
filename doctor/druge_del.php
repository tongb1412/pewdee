<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$vn = $_POST['vn'];
$did = $_POST['did'];
$branch_id = $_SESSION['branch_id'];
$company_code = $_SESSION['company_code'];

$sql = "delete from tb_drugerec  Where vn='$vn' and did='$did' and branchid = '$branch_id' and company_code = '$company_code'";
mysql_query($sql);

echo '||doctor/doctor_form.php'.'||'.$vn.'||DEL||DEL';
?>