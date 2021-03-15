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
$branch_id = $_SESSION['branch_id'];
$company_code = $_SESSION['company_code'];
$data = array();
// $sql = "select total,unit,duse from tb_druge where did = '$did' ";
$sql = "select SUM(b.total), a.unit, a.duse from tb_druge as a, tb_drugeinstock as b where (a.did = '$did' and a.did = b.did) and b.branchid = '$branch_id' and (a.company_code = '$company_code' and b.company_code = '$company_code' )";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$rs = mysql_fetch_array($result);
$data['total'] = $rs['SUM(b.total)'];
if($data['total'] >= $qty){
	$con = 'DELL'; 
	$txt = '';
    $unit = $rs['unit'];
    $duse = $rs['duse'];

	$sql = "select * from tb_drugerec where did = '$did' and hn='$hn' and vn='$vn' and pid='-' and branchid = '$branch_id' and company_code = '$company_code'";
	$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
	$Num_Rows = mysql_num_rows($result);
	if(empty($Num_Rows)){
		$sql = "insert into tb_drugerec  values('$vn','$hn','$did','$dname','$qty','$unit','$price','$duse','$typ','$fis','-','$branch_id','$company_code')";
		mysql_query($sql);	   		
	} else {
		$sql = "Update tb_drugerec Set qty='$qty',duse='$duse' Where vn='$vn' and did='$did' and hn='$hn' and pid='-' and branchid = '$branch_id' and company_code = '$company_code'";
		mysql_query($sql);
	}
	$txt = $sql;

} else {
	$con = 'ADD'; $txt = 'จำนวนยาในคลังไม่พอจ่าย  จำนวนยาที่จ่ายได้คือ '.$rs['total'];
}




echo '||doctor/doctor_form.php'.'||'.$vn.'||'.$con.'||'.$txt;
?>