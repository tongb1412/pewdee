<?
// session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
include('../class/config.php');
$user = $_POST['user'];
$pass = $_POST['pass'];


$sql1 = "select staffid,pname,fname,lname,user,pass,mode,branchid,company_code,company_data from tb_staff where user='$user' and pass='$pass' ";
$result = mysql_query($sql1) or die ("Error Query ".$sql1); 
$n = mysql_num_rows($result);

if(!empty($n)){
    $rs=mysql_fetch_array($result);
	$confirm ='Y'; 
	$txt= $rs['mode']; 
	$_SESSION["SYS_EID"]  = $rs['staffid']; 
	$_SESSION["SYS_ENAME"] = $rs['pname'].$rs['fname'].'    '.$rs['lname']; 
	$_SESSION["mode"] = $rs['mode']; 
	$_SESSION["branch_id"] = $rs['branchid']; 
	$_SESSION["company_data"] = $rs['company_data']; 
	$_SESSION["company_code"] = $rs['company_code']; 
	$SYS_EID= $_SESSION["SYS_EID"] ;
	$SYS_ENAME= $_SESSION["SYS_ENAME"] ;
	$branch_id= $_SESSION["branch_id"] ;
	$company_code= $_SESSION["company_code"] ;
	$dat = date('Y-m-d');
	$tim = date('H:i:s');
	print_r($rs);
	$sql = "insert into tb_login  values('$SYS_EID','$dat','$tim','$SYS_ENAME','$branch_id','$company_code')";
//	echo $sql;exit();
	mysql_query($sql);	 	
	
} else { $confirm ='N' ; $txt='Username หรือ Password ไม่ถูกต้อง'; }


echo '||'.$confirm.'||'.$txt;
?>