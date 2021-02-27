<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');

$staffid = $_POST['staffid'];
$branch = $_POST['branch'];
$pname = trim($_POST['pname']);
$nname = trim($_POST['nname']);
$sex = $_POST['sex'];
$fname = trim($_POST['fname']);
$lname = trim($_POST['lname']);
$pos = $_POST['pos'];
$st = $_POST['st'];
$bl = $_POST['bl'];
$degree = $_POST['degree'];
$acc = $_POST['acc'];
$tel = $_POST['tel'];
if(empty($_POST['dy'])){
	$dob = '';
} else {
	$dob = $_POST['dd'].'/'.$_POST['dm'].'/'.$_POST['dy'];
}




$address = $_POST['address'];
$idcard = $_POST['idcard'];
$mail = $_POST['mail'];
$status = $_POST['status'];
$tpy = $_POST['tpy'];
$sdate = $_POST['sdate'];
$dday = $_POST['dday'];
$ll = $_POST['ll'];
$sso = $_POST['sso'];
$ssonum = $_POST['ssonum'];
$mode = $_POST['mode'];
$show = $_POST['eshow'];
$user = $_POST['user'];
$pass = $_POST['pass'];

if($_POST['type']!='edit'){
	$sql  = "insert into tb_staff  values('$staffid','$pname','$fname','$lname','$nname','$st','$bl','$sex','$sdate','$status','$tpy'";
	$sql .= ",'$branch','$ll','$dob','$degree','$pos','-','-','-','$acc','$address','$tel','$mail','$sso','$ssonum','-','-','-','$idcard','$mode','$eshow','$user','$pass','E')";
	mysql_query($sql) or die ("Error Query [".$sql."]");

	
	$sql  = "update tb_autonumber set last='$staffid' where typ='PD'";
	mysql_query($sql) or die ("Error Query [".$sql."]");	
	
} else {

	$sql  = "update tb_staff set pname='$pname',fname='$fname',lname='$lname',sex='$sex',nickname='$nname',re_status='$st'";
	$sql .= ",blood='$bl',start_date='$sdate',status='$status',category='$tpy',branchid='$branch',L_date='$ll',birthday='$dob'";
    $sql .= ",degree='$degree',position='$pos',acc_number='$acc',address='$address',tel='$tel',email='$mail'";
	$sql .= ",sso='$sso',sso_on='$ssonum',idcard='$idcard',typ='$mode',eshow='$show',user='$user',pass='$pass'  ";
	$sql .= "where staffid='$staffid'";
	mysql_query($sql) or die ("Error Query [".$sql."]");
}

echo '||setting/employee.php'.'||'.$staffid.'||ADD||บันทึกข้อมูลเรียบร้อยแล้ว';

?>