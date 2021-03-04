<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$id = $_POST['cn'];
$name = $_POST['name'];
$engname = $_POST['engname'];
$otime = $_POST['otime'];
$ctime = $_POST['ctime'];
$add = $_POST['add'];
$eadd = $_POST['engadd'];
$pro = $_POST['pro'];
$pos = $_POST['pos'];
$tex = $_POST['texid'];
$number = $_POST['number'];
$tel = $_POST['tel'];
$fax = $_POST['fax'];
$edit = $_POST['edit'];


$sql = "select * from tb_clinicinformation where cn = '$id' ";
$clinic_result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$row=mysql_fetch_array($clinic_result);
if($row['cn'] == $id) {
	$edit = "Y";
}

if($edit == "N") {
	$sql = "insert into tb_clinicinformation (cn,clinicname,address,province,telephone,fax,timeopen,timeclose,taxnumber,clinicnumber,post,nameeng,addeng )";
	$sql .= " values ('$id', '$name','$add','$pro','$tel','$fax','$otime','$ctime','$tex','$number','$pos','$engname','$engadd' ) ";
}else {
	$sql = "Update tb_clinicinformation Set clinicname='$name',address='$add',province='$pro',telephone='$tel',fax='$fax',";
	$sql = $sql."timeopen='$otime',timeclose='$ctime',taxnumber='$tex',clinicnumber='$number',post='$pos',nameeng='$engname',addeng='$engadd' ";
	//	$sql = $sql."nameeng='$engname',addeng='$engadd' ";
	$sql = $sql."Where cn='$id'";
}
// echo $sql;

mysql_query($sql);
echo '||setting/clinicinformation.php'.'||'.$_POST['mode'].'||ADD||บันทึกข้อมูลเรียบร้อยแล้ว';
?>