<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
/*$sdate = $_GET['sdate'];
$edate = $_GET['edate'];*/

$t0 = strtotime($_GET['sdate']);
$t1 = strtotime($_GET['edate']) + (1*24*3600); 
$sdate = date("Y-m-d", $t0); 
$edate = date("Y-m-d", $t1); 

$c =0; $d=0; $t=0;
$sql = "select a.*,b.fname efname,b.lname elname ,c.fname cfname,c.lname clname,d.fname ckfname ,d.lname cklname from tb_totalprice a,tb_staff b,tb_staff c,tb_staff d where a.empname = b.staffid and a.cashier = c.staffid and a.cashier_check = d.staffid and (a.date between '$sdate%' and '$edate%') ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$Num_Rows = mysql_num_rows($result);
$n=1; $m=1; $s='y'; $x = 52; 

$n=1;

while($rs=mysql_fetch_array($result)){  
//$c = $dp + $rs['cash'];
//$d = $lp + $rs['credit'];
//$t = $lp + $rs['tot'];

$c = $c + $rs['cash'];
$k1 = $k1 + $rs['k_krungsri'];
$k2 = $k2 + $rs['k_kasikorn'];
$k3 = $k3 + $rs['k_thai'];
$k4 = $k4 + $rs['k_amax'];
$k5 = $k5 + $rs['k_uob'];
$k6 = $k6 + $rs['k_ktc'];
$k7 = $k7 + $rs['k_tana'];
$k8 = $k8 + $rs['total'];



if($s=='y'){ 
?>
<!--<div style="width:100%; height:3508px;  font-family: 'Angsana New'; text-align:center; margin-left:0px;">    --> 
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:14px; font-weight:bold; float:left;">รายงานสรุปบันทึกยอดรายวัน</div>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:13px; font-weight:bold; float:left;">
	ระหว่างวันที่ <?=$_GET['sdate'].'  ถึง  '.$_GET['edate'];?> 
	</div>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:12px; font-weight:bold; float:left;">

	<div style="width:100%; float:left; text-align:right;">
		หน้า : <?='1';?>&nbsp;
	</div>
	
	</div>	


    <div style="width:100%; height:30px; line-height:25px; text-align:center; font-size:10px; font-weight:bold;  float:left; ">
      <div style="width:3%; float:left; border-bottom:#999999 2px solid;">ลำดับ</div>
      <div style="width:4%; float:left; border-bottom:#999999 2px solid;">วันที่</div>
      <div style="width:6%; float:left; border-bottom:#999999 2px solid;">เงินสด</div>
      <div style="width:7%; float:left; border-bottom:#999999 2px solid;">กรุงศรีฯ</div>
      <div style="width:7%; float:left; border-bottom:#999999 2px solid;">กสิกร</div>
	  <div style="width:7%; float:left; border-bottom:#999999 2px solid;">ไทยพาณิชย์</div>
	  <div style="width:7%; float:left; border-bottom:#999999 2px solid;">Amax</div>
	  <div style="width:7%; float:left; border-bottom:#999999 2px solid;">OUB</div>
      <div style="width:7%; float:left; border-bottom:#999999 2px solid;">กรุงไทย</div>
	  <div style="width:7%; float:left; border-bottom:#999999 2px solid;">ธนชาติ</div>
	  <div style="width:7%; float:left; border-bottom:#999999 2px solid;">คงเหลือ</div>
	  <div style="width:7%; float:left; border-bottom:#999999 2px solid;">ผู้บันทึก</div>
	  <div style="width:7%; float:left; border-bottom:#999999 2px solid;">แคชเขียร์ประจำวัน</div>
	  <div style="width:7%; float:left; border-bottom:#999999 2px solid;">พนักงานตรวจ</div>
	  <div style="width:10%; float:left; border-bottom:#999999 2px solid;">เวลาบันทึก</div>
	</div>	
    
 <? 
 $s='n';
 }
if( $n > ($m * $x) ){ $m++; }  
if($m-1 > 1){  $x = 56; } 
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
      <div style="width:3%; float:left; border-bottom:#999999 2px solid;">ลำดับ</div>
      <div style="width:4%; float:left; border-bottom:#999999 2px solid;">วันที่</div>
      <div style="width:6%; float:left; border-bottom:#999999 2px solid;">เงินสด</div>
      <div style="width:7%; float:left; border-bottom:#999999 2px solid;">กรุงศรีฯ</div>
      <div style="width:7%; float:left; border-bottom:#999999 2px solid;">กสิกร</div>
	  <div style="width:7%; float:left; border-bottom:#999999 2px solid;">ไทยพาณิชย์</div>
	  <div style="width:7%; float:left; border-bottom:#999999 2px solid;">Amax</div>
	  <div style="width:7%; float:left; border-bottom:#999999 2px solid;">OUB</div>
      <div style="width:7%; float:left; border-bottom:#999999 2px solid;">กรุงไทย</div>
	  <div style="width:7%; float:left; border-bottom:#999999 2px solid;">ธนชาต</div>
	  <div style="width:7%; float:left; border-bottom:#999999 2px solid;">คงเหลือ</div>
	  <div style="width:7%; float:left; border-bottom:#999999 2px solid;">ผู้บันทึก</div>
	  <div style="width:7%; float:left; border-bottom:#999999 2px solid;">แคชเขียร์ประจำวัน</div>
	  <div style="width:7%; float:left; border-bottom:#999999 2px solid;">พนักงานตรวจ</div>
	  <div style="width:10%; float:left; border-bottom:#999999 2px solid;">เวลาบันทึก</div>
	</div>	
<?
 } 
?>		
		

	<div  style="width:100%; font-size:10px; text-align:left; float:left; margin:auto; ">	
		<div style="width:3%; text-align: center; float:left;"><?=$n?></div>
        <div style="width:3%; float:left;"><?=$rs['date']?></div>
		<div style="width:5%; text-align:right; float:left;">&nbsp;<?=number_format($rs['cash'],'2','.',',')?></div>
		<div style="width:7%; text-align:right; float:left;">&nbsp;<?=number_format($rs['k_krungsri'],'2','.',',')?></div>
        <div style="width:7%; text-align:right; float:left;">&nbsp;<?=number_format($rs['k_kasikorn'],'2','.',',')?></div>
		<div style="width:7%; text-align:right; float:left;">&nbsp;<?=number_format($rs['k_thai'],'2','.',',')?></div>
        <div style="width:7%; text-align:right; float:left;">&nbsp;<?=number_format($rs['k_amax'],'2','.',',')?></div>
        <div style="width:7%; text-align:right; float:left;">&nbsp;<?=number_format($rs['k_uob'],'2','.',',')?></div>
        <div style="width:7%; text-align:right; float:left;">&nbsp;<?=number_format($rs['k_ktc'],'2','.',',')?></div>
        <div style="width:7%; text-align:right; float:left;">&nbsp;<?=number_format($rs['k_tana'],'2','.',',')?></div>
        <div style="width:7%; text-align:right; float:left;">&nbsp;<?=number_format($rs['total'],'2','.',',')?></div>
        <div style="width:8%; float:left;">&nbsp;&nbsp;&nbsp;<?=$rs['efname'].'    '.$rs['elname']  ?></div>
        <div style="width:8%; float:left;">&nbsp;&nbsp;&nbsp;<?=$rs['cfname'].'    '.$rs['clname']  ?></div>
        <div style="width:7%; float:left;"><?=$rs['ckfname'].'    '.$rs['cklname']  ?></div>
        <div style="width:10%; float:left;"><?=$rs['datenow']?></div>
	</div>
	





<? $n++; } ?>	
<div style="width:100%; height:10px; border-bottom:#999999 1px solid; float:left; margin:auto;  ">&nbsp;</div>



<div style="width:100%; font-size:11px; text-align:left; float:left; font-weight:bold; margin:auto; margin-top:5px;  ">
	<div style="width:1%; float:left; text-align:center;">&nbsp;</div>
	
	<div style="width:5%; float:left; text-align:right">รวม&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
	<div style="width:7%; float:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=number_format($c,'2','.',',')?>&nbsp;&nbsp;</div>
	<div style="width:7%; float:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=number_format($k1,'2','.',',')?>&nbsp;&nbsp;</div>
	<div style="width:7%; float:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=number_format($k2,'2','.',',')?>&nbsp;&nbsp;</div>
    <div style="width:8%; float:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=number_format($k3,'2','.',',')?>&nbsp;&nbsp;</div>
    <div style="width:8%; float:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=number_format($k4,'2','.',',')?>&nbsp;&nbsp;</div>
    <div style="width:7%; float:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=number_format($k5,'2','.',',')?>&nbsp;&nbsp;</div>
    <div style="width:7%; float:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=number_format($k6,'2','.',',')?>&nbsp;&nbsp;</div>
    <div style="width:7%; float:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=number_format($k7,'2','.',',')?>&nbsp;&nbsp;</div>
	<div style="width:7%; float:left; text-align:center">&nbsp;&nbsp;<?='-'?></div>
</div>	
<div style="width:100%; height:10px; border-bottom:#999999 1px solid; float:left; margin:auto;">&nbsp;</div>



	



