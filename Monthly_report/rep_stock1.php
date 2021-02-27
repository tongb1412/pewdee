<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="rep_stoc.xls"');# ???????? 
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

$endLine = 33;




$sqlC .="select clinicname from tb_clinicinformation ";
$strc  = mysql_query($sqlC)or die ("Error Query [".$sqlC."]"); 
$rs=mysql_fetch_array($strc);

$cname = $rs['clinicname'];

$txt1 = ' ฌ วันที่ '.date('Y-m-d').$rs['clinicname']; 



//$txt = 'ตั้งแต่วันที่ '.showdateTH($sdat).'  ถึงวันที่  '.showdateTH($edate); 


//$sdat = date('Y-m-d',strtotime($sdat) -1);
//$edat = date('Y-m-d',strtotime($edat) -1);




$sql  = "select * from tb_druge where status = 'IN'  order by dgid,tname asc  "; 

$str = mysql_query($sql) or die($sql);


?>
<BODY>
<TABLE  x:str BORDER="1">
<TR><TD colspan="8" align="center"><b>รายงานยาคงเหลือ</b></TD></TR>
<TR><TD colspan="8" align="center"><b><?=$txt1?></b></TD></TR>

        	<tr >
        	<td align="center" style="background:#CCCCCC">ลำดับ</td>
            <td align="center" style="background:#CCCCCC">รหัส</td>
            <td align="center" style="background:#CCCCCC">ชื่อยา</td>
            <td align="center" style="background:#CCCCCC">หน่วย</td>
            <td align="center" style="background:#CCCCCC">ราคา</td>
            <td align="center" style="background:#CCCCCC">ในCom</td>
            <td align="center" style="background:#CCCCCC">นับจริง</td>
            <td align="center" style="background:#CCCCCC">ขาดเกิน</td>
            </tr>



<?
$n = 1; 
while($rs = mysql_fetch_array($str)){ 
$t1 = ''; $t2 = ''; 

       		
		
			 


?>
<TR>
    <TD align="center" ><?=$n?></TD>
    <TD align="left" ><?=$rs['did']?></TD>
    <TD align="left" ><?=$rs['tname']?></TD>
    <TD align="left" ><?=$rs['unit']?></TD>
    <TD align="left" ><?=$rs['sprice']?></TD>
    <TD align="center" ><?=$rs['total']?></TD>    
    <TD align="center" >&nbsp;</TD>
    <TD align="left" >&nbsp;</TD>
 
</TR>

<? $n++; }?>




</TABLE>
</BODY>
</HTML>