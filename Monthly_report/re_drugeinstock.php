<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$did = $_GET['did'];
$t0 = strtotime($_GET['sdate']);
$t1 = strtotime($_GET['edate']) + (1*24*3600); 
$sdate = date("Y-m-d", $t0); 
$edate = date("Y-m-d", $t1); 


$dname ='';
$sql = "select tname from tb_druge where   did='$did'";
$result = mysql_query($sql) or die ("Error Query [".$sql."]");
$n = mysql_num_rows($result);
if(!empty($n)){
	$rs=mysql_fetch_array($result);
	$dname = 'ยา : '.$rs['tname'];
} else {
	$dname = 'ยา : ทั้งหมด';
}


?>


	
<? 


if(empty($did)){
$sql  = "select a.ldate,a.empid,a.sid,a.sname,c.fname,c.lname,b.*   from tb_instock a, tb_drugeinstock b,tb_staff c  where (a.lno=b.lno) and (a.empid = c.staffid)  and (a.ldate between '$sdate' and '$edate')";
} else {
$sql  = "select a.ldate,a.empid,a.sid,a.sname,c.fname,c.lname,b.*   from tb_instock a, tb_drugeinstock b,tb_staff c  where (a.lno=b.lno) and (a.empid = c.staffid)  and (a.ldate between '$sdate' and '$edate') and (b.did like '%$did%') ";

}

$sql .=" order by ldate,a.lno,did asc ";
$result  = mysql_query($sql)or die ("Error Query [".$sql."]"); 

$n=1; $m=1; $s='y'; $x = 65;

 $tt=0; 
while($rs=mysql_fetch_array($result)){  





 
if($s=='y'){ 	
?>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:14px; font-weight:bold; float:left;">
	รายงานการรับเข้ายาเข้าสต็อค
	</div>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:13px; font-weight:bold; float:left;">
	ช่วงวันที่ <?=$_GET['sdate'].'  ถึง  '.$_GET['edate'];?> 
	</div>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:12px; font-weight:bold; float:left;">
		<div style="width:50%; float:left; text-align:left;">
		<?=$dname?>&nbsp;
		</div>
		<div style="width:50%; float:left; text-align:right;">
		หน้า : <?='1';?>&nbsp;
		</div>
	
	</div>	
    <div style="width:100%; height:30px; line-height:25px; text-align:center; font-size:10px; font-weight:bold;  float:left;">
      <div style="width:6%; float:left; border-bottom:#999999 2px solid;">ลำดับ</div>
      <div style="width:8%; float:left; border-bottom:#999999 2px solid;">วันที่รับ</div>
      <div style="width:13%; float:left; border-bottom:#999999 2px solid;">ผู้รับเข้า</div>
      <div style="width:10%; float:left; border-bottom:#999999 2px solid;">Lot no&nbsp;&nbsp;&nbsp;&nbsp;</div>
      <div style="width:15%; float:left; border-bottom:#999999 2px solid;">ยา&nbsp;&nbsp;&nbsp;&nbsp;</div>
      <div style="width:12%; float:left; border-bottom:#999999 2px solid;">จำนวนรับ</div>
	  <div style="width:7%; float:left; border-bottom:#999999 2px solid;">คงเหลือ</div>
	  <div style="width:7%; float:left; border-bottom:#999999 2px solid;">หน่วย</div>
	  <div style="width:10%; float:left; border-bottom:#999999 2px solid;">เลขที่บิล</div>
	  <div style="width:10%; float:left; border-bottom:#999999 2px solid;">ชื่อผู้ขาย</div>
	 
	</div>		
	
		
 <? 
 $s='n';
 }
if( $n > ($m * $x) ){ $m++; }  
if($m-1 > 1){  $x = 67; } 
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
      <div style="width:6%; float:left; border-bottom:#999999 2px solid;">ลำดับ</div>
      <div style="width:8%; float:left; border-bottom:#999999 2px solid;">วันที่รับ</div>
      <div style="width:13%; float:left; border-bottom:#999999 2px solid;">ผู้รับเข้า</div>
      <div style="width:10%; float:left; border-bottom:#999999 2px solid;">Lot no&nbsp;&nbsp;&nbsp;&nbsp;</div>
      <div style="width:15%; float:left; border-bottom:#999999 2px solid;">ยา&nbsp;&nbsp;&nbsp;&nbsp;</div>
      <div style="width:12%; float:left; border-bottom:#999999 2px solid;">จำนวนรับ</div>
	  <div style="width:7%; float:left; border-bottom:#999999 2px solid;">คงเหลือ</div>
	  <div style="width:7%; float:left; border-bottom:#999999 2px solid;">หน่วย</div>
	  <div style="width:10%; float:left; border-bottom:#999999 2px solid;">เลขที่บิล</div>
	  <div style="width:10%; float:left; border-bottom:#999999 2px solid;">ชื่อผู้ขาย</div>
	</div>		
	
	
	

<?
 } 
?>	
		

	
	
	
	
<div  style="width:100%; font-size:10px; text-align: left; float:left; margin:auto; height:15px; overflow:hidden; ">
	<div style="width:6%; float:left;text-align: center;"><?=$n?></div>
	<div style="width:8%; float:left;">&nbsp;<?=$rs['ldate']?></div>
	<div style="width:15%; float:left;">&nbsp;<?=$rs['fname'].'    '.$rs['lname']?></div>
	<div style="width:10%; text-align:left; float:left;">&nbsp;<?=$rs['lno']?></div>
	<div style="width:15%; float:left; overflow:hidden; white-space:nowrap">&nbsp;<?=$rs['dname']?></div>
	<div style="width:10%; float:left;text-align: center;">&nbsp;<? echo number_format($rs['qty'],'0','.',',') ?></div>
	<div style="width:10%; float:left;text-align: center;">&nbsp;<? echo number_format($rs['total'],'0','.',',') ?></div>
	<div style="width:8%; float:left;">&nbsp;<?=$rs['unit']?></div>		
	<div style="width:8%; float:left;">&nbsp;<?=$rs['sid']?></div>	
	<div style="width:8%; float:left;  overflow:hidden; white-space:nowrap">&nbsp;<?=$rs['sname']?></div>						
	
</div>	
	
	
<? $n++; } ?>	


