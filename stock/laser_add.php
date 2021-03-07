<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');

$lid = $_POST['lid'];
$lname = trim($_POST['lname']);
$total = trim($_POST['total']);
$unit = $_POST['unit'];
$sqty = $_POST['sqty'];

if($_POST['type']=='ADD'){


 $sql1 = "select lname from tb_laser where lid='$lid'";
 $result = mysql_query($sql1) or die ("Error Query ".$sql1); 
 $n = mysql_num_rows($result);
 if(empty($n)){
 
	$sql2  = "insert into tb_laser  values('$lid','$lname','$unit','$sqty','$total')";
	mysql_query($sql2) or die ("Error Query [".$sql2."]");
	
	$sql2  = "update tb_autonumber set last='$lid' where typ='LS'";
	mysql_query($sql2) or die ("Error Query [".$sql2."]");	
	
	
	$txt = 'บันทึกข้อมูลเรียบร้อยแล้ว';
	$lid='';
	
  } else {

	$txt = 'รหัสเลเซอร์ มีในระบบแล้วไม่สามารถบันทึกได้';  
  }		

} else {
	$sql2  = "update tb_laser set lname='$lname',unit='$unit',sqty='$sqty' where lid='$lid'";
	mysql_query($sql2) or die ("Error Query [".$sql2."]");
	
	$txt = 'แก้ไขข้อมูลเรียบร้อยแล้ว';	
}




echo '||stock/laser.php'.'||'.$lid.'||ADD||'.$txt;
?>