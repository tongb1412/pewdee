<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/monthly_report.css" rel="stylesheet" type="text/css" />
<?
include('../class/config.php');
include('../class/permission_user.php');
/*$sdate = $_GET['sdate'];
$edate = $_GET['edate'];*/

$t0 = strtotime($_GET['sdate']);
$t1 = strtotime($_GET['edate']) + (1*24*3600); 
$sdate = date("Y-m-d", $t0); 
$edate = date("Y-m-d", $t1);

if(!empty($_REQUEST['branchid'])){
	$branchid = $_REQUEST['branchid'];
} else {
	$branchid = $_SESSION['branch_id'];
}
$as = "a";
$data = set_where_user_data($as ,$branchid, $_SESSION['company_code'], $_SESSION['company_data']);
$where_branch_id = "";
$where_branch_id .= $data['where_branch_id'];
$where_branch_id .= $data['where_company_code'];

$c =0; $d=0; $t=0;
// $sql = "select a.*, b.cradno, b.pname, b.fname, b.lname, c.cn, c.clinicname, (a.total - a.recive) aa  from tb_payment a, tb_patient  b, tb_clinicinformation c where (a.hn = b.hn) and  (a.pdate between '$sdate%' and '$edate%') and a.branchid = c.cn " . $where_branch_id;
$sql = "select a.*, b.cradno, b.pname, b.fname, b.lname, c.cn, c.clinicname, (a.total - a.recive) aa  from tb_payment a, tb_patient  b, tb_clinicinformation c, tb_vst d where (a.hn = b.hn) and (a.vn = d.vn) and (a.pdate between '$sdate%' and '$edate%') and (d.status='COM') and a.branchid = c.cn " . $where_branch_id;
// echo $sql;
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$Num_Rows = mysql_num_rows($result);
$n=1; $m=1; $s='y'; $x = 81; 

$n=1;

while($rs = mysql_fetch_array($result)){  
	//$c = $dp + $rs['cash'];
	//$d = $lp + $rs['credit'];
	//$t = $lp + $rs['tot'];

	$c = $c + $rs['cash'];
	$d = $d + $rs['credit'];
	$t = $t + $rs['tot'];



	if($s=='y'){ 
	?>
	<!--<div style="width:100%; height:3508px;  font-family: 'Angsana New'; text-align:center; margin-left:0px;">    -->
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:14px; font-weight:bold; float:left;">รายงานแยกตามการชำระ</div>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:13px; font-weight:bold; float:left;">
		ระหว่างวันที่ <?= $_GET['sdate'] . '  ถึง  ' . $_GET['edate']; ?>
	</div>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:12px; font-weight:bold; float:left;">

		<div style="width:100%; float:left; text-align:right;">
			หน้า : <?= '1'; ?>&nbsp;
		</div>

	</div>

	<!--<div style="width:100%; height:auto;  float:left; border-top:#CCCCCC 1px dotted; ">  </div>-->
	<div style="width:100%; height:30px; line-height:25px; text-align:center; font-size:10px; font-weight:bold;  float:left; ">
		<div class="report">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ลำดับ</div>
		<div class="report">Crad No.</div>
		<div class="report" style="width:16%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ชื่อ-สกุล</div>
		<div class="report">เงินสด</div>
		<div class="report">&nbsp;&nbsp;บัตรเครดิต</div>
		<div class="report">&nbsp;&nbsp;รวมทั้งหมด</div>
		<div class="report">&nbsp;&nbsp;เลขที่ใบเสร็จ</div>
		<div class="report">&nbsp;&nbsp;สาขา</div>
		<!--<div style="width:100%; height:auto;  float:left; border-top:#CCCCCC 1px dotted; "> </div>-->
	</div>
	<? 
	$s='n';
	}
	if( $n > ($m * $x) ){ $m++; }  
	if($m-1 > 1){  $x = 83; } 
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
		<div class="report">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ลำดับ</div>
		<div class="report" >Crad No.</div>
		<div class="report" style="width:16%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ชื่อ-สกุล</div>
		<div class="report">เงินสด</div>
		<div class="report">&nbsp;&nbsp;บัตรเครดิต</div>
		<div class="report">&nbsp;&nbsp;รวมทั้งหมด</div>
		<div class="report">&nbsp;&nbsp;เลขที่ใบเสร็จ</div>
		<div class="report">&nbsp;&nbsp;สาขา</div>
		<!--<div style="width:100%; height:auto;  float:left; border-top:#CCCCCC 1px dotted; "> </div>-->
	</div>
	<?
	} 
	?>


	<div style="width:100%; font-size:10px; text-align:left; float:left; margin:auto; ">
		<div class="report-data center"><?= $n ?></div>
		<div class="report-data left" style="width:6%; margin-right:9%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $rs['cradno'] ?></div>
		<div class="report-data left" style="width:12%"><?= $rs['pname'] . $rs['fname'] . '    ' . $rs['lname']  ?></div>
		<div class="report-data report-num left" style="margin-left: 5%;">&nbsp;<?= number_format($rs['cash'], '2', '.', ',') ?></div>
		<div class="report-data report-num left" style="margin-left: 6%;">&nbsp;<?= number_format($rs['credit'], '2', '.', ',') ?></div>
		<div class="report-data report-num left" style="margin-left: 7%;">&nbsp;<?= number_format($rs['tot'], '2', '.', ',') ?></div>
		<div class="report-data left" style="margin-left: 4%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $rs['billno'] ?></div>
		<div class="report-data left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $rs['clinicname'] ?></div>
	</div>






<? $n++; } ?>
<div style="width:100%; height:10px; border-bottom:#999999 1px solid; float:left; margin:auto;  ">&nbsp;</div>



<div style="width:100%; font-size:11px; text-align:left; float:left; font-weight:bold; margin:auto; margin-top:5px;  ">
	<div style="width:5%; float:left; text-align:center;">&nbsp;</div>
	<div style="width:9%; float:left;">&nbsp;</div>
	<div style="width:28%; float:left; text-align:right; margin-left:2%;">รวมทั้งหมด&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
	<div style="width:12%; float:left; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= number_format($c, '2', '.', ',') ?>&nbsp;&nbsp;</div>
	<div style="width:12.75%; float:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= number_format($d, '2', '.', ',') ?>&nbsp;&nbsp;</div>
	<div style="width:15%; float:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= number_format($t, '2', '.', ',') ?>&nbsp;&nbsp;</div>
	<div style="width:10%; float:left; text-align:center">&nbsp;&nbsp;<?= '-' ?></div>
</div>
<div style="width:100%; height:10px; border-bottom:#999999 1px solid; float:left; margin:auto;">&nbsp;</div>