<?
session_start();
include('../class/config.php');
require('../class/permission_user.php');

$lno = $_POST['lno'];
$branch_id = $_SESSION['branch_id'];
$company_code = $_SESSION['company_code'];

$where_user_data = set_where_user_data('',$_SESSION['branch_id'], $_SESSION['company_code'], $_SESSION['company_data']);

$sql1 = "select did from tb_temp_drugeinstock where lno='$lno'" . $where_user_data['where_branch_id'] . $where_user_data['where_company_code'];
$result = mysql_query($sql1) or die ("Error Query ".$sql1); 
$n = mysql_num_rows($result);
if(!empty($n)){
     $empid = $SYS_EID;
     $sid = $_POST['sid'];
	 $sname = $_POST['sname'];
	 $dat = date('Y-m-d',time());
     $sql = "insert into tb_instock  values('$lno','$empid','$dat','$sid','$sname','D','$branch_id','$company_code')";
     mysql_query($sql) or die ("Error Query ".$sql);
	 
	 
	$sql1 = "select * from tb_temp_drugeinstock where lno='$lno'" . $where_user_data['where_branch_id'] . $where_user_data['where_company_code'];
	$result = mysql_query($sql1) or die ("Error Query ".$sql1); 
    while($rs = mysql_fetch_array($result)){
	   $did = $rs['did'];
	   $dname = $rs['dname'];
	   $unit = $rs['unit'];
	   $qty = $rs['qty'];
	   $price = $rs['price'];
	   $totalprice = $rs['totalprice'];
	   $bdate = $rs['bdate'];
	   $edate = $rs['edate'];

       $sql = "insert into tb_drugeinstock  values('$lno','$did','$dname','$unit','$qty','$price','$totalprice','$bdate','$edate','$qty','$branch_id','$company_code')";
       mysql_query($sql) or die ("Error Query ".$sql);

	   $sql = "select total from tb_druge where did='$did'";
	   $str = mysql_query($sql) or die ("Error Query ".$sql); 	 
	   $row = mysql_fetch_array($str);
	   $dtotal = intval($qty) + intval($row['total']);
	   
	   $sql = "Update tb_druge Set total='$dtotal' Where did='$did'";
	   mysql_query($sql) or die ("Error Query ".$sql);
	   
	   $sql  = "update tb_autonumber set last='$lno' where typ='LT'";
	   mysql_query($sql) or die ("Error Query [".$sql."]");	

	    $dat = date('Y-m-d H:i:s');
	    $pname = $eid.'  ???????????????????????????????????????';
		$sql = "insert into drugelog (vn, lno, did, dname, qty, total, pname, dat, typ, branchid,'company_code') values('-','$lno','$did','$dname','$qty','$dtotal','$pname','$dat','I','$branch_id','$company_code')";
		// echo $sql;exit();
		mysql_query($sql);
		
	   $txt = '??????????????????????????????????????????????????????????????????????????????'; $con ='Y';
	}
} else {
	$txt = '??????????????????????????????????????????????????????????????????????????? ??????????????????????????????????????????????????????????????????'; $con ='N';
}

echo '||stock/instock_show.php'.'||STOCK||'.$lno.'||'.$txt.'||'.$con;





?>