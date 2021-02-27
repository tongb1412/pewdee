<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$velid = $_POST['velid'];
$name = $_POST['velname'];
$disdrug = $_POST['disdrug'];
$dislab = $_POST['dislab'];
$dislaser = $_POST['dislaser'];
$distr = $_POST['distr'];
$disco = $_POST['disco'];
$dispg = $_POST['dispg'];

if($_POST['type']!='edit'){

	$sql1 = "select velname from tb_level where velname='$name'  ";
	$result = mysql_query($sql1) or die ("Error Querycc ".$sql1); 
	$n = mysql_num_rows($result);
	if(empty($n)){
		$sql = "insert into tb_level  values('NULL','$name','$disdrug','$dislab','$dislaser','$distr','$disco','$dispg')";	
		$txt = 'บันทึกข้อมูลเรียบร้อยแล้ว';
		
	} else {
		$txt = 'ชื่อสถานะนี้มีในระบบแล้วไม่สามารถบันทึกได้';
	}

} else {
	$sql = "Update tb_level Set velname='$name',disdrug='$disdrug',dislab='$dislab',dislaser='$dislaser'";
	$sql .= ",disment='$distr',discourse='$disco',dispg='$dispg' Where velid='$velid'";
}
mysql_query($sql);
echo '||setting/level_list.php'.'||'.$velid.'||ADD||'.$txt;
?>