<?
include('../class/config.php');

$sdat = substr($_GET['sdate'],6,4).'-'.substr($_GET['sdate'],3,2).'-'.substr($_GET['sdate'],0,2);
$edat  = date('Y-m-d',mktime(0, 0, 0, substr($_GET['edate'],3,2)  , substr($_GET['edate'],0,2)+1, substr($_GET['edate'],6,4)));
$edate  = date('Y-m-d',mktime(0, 0, 0, substr($_GET['edate'],3,2)  , substr($_GET['edate'],0,2), substr($_GET['edate'],6,4)));
$endLine = 33;

$txt1 = 'ตั้งแต่วันที่ '.showdateTH($sdat).'  ถึงวันที่  '.showdateTH($edate); 


$sql  = "select a.vdate as t1,b.* from tb_vst a,cbil b  where  (a.vn=b.vn)  and (a.status IN('CANCEL'))    ";
$sql .= "and (b.cdat between '$sdat' and '$edat')  order by a.vn asc  ";

$str  = mysql_query($sql);
$num = mysql_num_rows($str);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>รายงานยกเลิกบิล</title>
</head>
<style type="text/css">
body {
	font: 12px Tahoma, Verdana, Arial, Helvetica, sans-serif;
	background:#FFFFFF;
	padding: 0;
	margin: 0;
	text-align:center;
}
.txt1 { font-size:14px; font-weight:bold; height:25px; line-height:25px; }
.lineH { border-bottom:#999999 1px solid; font-size:12px; font-weight:bold; line-height:20px; height:20px; overflow:hidden; }
.line { border-bottom:#999999 1px dotted; line-height:20px; height:20px; overflow:hidden;}
.lineT { border-bottom:#999999 1px dotted; line-height:20px; height:20px; font-weight:bold; }
.lineName { line-height:20px; height:20px; font-weight:bold; }
</style>
<body>
<table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr><td align="center" class="txt1">รายงานยกเลิกบิล</td></tr>
	<tr><td align="center" class="txt1"><?=$txt1;?></td></tr>
    <tr>
    <td align="center">
    <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" >
		<? 			
		$showLine = 1;
		showHeader(); 		
        $n=0; $sd = ''; $m=1; 	
        while($rs  = mysql_fetch_array($str)){
		    $showLine++;
			if($showLine > $endLine ){ showHeader(); $showLine = 1; }			
        	$dat = substr($rs['cdat'],8,2).'-'.substr($rs['cdat'],5,2).'-'.substr($rs['cdat'],0,4);
			$ct =  substr($rs['t1'],8,2).'-'.substr($rs['t1'],5,2).'-'.substr($rs['t1'],0,4);
        	if($sd!=$dat){ $sd=$dat; $dd= $dat; } else { $dd='-';  }  			
			$t1 = $m;
			$t2 = $dd;
			$t3 = $rs['bno'];
			$t4 = $rs['cname'];  
			$t5 = $rs['t1'];
            $t6 = $rs['ctime'];
			$t7 = $rs['total'];
			$t8 = $rs['ename'];
			$t9 = $rs['pname'];			
			$t10 = $rs['mem'] ;
			showDetail($t1,$t2,$t3,$t4,$t5,$t6,$t7,$t8,$t9,$t10);       
         $n++; $m++;
		 } 
	
		
		 ?>
    </table> 
    </td>
    </tr>       
</table>
<?
function showdateTH($txt){   
    $dat = explode('-',$txt);
    $d = $dat[2];
	$m = $dat[1];
	$y = $dat[0] + 543;
	$tt = '0';
	//$thmonth=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษาคม","พฤษภาคม","มิถุนายน","กรกฏาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
	$thmonth=array("ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
	for($i=0;$i<12;$i++){
	    $x = explode($thmonth[$i],$txt);
		if( count($x) == 2){ $tt='563'; }
		
	}
	
	$m=$m-1;
	 
	if($tt=='563'){
    	return $txt;
	} else {
		return $d." ".$thmonth[$m]." ".$y;
	}


}
function showHeader(){
?>
    	<tr valign="top" >
        <td align="center" class="lineH" width="40">ลำดับ</td>    
        <td align="center" class="lineH" width="90" >เลขที่ใบเสร็จ</td>       
        <td align="center" class="lineH" width="180" >ชื่อ</td>
        
        <td align="center" class="lineH" width="120">เวลาพิมพ์ใบเสร็จ</td>
        <td align="center" class="lineH" width="80">เวลายกเลิก</td> 
        <td align="center" class="lineH" width="80">จำนวนเงิน</td> 
        <td align="center" class="lineH" width="80">ผู้ยกเลิก</td>  
        <td align="center" class="lineH" width="80">ผู้ตรวจสอบ</td>  
        <td align="center" class="lineH" >หมายเหตุ</td>             
    	</tr> 
<?
}
function showDetail($t1,$t2,$t3,$t4,$t5,$t6,$t7,$t8,$t9,$t10){
?>
        <tr valign="top">
        <td align="center" class="line" ><?=$t1?></td>  
        <td align="center" class="line" ><?=$t3?></td>
        <td align="left" class="line">&nbsp;&nbsp;<?=$t4?></td>
        <td align="center" class="line"  ><?=$t5?></td>
        <td align="center" class="line"><?=$t6?></td>
        <td align="right" class="line"><?=number_format($t7,2,'.',','); ?>&nbsp;&nbsp;</td>
        <td align="left" class="line">&nbsp;&nbsp;<?=$t8?></td>
        <td align="left" class="line">&nbsp;&nbsp;<?=$t9?></td>
        <td align="left" class="line">&nbsp;&nbsp;<?=$t10?></td>
    	</tr>  
<?
}

?>
</body>
</html>


