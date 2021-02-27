<?
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
include('../class/config.php');
$user = $_POST['user'];
$pass = $_POST['pass'];


$sql1 = "select staffid,pname,fname,lname,user,pass,mode from tb_staff where user='$user' and pass='$pass' ";
$result = mysql_query($sql1) or die ("Error Querycc ".$sql1); 
$n = mysql_num_rows($result);

if(!empty($n)){
    $rs=mysql_fetch_array($result);
	$confirm ='Y'; 
	$txt= $rs['mode']; 
	session_register("SYS_EID");
	session_register("SYS_ENAME");	
	$SYS_EID = $rs['staffid']; 
	$SYS_ENAME = $rs['pname'].$rs['fname'].'    '.$rs['lname']; 
	$_SESSION["mode"] = $rs['mode']; 
	$dat = date('Y-m-d');
	$tim = date('H:i:s');
	$sql = "insert into tb_login  values('$SYS_EID','$dat','$tim','$SYS_ENAME')";
//	echo $sql;exit();
	mysql_query($sql);	 	
	
} else { $confirm ='N' ; $txt='Username หรือ Password ไม่ถูกต้อง'; }


echo '||'.$confirm.'||'.$txt;
?>