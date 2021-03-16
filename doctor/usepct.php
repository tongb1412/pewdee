<?php ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
include('../class/permission_user.php');

$hn = $_POST['hn'];
$pvn = $_POST['pvn'];
$uvn = $_POST['vn'];
$tid = $_POST['tid'];
$eid = $_POST['eid'];
$ename = $_POST['ename'];

$eid1 = $_POST['eid1'];
$eid2 = $_POST['eid2'];

$qty = $_POST['qty'];
$stqty = $_POST['tqty'];
$dat = date('Y-m-d');

$branch_id = $_SESSION['branch_id'];
$company_code = $_SESSION['company_code'];
$company_data = $_SESSION['company_data'];
$where_data =  set_where_user_data('',$branch_id, $company_code, $company_data);

$sql = "select * from tb_pctrec  where hn='$hn' and  tid='$tid' and vn='$pvn' and typ IN ('T','L')  and total > 0 " . $where_data['where_company_code'] . " order by vn asc ";
$str = mysql_query($sql) or die ("Error Query [".$sql."]");
$txtddd = $sql;
while(($rs = mysql_fetch_array($str)) && ($qty > 0)){
  //$vn = $rs['vn'];
	$type = $rs['typ'];
	$unit = $rs['unit'];
	$tname = $rs['tname'];
	$sqls = "select sum(qty) as total from tb_pctuse  where vn='$pvn' and uvn='$uvn'  and hn='$hn' and pid='$tid' and tid='$tid'  and ftyp='T' ";
	$strs = mysql_query($sqls) or die ("Error Query [".$sqls."]");
	$rss = mysql_fetch_array($strs);
	$sum = $rss['total'];
	if($sum < $qty){
		if($rs_pct['total'] >= $qty ){
			$total =  $rs['total'] - $qty;
			$sql_in = "insert into tb_pctuse  values('NULL','$vn','$hn','$tid','$tid','$tid','$dat','$eid','$ename','$tname','$qty','$unit','$type','T','$uvn','$eid1','$eid2','$stqty','$branch_id','$company_code')";
			mysql_query($sql_in);
			$sql_in = "Update tb_pctrec Set total='$total' Where vn='$vn' and tid='$tid' and hn='$hn' and typ='$type' ". $where_data['where_branch_id'] . $where_data['where_company_code'];
			mysql_query($sql_in);
			$qty = 0;
		} else {
			$total = $rs['total'];
			$sql_in = "insert into tb_pctuse  values('NULL','$vn','$hn','$tid','$tid','$tid','$dat','$eid','$ename','$tname','$total','$unit','$type','T','$uvn','$eid1','$eid2','0','$branch_id','$company_code')";
			mysql_query($sql_in);
			$sql_in = "Update tb_pctrec Set total='0' Where vn='$vn' and tid='$tid' and hn='$hn' and typ='$type' ". $where_data['where_branch_id'] . $where_data['where_company_code'];
			mysql_query($sql_in);
			$qty = $qty - $total;
		}
	}
}

$sql = "select * from tb_pctrec  where hn='$hn' and vn='$pvn' and typ='C' and total > 0 order by vn asc ";
$str = mysql_query($sql) or die ("Error Query [".$sql."]");

while( ($rs=mysql_fetch_array($str)) && ($qty > 0)){
  //  $vn = $rs['vn'];

	$cid = $rs['tid'];
	$tqty = $rs['qty'];
	$total = $rs['total'];

	$sqlc  = "select  tb_course_detail.*,tb_treatment.unit,tb_treatment.typ from tb_course_detail,tb_treatment  ";
	$sqlc .= "where tb_course_detail.tid=tb_treatment.tid  and  tb_course_detail.cid='$cid' and tb_course_detail.tid='$tid'  ";
	$strc = mysql_query($sqlc) or die ("Error Query [".$sqlc."]");
	$n = mysql_num_rows($strc);
    if(!empty($n)){
		$rc=mysql_fetch_array($strc);
		$tname = $rc['tname'];
		$type = $rc['typ'];
		$unit = $rc['unit'];
		$tqty = $tqty * $rc['qty'];



		$sqls = "select sum(qty) as total from tb_pctuse  where vn='$pvn' and hn='$hn' and pid='$cid' and tid='$tid'  and ftyp='C' ";
		$strs = mysql_query($sqls) or die ("Error Query [".$sqls."]");
		$rss=mysql_fetch_array($strs);
		$sum = $rss['total'];
		if($sum < $tqty){
			if($tqty >= $qty ){

				$sql_in = "insert into tb_pctuse values('NULL','$pvn','$hn','$cid','$cid','$tid','$dat','$eid','$ename','$tname','$qty','$unit','$type','C','$uvn','$eid1','$eid2','$stqty','$branch_id','$company_code')";
				mysql_query($sql_in);
				$total = $total - $qty;
				$sql_in = "Update tb_pctrec Set total='$total' Where vn='$pvn' and tid='$cid' and hn='$hn' and typ='C' ". $where_data['where_branch_id'] . $where_data['where_company_code'];
				mysql_query($sql_in);
				$qty = 0;
			} else {
				$total = $rs['total'];
				$sql_in = "insert into tb_pctuse values('NULL','$pvn','$hn','$cid','$cid','$tid','$dat','$eid','$ename','$tname','$total','$unit','$type','C','$uvn','$eid1','$eid2','0','$branch_id','$company_code')";
				mysql_query($sql_in);
				$sql_in = "Update tb_pctrec Set total='0' Where vn='$pvn' and tid='$cid' and hn='$hn' and typ='C' ". $where_data['where_branch_id'] . $where_data['where_company_code'];
				mysql_query($sql_in);
				$qty = $qty - $total;
			}
		}

	}

}

$sql = "select * from tb_pctrec  where hn = '$hn' and typ='P' and total > 0 " . $where_data['where_branch_id'] . $where_data['where_company_code'] . " order by vn asc ";
$str = mysql_query($sql) or die ("Error Query [".$sql."]");

while( ($rs = mysql_fetch_array($str)) && ($qty > 0)){
    $vn = $rs['vn'];
	$pid = $rs['tid'];
	$tqty = $rs['qty'];
	$total = $rs['total'];

	$sqlt = "select tb_package_detail.*,tb_treatment.unit,tb_treatment.typ from tb_package_detail,tb_treatment  where tb_package_detail.id = tb_treatment.tid ";
	$sqlt .= "and tb_package_detail.pid='$pid' and tb_package_detail.id='$tid' and tb_package_detail.typ IN('T','L') and tb_package_detail.company_code = '$company_code'";
	$strt = mysql_query($sqlt) or die ("Error Query [".$sqlt."]");
	$rt = mysql_fetch_array($strt);
	$tname =  $rt['name'];
	$unit =  $rt['unit'];
	$type =  $rt['typ'];
	$nqty =  $rt['qty'] * $tqty;
	$sqls = "select sum(qty) as total from tb_pctuse  where vn='$vn' and hn='$hn' and pid='$pid' and tid='$tid'  and ftyp='PT' ". $where_data['where_branch_id'] . $where_data['where_company_code'];
	// echo $sqls;exit();
	$strs = mysql_query($sqls) or die ("Error Query [".$sqls."]");
	$rss = mysql_fetch_array($strs);
	$sum = $rss['total'];
	if($sum < $nqty){
		if($nqty >= $qty ){
			$sum =  $nqty - $qty;
			$sql_in = "insert into tb_pctuse values('NULL','$vn','$hn','$pid','$pid','$tid','$dat','$eid','$ename','$tname','$qty','$unit','$type','PT','$uvn','$eid1','$eid2','$stqty','$branch_id','$company_code')";
			mysql_query($sql_in);
			$total = $total - $qty;
			$sql_in = "Update tb_pctrec Set total='$total' Where vn='$vn' and tid='$pid' and hn='$hn' and typ='P' " . $where_data['where_branch_id'] . $where_data['where_company_code'];
			mysql_query($sql_in);
			$qty = 0;
		} else {
			$total = $rs['total'];
			$sql_in = "insert into tb_pctuse values('NULL','$vn','$hn','$pid','$pid','$tid','$dat','$eid','$ename','$tname','$total','$unit','$type','PT','$uvn','$eid1','$eid2','0','$branch_id','$company_code')";
			mysql_query($sql_in);
			$sql_in = "Update tb_pctrec Set total='0' Where vn='$vn' and tid='$pid' and hn='$hn' and typ='P' " . $where_data['where_branch_id'] . $where_data['where_company_code'];
			mysql_query($sql_in);
			$qty = $qty - $total;
		}
	}

	$sqly = "select id,qty from tb_package_detail  where pid='$pid' and typ = 'C' ";
	$stry = mysql_query($sqly) or die ("Error Query [".$sqly."]");
	while($ry=mysql_fetch_array($stry)){
		$cid = $ry['id'];
	    $cqty = $ry['qty'];
		$sqlc  = "select  tb_course_detail.*,tb_treatment.unit,tb_treatment.typ from tb_course_detail,tb_treatment  ";
		$sqlc .= "where tb_course_detail.tid=tb_treatment.tid  and  tb_course_detail.cid='$cid' and tb_course_detail.tid='$tid' and tb_course_detail.company_code = '$company_code'";
		$strc = mysql_query($sqlc) or die ("Error Query [".$sqlc."]");
		$n = mysql_num_rows($strc);
		if(!empty($n)){
			$rc=mysql_fetch_array($strc);
			$tname = $rc['tname'];
			$type = $rc['typ'];
			$unit = $rc['unit'];
			$tcqty = ($cqty * $rc['qty']) * $tqty;
			$sqls = "select sum(qty) as total from tb_pctuse  where vn='$vn' and hn='$hn' and pid='$pid' and cid='$cid' and tid='$tid'  and ftyp='PC' ". $where_data['where_branch_id'] . $where_data['where_company_code'];
			$strs = mysql_query($sqls) or die ("Error Query [".$sqls."]");
			$rss=mysql_fetch_array($strs);
			$sum = $rss['total'];
			if($sum < $tcqty){
				if($tcqty >= $qty ){
					$sql_in = "insert into tb_pctuse  values('NULL','$vn','$hn','$pid','$cid','$tid','$dat','$eid','$ename','$tname','$qty','$unit','$type','PC','$uvn','$eid1','$eid2','$stqty','$branch_id','$company_code')";
					mysql_query($sql_in);
					$total = $total - $qty;
					$sql_in = "Update tb_pctrec Set total='$total' Where vn='$vn' and tid='$pid' and hn='$hn' and typ='P' ". $where_data['where_branch_id'] . $where_data['where_company_code'];
					mysql_query($sql_in);
					$qty = 0;
				} else {
					$total = $rs['total'];
					$sql_in = "insert into tb_pctuse  values('NULL','$vn','$hn','$pid','$cid','$tid','$dat','$eid','$ename','$tname','$total','$unit','$type','PC','$uvn','$eid1','$eid2','0','$branch_id','$company_code')";
					mysql_query($sql_in);
					$sql_in = "Update tb_pctrec Set total='0' Where vn='$vn' and tid='$pid' and hn='$hn' and typ='P' ". $where_data['where_branch_id'] . $where_data['where_company_code'];
					mysql_query($sql_in);
					$qty = $qty - $total;
				}
			}
		}
	}
}


echo '||doctor/doctor_form.php'.'||'.$_POST['vn'].'||DEL||'.$txtddd;

?>