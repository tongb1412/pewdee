<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/monthly_report.css" rel="stylesheet" type="text/css" />
<?
include('../class/config.php');
include('../class/permission_user.php');
// $did = $_GET['did'];
$t0 = strtotime($_GET['sdate']);
$t1 = strtotime($_GET['edate']) + (1*24*3600); 
$sdate = date("Y-m-d", $t0); 
$edate = date("Y-m-d", $t1); 

//$sdate = substr($_GET['sdate'],6,4).'-'.substr($_GET['sdate'],3,2).'-'.substr($_GET['sdate'],0,2)  ;
//$edate = substr($_GET['edate'],6,4).'-'.substr($_GET['edate'],3,2).'-'.$nd ;


if(!empty($_REQUEST['branchid'])){
	$branch_id = $_REQUEST['branchid'];
} else {
	$branch_id = $_SESSION['branch_id'];
}

if(!empty($_REQUEST['did'])){
	$did = $_REQUEST['did'];
} else {
	$did = "";
}

$as = "a";
$data = set_where_user_data($as ,$branch_id, $_SESSION['company_code'], $_SESSION['company_data']);
$where_branch_id = "";
$where_branch_id .= $data['where_branch_id'];
$where_branch_id .= $data['where_company_code'];



$sqlC .="select clinicname from tb_clinicinformation where cn = '$branch_id'";
$strc  = mysql_query($sqlC)or die ("Error Query [".$sqlC."]"); 
$rs = mysql_fetch_array($strc);
$cname = $rs['clinicname'];

$dname ='';

$empid = '';

if(empty($did)){
	$sql = "select a.*,b.cradno,b.pname,b.fname,b.lname,c.empid,c.empname, d.cn, d.clinicname from tb_payment a,tb_patient b,tb_vst c, tb_clinicinformation d  where (a.hn = b.hn) and (a.vn=c.vn)  and (a.pdate  between '$sdate%' and '$edate%') and (c.status='COM') and a.discount <> 0 and a.branchid = d.cn ";
} else {
	$sql = "select a.*,b.cradno,b.pname,b.fname,b.lname,c.empid,c.empname, d.cn, d.clinicname from tb_payment a,tb_patient b,tb_vst c, tb_clinicinformation d  where (a.hn = b.hn) and (a.vn=c.vn)  and (a.pdate  between '$sdate%' and '$edate%') and (c.empid like '%$did%') and (c.status='COM') and a.discount <> 0 and a.branchid = d.cn";
}

$sql .=" $where_branch_id order by a.branchid,c.empid,a.billno asc ";

// echo $sql;
$result  = mysql_query($sql)or die ("Error Query [".$sql."]"); 

$n=1; $m=1; $s='y'; $x = 52; $h=1; $nn=0;

$dp =0; $lp=0; $tp=0; $cp=0; $pp=0; $ds=0; $tt=0; $re=0; $aa=0; $total = 0;
$dp1 =0; $lp1=0; $tp1=0; $cp1=0; $pp1=0; $ds1=0; $tt1=0; $re1=0; $aa1=0; $total1 = 0; $cash = 0; $credit = 0; $ku = 0;

$flag = 0;
$flag_branch = "";

while($rs = mysql_fetch_array($result)){  
$nn++;




 
if($s=='y'){ 	
?>
<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:14px; font-weight:bold; float:left;">
	?????????????????????????????????????????????????????????
</div>
<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:13px; font-weight:bold; float:left;">
	????????????????????????????????? <?= $_GET['sdate'] . '  ?????????  ' . $_GET['edate']; ?>
</div>
<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:12px; font-weight:bold; float:left;">
	<div style="width:50%; float:left; text-align:left;">
		&nbsp;????????????
			<?php
			if ($branch_id == "00") {
				echo "?????????????????????";
				// echo $rs['clinicname'];

			} else {
				echo $cname;
			}
			?>
	</div>
	<div style="width:50%; float:left; text-align:right;">
		???????????? : <?= '1'; ?>&nbsp;
	</div>

</div>
<div style="width:100%; height:30px; line-height:25px; text-align:center; font-size:10px; font-weight:bold;  float:left; ">
	<div style="width:4%; float:left; border-bottom:#999999 2px solid;">???????????????</div>
	<div style="width:10%; float:left; border-bottom:#999999 2px solid; overflow:hidden">Crad No.</div>
	<div style="width:14%; float:left; border-bottom:#999999 2px solid;">????????????-????????????</div>
	<div style="width:9%; float:left; border-bottom:#999999 2px solid;">???????????????</div>
	<div style="width:9%; float:left; border-bottom:#999999 2px solid;">?????????????????????</div>
	<div style="width:9%; float:left; border-bottom:#999999 2px solid;">?????????????????????</div>
	<div style="width:9%; float:left; border-bottom:#999999 2px solid;">???????????????</div>
	<div style="width:9%; float:left; border-bottom:#999999 2px solid;">?????????????????????</div>
	<div style="width:9%; float:left; border-bottom:#999999 2px solid;">?????????????????????</div>
	<div style="width:9%; float:left; border-bottom:#999999 2px solid;">??????????????????</div>
	<div style="width:9%; float:left; border-bottom:#999999 2px solid;">?????????????????????</div>

</div>
<? 
 $s='n';
 }
if( $n > ($m * $x) ){ $m++; }  
if($m-1 > 1){  $x = 54; } 
if($n == ((($m-1) * $x) + 1) && $m > 1){
 
?>
	<br><br>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:12px; font-weight:bold; float:left;">
		<div style="width:50%; float:left; text-align:left;">
			&nbsp;????????????
			<?php
			if ($branch_id == "00") {
				echo "?????????????????????";
				// echo $rs['clinicname'];
			} else {
				echo $cname;
			}
			?>
		</div>
		<div style="width:50%; float:left; text-align:right;">
			???????????? : <?= $m; ?>&nbsp;
		</div>
	</div>
	<div style="width:100%; height:30px; line-height:25px; text-align:center; font-size:10px; font-weight:bold;  float:left; ">
		<div style="width:4%; float:left; border-bottom:#999999 2px solid;">???????????????</div>
		<div style="width:10%; float:left; border-bottom:#999999 2px solid; overflow:hidden">Crad No.</div>
		<div style="width:14%; float:left; border-bottom:#999999 2px solid;">????????????-????????????</div>
		<div style="width:9%; float:left; border-bottom:#999999 2px solid;">???????????????</div>
		<div style="width:9%; float:left; border-bottom:#999999 2px solid;">?????????????????????</div>
		<div style="width:9%; float:left; border-bottom:#999999 2px solid;">?????????????????????</div>
		<div style="width:9%; float:left; border-bottom:#999999 2px solid;">???????????????</div>
		<div style="width:9%; float:left; border-bottom:#999999 2px solid;">?????????????????????</div>
		<div style="width:9%; float:left; border-bottom:#999999 2px solid;">?????????????????????</div>
		<div style="width:9%; float:left; border-bottom:#999999 2px solid;">??????????????????</div>
		<div style="width:9%; float:left; border-bottom:#999999 2px solid;">?????????????????????</div>
	</div>
<?php
} 
$ft = 'N';

if($empid != $rs['empid']){
$empid = $rs['empid'];  
if($empid=='-'){ $dname = '??????????????????????????????????????????';  } else { $dname = $rs['empname']; }
if($n>1){

?>
<div style="width:100%; font-size:10px; text-align:left; float:left; margin:auto; font-weight:bold; border-top:#CCCCCC 1px dotted; overflow:hidden;">
	<div style="width:4%; float:left; text-align:center;">&nbsp;</div>
	<div style="width:10%; float:left;">&nbsp;</div>
	<div style="width:14%; float:left; text-align:center"><?= $h - 1 . '  ??????????????????'; ?>&nbsp;</div>
	<div style="width:9%; text-align:right; float:left;"><?= number_format($dp1, '0', '.', ',') ?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right; float:left;"><?= number_format($lp1, '0', '.', ',') ?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right; float:left;"><?= number_format($tp1, '0', '.', ',') ?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right;float:left;"><?= number_format($cp1, '0', '.', ',') ?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right; float:left;"><?= number_format($pp1, '0', '.', ',') ?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right; float:left;"><?= number_format($tt1, '0', '.', ',') ?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right; float:left;"><?= number_format($ds1, '0', '.', ',') ?>&nbsp;&nbsp;</div>

	<div style="width:9%; text-align:right; float:left;"><?= number_format($re1, '0', '.', ',') ?>&nbsp;&nbsp;</div>

</div>
<? 
 $h=1; $m=1; $n++;
$dp1 =0; $lp1=0; $tp1=0; $cp1=0; $pp1=0; $ds1=0; $tt1=0; $re1=0; $aa1=0; $total1 = 0;$cash1 = 0;$credit1 = 0; $ku1 = 0;
}
?>
<div style="width:100%; font-size:10px; text-align:left; float:left; margin:auto; font-weight:bold; ">
	&nbsp;
	<?php
	if ($branch_id == "00") {
		// echo "?????????????????????";
		echo $dname;
		echo " ( ???????????? " . $rs['clinicname'] . " )";
	} else {
		echo $dname;
	}
	?>
</div>
<? 
}


$dp = $dp + $rs['dp'];
$lp = $lp + $rs['lp'];
$tp = $tp + $rs['tp'];
$cp = $cp + $rs['cp'];
$pp = $pp + $rs['pp'];
$ds = $ds + $rs['discount'];
$tt = $tt + $rs['total'];
$cash = $cash + $rs['cash'];
$credit = $credit + $rs['credit'];
$ku = $ku + $rs['ku'];
$total = $total + ($rs['total'] -  $rs['discount']);


$dp1 = $dp1 + $rs['dp'];
$lp1 = $lp1 + $rs['lp'];
$tp1 = $tp1 + $rs['tp'];
$cp1 = $cp1 + $rs['cp'];
$pp1 = $pp1 + $rs['pp'];
$ds1 = $ds1 + $rs['discount'];
$tt1 = $tt1 + $rs['total'];
$cash1 = $cash1 + $rs['cash'];
$credit1 = $credit1 + $rs['credit'];
$ku1 = $ku1 + $rs['ku'];
$total1 = $total1 + ($rs['total'] -  $rs['discount']);




if($rs['recive'] < $rs['total']){	
	$recive = $rs['cash'] + $rs['credit'] + $rs['ku'];
	$re = $re + $recive;
	$aa = $aa + (($rs['total'] - $rs['discount']) - $recive);
	
	$re1 = $re1 + $recive;
	$aa1 = $aa1 + (($rs['total'] - $rs['discount']) - $recive);	
	
	$ar = ($rs['total'] - $rs['discount']) - $recive;
} else {
	$re = $re + ($rs['total'] -  $rs['discount']);
	$re1 = $re1 + ($rs['total'] -  $rs['discount']);
	
	$recive = $rs['total'] - $rs['discount'];
	$ar = 0;
}

?>

<div style="width:100%; font-size:10px; text-align:left; float:left; margin:auto; overflow:hidden; ">
	<div style="width:4%; float:left; text-align:center;"><?= $m ?></div>
	<div style="width:10%; float:left;">&nbsp;<?= $rs['cradno'] ?></div>
	<div style="width:14%; float:left;"><?= $rs['pname'] . $rs['fname'] . '    ' . $rs['lname'] . '  '  ?></div>
	<div style="width:9%; text-align:right; float:left;"><?= number_format($rs['dp'], '0', '.', ',') ?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right; float:left;"><?= number_format($rs['lp'], '0', '.', ',') ?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right; float:left;"><?= number_format($rs['tp'], '0', '.', ',') ?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right;float:left;"><?= number_format($rs['cp'], '0', '.', ',') ?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right; float:left;"><?= number_format($rs['pp'], '0', '.', ',') ?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right; float:left;"><?= number_format($rs['total'], '0', '.', ',') ?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right; float:left;"><?= number_format($rs['discount'], '0', '.', ',') ?>&nbsp;&nbsp;</div>

	<div style="width:6%; text-align:right; float:left;"><?= number_format($recive, '0', '.', ',') ?>&nbsp;&nbsp;</div>




</div>
<? 

$n++; $h++; $m++;   } 
?>
<div style="width:100%; font-size:10px; text-align:left; float:left; margin:auto; font-weight:bold; border-top:#CCCCCC 1px dotted; overflow:hidden;">
	<div style="width:4%; float:left; text-align:center;">&nbsp;</div>
	<div style="width:10%; float:left;">&nbsp;</div>
	<div style="width:14%; float:left; text-align:center"><?= $h - 1 . '  ??????????????????'; ?>&nbsp;</div>
	<div style="width:9%; text-align:right; float:left;"><?= number_format($dp1, '0', '.', ',') ?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right; float:left;"><?= number_format($lp1, '0', '.', ',') ?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right; float:left;"><?= number_format($tp1, '0', '.', ',') ?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right;float:left;"><?= number_format($cp1, '0', '.', ',') ?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right; float:left;"><?= number_format($pp1, '0', '.', ',') ?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right; float:left;"><?= number_format($tt1, '0', '.', ',') ?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right; float:left;"><?= number_format($ds1, '0', '.', ',') ?>&nbsp;&nbsp;</div>

	<div style="width:9%; text-align:right; float:left;"><?= number_format($re1, '0', '.', ',') ?>&nbsp;&nbsp;</div>

</div>


<div style="width:100%; height:10px; border-bottom:#999999 1px solid; float:left; margin:auto;  ">&nbsp;</div>

<div style="width:100%; font-size:10px; text-align:left; float:left; font-weight:bold; margin:auto; margin-top:5px;  overflow:hidden;">
	<div style="width:4%; float:left; text-align:center;">&nbsp;</div>
	<div style="width:10%; float:left;">??????????????????????????????&nbsp;</div>
	<div style="width:14%; float:left; text-align:center"><?= $nn . '  ??????????????????'; ?>&nbsp;</div>
	<div style="width:9%; text-align:right; float:left;"><?= number_format($dp, '0', '.', ',') ?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right; float:left;"><?= number_format($lp, '0', '.', ',') ?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right; float:left;"><?= number_format($tp, '0', '.', ',') ?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right;float:left;"><?= number_format($cp, '0', '.', ',') ?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right; float:left;"><?= number_format($pp, '0', '.', ',') ?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right; float:left;"><?= number_format($tt, '0', '.', ',') ?>&nbsp;&nbsp;</div>
	<div style="width:9%; text-align:right; float:left;"><?= number_format($ds, '0', '.', ',') ?>&nbsp;&nbsp;</div>

	<div style="width:9%; text-align:right; float:left;"><?= number_format($re, '0', '.', ',') ?>&nbsp;&nbsp;</div>




</div>
<div style="width:100%; height:10px; border-bottom:#999999 1px solid; float:left; margin:auto;">&nbsp;</div>