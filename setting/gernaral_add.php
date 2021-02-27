<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$id = $_POST['id'];
$name = $_POST['gname'];
$mode = $_POST['mode'];
$dis = $_POST['dis'];
if($_POST['type']!='edit'){
	$sql = "insert into tb_gernaral  values('NULL','$name','$mode','$dis')";	
} else {
	$sql = "Update tb_gernaral Set name='$name',discount='$dis' Where id='$id'";
}
mysql_query($sql);
echo '||setting/gernaral_list.php'.'||'.$_POST['mode'].'||DEL||บันทึกข้อมูลเรียบร้อยแล้ว';
?>