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
$sql = "select a.*,(a.cash+a.credit) total1,b.cradno,b.pname,b.fname,b.lname, c.cn, c.clinicname  ";
$sql .="from tb_payment a,tb_patient b, tb_clinicinformation c where (a.hn = b.hn)  and (a.vn like 'AR%') and (a.pdate between '$sdate%' and '$edate%') and a.branchid = c.cn " . $where_branch_id;
$sql .="  order by a.pdate  ";

$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$Num_Rows = mysql_num_rows($result);
$n=1; $m=1; $s='y'; $x = 81; 

$n=1;

while($rs=mysql_fetch_array($result)){ 
//$c = $dp + $rs['cash'];
//$d = $lp + $rs['credit'];
//$t = $lp + $rs['tot'];

$c = $c + $rs['cash'];
$d = $d + $rs['credit'];
$t = $t + $rs['total1'];



if($s=='y'){ 
?>
<!--<div style="width:100%; height:3508px;  font-family: 'Angsana New'; text-align:center; margin-left:0px;">    -->
<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:14px; font-weight:bold; float:left;">
	รายงานรายได้จากค้างชำระ
</div>
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
	<div class="report report-no">ลำดับ</div>
	<div class="report">Crad No.</div>
	<div class="report report-name">ชื่อ-สกุล</div>
	<div class="report">เงินสด</div>
	<div class="report">บัตรเครดิต</div>
	<div class="report">รวมทั้งหมด</div>
	<div class="report report-bill">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เลขที่ใบเสร็จ</div>
	<div class="report report-name" >สาขา</div>
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
	<div class="report">เงินสด</div>
	<div class="report">บัตรเครดิต</div>
	<div class="report">รวมทั้งหมด</div>
	<div class="report report-bill">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เลขที่ใบเสร็จ</div>
	<div class="report report-name" >สาขา</div>
</div>
<?
 } 
?>


<div style="width:100%; font-size:10px; text-align:left; float:left; margin:auto; ">
	<div class="report-data report-no center" style="margin-right: 4%;"><?= $n ?></div>
	<div class="report-data left"><?= $rs['cradno'] ?></div>
	<div class="report-data left" style="margin-right: 4%;"><?= $rs['fname'] . '    ' . $rs['lname'] ?></div>
	<div class="report-data report-num left" style="margin-right: 5%;"><?= number_format($rs['cash'], '2', '.', ',') ?></div>
	<div class="report-data report-num left" style="margin-right: 7%;">&nbsp;&nbsp;&nbsp;<?= number_format($rs['credit'], '2', '.', ',') ?></div>
	<div class="report-data report-num left" style="margin-right: 7%;">&nbsp;&nbsp;&nbsp;<?= number_format($rs['total1'], '2', '.', ',') ?></div>
	<div class="report-data left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $rs['billno'] ?></div>
	<div class="report-data left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $rs['clinicname'] ?></div>
</div>

<? $n++; } ?>
<div style="width:100%; height:10px; border-bottom:#999999 1px solid; float:left; margin:auto;  ">&nbsp;</div>



<div style="width:100%; font-size:12px; text-align:left; float:left; font-weight:bold; margin:auto; margin-top:5px;  ">
	<div class="report-data" style="margin-left:4%">&nbsp;</div>
	<div class="report-data right" style="margin-right:1%">รวมทั้งหมด&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
	<div class="report-data right" style="margin-right:1.5%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= number_format($c, '2', '.', ',') ?>&nbsp;&nbsp;</div>
	<div class="report-data right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= number_format($d, '2', '.', ',') ?>&nbsp;&nbsp;</div>
	<div class="report-data right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= number_format($t, '2', '.', ',') ?>&nbsp;&nbsp;</div>
</div>
<div style="width:100%; height:10px; border-bottom:#999999 1px solid; float:left; margin:auto;">&nbsp;</div>