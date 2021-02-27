<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$dat = date('Y-m-d',time());

$sql = "select distinct(a.hn) hn,a.pdate,b.cradno,b.pname,b.fname,b.lname  from tb_payment a,tb_patient  b where (a.hn = b.hn) and  (a.pdate like '%$dat%') ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$Num_Rows = mysql_num_rows($result);  


?>
<div style="width:100%; height:1000px;  font-family: 'Angsana New'; text-align:center; margin-left:0px;">     
	<div style="width:100%; height:20px;  line-height:20px; font-weight:bold; font-size:1ุ6px ">รายงานคนไข้ประจำวัน</div>
	<div style="width:100%; height:20px;  line-height:20px; font-weight:bold; font-size:1ุ6px "><?=$dat?></div>

	<div style="width:100%; height:auto;  float:left; border-top:#CCCCCC 1px dotted; ">  </div>
				<div style="width:18%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;ลำดับ</div>
				<div style="width:20%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;รหัสคนไข้</div>
				<div style="width:20%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;Crad No.</div>
				<div style="width:42%;float:left; border-bottom:#999999 2px solid;">&nbsp;&nbsp;ชื่อ-สกุล</div>
				<div style="width:100%; height:auto;  float:left; border-top:#CCCCCC 1px dotted; "> </div>
<?  
$n=1;
while($rs=mysql_fetch_array($result)){  



?>

	
		<div style="width:10%; height:18px; text-align:center; line-height:20px;  float:left;"><?=$n?></div>
		<div style="width:15%; height:20px; text-align:left; line-height:20px;  float:left;">&nbsp;&nbsp;&nbsp;<?=$rs['hn']?></div>
		<div style="width:20%; float:left; text-align:left">&nbsp;<?=$rs['cradno']?></div>
		<div style="width:47%; float:left; text-align:left">&nbsp;<?=$rs['pname'].$rs['fname'].'    '.$rs['lname']  ?></div>






<? $n++; } ?>


<?php /*?><? $n++;  ?><?php */?>



	

</div>

