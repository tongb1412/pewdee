<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$dat = date('d-m-Y',time());

$sql = "select a.pdate,sum(a.cash) s_cash ,sum(a.credit) s_credit,sum(a.total) s_total,b.cradno,b.pname,b.fname,b.lname ";
$sql .= "from tb_payment a,tb_patient b where (a.hn = b.hn) and (a.pdate like '%$dat%') and (a.vn like 'AR%') group by 'a.pdate%' ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$Num_Rows = mysql_num_rows($result);  


?>
<div style="width:100%; height:3508px;  font-family: 'Angsana New'; text-align:center; margin-left:0px;">     
	<div style="width:100%; height:20px;  line-height:20px; font-weight:bold; font-size:1ุ6px ">รายงานแยกตามการชำระ</div>
	<div style="width:100%; height:20px;  line-height:20px; font-weight:bold; font-size:16px "><?=$dat?></div>

	<div style="width:100%; height:auto;  float:left; border-top:#CCCCCC 1px dotted; ">  </div>
      		<div style="width:10%;text-align:left; float:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ลำดับ</div>
      		<div style="width:10%;text-align:left; float:left;">Crad No.</div>
      		<div style="width:22%;text-align:left; float:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ชื่อ-สกุล</div>
      		<div style="width:15%;text-align:left; float:left;">เงินสด</div>
      		<div style="width:15%;text-align:left; float:left;">&nbsp;&nbsp;บัตรเครดิต</div>
      		<div style="width:14%;text-align:left; float:left;">&nbsp;&nbsp;รวมทั้งหมด</div>
	  		<div style="width:14%;text-align:left; float:left;">&nbsp;&nbsp;เลขที่ใบเสร็จ</div>
				<div style="width:100%; height:auto;  float:left; border-top:#CCCCCC 1px dotted; "> </div>
<?  
$n=1;
$c =0; $d=0; $t=0;
while($rs=mysql_fetch_array($result)){  
$c = $dp + $rs['cash'];
$d = $lp + $rs['credit'];
$t = $lp + $rs['total'];


?>

	
	<div style="width:5%; float:left;"><?=$n?></div>
	<div style="width:10%; float:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$rs['cradno']?></div>
	<div style="width:22%; float:left;"><?=$rs['pname'].$rs['fname'].'    '.$rs['lname']  ?></div>
	<div style="width:14%; float:left;">&nbsp;<?=number_format($rs['cash'],'2','.',',')?></div>
	<div style="width:15%; float:left;">&nbsp;<?=number_format($rs['credit'],'2','.',',')?></div>
	<div style="width:15%; float:left;">&nbsp;<?=number_format($rs['total'],'2','.',',')?></div>
	<div style="width:15%; float:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$rs['billno']?></div>
	






<? $n++; } ?>

<div style="width:100%; height:10px; border-bottom:#999999 1px solid; float:left; margin:auto;  ">&nbsp;</div>



<div style="width:100%; font-size:16px; text-align:left; float:left; font-weight:bold; margin:auto; margin-top:5px;  ">
	<div style="width:5%; float:left; text-align:center;">&nbsp;</div>
	<div style="width:10%; float:left;">&nbsp;</div>
	<div style="width:27%; float:left; text-align:right">รวมทั้งหมด&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
	<div style="width:15%; float:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=number_format($c,'2','.',',')?>&nbsp;&nbsp;</div>
	<div style="width:15%; float:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=number_format($d,'2','.',',')?>&nbsp;&nbsp;</div>
	<div style="width:15%; float:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=number_format($t,'2','.',',')?>&nbsp;&nbsp;</div>
	<div style="width:8%; float:left; text-align:center">&nbsp;&nbsp;<?='-'?></div>
	
								
	
</div>	
<div style="width:100%; height:10px; border-bottom:#999999 1px solid; float:left; margin:auto;">&nbsp;</div>



	

</div>

