<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/monthly_report.css" rel="stylesheet" type="text/css" />
<?
include('../class/config.php');
include('../class/permission_user.php');
$did = $_GET['did'];
//$sdate = $_GET['sdate'];
//$edate = $_GET['edate'];

/*$nd = substr($_GET['edate'],0,2) + 1; 
if(strlen($nd)==1){ $nd = '0'.$nd; }
$sdate = substr($_GET['sdate'],6,4).'-'.substr($_GET['sdate'],3,2).'-'.substr($_GET['sdate'],0,2)  ;
$edate = substr($_GET['edate'],6,4).'-'.substr($_GET['edate'],3,2).'-'.$nd ;*/

$t0 = strtotime($_GET['sdate']);
$t1 = strtotime($_GET['edate']) + (1*24*3600); 
//$t1 = strtotime($_POST['edate']);
$sdate = date("Y-m-d", $t0); 
$edate = date("Y-m-d", $t1); 


if(empty($did)){
	$dname = 'ธนาคาร : ทั้งหมด';
} else {
	$dname = 'ธนาคาร : '.$did;
}

if(!empty($_REQUEST['branchid'])){
	$branch_id = $_REQUEST['branchid'];
} else {
	$branch_id = $_SESSION['branch_id'];
}
$as = "a";
$data = set_where_user_data($as ,$branch_id, $_SESSION['company_code'], $_SESSION['company_data']);
$where_branch_id = "";
$where_branch_id .= $data['where_branch_id'];
$where_branch_id .= $data['where_company_code'];

?>



<? 


if(empty($did)){
	$sql = "select a.*,b.cradno,b.pname,b.fname,b.lname, c.cn, c.clinicname  from tb_payment a,tb_patient  b,tb_clinicinformation c where (a.hn = b.hn) and  (a.pdate between '$sdate%' and '$edate%') and (a.credit >0) and a.branchid = c.cn  " . $where_branch_id;
} else {
	$sql = "select a.*,b.cradno,b.pname,b.fname,b.lname, c.cn, c.clinicname  from tb_payment a,tb_patient  b,tb_clinicinformation c where (a.hn = b.hn) and  (a.pdate between '$sdate%' and '$edate%') and (credit >0) and (a.creditname like '%$did%') and a.branchid = c.cn " . $where_branch_id;
}
// echo $sql;exit();
$sql .=" order by a.billno asc ";
$result  = mysql_query($sql)or die ("Error Query [".$sql."]"); 

$n=1; $m=1; $s='y'; $x = 81;

 $tt=0; 
while($rs=mysql_fetch_array($result)){  

	$tt = $tt + $rs['credit'];



	
	if($s=='y'){ 	
	?>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:14px; font-weight:bold; float:left;">
		รายงานรายได้แยกตามบัตรเครดิต
	</div>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:13px; font-weight:bold; float:left;">
		ระหว่างวันที่ <?= $_GET['sdate'] ?> ถึง <?= $_GET['edate'] ?>
	</div>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:12px; font-weight:bold; float:left;">
		<div style="width:50%; float:left; text-align:left;">
			<?= $dname ?>&nbsp;
		</div>
		<div style="width:50%; float:left; text-align:right;">
			หน้า : <?= '1'; ?>&nbsp;
		</div>

	</div>
	<div style="width:100%; height:30px; line-height:25px; text-align:center; font-size:10px; font-weight:bold;  float:left;">
		<div class="report report-no">ลำดับ</div>
		<div class="report">Crad No.</div>
		<div class="report report-name">ชื่อ-สกุล</div>
		<div class="report report-name">ชื่อบัตร</div>
		<div class="report">เลขที่บัตร</div>
		<div class="report">จำนวนเงิน</div>
		<div class="report" style="width: 14%;">เลขที่ใบเสร็จ</div>
		<div class="report">สาขา</div>
	</div>


	<? 
	$s='n';
	}
	if( $n > ($m * $x) ){ $m++; }  
	if($m-1 > 1){  $x = 86; } 
	if($n == ((($m-1) * $x) + 1) && $m > 1){
	
		?>
	<br><br>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:12px; font-weight:bold; float:left;">
		<div style="width:50%; float:left; text-align:left;">
			<?= $dname ?>&nbsp;
		</div>
		<div style="width:50%; float:left; text-align:right;">
			หน้า : <?= $m; ?>&nbsp;
		</div>
	</div>
	<div style="width:100%; height:30px; line-height:25px; text-align:center; font-size:10px; font-weight:bold;  float:left; ">
		<div class="report report-no">ลำดับ</div>
		<div class="report">Crad No.</div>
		<div class="report report-name">ชื่อ-สกุล</div>
		<div class="report report-name">ชื่อบัตร</div>
		<div class="report">เลขที่บัตร</div>
		<div class="report">จำนวนเงิน</div>
		<div class="report"style="width: 14%;">เลขที่ใบเสร็จ</div>
		<div class="report">สาขา</div>
	</div>
	<?
	} 
	?>

	<div style="width:100%; font-size:10px; text-align:left; float:left; margin:auto; ">
		<div class="report-data report-no center"><?= $n ?></div>
		<div class="report-data left" style="margin-left:3%; margin-right:6%; width:7%;">&nbsp;<?= $rs['cradno'] ?></div>
		<div class="report-data left" style="margin-right:4%;"><?= $rs['pname'] . $rs['fname'] . '    ' . $rs['lname']  ?></div>
		<div class="report-data left"><?= $rs['creditname'] . '  ' . $rs['pdate'] ?>&nbsp;&nbsp;</div>
		<div class="report-data center"><?= $rs['credittype'] ?>&nbsp;&nbsp;</div>
		<div class="report-data left" style="width:5.5%; margin-right:6%; margin-left:3%;"><?= number_format($rs['credit'], '2', '.', ',') ?>&nbsp;&nbsp;</div>
		<div class="report-data left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $rs['billno'] ?></div>
		<div class="left"><?= $rs['clinicname'] ?></div>
	</div>

<? $n++; } ?>
<div style="width:100%; height:10px; border-bottom:#999999 1px solid; float:left; margin:auto;  ">&nbsp;</div>

<div style="width:100%; font-size:10px; text-align:left; float:left; font-weight:bold; margin:auto; margin-top:5px;  ">
	<div style="width:5%; float:left; text-align:center;">&nbsp;</div>
	<div style="width:39%; float:left;">&nbsp;</div>
	<div style="width:20%; float:left; text-align:right">รวมทั้งหมด&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
	<div style="width:6%; text-align:right; float:left;"><?= number_format($tt, '2', '.', ',') ?>&nbsp;&nbsp;</div>
	<div style="width:20%; float:left; text-align:center"><?= '-' ?></div>
</div>
<div style="width:100%; height:10px; border-bottom:#999999 1px solid; float:left; margin:auto;">&nbsp;</div>