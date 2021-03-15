<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div style="width:auto; margin:auto; height:auto;">
<?
include('../class/config.php');
include('../class/permission_user.php');


if(empty($_GET['sdate'])){
$sdate ='0000-00-00';
$edate ='0000-00-00';
} else {


$t0 = strtotime($_GET['sdate']);
$t1 = strtotime($_GET['edate']) + (1*24*3600); 
$sdate = date("Y-m-d", $t0); 
$edate = date("Y-m-d", $t1); 
 $total = 0;
}

if(!empty($_GET['branchid'])){
	$branchid = $_GET['branchid'];
} else {
	$branchid = '';
}
$where_branch_id = "";
if($branchid != "") {
	if($branchid != "00"){ 
		$where_branch_id = " and (a.branchid ='".$branchid."' or a.branchid is null ) ";
	} 
}else if($_SESSION['branch_id'] != "") {	
	$where_branch_id = " and (a.branchid ='".$_SESSION['branch_id']."'  or a.branchid is null ) ";
}


$branchname = get_branch_name($branchid,$_SESSION['company_code']);

// echo "x".$branchid."x";


$sql = "select *  ";
$sql .="from tb_patient a";
$sql .=" LEFT JOIN tb_branch b on b.branchid = a.branchid ";
$sql .= " where (datep between '$sdate%' and '$edate%') and new = 'N' $where_branch_id";
$sql .="  order by hn  ";
// echo $sql;
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$Num_Rows = mysql_num_rows($result); 

$n=1; $m=1; $s='y'; $x = 81; 

$t1=0; $t2=0; $t3=0;
while($rs=mysql_fetch_array($result)){ 
$t1++;
switch($rs['empid']){
case '00' : $t3++; break;
case '-' : $t3++; break;

}
 
if($s=='y'){ 	
?>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:14px; font-weight:bold; float:left;">
	รายงานคนไข้ใหม่ <?php if($branchname != "") { echo " (สาขา $branchname)"; } ?>
	</div>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:13px; font-weight:bold; float:left;">
	ประจำวันที่  <?=$_GET['sdate'].'  ถึง  '.$_GET['edate'];?>
	</div>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:12px; font-weight:bold; float:left;">

		<div style="width:100%; float:left; text-align:right;">
		หน้า : <?='1';?>&nbsp;
		</div>
	
	</div>	
    <div style="width:100%; height:30px; line-height:25px; text-align:center; font-size:10px; font-weight:bold;  float:left; ">
				<?php 
					if($branchid == "") { ?>
						<div style="width:8%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;ลำดับ</div>
						<div style="width:10%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;วันที่</div>
						<div style="width:28%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;Crad No.</div>
						<div style="width:11%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;ชื่อ-สกุล</div>
						<div style="width:37%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;</div>
						<div style="width:5%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;</div>
				<?php 
					} else { 
				?>
						<div style="width:8%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;ลำดับ</div>
						<div style="width:10%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;วันที่</div>
						<div style="width:15%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;Crad No.</div>
						<div style="width:15%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;ชื่อ-สกุล</div>
						<div style="width:37%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;สาขา</div>
						<div style="width:15%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;</div>
				<?php 		
					}
				?>
				

				

	</div>		
 <? 
 $s='n';
 }
if( $n > ($m * $x) ){ $m++; }
if($m-1 > 1){  $x = 83;} 
if($n == ((($m-1) * $x) + 1) && $m > 1){
   
    ?>
	<br>
	
	<div style="width:100%; height:25px; line-height:25px; text-align:right; font-size:12px; font-weight:bold; float:left;">

		หน้า : <?=$m.'  '.$n.'  '.$x;?>&nbsp;
		
	</div>
    <div style="width:100%; height:30px; line-height:25px; text-align:center; font-size:10px; font-weight:bold;  float:left; ">
				<?php 
					if($branchid == "") { ?>
						<div style="width:8%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;ลำดับ</div>
						<div style="width:10%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;วันที่</div>
						<div style="width:28%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;Crad No.</div>
						<div style="width:10%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;ชื่อ-สกุล</div>
						<div style="width:37%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;</div>
						<div style="width:5%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;</div>
				<?php 
					} else { 
				?>
						<div style="width:8%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;ลำดับ</div>
						<div style="width:10%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;วันที่</div>
						<div style="width:15%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;Crad No.</div>
						<div style="width:15%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;ชื่อ-สกุล</div>
						<div style="width:37%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;สาขา</div>
						<div style="width:15%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;</div>
				<?php 		
					}
				?>
	</div>	
<?

 } 
?>	
		

	
	
	
	
<div  style="width:100%; font-size:10px; text-align:left; float:left; margin:auto; overflow:hidden; ">
	<?php 
		if($branchid == "") { ?>
		<div style="width:8%; float:left; text-align:center;"><?=$n?></div>
		<div style="width:21%; float:left;">&nbsp;<?=$rs['datep']?></div>
		<div style="width:10%; float:left;">&nbsp;<?=$rs['cradno']?></div>
		<div style="width:51%; float:left; text-align:left">&nbsp;<?=$rs['pname'].$rs['fname'].'    '.$rs['lname']  ?></div>
		<div style="width:1%; float:left;">&nbsp;&nbsp;&nbsp;</div>		
	<?php 
		} else { 
	?>
		<div style="width:8%; float:left; text-align:center;"><?=$n?></div>
		<div style="width:15%; float:left;">&nbsp;<?=$rs['datep']?></div>
		<div style="width:10%; float:left;">&nbsp;<?=$rs['cradno']?></div>
		<div style="width:30%; float:left; text-align:left">&nbsp;<?=$rs['pname'].$rs['fname'].'    '.$rs['lname']  ?></div>
		<div style="width:20%; float:left; text-align:left">&nbsp;<?=$rs['branchname']  ?></div>
		<div style="width:1%; float:left;">&nbsp;&nbsp;&nbsp;</div>	
	<?php 		
		}
	?>
</div>	
	
	
<? $n++; } 

?>	

	
								
	
</div>

</div>
