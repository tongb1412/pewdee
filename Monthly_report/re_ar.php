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
$sql = "select a.*,(a.cash+a.credit) total1,b.cradno,b.pname,b.fname,b.lname  ";
$sql .="from tb_payment a,tb_patient b where (a.hn = b.hn)  and (a.vn like 'AR%') and (a.pdate between '$sdate%' and '$edate%') ";
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
	ระหว่างวันที่ <?=$_GET['sdate'].'  ถึง  '.$_GET['edate'];?> 
	</div>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:12px; font-weight:bold; float:left;">

	<div style="width:100%; float:left; text-align:right;">
		หน้า : <?='1';?>&nbsp;
	</div>
	
	</div>	


<!--<div style="width:100%; height:auto;  float:left; border-top:#CCCCCC 1px dotted; ">  </div>-->
	<div style="width:100%; height:30px; line-height:25px; text-align:center; font-size:10px; font-weight:bold;  float:left; ">
				<div style="width:10%;float:left; border-bottom:#999999 2px solid;">ลำดับ</div>
				<div style="width:8%;float:left; border-bottom:#999999 2px solid;">Crad No.</div>
				<div style="width:20%;float:left; border-bottom:#999999 2px solid;">ชื่อ-สกุล</div>
				<div style="width:15%;float:left; border-bottom:#999999 2px solid;">เงินสด</div>
				<div style="width:15%;float:left; border-bottom:#999999 2px solid;">บัตรเครดิต</div>
				<div style="width:14%;float:left; border-bottom:#999999 2px solid;">รวมทั้งหมด</div>
				<div style="width:18%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เลขที่ใบเสร็จ</div>
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
				<div style="width:10%;float:left; border-bottom:#999999 2px solid;">ลำดับ</div>
				<div style="width:8%;float:left; border-bottom:#999999 2px solid;">Crad No.</div>
				<div style="width:20%;float:left; border-bottom:#999999 2px solid;">ชื่อ-สกุล</div>
				<div style="width:15%;float:left; border-bottom:#999999 2px solid;">เงินสด</div>
				<div style="width:15%;float:left; border-bottom:#999999 2px solid;">บัตรเครดิต</div>
				<div style="width:14%;float:left; border-bottom:#999999 2px solid;">รวมทั้งหมด</div>
				<div style="width:18%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เลขที่ใบเสร็จ</div>
	</div>
<?
 } 
?>		
		

	<div  style="width:100%; font-size:10px; text-align:left; float:left; margin:auto; ">	
		<div style="width:10%; float:left; text-align:center;"><?=$n?></div>
		<div style="width:10%; float:left;"><?=$rs['cradno']?></div>
		<div style="width:22%; float:left;"><?=$rs['fname'].'    '.$rs['lname']?></div>
		<div style="width:15%; float:left; text-align:left">&nbsp;<?=number_format($rs['cash'],'2','.',',')?></div>
		<div style="width:15%; float:left;">&nbsp;&nbsp;&nbsp;<?=number_format($rs['credit'],'2','.',',')?></div>		
		<div style="width:14%; float:left;">&nbsp;&nbsp;&nbsp;<?=number_format($rs['total1'],'2','.',',')?></div>	
		<div style="width:14%; float:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$rs['billno']?></div>
	</div>
	





<? $n++; } ?>	
<div style="width:100%; height:10px; border-bottom:#999999 1px solid; float:left; margin:auto;  ">&nbsp;</div>



<div style="width:100%; font-size:12px; text-align:left; float:left; font-weight:bold; margin:auto; margin-top:5px;  ">
	<div style="width:12%; float:left; text-align:center;">&nbsp;</div>
	
	<div style="width:27%; float:left; text-align:right">รวมทั้งหมด&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
	<div style="width:15%; float:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=number_format($c,'2','.',',')?>&nbsp;&nbsp;</div>
	<div style="width:15%; float:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=number_format($d,'2','.',',')?>&nbsp;&nbsp;</div>
	<div style="width:15%; float:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=number_format($t,'2','.',',')?>&nbsp;&nbsp;</div>
	<div style="width:8%; float:left; text-align:center">&nbsp;&nbsp;<?='-'?></div>
</div>	
<div style="width:100%; height:10px; border-bottom:#999999 1px solid; float:left; margin:auto;">&nbsp;</div>



	



