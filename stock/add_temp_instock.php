<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$lno = $_POST['lno'];
$did = $_POST['did'];
$dname = $_POST['dname'];
$qty = $_POST['qty'];
$unit = $_POST['unit'];
$totalprice = $_POST['totalprice'];
$price = $_POST['price'];
$bdate = $_POST['bdate'];



$bdate = date("Y-m-d",strtotime(str_replace('/', '-',$bdate)));
$edate = $_POST['edate'];
$edate = date("Y-m-d",strtotime(str_replace('/', '-',$edate)));
if($_SESSION['branch_id'] !="") {	
	$where_branch_id = " and branchid ='".$_SESSION['branch_id']."'  ";
	$branch_id = $_SESSION['branch_id'];
}else if ($_SESSION['branch_id'] =="") {	
	$where_branch_id = " and branchid ='".$_SESSION['branch_id']."'  ";
}

 $sql1 = "select did from tb_temp_drugeinstock where lno='$lno' and did='$did'";
 $result = mysql_query($sql1) or die ("Error Querycc ".$sql1); 
 $n = mysql_num_rows($result);
 if(empty($n)){

	$sql = "insert into tb_temp_drugeinstock  values('$lno','$did','$dname','$unit','$qty','$price','$totalprice','$bdate','$edate','$branch_id')";	

 } else {
 
 	$sql = "Update tb_temp_drugeinstock Set qty='$qty',price='$price',totalprice='$totalprice',bdate='$bdate',edate='$edate' Where lno='$lno' and did='$did'";
 }
 mysql_query($sql);

echo '||stock/temp_instock_list.php'.'||'.$lno.'||DEL||บันทึกข้อมูลเรียบร้อยแล้ว';
?>