<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
session_start();
include('../class/config.php');
include_once('../class/permission_user.php');
$id = $_POST['id'];
$name = $_POST['name'];
$unit = $_POST['unit'];
$price = $_POST['price'];
$total = $_POST['total'];
$dat = date('d-m-Y',time());

$company_code = $_SESSION['company_code'];
$branchid = $_SESSION['branchid'];
if($company_code == "") {
	$company_code = "NULL";
}else {
	$company_code = "'$company_code'";
}
if($branchid == "") {
	$branchid = "NULL";
}else {
	$branchid = "'$branchid'";
}

if($_POST['type']!='edit'){

		$sql = "insert into tb_costs  values(NULL,'$dat','$name','$unit','$price','$total',$branchid,$company_code)";	
	

} else {
	$sql = "Update tb_costs Set date='$dat',name='$name',unit='$unit',price='$price'";
	$sql .= ",total='$total' ";
}
// echo $sql;
mysql_query($sql);
echo '||setting/costs_list.php'.'||'.$id.'||ADD||บันทึกข้อมูลเรียบร้อยแล้ว';
?>