<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
session_start();
include('../class/config.php');
include('../class/permission_user.php');

$dat = date('Y-m-d',time());


// $dat = date('Y-m-d');
// $dat = "2011-03-22";


if(!empty($_REQUEST['branchid'])){
	$branch_id = $_REQUEST['branchid'];
} else {
	$branch_id = $_SESSION['branch_id'];
}
$as = "b";
$data = set_where_user_data($as ,$branch_id, $_SESSION['company_code'], $_SESSION['company_data']);
$where_branch_id = "";
$where_branch_id .= $data['where_branch_id'];
$where_branch_id .= $data['where_company_code'];

$sql = "select b.cradno, b.branchid,b.pname,b.fname,b.lname,substr(c.vdate,12,8) vdate,c.empname,substr(c.ctime,12,8) cdate ";
$sql .="from tb_patient  b,tb_vst c where b.hn=c.hn and c.vdate like '%$dat%' and c.status not IN ('CANCEL') $where_branch_id";
// echo $sql;
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$Num_Rows = mysql_num_rows($result); 

$n=1; $m=1; $s='y'; $x = 80;

$t1=0; $t2=0; $t3=0;
$flag_branch = "";
while($rs=mysql_fetch_array($result)){ 
$t1++;
switch($rs['empid']){
case '00' : $t3++; break;
case '-' : $t3++; break;

}
 
if($s=='y'){ 	
?>
<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:14px; font-weight:bold; float:left;">
	รายงานคนไข้ประจำวัน
</div>
<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:13px; font-weight:bold; float:left;">
	ประจำวันที่ <?= date('d/m/Y', time()); ?>
</div>
<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:12px; font-weight:bold; float:left;">

	<div style="width:100%; float:left; text-align:right;">
		หน้า : <?= '1'; ?>&nbsp;
	</div>

</div>
<div style="width:100%; height:30px; line-height:25px; text-align:center; font-size:10px; font-weight:bold;  float:left; ">
	<div style="width:13%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;ลำดับ</div>
	<div style="width:7%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;เวลาเข้า</div>
	<div style="width:15%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;Crad No.</div>
	<div style="width:31%;float:left; border-bottom:#999999 2px solid;">ชื่อ-สกุล</div>
	<div style="width:7%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;เวลาออก</div>
	<div style="width:25%;float:left; border-bottom:#999999 2px solid;">แพทย์้</div>
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
	<div style="width:13%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;ลำดับ</div>
	<div style="width:7%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;เวลาเข้า</div>
	<div style="width:15%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;Crad No.</div>
	<div style="width:31%;float:left; border-bottom:#999999 2px solid;">ชื่อ-สกุล</div>
	<div style="width:7%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;เวลาออก</div>
	<div style="width:25%;float:left; border-bottom:#999999 2px solid;">แพทย์้</div>
</div>
<?
 } 
	if($flag_branch != $rs['branchid']){
		$flag_branch = $rs['branchid'];
		?>
		<div style="width:100%; height:30px; line-height:25px; text-align:left; font-size:12px; font-weight:bold;  float:left; ">
			<div style="width:30%; float:left;">สาขา <?php echo $_SESSION['clinic_info'][$rs['branchid']]['clinicname'] ?></div>
		</div>
		<?php
	}
?>

<div style="width:100%; font-size:10px; text-align:left; float:left; margin:auto; ">
	<div style="width:13%; float:left; text-align:center;"><?= $n ?></div>
	<div style="width:7%; float:left;  text-align:center;">&nbsp;<?= $rs['vdate'] ?></div>
	<div style="width:15%; text-align:center; float:left;">&nbsp;<?= $rs['cradno'] ?></div>
	<div style="width:31%; float:left; text-align:left">&nbsp;&nbsp;&nbsp;&nbsp;<?= $rs['pname'] . $rs['fname'] . '    ' . $rs['lname']  ?></div>
	<div style="width:7%; float:left;  text-align:center;">&nbsp;<?= $rs['cdate'] ?></div>
	<div style="width:25%; float:left;">&nbsp;&nbsp;&nbsp;&nbsp;<?= $rs['empname'] ?></div>
</div>


<? $n++; } 
//echo $t1.' '.$t2.' '.$t3;
?>




</div>