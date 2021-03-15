<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$vn = $_POST['vn'];
$hn = $_POST['hn'];
$lid = $_POST['lid'];
$lname = $_POST['lname'];
$qty = $_POST['qty'];
$price = $_POST['price'];

$eid = $_POST['eid'];
$ename = $_POST['ename'];
$mem = $_POST['mem'];
$branch_id = $_SESSION['branch_id'];
$company_code = $_SESSION['company_code'];
$company_data = $_SESSION['company_data'];

	$sql = "select * from tb_labrec where lid='$lid' and hn='$hn' and vn='$vn' and branchid = '$branch_id' and company_code = '$company_code' ";
	$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
	$Num_Rows = mysql_num_rows($result);
	if(empty($Num_Rows)){
		$sql = "insert into tb_labrec  values('$vn','$hn','$lid','$lname','$qty','$price','$eid','$ename','$mem','$branch_id','$company_code')";
		mysql_query($sql);	   		
	} else {
		$sql = "Update tb_labrec Set qty='$qty',eid='$eid',ename='$ename',mem='$mem' Where vn='$vn' and lid='$lid' and hn='$hn' and branchid = '$branch_id' and company_code = '$company_code' ";
		mysql_query($sql);
	}
	$txt = $sql;

echo '||doctor/doctor_form.php'.'||'.$vn.'||'.$con.'||'.$txt;
?>