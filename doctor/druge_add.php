<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$vn = $_POST['vn'];
$hn = $_POST['hn'];
$did = $_POST['did'];
$dname = $_POST['dname'];
$qty = $_POST['qty'];
$price = $_POST['price'];
$typ = $_POST['typ'];
$fis = $_POST['fis'];


$sql = "select total,unit,duse from tb_druge where did = '$did' ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$rs=mysql_fetch_array($result);
if($rs['total'] >= $qty){
	$con = 'DELL'; $txt = '';
    $unit = $rs['unit'];
    $duse = $rs['duse'];

	$sql = "select * from tb_drugerec where did='$did' and hn='$hn' and vn='$vn' and pid='-' ";
	$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
	$Num_Rows = mysql_num_rows($result);
	if(empty($Num_Rows)){
		$sql = "insert into tb_drugerec  values('$vn','$hn','$did','$dname','$qty','$unit','$price','$duse','$typ','$fis','-')";
		mysql_query($sql);	   		
	} else {
		$sql = "Update tb_drugerec Set qty='$qty',duse='$duse' Where vn='$vn' and did='$did' and hn='$hn' and pid='-'  ";
		mysql_query($sql);
	}
	$txt = $sql;

} else {
	$con = 'ADD'; $txt = 'จำนวนยาในคลังไม่พอจ่าย  จำนวนยาที่จ่ายได้คือ '.$rs['total'];
}




echo '||doctor/doctor_form.php'.'||'.$vn.'||'.$con.'||'.$txt;
?>