<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');

$vn = $_POST['vn'];
$hn = $_POST['hn'];
$pid = $_POST['pid'];
$pname = $_POST['pname'];
$qty = $_POST['qty'];
$stqty = $_POST['tqty'];
$price = $_POST['price'];
$price = $_POST['price'];
$tprice = $_POST['tprice'];
$type = $_POST['type'];
$unit = $_POST['unit'];
$seid = $_POST['seid'];
$sename = $_POST['sename'];

$ncid = $_POST['cid'];
$ncname = $_POST['cname'];

$dat = date('Y-m-d');
$branch_id = $_SESSION['branch_id'];
$company_code = $_SESSION['company_code'];
$company_data = $_SESSION['company_data'];
$where_company = "and company_code = '$company_code'";
$where_branch = "and branchid = '$branch_id'";

if($type=='T' || $type=='L'){ 
	$total = $qty;
}
if($type=='P'){ 
    $total = 0;  
	$sql = "select sum(qty) as total from tb_package_detail  where pid='$pid' and typ IN('T','L') " . $where_company . " group by pid  ";
	$str = mysql_query($sql) or die ("Error Query [".$sql."]");	
	$rs = mysql_fetch_array($str);		
	$total = $total + ($rs['total'] * $qty);
	$sql = "select id,qty from tb_package_detail  where pid='$pid' and typ = 'C' " . $where_company;
	$str = mysql_query($sql) or die ("Error Query [".$sql."]");	
	while($rs=mysql_fetch_array($str)){
		$cid = $rs['id'];
		$tqty = $rs['qty'];
		$sqlc = "select sum(qty) as total from tb_course_detail  where cid='$cid' " . $where_company . " group by cid  ";
		$strc = mysql_query($sqlc) or die ("Error Query [".$sqlc."]");	
		$rc = mysql_fetch_array($strc);		
		$total = $total + (($rc['total'] * $tqty) * $qty);
	}
}



if($type=='C'){ 
	$total = 0;
	$sqlc = "select sum(qty) as total from tb_course_detail  where cid='$pid' " . $where_company . " group by cid  ";
	$strc = mysql_query($sqlc) or die ("Error Query [".$sqlc."]");	
	$rc=mysql_fetch_array($strc);		
	$total = $total + ($rc['total'] * $qty);	
}




$sql = "select * from tb_pctrec where tid='$pid' and hn='$hn' and vn='$vn' and typ='$type' ". $where_branch . $where_company;
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$Num_Rows = mysql_num_rows($result);	
if(empty($Num_Rows)){
	$sql = "insert into tb_pctrec values('$vn','$hn','$pid','$pname','$type','$qty','$unit','$price','$tprice','$dat','$total','$seid','$sename','','','$branch_id','$company_code')";
	mysql_query($sql);		   		
} else {	
	$sql = "Update tb_pctrec Set qty='$qty',price='$price',totalprice='$tprice',total='$total',cid='$ncid',cname='$ncname' Where vn='$vn' and tid='$pid' and hn='$hn' and typ='$type' ". $where_branch . $where_company;
	mysql_query($sql);		
}
	

	
if($type=='P'){
    $sql = "delete from tb_drugerec where vn='$vn' and pid='$pid' " . $where_branch . $where_company;
	mysql_query($sql) or die ("Error Query [".$sql."]");


	$sql = "select * from tb_package_detail where pid='$pid' and typ = 'D' ". $where_company;
	$str = mysql_query($sql) or die ("Error Query [".$sql."]");
			
	while($rs = mysql_fetch_array($str)){		
			        
		$did = $rs['id'];
		$dname = $rs['name'];
		$dqty = $rs['qty'] * $qty ;
		
		$sql_t = "select unit,duse,sprice from tb_druge where did='$did'" . $where_company;
		$str_t = mysql_query($sql_t) or die ("Error Query [".$sql_t."]");
		
		$rt = mysql_fetch_array($str_t);
		$dunit = $rt['unit'];
		$duse = $rt['duse'];
		$dprice = $rt['sprice'];
		$sqld = "select * from tb_drugerec where vn='$vn' and did='$did' and pid='$pid' " . $where_branch . $where_company;
		$result = mysql_query($sqld) or die ("Error Query [".$sqld."]"); 
		$Num_Rows = mysql_num_rows($result);
		if(empty($Num_Rows)){										
			$sql_in = "insert into tb_drugerec  values('$vn','$hn','$did','$dname','$dqty','$dunit','$dprice','$duse','55','N','$pid','$branch_id','$company_code')";
			mysql_query($sql_in) or die ("Error Query [".$sql_in."]");	
		} else {
			$rd=mysql_fetch_array($result);  
			$dqty = $rd['qty'] + $dqty;
			$sqld = "Update tb_drugerec Set qty='$dqty' Where vn='$vn' and tid='$pid' and hn='$hn' and typ='$type' and ftyp='T' ". $where_branch . $where_company;
			mysql_query($sqld);
			
		}				
	}
} 
		
if($type=='T' || $type=='L') {	
    $sql = "delete from tb_pctuse where vn='$vn' and pid='$pid' and ftyp='T' ". $where_branch . $where_company;
	mysql_query($sql) or die ("Error Query [".$sql."]");	
					
	$eid = $_POST['eid'];
	$ename = $_POST['ename'];
	if(! empty($ename)){
		$sql = "insert into tb_pctuse values('NULL','$vn','$hn','$pid','$pid','$pid','$dat','$eid','$ename','$pname','$qty','$unit','$type','T','$vn','$ncid','','$stqty','$branch_id','$company_code')";
		mysql_query($sql);
		$sql = "Update tb_pctrec Set total='0' Where vn='$vn' and tid='$pid' and hn='$hn' and typ='$type' ". $where_branch . $where_company;
		mysql_query($sql);	
	}				
}	
	
	
	
	
	


echo '||doctor/doctor_form.php'.'||'.$vn.'||DEL||'.$ttt;



?>