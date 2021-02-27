<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');


$dat = date('Y-m-d',time());

$sql = "select b.cradno,b.pname,b.fname,b.lname,substr(c.vdate,12,8) vdate,c.empname,substr(c.ctime,12,8) cdate  ";
$sql .="from tb_patient  b,tb_vst c where b.hn=c.hn and c.vdate like '%$dat%' and c.status not IN ('CANCEL')  ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$Num_Rows = mysql_num_rows($result); 

$n=1; $m=1; $s='y'; $x = 80;

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
	รายงานคนไข้ประจำวัน
	</div>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:13px; font-weight:bold; float:left;">
	ประจำวันที่  <?=date('d/m/Y',time());?> 
	</div>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:12px; font-weight:bold; float:left;">

		<div style="width:100%; float:left; text-align:right;">
		หน้า : <?='1';?>&nbsp;
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
		<?=$dname?>&nbsp;
		</div>
		<div style="width:50%; float:left; text-align:right;">
		หน้า : <?=$m;?>&nbsp;
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
?>	
		

	
	
	
	
<div  style="width:100%; font-size:10px; text-align:left; float:left; margin:auto; ">
		<div style="width:13%; float:left; text-align:center;"><?=$n?></div>
		<div style="width:7%; float:left;  text-align:center;">&nbsp;<?=$rs['vdate']?></div>
		<div style="width:15%; text-align:center; float:left;">&nbsp;<?=$rs['cradno']?></div>
		<div style="width:31%; float:left; text-align:left">&nbsp;&nbsp;&nbsp;&nbsp;<?=$rs['pname'].$rs['fname'].'    '.$rs['lname']  ?></div>
		<div style="width:7%; float:left;  text-align:center;">&nbsp;<?=$rs['cdate']?></div>
		<div style="width:25%; float:left;">&nbsp;&nbsp;&nbsp;&nbsp;<?=$rs['empname']?></div>
	
								
	
</div>	
	
	
<? $n++; } 
//echo $t1.' '.$t2.' '.$t3;
?>	

	
								
	
</div>	


