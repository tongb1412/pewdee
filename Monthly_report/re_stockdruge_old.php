<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$did = $_GET['did'];


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
$sql  = "select * from tb_druge where status='IN' ";
} else {
$sql  = "select * from tb_druge where status='IN' and (did like '%$did%') ";

}

$sql .=" order by dgroup,tname asc ";
$result  = mysql_query($sql)or die ("Error Query [".$sql."]"); 

$n=1; $m=1; $s='y'; $x = 60;

 $tt=0; 
while($rs=mysql_fetch_array($result)){  





 
if($s=='y'){ 	
?>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:14px; font-weight:bold; float:left;">
	รายงานยาทั้งหมด
	</div>
<!--	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:13px; font-weight:bold; float:left;">
	ช่วงวันที่ <?=$sdate?>  ถึง  <?=$edate?>
	</div>-->
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:13px; font-weight:bold; float:left;">
		<div style="width:50%; float:left; text-align:left;">
		<?=$dname?>&nbsp;
		</div>
		<div style="width:50%; float:left; text-align:right;">
		หน้า : <?='1';?>&nbsp;
		</div>
	
	</div>	
    <div style="width:100%; height:30px; line-height:25px; text-align:center; font-size:11px; font-weight:bold;  float:left;">
      <div style="width:10%; float:left; border-bottom:#999999 2px solid;">ลำดับ</div>
      <div style="width:8%; float:left; border-bottom:#999999 2px solid;">รหัส</div>
      <div style="width:25%; float:left; border-bottom:#999999 2px solid;">รายการ</div>
      
      <div style="width:25%; float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;&nbsp;&nbsp;คงเหลือ</div>
	  <div style="width:20%; float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;&nbsp;&nbsp;นับจริง</div>
      <div style="width:12%; float:left; border-bottom:#999999 2px solid;">หน่วย</div>
	 
	</div>		
	
		
 <? 
 $s='n';
 }
if( $n > ($m * $x) ){ $m++; }  
if($m-1 > 1){  $x = 61; } 
if($n == ((($m-1) * $x) + 1) && $m > 1){
 
    ?>
	<br><br>
	<div style="width:100%; height:25px; line-height:25px; text-align:center; font-size:13px; font-weight:bold; float:left;">
		<div style="width:50%; float:left; text-align:left;">
		<?=$dname?>&nbsp;
		</div>
		<div style="width:50%; float:left; text-align:right;">
		หน้า : <?=$m;?>&nbsp;
		</div>
	</div>
    <div style="width:100%; height:30px; line-height:25px; text-align:center; font-size:12px; font-weight:bold;  float:left; ">
      <div style="width:10%; float:left; border-bottom:#999999 2px solid;">ลำดับ</div>
      <div style="width:8%; float:left; border-bottom:#999999 2px solid;">รหัส</div>
      <div style="width:25%; float:left; border-bottom:#999999 2px solid;">รายการ</div>
      
      <div style="width:25%; float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;&nbsp;&nbsp;คงเหลือ</div>
	  <div style="width:20%; float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;&nbsp;&nbsp;นับจริง</div>
      <div style="width:12%; float:left; border-bottom:#999999 2px solid;">หน่วย</div>
	</div>		
	
	
	

<?
 } 
?>	
		

	
	
	
	
<div  style="width:100%; font-size:13px; text-align: center; float:left; margin:auto; overflow:hidden; ">
	<div style="width:10%; float:left;"><?=$n?></div>
	<div style="width:8%; float:left;"><?=$rs['did']?></div>
	<div style="width:25%; text-align:left; float:left;"><?=$rs['tname']?></div>
	<?php /*?><div style="width:20%; float:left;"><?=$rs['dgroup']?></div><?php */?>
	<div style="width:25%; float:left;"><? echo number_format($rs['total'],'0','.',',') ?></div>
	<div style="width:20%; float:left;">&nbsp;</div>
	<div style="width:12%; float:left;">&nbsp;<?=$rs['unit']?></div>
	
								
	
</div>	
	
	
<? $n++; } ?>	


