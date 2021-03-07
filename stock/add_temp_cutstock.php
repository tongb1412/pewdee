<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
if($_SESSION['branch_id'] !="") {	
	$where_branch_id = " and branchid ='".$_SESSION['branch_id']."'  ";
	$branch_id = $_SESSION['branch_id'];
}else if ($_SESSION['branch_id'] =="") {	
	$where_branch_id = " and branchid ='".$_SESSION['branch_id']."'  ";
}
$lno = $_POST['lno'];
$typ = $_POST['typ'];
$did = $_POST['did'];
$dname = $_POST['dname'];
$qty = $_POST['qty'];
$unit = $_POST['unit'];

echo $did.'  '.$dname;

 $sql1 = "select did from tb_temp_drugecutstock where lno='$lno' and did='$did'" . $where_branch_id;

 $result = mysql_query($sql1) or die ("Error Query ".$sql1); 
 $n = mysql_num_rows($result);
 if(empty($n)){

	$sql = "insert into tb_temp_drugecutstock  values('$lno','$typ','$did','$dname','$unit','$qty','$branch_id')";	
	
 } else {
 
 	$sql = "Update tb_temp_drugecutstock Set qty='$qty' Where lno='$lno' and did='$did' and typ='$typ' "  . $where_branch_id;
 }
 mysql_query($sql);

echo '||stock/temp_cutstock_list.php'.'||'.$lno.'||DEL||บันทึกข้อมูลเรียบร้อยแล้ว';
?>