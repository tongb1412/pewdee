<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$cid = $_POST['cid'];
$cname = $_POST['cname'];
$price = $_POST['price'];
$total = $_POST['total'];
$cgroup = $_POST['cgroup'];
$sql = "select * from tb_course where cid = '$cid' ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$Num_Rows = mysql_num_rows($result);
if(empty($Num_Rows)){
	$sql = "insert into tb_course  values('$cid','$cname','$price','$cgroup')";
	mysql_query($sql);
	$sql  = "update tb_autonumber set last='$cid' where typ='CT'";
	 mysql_query($sql) or die ("Error Query [".$sql."]");	
	   		
} else {
	$sql = "Update tb_course Set cname='$cname',price='$price',cgroup='$cgroup' Where cid='$cid'";
	mysql_query($sql);
}

echo '||setting/new_course.php'.'||'.$_POST['mode'].'||ADD||บันทึกข้อมูลเรียบร้อยแล้ว';
?>