<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="Report1.xls"');# ???????? 
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

$charset = "SET NAMES 'utf8'";

ini_set('max_execution_time',36000); 

$sdat = substr($_POST['sdate'],6,4).'-'.substr($_POST['sdate'],3,2).'-'.substr($_POST['sdate'],0,2);
$edat  = date('Y-m-d',mktime(0, 0, 0, substr($_POST['edate'],3,2)  , substr($_POST['edate'],0,2)+1, substr($_POST['edate'],6,4)));
$txt1 = 'วันที่ '.$_POST['sdate'].'  ถึง  '.$_POST['edate']; 



$sql = "select * from tb_gernaral where typ= 'GTR' order by discount desc ";
$str = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$n=0;
while($rs = mysql_fetch_array($str)){
		$gname[$n] = $rs['name']; 
		$gid[$n] = $rs['id'];
		$n++;
}
$gnum = $n ;
$sn = ($gnum*3) + 5;

$sql = "select * from tb_gernaral where typ= 'GTC' order by discount desc ";
$str = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$n=0;
while($rs = mysql_fetch_array($str)){
    $cname[$n] = $rs['name']; 
	$cid[$n] = $rs['id'];
	$n++;
}
$cnum = $n ;
$sn = $sn + ($cnum * 2);
?>
<BODY>
<TABLE  x:str BORDER="1">
<TR x:str BORDER="0">
    <TD colspan="<?=$sn?>" align="center"><b>รายงานบัญชีแพทย์</b></TD>

</TR>
<TR x:str BORDER="0">
    <TD colspan="<?=$sn?>" align="center"><b><?=$txt1?></b></TD>

</TR>

<TR valign="bottom">
    <TD align="center" rowspan="2"><b>ลำดับ</b></TD>
    <TD align="center" rowspan="2"><b>ชื่อแพทย์</b></TD>
    <TD align="center" rowspan="2"><b>วันที่</b></TD>
    <TD align="center" rowspan="2"><b>HN</b></TD>
    <TD align="center" rowspan="2"><b>รวมยอด</b></TD>
    <TD align="center" rowspan="2"><b>ค่าตรวจ</b></TD>
    <TD align="center" rowspan="2"><b>ส่วนลด</b></TD>
    <? for($i=0; $i<$gnum; $i++){ ?>  <TD align="center" colspan="3" align="center"><b><?=$gname[$i]?></b></TD> <? } ?>
    <? for($i=0; $i<$cnum; $i++){ ?>  <TD align="center" colspan="2" align="center" bgcolor="#FFCC00"><b><?=$cname[$i]?></b></TD> <? } ?>
   
</TR>
<TR>
 	<? for($i=0; $i<$gnum; $i++){ ?>  
    <TD align="center" align="center"><b>ครั้ง</b></TD> 
    <TD align="center" align="center"><b>ใช้คอร์ส</b></TD>
    <TD align="center" align="center"><b>ทำ</b></TD>
	<? } ?>
	<? for($i=0; $i<$cnum; $i++){ ?> 
    <TD align="center" align="center" bgcolor="#FFCC00"><b>ครั้ง</b></TD>   
    <TD align="center" align="center" bgcolor="#FFCC00"><b>ราคา</b></TD>
    <? } ?>
</TR>


<?
$sql = "select distinct a.empid,a.empname from tb_vst a,tb_staff b where (a.empid=b.staffid) and (a.empid<>'00') and (a.status='COM') and (b.typ='D') and (a.vdate between '$sdat%' and '$edat%') order by a.vn asc ";

$str  = mysql_query($sql)or die ("Error Query [".$sql."]");
$number = mysql_num_rows($str);
$n=0;  
while($rs=mysql_fetch_array($str)){    
	$dname[$n] = $rs['empname'];
	$did[$n] = $rs['empid'];
	$n++; 
}
$j = 0;
for($i = 0;$i < $number; $i++){
    $j++;
    $empid = $did[$i];  
	$sql = "select distinct vn,vdate,hn from tb_vst where (empid='$empid')   and (vdate between '$sdat%' and '$edat%')";
	$str  = mysql_query($sql)or die ("Error Query [".$sql."]");
	
	
	$rd= mysql_num_rows($str);
    $dtotal = 0;
	$dp = 0; $lp = 0; $total = 0; $dis = 0;  $t1 = 0; $t2 = 0; $t3 = 0;
	while($rs=mysql_fetch_array($str)){
		$vn = $rs['vn'];  
		$dat = substr($rs['vdate'],0,10);
		
		$s1 = "select billno,dp,lp,ku,discount,total from tb_payment where vn='$vn'  ";
		$tr  = mysql_query($s1)or die ("Error Query [".$s1."]");
		$row = mysql_fetch_array($tr);
		$total = $row['total'];
		$dp = $row['dp'] + $row['lp'];	
		$dis = $row['ku'] + $row['discount'];		
			
		$d1 = number_format($dp,'1','.',',');
		$y = explode('.',$d1);
		$d1 = $y[0];		
		
		$t1 = number_format($total,'1','.',',');
		$x = explode('.',$t1);
		$t1 = $x[0];
		
		$c1 = number_format($dis,'1','.',',');
		$a = explode('.',$c1);
		$c1 = $a[0];
		
		?>
        <TR valign="top" >
        <TD align="center" align="center" ><?=$j?></TD> 
        <TD align="center" align="left" ><?=$dname[$i]?></TD> 
        <TD align="center" align="center" ><?=$dat?></TD> 
        <TD align="center" align="center" ><?= $row['billno']?></TD> 
        <TD align="center" align="center" ><?=$t1?></TD> 
        <TD align="center" align="center" ><?=$d1?></TD>
        <TD align="center" align="center" ><?=$c1?></TD> 
        <?	
		
		for($j = 0;$j < $gnum; $j++){
		   
			$tgid = $gid[$j] ;  
			//ขายทรีทเม้น / เลเซอร์
			$sl = "select a.totalprice,a.tid from tb_pctrec a,tb_treatment b,tb_vst c where a.vn = c.vn and a.tid=b.tid and a.typ in ('L','T') and b.tgroup ='$tgid' and a.vn='$vn' ";
			$tr  = mysql_query($sl)or die ("Error Query [".$sl."]");
			$row = mysql_fetch_array($tr);
			$num = mysql_num_rows($tr);
			
			
			$t1 = 0; $t2 = 0; $t3 = 0;
			if($row['totalprice'] > 0){ $t3 = $row['totalprice']; $t1++; } 	
		
		    	
				
			//ใช้ course
			$sl  = "select a.qty,(b.totalprice / b.qty) price,a.tid  from tb_pctuse a,tb_pctrec b,tb_treatment c ";
			$sl .= "where a.vn = b.vn and a.cid=b.tid and a.ftyp='C' and a.tid=c.tid and c.tgroup ='$tgid' and a.uvn='$vn'  ";
			$tr  = mysql_query($sl)or die ("Error Query [".$sl."]");
			$num = mysql_num_rows($tr);
			if(!empty($num)){
			    $t2= 0; 
				while($row = mysql_fetch_array($tr)){
					$t2 = $t2 + $row['price'] * $row['qty'];							
				    $t1 = $t1 + $row['qty'];
				}		
			} else { $t2 = ''; }
			if(empty($t1)){ $t1 =' '; }
			if(empty($t3)){ $t3 =' '; }
			?>
            <TD align="center" align="center"><?=$t1?></TD> 
            <TD align="center" align="right"><?=$t2?></TD> 
            <TD align="center" align="right"><?=$t3?></TD> 
            <?
        }
			
		for($j = 0;$j < $cnum; $j++){	
			$cgid = $cid[$j] ; 
			//ขายทรีทเม้น / เลเซอร์
			$sl = "select a.totalprice from tb_pctrec a,tb_course b,tb_vst c where a.vn = c.vn and a.tid=b.cid and a.typ = 'C' and b.cgroup ='$cgid' and a.vn='$vn' ";
			$tr  = mysql_query($sl)or die ("Error Query [".$sl."]");
			$row = mysql_fetch_array($tr);
			$num = mysql_num_rows($tr);
						
			$t1 = 0; $t2 = 0; $t3 = 0;
			if($row['totalprice'] > 0){ $t2 = $row['totalprice']; $t1++; } 	
			if(empty($t1)){ $t1 =' '; }
			if(empty($t2)){ $t2 =' '; }	
			?>
            <TD align="center" align="center" bgcolor="#FFCC00"><?=$t1?></TD> 
            <TD align="center" align="right" bgcolor="#FFCC00"><?=$t2?></TD>    
                 
            <?				
			
		}	
			
	?>
     </TR>   
	<?
	}
   
}
?>




</TABLE>
</BODY>
</HTML>