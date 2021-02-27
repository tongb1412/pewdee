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
$sql = "select a.*,b.fname efname,b.lname elname ,c.fname cfname,c.lname clname,d.fname ckfname ,d.lname cklname from tb_totalcash a,tb_staff b,tb_staff c,tb_staff d where a.empname = b.staffid and a.cashier = c.staffid and a.cashier_check = d.staffid and (a.date between '$sdate%' and '$edate%') ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]");
$Num_Rows = mysql_num_rows($result);
$n=1; $m=1; $s='y'; $x = 52;

$n=1;

while($rs=mysql_fetch_array($result)){
//$c = $dp + $rs['cash'];
//$d = $lp + $rs['credit'];
//$t = $lp + $rs['tot'];




if($s=='y'){
?>
<!--<div style="width:100%; height:3508px;  font-family: 'Angsana New'; text-align:center; margin-left:0px;">    -->
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:14px; font-weight:bold; float:left;">รายงานสรุปบันทึกยอดสดประจำวัน</div>
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
      <div style="width:6%; float:left; border-bottom:#999999 2px solid;">ยอดยกมา</div>
      <div style="width:7%; float:left; border-bottom:#999999 2px solid;">ยอดขาย</div>
      <div style="width:7%; float:left; border-bottom:#999999 2px solid;">ค่าใช้จ่าย</div>
	  <div style="width:7%; float:left; border-bottom:#999999 2px solid;">แพทย์เบิก</div>
	  <div style="width:7%; float:left; border-bottom:#999999 2px solid;">ฝากธนาคาร</div>
	  <div style="width:21%; float:left; border-bottom:#999999 2px solid;">หมายเหตุ</div>
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
      <div style="width:6%; float:left; border-bottom:#999999 2px solid;">ยอดยกมา</div>
      <div style="width:7%; float:left; border-bottom:#999999 2px solid;">ยอดขาย</div>
      <div style="width:7%; float:left; border-bottom:#999999 2px solid;">ค่าใช้จ่าย</div>
	  <div style="width:7%; float:left; border-bottom:#999999 2px solid;">แพทย์เบิก</div>
	  <div style="width:7%; float:left; border-bottom:#999999 2px solid;">ฝากธนาคาร</div>
	  <div style="width:21%; float:left; border-bottom:#999999 2px solid;">หมายเหตุ</div>
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
		<div style="width:5%; text-align:right; float:left;">&nbsp;<?=number_format($rs['cash_yes'],'2','.',',')?></div>
		<div style="width:7%; text-align:right; float:left;">&nbsp;<?=number_format($rs['today_total'],'2','.',',')?></div>
        <div style="width:7%; text-align:right; float:left;">&nbsp;<?=number_format($rs['coste'],'2','.',',')?></div>
		<div style="width:7%; text-align:right; float:left;">&nbsp;<?=number_format($rs['doctor_cos'],'2','.',',')?></div>
        <div style="width:7%; text-align:right; float:left;">&nbsp;<?=number_format($rs['bank'],'2','.',',')?></div>
        <div style="width:21%; float:left;">&nbsp;&nbsp;<? if($rs['mem']!==''){ echo $rs['mem'];  } else { echo '-';  }  ?></div>
        <div style="width:7%; text-align:right; float:left;">&nbsp;<?=number_format($rs['total'],'2','.',',')?></div>

        <div style="width:8%; float:left;">&nbsp;&nbsp;&nbsp;<?=$rs['efname'].'    '.$rs['elname']  ?></div>
        <div style="width:8%; float:left;">&nbsp;&nbsp;&nbsp;<?=$rs['cfname'].'    '.$rs['clname']  ?></div>
        <div style="width:7%; float:left;"><?=$rs['ckfname'].'    '.$rs['cklname']  ?></div>
        <div style="width:10%; float:left;"><?=$rs['datenow']?></div>
	</div>






<? $n++; } ?>
<div style="width:100%; height:10px; border-bottom:#999999 1px solid; float:left; margin:auto;  ">&nbsp;</div>




<div style="width:100%; height:10px; border-bottom:#999999 1px solid; float:left; margin:auto;">&nbsp;</div>
