<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$tid = $_POST['tid'];
$tname = $_POST['tname'];
$price = $_POST['price'];
$mode = $_POST['mode'];
$unit = $_POST['unit'];
$tgroup = $_POST['tgroup'];

if($_POST['type']!='edit'){
	$sql = "insert into tb_treatment  values('$tid','$tname','$price','$mode','$unit','$tgroup')";	
	mysql_query($sql);
	
	$sql  = "update tb_autonumber set last='$tid' where typ='TM'";
	mysql_query($sql) or die ("Error Query [".$sql."]");	
	
} else {
	$sql = "Update tb_treatment Set tname='$tname',price='$price',typ='$mode',unit='$unit',tgroup='$tgroup' Where tid='$tid'";
	mysql_query($sql);
}

echo '||setting/treatment.php'.'||'.$tid.'||DEL||บันทึกข้อมูลเรียบร้อยแล้ว';
?>