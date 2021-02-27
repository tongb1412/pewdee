<?
include('../class/config.php');
$hn = $_POST['hn'];
$eid = $_POST['eid'];

$vn = 'VN'.date('ymdHis',time());
$dat = date('Y-m-d H:i:s',time());
if($eid!='00'){
$sql = "select * from tb_staff where staffid='$eid'";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$rs=mysql_fetch_array($result);
$ename = $rs['pname'].$rs['fname'].'    '.$rs['lname'];
} else {
$ename = 'ไม่ระบุแพทย์';
}

$sql = "insert into tb_vst  values('$vn','$hn','$dat','DOC','$eid','$ename','00','','')";
mysql_query($sql);	

$sql = "update tb_patient set stayin='DOC',vn='$vn'  where hn='$hn' ";
mysql_query($sql);


echo '||register/register.php'.'||'.$hn.'||Y||ส่งคนไข้เข้าระบบเรียบร้อยแล้ว';
?>