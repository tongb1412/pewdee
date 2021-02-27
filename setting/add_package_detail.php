<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$cid = $_POST['cid'];
$tid = $_POST['tid'];
$tname = $_POST['tname'];
$qty = $_POST['qty'];
$price = $_POST['price'];
$uprice = $_POST['uprice'];
$ptype = $_POST['ptype'];

if($_POST['type']!='edit'){
	$sql = "insert into tb_package_detail  values('$cid','$tid','$tname','$qty','$price','$uprice','$ptype')";	
	mysql_query($sql);	
	
} else {
	$sql = "Update tb_package_detail Set price='$price',qty='$qty' Where id='$tid' and pid='$cid' ";
	mysql_query($sql);
}

echo '||setting/package_treatment_list.php'.'||'.$cid.'||DEL||'.$sql;
?>