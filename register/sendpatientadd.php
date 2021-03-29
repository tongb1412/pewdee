<?php
session_start();
include('../class/config.php');
include('../class/permission_user.php');
$hn = $_POST['hn'];
$eid = $_POST['eid'];
$bid = $_POST['bid'];
$_SESSION['patient_branch_id'] = "";
$branch_id = "";

if(empty($bid)){
    if($_SESSION['branch_id'] != ""){
        $branch_id = $_SESSION['branch_id'];
    }
}
else{
    $branch_id = $bid;
}

if($hn != ""){
    $_SESSION['patient_branch_id'][$hn] = $bid; // รหัสสาขา ของคนไข้ที่จะนำเข้าระบบ
}

$company_code = $_SESSION['company_code'];
$company_data = $_SESSION['company_data'];
$where_user =  set_where_user_data('',$branch_id, $company_code, $company_data);

$vn = 'VN'.date('ymdHis',time());
$dat = date('Y-m-d H:i:s',time());
if($eid!='00') {
    $sql = "select * from tb_staff where staffid='$eid'";
    $result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
    $rs = mysql_fetch_array($result);
    $ename = $rs['pname'].$rs['fname'].'    '.$rs['lname'];
} else {
    $ename = 'ไม่ระบุแพทย์';
}

$sql = "insert into tb_vst values('$vn','$hn','$dat','DOC','$eid','$ename','00',NULL,'','$branch_id','$company_code')";
// echo $sql;exit();
mysql_query($sql);	

$sql = "update tb_patient set stayin = 'DOC',vn='$vn' where hn='$hn' " . $where_user['where_company_code'];
mysql_query($sql);

echo '||register/register.php'.'||'.$hn.'||Y||ส่งคนไข้เข้าระบบเรียบร้อยแล้ว';
?>