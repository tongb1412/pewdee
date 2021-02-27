<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$lno = $_POST['lno'];
$lid = $_POST['lid'];
$lname = $_POST['lname'];
$qty = $_POST['qty'];
$unit = $_POST['unit'];


 $sql1 = "select lid from tb_temp_laserinstock where lno='$lno' and lid='$lid'";
 $result = mysql_query($sql1) or die ("Error Querycc ".$sql1); 
 $n = mysql_num_rows($result);
 if(empty($n)){

	$sql = "insert into tb_temp_laserinstock  values('$lno','$lid','$lname','$unit','$qty')";	

 } else {
 
 	$sql = "Update tb_temp_laserinstock Set qty='$qty' Where lno='$lno' and lid='$lid'";
 }
 mysql_query($sql);

echo '||stock/temp_laserinstock_list.php'.'||'.$lno.'||DEL||บันทึกข้อมูลเรียบร้อยแล้ว';
?>