<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
<?
include('../class/config.php');
mysql_query("SET NAMES tis620");


$sdat = substr($_POST['sdate'],6,4).'-'.substr($_POST['sdate'],3,2).'-'.substr($_POST['sdate'],0,2);
$edat  = date('Y-m-d',mktime(0, 0, 0, substr($_POST['edate'],3,2)  , substr($_POST['edate'],0,2)+1, substr($_POST['edate'],6,4)));


$txt1 = $_POST['sdate'].'  to  '.$_POST['edate']; 



$filName = "Rep_Ku.csv";
$objWrite = fopen("Rep_Ku.csv", "w");

fwrite($objWrite,"\"Kupong Report\"");
fwrite($objWrite,"\n");
fwrite($objWrite,"\"$txt1\"");
fwrite($objWrite,"\n");

fwrite($objWrite,"\"no\",\"Date\",\"Name\",\"Card no / Comment\",\"Card TType\",\"Discount\",\"Amount\",\"Patient Type\"");
fwrite($objWrite,"\n");

$sql  = "select a.vn,b.pname,b.fname,b.lname,b.new,c.* from tb_vst a,tb_patient b,tb_payment c  where  (a.hn=b.hn) and (a.vn=c.vn) and (a.status IN('COM'))    ";
$sql .= " and (c.total > 0) and  (c.ku > 0)  and (c.pdate between '$sdat' and '$edat')  order by a.vn asc  ";


$str  = mysql_query($sql);
$num = mysql_num_rows($str);
$m=1;
while($rs  = mysql_fetch_array($str)){

	
			$t1 = $m;
			$t2 = $dd;
			$t3 = $rs['pname'].$rs['fname'].'  '.$rs['lname'];
			$t4 = $rs['kno'];  
			$t5 = $rs['total'] - $rs['ku']  ;
			if($rs['new']=='O') { $t6 = 'Old'; } else { $t6 = 'New'; }
			if($rs['ktype']=='K') { $t7 = 'Kupong'; } 
			if($rs['ktype']=='B') { $t7 = 'Bank Tranfer'; } 
			if($rs['ktype']=='P') { $t7 = 'Post'; } 
			$t8 = $rs['ku'] ;	

	fwrite($objWrite,"\"$t1\""); 
	fwrite($objWrite,",\"$t2\"");			
	fwrite($objWrite,",\"$t3\"");
	fwrite($objWrite,",\"$t4\"");
	fwrite($objWrite,",\"$t7\"");
	fwrite($objWrite,",\"$t8\"");
	fwrite($objWrite,",\"$t5\"");
	fwrite($objWrite,",\"$t6\"");
	fwrite($objWrite,"\n");
 $m++;
}

fclose($objWrite);
?>
<div style="width:300px; height:100px; margin:auto; text-align:center; font-size:20px; margin-top:100px;">
เตรียมข้อมูลเรียบร้อยแล้ว
<br />
<a href="Monthly_report/<?=$filName?>" target="_blank">Export File To Excel</a>

</div>

