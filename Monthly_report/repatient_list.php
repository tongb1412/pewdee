	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div style=" width: 98%; margin-top:5px;   text-align:center; height:345px; ">

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

	$t0 = strtotime($_POST['sdate']);
	$t1 = strtotime($_POST['edate']) + (1*24*3600); 
	$sdate = date("Y-m-d", $t0); 
	$edate = date("Y-m-d", $t1); 
}

?>
			<div style="width:98%; height:20px; padding-top:5px; color:#000000; margin:auto; font-weight:bold; font-size:12px; background:<?=$tabcolor?>;">
				<div style="width:8%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ลำดับ</div>
				<div style="width:20%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;เวลา</div>
				<div style="width:10%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;Crad No.</div>
				<div style="width:35%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ชื่อ-สกุล</div>
				<div style="width:22%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;แพทย์</div>
			</div>
	
		
<? 


if(!empty($_POST['branchid'])){
	$branchid = $_POST['branchid'];
} else {
	$branchid = '';
}
$where_branch_id = "";
if($branchid != "") {
	if($branchid != "00"){ 
		$where_branch_id = " and (b.branchid ='".$branchid."' or b.branchid is null ) ";
	} 
}else if($_SESSION['branch_id'] != "" && $_SESSION['branch_id'] != "07") {	
	$where_branch_id = " and (b.branchid ='".$_SESSION['branch_id']."'  or b.branchid is null ) ";
}


$cl = $color1;
$sql = "select distinct(b.hn) hn, b.cradno,b.pname,b.fname,b.lname,c.vdate,c.empname  ";
$sql .="from tb_patient  b,tb_vst c where b.hn=c.hn and  (c.vdate between '$sdate%' and '$edate%') and c.status not IN ('CANCEL') $where_branch_id ";
// echo $sql;
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$Num_Rows = mysql_num_rows($result);  

$total = $Num_Rows;

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
$sql .=" order by c.vdate,c.vn asc LIMIT $Page_Start , $Per_Page";
// echo $sql;
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
	<div style="width:20%; height:20px; text-align:left; line-height:20px;  float:left; "><?=$rs['vdate']?></div>
	<div style="width:10%; height:20px; text-align:left; line-height:20px;  float:left;">&nbsp;<?=$rs['cradno']?></div>
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
	<a href="javascript: ajaxLoad('post','Monthly_report/repatient_list.php','Page=<?=$Prev_Page?>&sdate=<?=$sdate?>&edate=<?=$_POST['edate']?>','pa_list')">	
	<img src='images/icon/back.png'  border='0' align="absmiddle"/>
	</a>

	
	
	<?
	}
	
	echo " <b>$Page </b>";
	
	if($Page!=$Num_Pages)
	{
	?>

	<a href="javascript: ajaxLoad('post','Monthly_report/repatient_list.php','Page=<?=$Next_Page?>&sdate=<?=$sdate?>&edate=<?=$_POST['edate']?>','pa_list')">	
	<img src='images/icon/next.png'  border='0' align="absmiddle" />
	</a>	
    <?		
	}
	


?>
</div>

<? } ?>
</div>



<!--รวม-->

<div id="d_list2" style=" width: 99%; margin-top:10px;   text-align:center; height:30px; background-color:#FFCC99;  ">
	
<?
$sql = "select distinct(b.hn) hn, b.cradno,b.pname,b.fname,b.lname,c.vdate,c.empname  ";
$sql .="from tb_patient  b,tb_vst c where b.hn=c.hn and  (c.vdate between '$sdate%' and '$edate%') and c.empid in ('00','-')  and c.status not IN ('CANCEL') ";


//$sql = "select c.hn from tb_patient  b,tb_vst c where b.hn=c.hn and  (substr(c.vdate,1,10)  between  '$sdate' and '$edate') and c.empid in ('00','-')";
$s_result = mysql_query($sql) or die ("Error Query [".$sql."]");  
//$row=mysql_fetch_array($s_result);

$sale = mysql_num_rows($s_result);


$sql = "select distinct(b.hn) hn, b.cradno,b.pname,b.fname,b.lname,c.vdate,c.empname  ";
$sql .="from tb_patient  b,tb_vst c where b.hn=c.hn and  (c.vdate between '$sdate%' and '$edate%') and c.empid not in ('00','-')  and c.status not IN ('CANCEL') ";

//$sql = "select c.hn from tb_patient  b,tb_vst c where b.hn=c.hn and  (substr(c.vdate,1,10)  between  '$sdate' and '$edate') and c.empid not in ('00','-')";
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


<? 	mysql_close($dblink); ?>






