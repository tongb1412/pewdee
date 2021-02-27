<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$id = $_POST['id'];
$name = $_POST['name'];
$unit = $_POST['unit'];
$price = $_POST['price'];
$total = $_POST['total'];
$dat = date('d-m-Y',time());

if($_POST['type']!='edit'){

		$sql = "insert into tb_costs  values('NULL','$dat','$name','$unit','$price','$total')";	
	

} else {
	$sql = "Update tb_costs Set date='$dat',name='$name',unit='$unit',price='$price'";
	$sql .= ",total='$total' ";
}
mysql_query($sql);
echo '||setting/costs_list.php'.'||'.$id.'||ADD||บันทึกข้อมูลเรียบร้อยแล้ว';
?>