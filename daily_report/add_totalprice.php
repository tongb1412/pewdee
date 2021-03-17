<?
include('../class/config.php');
$dat = $_POST['dat'];
$cash = $_POST['cash'];
$credit = $_POST['credit'];
$credit1 = $_POST['credit1'];
$credit2 = $_POST['credit2'];
$credit3 = $_POST['credit3'];
$credit4 = $_POST['credit4'];
$credit5 = $_POST['credit5'];
$credit6 = $_POST['credit6'];

$check = $_POST['check'];
$sempid = $_POST['sempid'];
$cempid = $_POST['cempid'];
$empid = $_POST['empid'];



$dat = substr($dat,6,4).'-'.substr($dat,3,2).'-'.substr($dat,0,2);
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

$sql = "select * from tb_totalprice where date = '$dat'";
$str = mysql_query($sql) or die ("Error Query [".$sql."]");
$n = mysql_num_rows($str);
if(empty($n)){
	$sql = "insert into tb_totalprice  values('$dat','$cash','$credit','$credit1','$credit2','$credit3','$credit4','$check','$sempid','$cempid','$empid','$date','$credit5','$credit6',$branchid,$company_code)";
	mysql_query($sql) or die ("Error Query [".$sql."]");
	$txt = 'บันทึกข้อมูลเรียบร้อยแล้ว'.$dat;
} else {
	$sql = "Update tb_totalprice Set cash='$cash',k_krungsri='$credit',k_kasikorn='$credit1',k_thai='$credit2',
			k_amax='$credit3',k_uob='$credit4',total='$check',
			empname='$sempid',cashier='$cempid',
			cashier_check='$empid',datenow='$date',k_ktc='$credit5',k_tana='$credit6' Where date='$dat' ";
	mysql_query($sql) or die ("Error Query [".$sql."]");
	$txt = 'แก้ไขข้อมูลเรียบร้อยแล้ว';
}


 


echo '||daily_report/totalprice.php'.'||APP||ADD||'.$txt;
?>