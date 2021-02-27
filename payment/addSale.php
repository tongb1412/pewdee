<?
include('../class/config.php');
$cno = $_POST['cno'];
$ptype = $_POST['ptype'];
$pid = $_POST['pid'];
$pname = $_POST['pname'];
$pqty = $_POST['pqty'];
$price = $_POST['price'];
$pseid = $_POST['pseid'];
$psename = $_POST['psename'];

$cash = $_POST['cash'];
$credit = $_POST['credit'];
$bank = $_POST['bank']; 
$bno = $_POST['creditno'];
$dat = date('Y-m-d H:i:s');
$sql = "select cno from tb_salepct where cno='$cno' ";
$str = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$n = mysql_num_rows($str);
if(empty($n)){
	$sql  = "insert into tb_salepct values('$cno','$ptype','$pid','$pname','$pqty','$price','$pseid','$psename','$dat'";
	$sql .= ",'$cash','$credit','$bank','$bno')";
	mysql_query($sql) or die ("Error Insert [".$sql."]"); 
	$con = 'Y'; 
} else {
	$con = 'N'; $cno='รหัสซ้ำไม่สามารถซื้อได้';
}
echo '||'.$con.'||'.$cno;

?>
