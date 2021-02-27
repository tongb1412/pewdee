<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="rep_stockcard_excel.xls"');# ???????? 
?>
<html xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">
<HTML>
<HEAD>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</HEAD>
<?

include('../class/config.php');

$sdat = substr($_GET['sdate'],6,4).'-'.substr($_GET['sdate'],3,2).'-'.substr($_GET['sdate'],0,2);
$edat  = date('Y-m-d',mktime(0, 0, 0, substr($_GET['edate'],3,2)  , substr($_GET['edate'],0,2)+1, substr($_GET['edate'],6,4)));
$edate  = date('Y-m-d',mktime(0, 0, 0, substr($_GET['edate'],3,2)  , substr($_GET['edate'],0,2), substr($_GET['edate'],6,4)));
$endLine = 33;



$txt1 = ' วันที่ '.$_GET['sdate'].'  ถึง  '.$_POST['edate'].' สาขา  '.$rs['clinicname']; 







$sql  = "select a.vdate as t1,b.* from tb_vst a,cbil b  where  (a.vn=b.vn)  and (a.status IN('CANCEL'))    ";
$sql .= "and (b.cdat between '$sdat' and '$edat')  order by a.vn asc  ";
$str = mysql_query($sql) or die($sql);


?>
<BODY>
<TABLE  x:str BORDER="1">
<TR><TD colspan="8" align="center"><b>รายงานยกเลิกบิล</b></TD></TR>
<TR><TD colspan="8" align="center"><b><?=$txt1?></b></TD></TR>


<TR >

    
        <td align="center" style="background:#CCCCCC">ลำดับ</td>
        <td align="center" style="background:#CCCCCC">เลขที่บิล</td> 
        <td align="center" style="background:#CCCCCC">ชื่ลูกค้า</td>        
        <td align="center" style="background:#CCCCCC" >เวลาที่พิมพ์ใบเสร็จ</td>
        <td align="center" style="background:#CCCCCC" >วันเวลาที่ยกเลิก</td>
        <td align="center" style="background:#CCCCCC">จำนวนเงิน</td>
        <td align="center" style="background:#CCCCCC">ผู้ยกเลิก</td> 
        <td align="center" style="background:#CCCCCC">ผู้ตรวจสอบ</td>     
    	<td align="center" style="background:#CCCCCC">หมายเหตุ</td>  
  
</TR>



<?
$n = 1;  $total = 0;  $sd='';
while($rs = mysql_fetch_array($str)){ 
$t1 = ''; $t2 = ''; 
$dat = substr($rs['dat'],8,2).'-'.substr($rs['dat'],5,2).'-'. (substr($rs['dat'],0,4)+543);


 
			
		//	$t1 = $m;
			$t2 = $rs['bno'];
			$t3 = $rs['cname'];
			$t4 = $rs['t1'];
			$t5 = $rs['cdat'].' '.$rs['ctime'];
			$t6 = $rs['total']; 
			$t7 = $rs['ename']; 
			$t8 = $rs['pname'];
			$t9 = $rs['mem'];	
		
			 


?>
<TR>
    <TD align="center" ><?=$n?></TD>
    <TD align="center" ><?=$t2?></TD>
    <TD align="center" ><?=$t3?></TD>
    <TD align="left" ><?=$t4?></TD>
    <TD align="left" ><?=$t5?></TD>
    <TD align="center" ><?=number_format($t6,0,'.',','); ?>&nbsp;&nbsp;</TD>    
    <TD align="center" ><?=$t7?></TD>
    <TD align="left" ><?=$t8?></TD>
    <TD align="left" ><?=$t9?></TD>
 
</TR>

<? $n++; }?>




</TABLE>
</BODY>
</HTML>



