<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
require('../class/permission_user.php');

$branch_id = $_SESSION['branch_id'];
$company_code = $_SESSION['company_code'];
$where_user_data = set_where_user_data('',$_SESSION['branch_id'], $_SESSION['company_code'], $_SESSION['company_data']);
$where_branch = $where_user_data['where_branch_id'];
$where_company = $where_user_data['where_company_code'];

$lno = $_POST['lno'];
$did = $_POST['did'];
$dname = $_POST['dname'];
$qty = $_POST['qty'];
$unit = $_POST['unit'];
$totalprice = $_POST['totalprice'];
$price = $_POST['price'];
$bdate = $_POST['bdate'];



$bdate = date("Y-m-d",strtotime(str_replace('/', '-',$bdate)));
$edate = $_POST['edate'];
$edate = date("Y-m-d",strtotime(str_replace('/', '-',$edate)));


$sql1 = "select did from tb_temp_drugeinstock where lno='$lno' and did='$did'" . $where_branch . $where_company;
$result = mysql_query($sql1) or die ("Error Query ".$sql1); 
$n = mysql_num_rows($result);
if(empty($n)){

$sql = "insert into tb_temp_drugeinstock  values('$lno','$did','$dname','$unit','$qty','$price','$totalprice','$bdate','$edate','$branch_id' , '$company_code')";	

} else {

$sql = "Update tb_temp_drugeinstock Set qty='$qty',price='$price',totalprice='$totalprice',bdate='$bdate',edate='$edate' Where lno='$lno' and did='$did'" . $where_branch . $where_company;
}
echo $sql;
mysql_query($sql);

echo '||stock/temp_instock_list.php'.'||'.$lno.'||DEL||บันทึกข้อมูลเรียบร้อยแล้ว';
?>