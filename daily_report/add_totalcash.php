<?
include('../class/config.php');

$cash_yes = $_POST['cash_yes'];
$to_day = $_POST['to_day'];
$coste = $_POST['coste'];
$doctor = $_POST['doctor'];
$bank = $_POST['bank'];
$mem = $_POST['mem'];
$check = $_POST['check'];
$sempid = $_POST['sempid'];
$cempid = $_POST['cempid'];
$empid = $_POST['empid'];
//echo 'xsempid';

$dat = date('Y-m-d');
//$dat = substr($dat,6,4).'-'.substr($dat,3,2).'-'.substr($dat,0,2);
$date = date('Y-m-d H:i;s');

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


$sql = "select * from tb_totalcash where date = '$dat'";
$str = mysql_query($sql) or die ("Error Query [".$sql."]");
$n = mysql_num_rows($str);
if(empty($n)){
	$sql = "insert into tb_totalcash  values('$dat','$cash_yes','$to_day','$coste','$doctor','$bank','$mem','$check','$sempid','$cempid','$empid','$date',$branchid,$company_code)";
	mysql_query($sql) or die ("Error Query [".$sql."]");
	$txt = 'บันทึกข้อมูลเรียบร้อยแล้ว'.$xsempid;
} else {
	$sql = "Update tb_totalcash Set cash_yes='$cash_yes',today_total='$to_day',coste='$coste',doctor_cos='$doctor',
			bank='$bank',mem='$mem',total='$check',
			empname='$sempid',cashier='$cempid',
			cashier_check='$empid',datenow='$date' Where date='$dat' ";
	mysql_query($sql) or die ("Error Query [".$sql."]");
	$txt = 'แก้ไขข้อมูลเรียบร้อยแล้ว';
}


 


echo '||daily_report/totalprice.php'.'||APP||ADD||'.$txt;
?>