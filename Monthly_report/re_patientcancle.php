<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div style="width:auto; margin:auto; height:auto;">
<?
include('../class/config.php');


$t0 = strtotime($_GET['sdate']);
$t1 = strtotime($_GET['edate']) + (1*24*3600); 
$sdate = date("Y-m-d", $t0); 
$edate = date("Y-m-d", $t1); 

$sql = "select a.*,b.fname,b.lname,b.cradno ";
$sql .="from tb_vst a,tb_patient b where a.hn = b.hn and (a.vdate between '$sdate%' and '$edate%') and a.status = 'CANCEL' ";
$sql .="  order by a.vdate  ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$Num_Rows = mysql_num_rows($result); 

$n=1; $m=1; $s='y'; $x = 81; 

$t1=0; $t2=0; $t3=0;
while($rs=mysql_fetch_array($result)){ 
/*$t1++;
switch($rs['empid']){
case '00' : $t3++; break;
case '-' : $t3++; break;

}*/
 
if($s=='y'){ 	
?>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:14px; font-weight:bold; float:left;">
	รายงานคนไข้ยกเลิก
	</div>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:13px; font-weight:bold; float:left;">
	ช่วงวันที่ <?=$_GET['sdate']?>  ถึง  <?=$_GET['edate']?>
	</div>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:12px; font-weight:bold; float:left;">

		<div style="width:100%; float:left; text-align:right;">
		หน้า : <?='1';?>&nbsp;
		</div>
	
	</div>	
    <div style="width:100%; height:30px; line-height:25px; text-align:center; font-size:10px; font-weight:bold;  float:left; ">
				<div style="width:8%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;ลำดับ</div>
				<div style="width:10%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;วันที่เวลาเข้า</div>
				<div style="width:18%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;วันที่เวลาออก</div>
				<div style="width:8%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;Crad No.</div>
				<div style="width:11%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;ชื่อ-สกุล</div>
				<div style="width:45%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;หมายเหตุ</div>
				<div style="width:0%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;</div>
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
				<div style="width:8%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;ลำดับ</div>
				<div style="width:10%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;วันที่เวลาเข้า</div>
				<div style="width:10%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;วันที่เวลาออก</div>
				<div style="width:28%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;Crad No.</div>
				<div style="width:11%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;ชื่อ-สกุล</div>
				<div style="width:27%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;หมายเหตุ</div>
				<div style="width:5%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;</div>
	</div>	
<?

 } 
?>	
		

	
	
	
	
<div  style="width:100%; font-size:10px; text-align:left; float:left; margin:auto; overflow:hidden; ">
		<div style="width:8%; float:left; text-align:center;"><?=$n?></div>
		<div style="width:15%; float:left;">&nbsp;<?=$rs['vdate']?></div>
		<div style="width:15%; float:left;">&nbsp;<?=$rs['ctime']?></div>
		<div style="width:10%; float:left;">&nbsp;<?=$rs['cradno']?></div>
		<div style="width:30%; float:left; text-align:left">&nbsp;<?=$rs['pname'].$rs['fname'].'    '.$rs['lname']  ?></div>
		<div style="width:20%; float:left;">&nbsp;<?=$rs['mem']?></div>
		<div style="width:1%; float:left;">&nbsp;&nbsp;&nbsp;</div>		
	
</div>	
	
	
<? $n++; } 

?>	

	
								
	
</div>

</div>
