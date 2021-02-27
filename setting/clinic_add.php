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

	$sql = "Update tb_clinicinformation Set clinicname='$name',address='$add',province='$pro',telephone='$tel',fax='$fax',";
	$sql = $sql."timeopen='$otime',timeclose='$ctime',taxnumber='$tex',clinicnumber='$number',post='$pos',nameeng='$engname',addeng='$engadd' ";
//	$sql = $sql."nameeng='$engname',addeng='$engadd' ";
	$sql = $sql."Where cn='$id'";

mysql_query($sql);
echo '||setting/clinicinformation.php'.'||'.$_POST['mode'].'||ADD||บันทึกข้อมูลเรียบร้อยแล้ว';
?>