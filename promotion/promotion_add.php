<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
include('../class/permission_user.php');

$proid = $_POST['proid'];
$proname = $_POST['proname'];
$dat = trim($_POST['dat']);
$dat1 = trim($_POST['dat1']);
// $dat = substr($_POST['dat'],6,4).'-'.substr($_POST['dat'],3,2).'-'.substr($_POST['dat'],0,2)  ;
// $dat1 = substr($_POST['dat1'],6,4).'-'.substr($_POST['dat1'],3,2).'-'.substr($_POST['dat1'],0,2)  ;
$mem = $_POST['mem'];
$tel = trim($_POST['tel']);

if(!empty($_REQUEST['branchid'])){
	$branch_id = $_REQUEST['branchid'];
} else {
	$branch_id = $_SESSION['branch_id'];
}

$company_code = $_SESSION['company_code'];

$as = "";
$data = set_where_user_data($as ,$branch_id, $_SESSION['company_code'], $_SESSION['company_data']);
$where_branch_id = "";
$where_branch_id .= $data['where_branch_id'];
$where_branch_id .= $data['where_company_code'];


if($_POST['type']!='edit'){
	$sql  = "insert into promotion  values('$proid','$proname','$dat','$dat1','$mem','$tel','$branch_id','$company_code')";
	mysql_query($sql) or die ("Error Query [".$sql."]");
	
	$sql  = "update tb_autonumber set last='$proid' where typ='PR'";
	mysql_query($sql) or die ("Error Query [".$sql."]");
	
} else {	
	$sql  = "update promotion set proname='$proname',datestart='$dat',datestop='$dat1',mem='$mem',protel='$tel'  ";
	$sql .= "where proid='$proid' ";
	
	mysql_query($sql) or die ("Error Query [".$sql."]");
}

echo '||promotion/promotion.php'.'||PR||ADD||บันทึกข้อมูลเรียบร้อยแล้ว';

?>