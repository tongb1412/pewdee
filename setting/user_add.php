<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$id = $_POST['staffid'];
$name = $_POST['fname'];
$unit = $_POST['user'];
$price = $_POST['pass'];


if($_POST['type']!='edit'){
$sql1 = "select empid from tb_user where empid='$id'  ";
$result = mysql_query($sql1) or die ("Error Querycc ".$sql1); 
$n = mysql_num_rows($result);
if(empty($n)){

 $sql1 = "select username from tb_user where username='$user'";
 $result = mysql_query($sql1) or die ("Error Querycc ".$sql1); 
 $n = mysql_num_rows($result);
 if(empty($n)){

		$sql = "insert into tb_user  values('$id','$fname','$user','$pass')";	
		$confirm = 'Yes';
		$txt = 'บันทึกข้อมูลเรียบร้อยแล้ว';
	
  } else {
	$confirm = 'No';
	$txt = 'username นี้มีในระบบแล้วไม่สามารถบันทึกได้';  
  }		
} else {
	$confirm = 'No';
	$txt = 'พนักงานท่านมีในระบบแล้วไม่สามารถบันทึกได้';
}
	

} else {
	$sql = "Update tb_user Set name='$fname',username='$user',password='$pass'  where empid='$id' ";
	
	$confirm = 'Yes';
	$txt = 'แก้ไขข้อมูลเรียบร้อยแล้ว';
}
mysql_query($sql);

echo '||setting/user_list.php'.'||'.$id.'||ADD||'.$sql;


?>