<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div style=" width: 98%; margin-top:5px;  text-align:center; height:345px; ">

<?
include('../class/config.php');
$cl = '';
$dat = date('Y-m-d');

?>
			<div style="width:98%; height:20px; padding-top:5px; color:#000000; margin:auto; font-weight:bold; font-size:12px; background:<?=$tabcolor?>;">
				<div style="width:8%;text-align:left; float:left;">&nbsp;<img src="../daily_report/images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ลำดับ</div>
				<div style="width:15%;text-align:left; float:left;">&nbsp;<img src="../daily_report/images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;เวลา</div>
				<div style="width:15%;text-align:left; float:left;">&nbsp;<img src="../daily_report/images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;Crad No.</div>
				<div style="width:35%;text-align:left; float:left;">&nbsp;<img src="../daily_report/images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ชื่อ-สกุล</div>
				<div style="width:22%;text-align:left; float:left;">&nbsp;<img src="../daily_report/images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;แพทย์</div>
			</div>
	
		
<? 

$cl = $color1;
$sql = "select b.cradno,b.pname,b.fname,b.lname,substr(c.vdate,12,8) vdate,c.empname  ";
$sql .="from tb_patient  b,tb_vst c where b.hn=c.hn and c.vdate like '%$dat%' and c.status not IN ('CANCEL') ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$Num_Rows = mysql_num_rows($result);  


//$Per_Page = 14;   // Per Page
//
//$Page = $_GET["Page"]; 
//if(!$_GET["Page"])	{	$Page=1;	}
//$Prev_Page = $Page-1;
//$Next_Page = $Page+1;
//$Page_Start = (($Per_Page*$Page)-$Per_Page);
//if($Num_Rows<=$Per_Page)
//{
//		$Num_Pages =1;
//}
//else if(($Num_Rows % $Per_Page)==0)
//{
//		$Num_Pages =($Num_Rows/$Per_Page) ;
//}
//else
//{
//		$Num_Pages =($Num_Rows/$Per_Page)+1;
//		$Num_Pages = (int)$Num_Pages;
//}
$sql .=" order by c.vn asc LIMIT $Page_Start , $Per_Page";
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
		
<div class="list_out" onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')" style="width:99%;background:<?=$cl?>; ">
	<div style="width:8%; height:20px; text-align: left; right line-height:20px;  float:left; "><?=$n?></div>
	<div style="width:15%; height:20px; text-align:left; line-height:20px;  float:left; ">&nbsp;&nbsp;&nbsp;<?=$rs['vdate']?></div>
	<div style="width:15%; height:20px; text-align:left; line-height:20px;  float:left;">&nbsp;<?=$rs['cradno']?></div>
	<div style="width:35%; height:20px; text-align:left; line-height:20px;  float:left;">&nbsp;<?=$rs['pname'].$rs['fname'].'    '.$rs['lname']  ?></div>
	<div style="width:22%; height:20px; text-align:left; line-height:20px;  float:left;">&nbsp;<?=$rs['empname']?></div>

	
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
	<a href="javascript: ajaxLoad('get','daily_report/repatient_list.php','Page=<?=$Prev_Page?>','staffedit')">	
	<img src='../daily_report/images/icon/back.png'  border='0' align="absmiddle"/>
	</a>
	<?
	}
	
	echo " <b>$Page </b>";
	
	if($Page!=$Num_Pages)
	{
	?>

	<a href="javascript: ajaxLoad('get','daily_report/repatient_list.php','Page=<?=$Next_Page?>','staffedit')">	
	<img src='../daily_report/images/icon/next.png'  border='0' align="absmiddle" />
	</a>	
    <?		
	}
	
	mysql_close($dblink);

?>
</div>

<? } ?>
</div>


<!--รวม-->

<div id="d_list2" style=" width: 99%; margin-top:10px;   text-align:center; height:30px; background-color:#FFCC99;  ">
	
<?
include('../class/config.php');
$dat = date('d-m-Y',time());
$sql = "select c.hn from tb_patient  b,tb_vst c where b.hn=c.hn and c.vdate like '%$dat%' ";
$s_result = mysql_query($sql) or die ("Error Query [".$sql."]");  
//$row=mysql_fetch_array($s_result);

$total = mysql_num_rows($s_result);


$sql = "select c.hn from tb_patient  b,tb_vst c where b.hn=c.hn and c.vdate like '%$dat%' and c.empid in ('00','-')";
$s_result = mysql_query($sql) or die ("Error Query [".$sql."]");  
//$row=mysql_fetch_array($s_result);

$sale = mysql_num_rows($s_result);

$sql = "select c.hn from tb_patient  b,tb_vst c where b.hn=c.hn and c.vdate like '%$dat%' and c.empid not in ('00','-')";
$s_result = mysql_query($sql) or die ("Error Query [".$sql."]");  
//$row=mysql_fetch_array($s_result);
$doc = mysql_num_rows($s_result);

?>	

	<div class="line" style="margin-top: 4px;">

      <div style="width:15%; float:left; text-align:right;">จำนวนคนไข้ :&nbsp;</div>
      <div style="width:10%; float:left;">
        <input style="font-weight:bold; text-align:right;" name="text2" type="text" id="" size="12"; value="<?=number_format($total,'0','.',',')?> &nbsp;"/>
      </div>
	  <div style="width:20%; float:left; text-align:right;">พบแพทย์ :&nbsp;</div>
      <div style="width:10%; float:left;">
        <input  style="font-weight:bold; text-align:right;" name="text2" type="text" id="" size="12"; value="<?=number_format($doc,'0','.',',')?>&nbsp;" />
      </div>
	  <div style="width:25%; float:left; text-align:right;">ซื้อยา/ทำหน้า(ไม่ระบุแพทย์):&nbsp;</div>  
      <div style="width:10%; float:left;">
        <input  style="font-weight:bold; text-align:right;" name="text2" type="text" id="" size="12"; value="<?=number_format($sale,'0','.',',')?>&nbsp;" />
      </div>
    </div>	
	
	
	
	
	</div>









