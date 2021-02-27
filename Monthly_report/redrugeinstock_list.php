<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div style=" width: 98%; margin-top:5px;  text-align:center; height:345px; ">
<?
include('../class/config.php');


if(!empty($_POST['did'])){
$did = $_POST['did'];
} else {
$did = '';
}


$cl = '';
if(empty($_POST['sdate'])){
$sdate ='0000-00-00';
$edate ='0000-00-00';
} else {

//$nd = substr($_POST['edate'],0,2) + 1;
//if(strlen($nd)==1){ $nd = '0'.$nd; }
//$sdate = substr($_POST['sdate'],6,4).'-'.substr($_POST['sdate'],3,2).'-'.substr($_POST['sdate'],0,2)  ;
//$edate = substr($_POST['edate'],6,4).'-'.substr($_POST['edate'],3,2).'-'.$nd ;

//$sdate = ($_POST['sdate']);
//$edate = ($_POST['edate']) + (1*24*3600); 

$t0 = strtotime($_POST['sdate']);
$t1 = strtotime($_POST['edate']) + (1*24*3600); 
$sdate = date("Y-m-d", $t0); 
$edate = date("Y-m-d", $t1);

 
}

?>
    <div style="width:98%; height:20px; padding-top:5px; color:#000000; margin:auto;  font-weight:bold; font-size:12px; background:<?=$tabcolor?>;">
      <div style="width:8%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ลำดับ</div>
      <div style="width:10%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;วันที่รับ</div>
	  <div style="width:10%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ผู้รับเข้า</div>
      <div style="width:10%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;Lot no</div>
      <div style="width:13%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ยา</div>
      <div style="width:10%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;จำนวนรับ</div>
	  <div style="width:10%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;คงเหลือ</div>
	  <div style="width:8%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;หน่วย</div>
	  <div style="width:10%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;เลขที่บิล</div>
	  <div style="width:10%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ชื่อผู้ขาย</div>
      
    </div>
	
		
<? 
/*$cl = $color1;
if(empty($did)){
$sql  = "select a.*,b.vdate,c.fname,c.lname,c.cradno from tb_drugerec a,tb_vst b,tb_patient c where a.vn = b.vn and b.status <> 'CANCLE'  and a.hn=c.hn ";
} else {
$sql  = "select a.*,b.vdate,c.fname,c.lname,c.cradno from tb_drugerec a,tb_vst b,tb_patient c where a.vn = b.vn and b.status <> 'CANCLE'  and a.hn=c.hn and (a.did like '%$did%') ";
}*/

if(empty($did)){
	if($sdate == $edate){
		$sql = "select a.ldate,a.empid,a.sid,a.sname,c.fname,c.lname,b.*   from tb_instock a, tb_drugeinstock b,tb_staff c  where (a.lno=b.lno) and (a.empid = c.staffid)  and ( a.ldate like '$sdate%' )  ";	
	} else {	
		$sql = "select a.ldate,a.empid,a.sid,a.sname,c.fname,c.lname,b.*   from tb_instock a, tb_drugeinstock b,tb_staff c  where (a.lno=b.lno) and (a.empid = c.staffid)  and (a.ldate between '$sdate' and '$edate')   ";
	}
} else {
	if($sdate == $edate){
		$sql = "select a.ldate,a.empid,a.sid,a.sname,c.fname,c.lname,b.*   from tb_instock a, tb_drugeinstock b,tb_staff c  where a.lno=b.lno and a.empid = c.staffid  and (a.ldate like '$sdate%') and (b.did like '%$did%')  ";
	} else {	
		$sql = "select a.ldate,a.empid,a.sid,a.sname,c.fname,c.lname,b.*   from tb_instock a, tb_drugeinstock b,tb_staff c  where (a.lno=b.lno) and (a.empid = c.staffid)  and (a.ldate between '$sdate' and '$edate') and (b.did like '%$did%')  ";
	
	}
}


/*$sql = "select a.ldate,a.empid  from tb_instock a  where  (a.ldate between '$sdate%' and '$edate%') ";*/


$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$Num_Rows = mysql_num_rows($result); 

/*echo $Num_Rows;*/


$Per_Page = 14;   // Per Page

$Page = $_POST["Page"];
if(!$_POST["Page"])	{	$Page=1;	}
$Prev_Page = $Page-1;
$Next_Page = $Page+1;
$Page_Start = (($Per_Page*$Page)-$Per_Page);
if($Num_Rows<=$Per_Page)
{
		$Num_Pages =1;
}
else if(($Num_Rows % $Per_Page)==0)
{
		$Num_Pages =($Num_Rows/$Per_Page) ;
}
else
{
		$Num_Pages =($Num_Rows/$Per_Page)+1;
		$Num_Pages = (int)$Num_Pages;
}
$sql .=" order by ldate,a.lno,did asc LIMIT $Page_Start , $Per_Page";
$result  = mysql_query($sql);
if($result){
$n=1;
while($rs=mysql_fetch_array($result)){  
if($cl != $color1){
	$cl = $color1;
} else {
	$cl = $color2;
}

?>	
		
<div class="list_out" onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')" style="width:98%;;background:<?=$cl?>; overflow:hidden; ">
	<div style="width:8%; float:left;"><?=$n?></div>
	<div style="width:10%; float:left;"><?=$rs['ldate']?></div>
	<div style="width:10%; float:left;"><?=$rs['fname'].'    '.$rs['lname']?></div>
	<div style="width:10%; float:left;"><?=$rs['lno']?></div>
	<div style="width:13%; float:left;"><?=$rs['dname']?></div>
	<div style="width:10%; float:left;"><? echo number_format($rs['qty'],'0','.',',') ?></div>
	<div style="width:10%; float:left;"><? echo number_format($rs['total'],'0','.',',') ?></div>
	<div style="width:8%; float:left;"><?=$rs['unit']?></div>	
	<div style="width:10%; float:left;"><?=$rs['sid']?></div>
	<div style="width:10%; float:left;"><?=$rs['sname']?></div>						
	
</div>






<? $n++; } ?>
<div style="width:83%; margin:auto; margin-top:10px; text-align:right; line-height:20px;">
 <?=$Num_Rows;?> 
  รายการ : 
  <?=$Num_Pages;?> 
  หน้า :
  <?
	if($Prev_Page)
	{
	?>
	<a href="javascript: ajaxLoad('post','Monthly_report/redrugeinstock_list.php','Page=<?=$Prev_Page?>&sdate=<?=$sdate?>&edate=<?=$_POST['edate']?>&did=<?=$_POST['did']?>','d_list')">	
	<img src='images/icon/back.png'  border='0' align="absmiddle"/>
	</a>
    
    
    
    
	<?
	}
	
	echo " <b>$Page </b>";
	
	if($Page!=$Num_Pages)
	{
	?>

	<a href="javascript: ajaxLoad('post','Monthly_report/redrugeinstock_list.php','Page=<?=$Next_Page?>&sdate=<?=$sdate?>&edate=<?=$_POST['edate']?>&did=<?=$_POST['did']?>','d_list')">	
	<img src='images/icon/next.png'  border='0' align="absmiddle" />
	</a>	
    <?		
	}
	
	mysql_close($dblink);

?>
</div>

<? } ?>
</div>



