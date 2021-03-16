<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$vn = $_POST['vn'];
$lid = $_POST['lid'];
$branch_id = $_SESSION['branch_id'];
$company_code = $_SESSION['company_code'];
$company_data = $_SESSION['company_data'];

$sql = "delete from tb_labrec  Where vn='$vn' and lid='$lid' and branchid = '$branch_id' and company_code = '$company_code' ";
mysql_query($sql);

echo '||doctor/doctor_form.php'.'||'.$vn.'||DEL||DEL';
?>