<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$hn = $_POST['hn'];
$mem = $_POST['mem'];
$vn = $_POST['vn'];
$dat = date('Y-m-d H:i:s',time());

$sql = "update tb_patient set vn='-',stayin='REG'  where hn='$hn' ";
mysql_query($sql);
	
$sql = "update tb_vst set status='CANCEL',ctime='$dat',mem='$mem'  where vn='$vn' ";
mysql_query($sql);

$sql = "delete from tb_pctrec  Where vn='$vn' ";
mysql_query($sql);

$sql = "delete from tb_pctuse  Where vn='$vn' ";
mysql_query($sql);

echo '||doctor/wait_list.php'.'||--||D||ส่งคนไข้กลับเวชระเบียนเรียบร้อยแล้ว';
?>