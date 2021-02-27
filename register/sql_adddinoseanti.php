<? include('../class/config.php'); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
$hn = $_POST['hn'];
$did = $_POST['did'];
$dname = $_POST['dname'];
$url = $_POST['url'];
$sql1 = "select dname from tb_dinoseanti where hn='$hn' and did='$did' ";
$result = mysql_query($sql1) or die ("Error Querycc ".$sql1); 
$n = mysql_num_rows($result);
if(empty($n)){
	$sql = "insert into tb_dinoseanti  values('$hn','$did','$dname')";
	mysql_query($sql);
}
echo '||'.$url.'||'.$hn.'||DEL||บันทึกข้อมูลเรียบร้อยแล้ว';
?>

