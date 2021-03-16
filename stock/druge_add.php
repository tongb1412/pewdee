<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');

$did = $_POST['did'];
$bcode = $_POST['bcode'];
$gname = trim($_POST['gname']);
$tname = $_POST['tname'];
$dgid = trim($_POST['dgid']);
$tid = trim($_POST['tid']);
$total = trim($_POST['total']);
$unit = $_POST['unit'];
$bprice = $_POST['bprice'];
$sprice = $_POST['sprice'];
$sqty = $_POST['sqty'];

$duse = $_POST['duse'];
$wuse = $_POST['wuse'];
$huse = $_POST['huse'];

$company_code = $_SESSION['company_code'];

$sql = "select name from tb_gernaral where id='$dgid' ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$rs=mysql_fetch_array($result);
$dgname = $rs['name'];

$sql = "select name from tb_gernaral where id='$tid' ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$rs=mysql_fetch_array($result);
$dtname = $rs['name'];


if($_POST['mode']=='ADD'){


 $sql1 = "select gname from tb_druge where did='$did'";
 $result = mysql_query($sql1) or die ("Error Query ".$sql1); 
 $n = mysql_num_rows($result);
 if(empty($n)){
 
	$sql  = "insert into tb_druge  values('$did','$bcode','$gname','$tname','$unit','$dgid','$dgname','$tid','$dtname','$bprice','$sprice','$total'";
	$sql .= ",'$sqty','$duse','$wuse','$huse','IN')";
	mysql_query($sql) or die ("Error Query [".$sql."]");
	
	$sql  = "update tb_autonumber set last='$did' where typ='DG'";
	mysql_query($sql) or die ("Error Query [".$sql."]");	
	
	$confirm = 'Yes';
	$txt = 'บันทึกข้อมูลเรียบร้อยแล้ว';
	
  } else {
	$confirm = 'No';
	$txt = 'รหัสนี้ มีในระบบแล้วไม่สามารถบันทึกได้';  
  }		

} else {
	$sql  = "update tb_druge set barcode='$bcode',gname='$gname',tname='$tname',unit='$unit',dgid='$dgid',wuse='$wuse',huse='$huse'";
	$sql .= ",dgroup='$dgname',sprice='$sprice',sqty='$sqty',tid='$tid',typname='$dtname',duse='$duse'  where did='$did' and company_code = '$company_code'";
	mysql_query($sql) or die ("Error Query [".$sql."]");
	$confirm = 'Yes';
	$txt = 'แก้ไขข้อมูลเรียบร้อยแล้ว';	
}




echo '||'.$confirm.'||'.$txt.'||'.$did;
?>