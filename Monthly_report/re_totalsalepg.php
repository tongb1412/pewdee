<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/monthly_report.css" rel="stylesheet" type="text/css" />
<?
include('../class/config.php');
include('../class/permission_user.php');


$t0 = strtotime($_GET['sdate']);
$t1 = strtotime($_GET['edate']); 
$sdate = date("Y-m-d", $t0); 
$edate = date("Y-m-d", $t1); 

/*$nd = substr($_GET['edate'],0,2) + 1; 
if(strlen($nd)==1){ $nd = '0'.$nd; }
$sdate = substr($_GET['sdate'],6,4).'-'.substr($_GET['sdate'],3,2).'-'.substr($_GET['sdate'],0,2)  ;
$edate = substr($_GET['edate'],6,4).'-'.substr($_GET['edate'],3,2).'-'.$nd ;*/

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

if(empty($did)) {
	$sql  = "select  a.empid, a.empname, a.tid, a.tname, a.branchid, b.cn, b.clinicname,sum(a.totalprice) totalprice,count(*) qty ";
	$sql .= "from tb_pctrec as a, tb_clinicinformation as b where (a.dat between '$sdate%' and '$edate%') and (a.typ ='P') and a.branchid = b.cn  ";
} else {
	$sql  = "select  a.empid, a.empname, a.tid, a.tname, a.branchid, b.cn, b.clinicname,sum(a.totalprice) totalprice,count(*) qty ";
	$sql .= "from tb_pctrec as a, tb_clinicinformation as b where (a.dat between '$sdate%' and '$edate%') and (a.typ ='P') and (a.empid like '%$did%') and a.branchid = b.cn ";
}

$sql .=" $where_branch_id group by empid,empname,tid,tname order by empid ";

// echo $sql;
$result  = mysql_query($sql)or die ("Error Query [".$sql."]"); 
$n=1; $m=1; $s='y'; $x = 52; $h=1; $nn=0;

$total = 0;
$total1 = 0;

while($rs = mysql_fetch_array($result)){  
$nn++;


if($s=='y'){ 	
?>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:14px; font-weight:bold; float:left;">
	รายงานรวมการขายแพ็คเกจ
	</div>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:13px; font-weight:bold; float:left;">
	ประจำวันที่  <?=$_GET['sdate'];?> ถึง  <?=$_GET['edate'];?> 
	</div>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:12px; font-weight:bold; float:left;">
		<div style="width:50%; float:left; text-align:left;">
			&nbsp;สาขา
			<?php
			if ($branch_id == "00") {
				echo "ทั้งหมด";
			} else {
				echo $cname;
			}
			?>
		</div>
		<div style="width:50%; float:left; text-align:right;">
		หน้า : <?='1';?>&nbsp;
		</div>
	
	</div>	
    <div style="width:100%; height:30px; line-height:25px; text-align:center; font-size:10px; font-weight:bold;  float:left;">
      <div style="width:8%; float:left; border-bottom:#999999 2px solid;">ลำดับ</div>
      <div style="width:20%; float:left; border-bottom:#999999 2px solid;">รหัส</div>
      <div style="width:30%; float:left; border-bottom:#999999 2px solid;">รายการ</div>      
      <div style="width:20%; float:left; border-bottom:#999999 2px solid;">จำนวนเงิน</div>
	  <div style="width:22%; float: left; border-bottom:#999999 2px solid;">จำนวนคนไข้</div> 
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
			&nbsp;สาขา
			<?php
			if ($branch_id == "00") {
				echo "ทั้งหมด";
			} else {
				echo $cname;
			}
			?>
		</div>
		<div style="width:50%; float:left; text-align:right;">
		หน้า : <?=$m;?>&nbsp;
		</div>
	</div>
    <div style="width:100%; height:30px; line-height:25px; text-align:center; font-size:10px; font-weight:bold;  float:left;">
      <div style="width:10%; float:left; border-bottom:#999999 2px solid;">ลำดับ</div>
      <div style="width:20%; float:left; border-bottom:#999999 2px solid;">รหัส</div>
      <div style="width:30%; float:left; border-bottom:#999999 2px solid;">รายการ</div>      
      <div style="width:20%; float:left; border-bottom:#999999 2px solid;">จำนวนเงิน</div>
	  <div style="width:20%; float:left; border-bottom:#999999 2px solid;">จำนวนคนไข้</div> 
	</div>	
<?
} 
$ft = 'N';
if($empid != $rs['empid'] ){
	$empid = $rs['empid'];  
	$dname = $rs['empname'];
if($n>1){

?>
<div  style="width:100%; font-size:10px; text-align:left; float:left; margin:auto; font-weight:bold; border-top:#CCCCCC 1px dotted; overflow:hidden;">	
	<!-- <div style="width:10%; float:left;">&nbsp;</div> -->
	<div style="width:20%; float:left;">&nbsp;</div>
	<div style="width:30%; float:left; text-align:right">รวม</div>	
    <div style="width:20%; float:left; text-align:right">&nbsp;<?=number_format($total,'0','.',',')?>&nbsp;&nbsp;&nbsp;</div>	
	<div style="width:20%; float:left; text-align:right"><?=number_format($qty,'0','.',',')?>&nbsp;&nbsp;&nbsp;</div>		
</div>
<? 
 $h=1; $m=1; $n++; 
 $total = 0;
 
}
?>	
<div  style="width:100%; font-size:10px; text-align:left; float:left; margin:auto; font-weight:bold; ">			
	&nbsp;
	<?php
		echo $dname;
		if ($branch_id != "00") {
			echo "";
		} else {
			echo " ( สาขา " . $rs['clinicname'] . " )";
		}
	
	?>
</div>
<? 
}


$total = $total + $rs['totalprice'];
$total1 = $total1+ $rs['totalprice'];
$qty = $m;




?>	
	
	
<div  style="width:100%; font-size:10px; text-align:left; float:left; margin:auto; overflow:hidden;  ">
	<div class="report-data" style="margin-left: 4%;"><?=$m?></div>
	<div class="report-data"><?=$rs['tid']?></div>
	<div class="report-data" style="margin-left: 10%;"><?=$rs['tname']?></div>
    <div class="report-data" style="margin-left: 16%;"><?=number_format($rs['totalprice'],'0','.',',')?>&nbsp;&nbsp;&nbsp;</div>	
	<div class="report-data" style="margin-left: 10%;"><?=number_format($rs['qty'],'0','.',',')?>&nbsp;&nbsp;&nbsp;</div>	
</div>	
<? 
	
$n++; $h++; $m++;   } 
?>	
<div  style="width:100%; font-size:10px; text-align:left; float:left; margin:auto; font-weight:bold; border-top:#CCCCCC 1px dotted; overflow:hidden;">	
	<!-- <div style="width:10%; float:left;">&nbsp;</div> -->
    
	<div style="width:20%; float:left;">&nbsp;</div>
	<div style="width:30%; float:left; text-align:right">รวม</div>	
    <div style="width:20%; float:left; text-align:right"><?=number_format($total,'0','.',',')?>&nbsp;&nbsp;&nbsp;</div>	
	<div style="width:20%; float:left; text-align:right"><?=number_format($qty,'0','.',',')?>&nbsp;&nbsp;&nbsp;</div>	
</div>


<div style="width:100%; height:10px; border-bottom:#999999 1px solid; float:left; margin:auto;  ">&nbsp;</div>

<div style="width:100%; font-size:10px; text-align:left; float:left; font-weight:bold; margin:auto; margin-top:5px;  overflow:hidden;">

	<!-- <div style="width:10%; float:left;">&nbsp;</div> -->
	<div style="width:20%; float:left;">รวมทั้งหมด</div>
	<div style="width:30%; float:left; text-align:right"><?=$nn.'  รายการ';?></div>	
    <div style="width:20%; float:left; text-align:right">&nbsp;<?=number_format($total1,'0','.',',')?>&nbsp;&nbsp;&nbsp;</div>	
	<div style="width:20%; float:left; text-align:right"><?=$nn.'  รายการ';?></div>		
</div>	
<div style="width:100%; height:10px; border-bottom:#999999 1px solid; float:left; margin:auto;">&nbsp;</div>

