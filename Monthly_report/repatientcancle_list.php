	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<?php	
	session_start();
	$body_height = "345";
    if ($_SESSION['company_data'] == "1") {
        $body_height = "370";
    }
	?>
<div style=" width: 98%; margin-top:5px;   text-align:center; height:<?=$body_height?>px; ">

<?
include('../class/config.php');
include('../class/permission_user.php');
$cl = '';
//$sdate = $_POST['sdate'];
//$edate = $_POST['edate'];
/*$t0 = strtotime($_GET['sdate']);
$t1 = strtotime($_GET['edate']) + (1*24*3600); 
$sdate = date("Y-m-d", $t0); 
$edate = date("Y-m-d", $t1);*/ 
//$nd = substr($_POST['edate'],0,2) + 1;

//$sdate = substr($_POST['sdate'],6,4).'-'.substr($_POST['sdate'],3,2).'-'.substr($_POST['sdate'],0,2)  ;
//$edate = substr($_POST['edate'],6,4).'-'.substr($_POST['edate'],3,2).'-'.$nd ;
$t0 = strtotime($_POST['sdate']);
$t1 = strtotime($_POST['edate']) + (1*24*3600); 
$sdate = date("Y-m-d", $t0); 
$edate = date("Y-m-d", $t1); 

//echo $edate;

?>
			<div style="width:98%; height:20px; padding-top:5px; color:#000000; margin:auto; font-weight:bold; font-size:12px; background:<?=$tabcolor?>;">
				<div style="width:8%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ลำดับ</div>
				<div style="width:20%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;วันที่เวลาเข้า</div>
				<div style="width:20%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;วันที่เวลาออก</div>
				<div style="width:10%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;Crad No.</div>
				<div style="width:20%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ชื่อ-สกุล</div>
				<div style="width:22%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;หมายเหตุ</div>

			</div>
	
		
<? 

if(!empty($_REQUEST['branchid'])){
	$branchid = $_REQUEST['branchid'];
} else {
	$branchid = '';
}
$as = "a";
$data = set_where_user_data($as ,$branchid, $_SESSION['company_code'], $_SESSION['company_data']);
$where_branch_id = "";
$where_branch_id .= $data['where_branch_id'];
$where_branch_id .= $data['where_company_code'];

$cl = $color1;
$sql = "select a.*,b.fname,b.lname,b.cradno ";
$sql .="from tb_vst a,tb_patient b where a.hn = b.hn and (a.vdate between '$sdate%' and '$edate%') and a.status = 'CANCEL' $where_branch_id";
// echo $sql;
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$Num_Rows = mysql_num_rows($result);  

$total = $Num_Rows;

if($_SESSION['company_data'] == "1"){
	$Per_Page = 15;   // Per Page
} else {
	$Per_Page = 14;   // Per Page
} // Per Page

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
$sql .=" order by a.hn asc LIMIT $Page_Start , $Per_Page";
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
	<div style="width:20%; height:20px; text-align:left; line-height:20px;  float:left; "><?=$rs['ctime']?></div>
	<div style="width:10%; height:20px; text-align:left; line-height:20px;  float:left;">&nbsp;<?=$rs['cradno']?></div>
	<div style="width:20%; height:20px; text-align:left; line-height:20px;  float:left;">&nbsp;<?=$rs['pname'].$rs['fname'].'    '.$rs['lname']  ?></div>
	<div style="width:22%; height:20px; text-align:left; line-height:20px;  float:left;">&nbsp;<?=$rs['mem']?></div>

	
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
	<a href="javascript: ajaxLoad('post','Monthly_report/repatientcancle_list.php','Page=<?=$Prev_Page?>&sdate=<?=$sdate?>&edate=<?=$_POST['edate']?>','pa_list')">	
	<img src='images/icon/back.png'  border='0' align="absmiddle"/>
	</a>
	<?
	}
	
	echo " <b>$Page </b>";
	
	if($Page!=$Num_Pages)
	{
	?>

	<a href="javascript: ajaxLoad('post','Monthly_report/repatientcancle_list.php','Page=<?=$Next_Page?>&sdate=<?=$sdate?>&edate=<?=$_POST['edate']?>','pa_list')">	
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
$sql .="from tb_patient  b,tb_vst c where b.hn=c.hn and  (c.vdate between '$sdate%' and '$edate%') and c.empid in ('00','-') ";


//$sql = "select c.hn from tb_patient  b,tb_vst c where b.hn=c.hn and  (substr(c.vdate,1,10)  between  '$sdate' and '$edate') and c.empid in ('00','-')";
$s_result = mysql_query($sql) or die ("Error Query [".$sql."]");  
//$row=mysql_fetch_array($s_result);

$sale = mysql_num_rows($s_result);


$sql = "select distinct(b.hn) hn, b.cradno,b.pname,b.fname,b.lname,c.vdate,c.empname  ";
$sql .="from tb_patient  b,tb_vst c where b.hn=c.hn and  (c.vdate between '$sdate%' and '$edate%') and c.empid not in ('00','-') ";

//$sql = "select c.hn from tb_patient  b,tb_vst c where b.hn=c.hn and  (substr(c.vdate,1,10)  between  '$sdate' and '$edate') and c.empid not in ('00','-')";
$s_result = mysql_query($sql) or die ("Error Query [".$sql."]");  
//$row=mysql_fetch_array($s_result);
$doc = mysql_num_rows($s_result);

?>	

	<div class="line" style="margin-top: 4px;">

      <div style="width:15%; float:left; text-align:right;">จำนวนคนไข้ยกเลิก :&nbsp;</div>
      <div style="width:10%; float:left;">
        <input style="font-weight:bold; text-align:right;" name="text2" type="text" id="" size="12"; value="<?=number_format($total,'0','.',',')?> &nbsp;"/>
      </div>
<!--	  <div style="width:20%; float:left; text-align:right;">พบแพทย์ :&nbsp;</div>
      <div style="width:10%; float:left;">
        <input  style="font-weight:bold; text-align:right;" name="text2" type="text" id="" size="12"; value="<?=number_format($doc,'0','.',',')?>&nbsp;" />
      </div>
	  <div style="width:25%; float:left; text-align:right;">ซื้อยา/ทำหน้า(ไม่ระบุแพทย์):&nbsp;</div>  
      <div style="width:10%; float:left;">
        <input  style="font-weight:bold; text-align:right;" name="text2" type="text" id="" size="12"; value="<?=number_format($sale,'0','.',',')?>&nbsp;" />
      </div>-->
    </div>	
	
	
	
	
	</div>


<? 	mysql_close($dblink); ?>






