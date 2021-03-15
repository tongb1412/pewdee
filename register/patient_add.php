<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
require('../class/permission_user.php'); 

$bid = $_POST['bid'];


$branch_id = "";
if($bid == "" || $bid == undefined || $bid == null){
	if($_SESSION["branch_id"] != ""){
		$branch_id = $_SESSION["branch_id"];
	}
} else {
	$branch_id = $bid;
}

$where_user_data = set_where_user_data('',$branch_id, $_SESSION['company_code'], $_SESSION['company_data']);
$company_data = $_SESSION['company_data'];
$company_code = $_SESSION['company_code'];

$cardno = $_POST['cardno'];
$hn = $_POST['hn'];
$pname = trim($_POST['pname']);
$sex = $_POST['sex'];
$fname = trim($_POST['fname']);
$lname = trim($_POST['lname']);
$level = $_POST['level'];
$st = $_POST['st'];
$bl = $_POST['bl'];
$oc = $_POST['oc'];
$pno = $_POST['pno'];
$pass = $_POST['pass'];
if(empty($_POST['dy'])){
	$dob = '';
} else {
	$dob = $_POST['dd'].'/'.$_POST['dm'].'/'.$_POST['dy'];
}



$adderss = $_POST['adderss'];
$tum = $_POST['tum'];
$aum = $_POST['aum'];
$province = $_POST['province'];
$post = $_POST['post'];

$country = $_POST['country'];
$tel = $_POST['tel'];
$mtel = $_POST['mtel'];
$email = $_POST['email'];
$facebook = $_POST['facebook'];
$mem = $_POST['mem'];
$typ = $_POST['typ'];
$how = $_POST['how'];
$other = $_POST['other'];

$dat = date('Y-m-d H:i:s');

if($_POST['mode']=='ADD'){
	$sql1 = "select fname from tb_patient where fname='$fname' and lname='$lname' " . $where_user_data['where_company_code'];
	$result = mysql_query($sql1) or die ("Error Query ".$sql1); 
	$n = mysql_num_rows($result);
	if(empty($n)){

		$sql1 = "select fname from tb_patient where hn='$hn'" . $where_user_data['where_company_code'];
		$result = mysql_query($sql1) or die ("Error Query ".$sql1); 
		$n = mysql_num_rows($result);
		if(empty($n)){

			$sql  = "insert into tb_patient values('$hn','$cardno','$dat','$level','$pname','$fname','$lname','$sex','$pno'";
			$sql .= ",'$dob','$bl','$oc','$st','$adderss','$tum','$aum','$province','$country','$post','$tel','$mtel','$email'";
			$sql .= ",'$facebook','$pass','REG','-','-','-','$mem','$typ','$how','$other','$branch_id', '$company_code')";
			mysql_query($sql) or die ("Error Query [".$sql."]");
			
			$sql  = "update tb_autonumber set last='$hn' where typ='HN'";
			mysql_query($sql) or die ("Error Query [".$sql."]");
			
			$confirm = 'Yes';
			$txt = 'บันทึกข้อมูลเรียบร้อยแล้ว';
			
		} else {
			$confirm = 'No';
			$txt = 'รหัสคนไข้ มีในระบบแล้วไม่สามารถบันทึกได้';  
		}		
	} else {
		$confirm = 'No';
		$txt = 'ชื่อ - สกุล มีในระบบแล้วไม่สามารถบันทึกได้';
	}
} else {
	if($company_data == "1"){
		$sql  = "update tb_patient set cradno='$cardno',level='$level',pname='$pname',fname='$fname',lname='$lname',sex='$sex'";
		$sql .= ",personalid='$pno',birthday='$dob',blood='$bl',occupation='$oc',state='$st',address='$adderss'";
		$sql .= ",tum='$tum',aum='$aum',province='$province',country='$country',post='$post',telephone='$tel'";
		$sql .= ",selfphone='$mtel',email='$email',facebook='$facebook',passport='$pass',mem='$mem',new='$typ',how='$how',other='$other', branchid = '$branch_id' where hn='$hn'" ;
	} else {
		$sql  = "update tb_patient set cradno='$cardno',level='$level',pname='$pname',fname='$fname',lname='$lname',sex='$sex'";
		$sql .= ",personalid='$pno',birthday='$dob',blood='$bl',occupation='$oc',state='$st',address='$adderss'";
		$sql .= ",tum='$tum',aum='$aum',province='$province',country='$country',post='$post',telephone='$tel'";
		$sql .= ",selfphone='$mtel',email='$email',facebook='$facebook',passport='$pass',mem='$mem',new='$typ',how='$how',other='$other' where hn='$hn'" ;
	}
	

	mysql_query($sql) or die ("Error Query [".$sql."]");
	$confirm = 'Yes';
	$txt = 'แก้ไขข้อมูลเรียบร้อยแล้ว';	
}




echo '||'.$confirm.'||'.$txt.'||'.$hn;
?>