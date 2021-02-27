<?
include('../class/config.php');
$an = $_POST['an'];


$sql = "Delete From tb_appointment  Where an='$an' ";
mysql_query($sql) or die ("Error Query [".$sql."]");	




echo '||appointment/new_form.php'.'||bbb||ADD||ลบข้อมูลเรียบร้อยแล้ว';
?>