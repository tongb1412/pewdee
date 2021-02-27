<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$cid = $_POST['cid'];
$cname = $_POST['cname'];
$price = $_POST['price'];

$sql = "select * from tb_package where pid = '$cid' ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$Num_Rows = mysql_num_rows($result);
if(empty($Num_Rows)){
	$sql = "insert into tb_package  values('$cid','$cname','$price')";
	mysql_query($sql);
	$sql  = "update tb_autonumber set last='$cid' where typ='PT'";
	mysql_query($sql) or die ("Error Query [".$sql."]");	
	  		
} else {
	$sql = "Update tb_package Set name='$cname',price='$price' Where pid='$cid'";
	mysql_query($sql);
}

echo '||setting/new_package.php'.'||'.$_POST['price'].'||ADD||บันทึกข้อมูลเรียบร้อยแล้ว';
?>