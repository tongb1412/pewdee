<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?

  session_start();
	$body_height = "300";
    if ($_SESSION['company_data'] == "1") {
        $body_height = "325";
	}
?>
<div style=" width: 98%; margin-top:5px;  overflow:auto;  text-align:center; height:<?=$body_height?>px; ">

<?
include('../class/config.php');
include('../class/permission_user.php');
$cl = '';
/*$sdate = $_POST['sdate'];
$edate = $_POST['edate'];*/
if(empty($_POST['sdate'])){
$sdate ='0000-00-00';
$edate ='0000-00-00';
} else {


$t0 = strtotime($_POST['sdate']);
$t1 = strtotime($_POST['edate']) + (1*24*3600); 

$sdate = date("Y-m-d", $t0); 
$edate = date("Y-m-d", $t1); 
}





?>
    <div style="width:2000px; height:20px; padding-top:5px; color:#000000; margin:auto;  font-weight:bold; font-size:12px; background:<?=$tabcolor?>;">
    <div style="width:3%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ลำดับ</div>
    <div style="width:5%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;วันที่</div>
    <div style="width:7%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;เงินสด</div>
    <div style="width:7%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ธนาคารกรุงศรีฯ </div>
    <div style="width:7%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ธนาคารกสิกร </div>
    <div style="width:7%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ธนาคารไทยพาณิชย์ </div>
	  <div style="width:7%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ธนาคาร Amax</div>
	  <div style="width:7%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ธนาคาร OUB</div>
    <div style="width:7%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ธนาคารกรุงไทย</div>
    <div style="width:7%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ธนาคารธนชาต</div>
	  <div style="width:7%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;คงเหลือ</div>
	  <div style="width:7%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ผู้บันทึก</div>
	  <div style="width:7%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;แคชเขียร์ประจำวัน </div>
	  <div style="width:7%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;พนักงานตรวจ</div>
    <div style="width:7%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;เวลาบันทึก</div>
    </div>
	
		
<? 




if(!empty($_REQUEST['branchid'])){
	$branchid = $_REQUEST['branchid'];
} else {
	$branchid = '';
}
$as = "b";
$data = set_where_user_data($as ,$branchid, $_SESSION['company_code'], $_SESSION['company_data']);
$where_branch_id = "";
$where_branch_id .= $data['where_branch_id'];
$where_branch_id .= $data['where_company_code'];



$cl = $color1;
$sql = "select a.*,b.fname efname,b.lname elname ,c.fname cfname,c.lname clname,d.fname ckfname ,d.lname cklname from tb_totalprice a,tb_staff b,tb_staff c,tb_staff d where a.empname = b.staffid and a.cashier = c.staffid and a.cashier_check = d.staffid and (a.date between '$sdate%' and '$edate%') $where_branch_id";
// echo $sql;
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$Num_Rows = mysql_num_rows($result); 



// $Per_Page = 14;   // Per Page

if($_SESSION['company_data'] == "1"){
	$Per_Page = 16;   // Per Page
} else {
	$Per_Page = 14;   // Per Page
}

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
$sql .=" order by a.date asc LIMIT $Page_Start , $Per_Page";
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
		
<div class="list_out" onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')" style="width:2000px; background:<?=$cl?>; ">
	<div style="width:3%; float:left;"><?=$n?></div>
	<div style="width:5%; float:left;">&nbsp;<?=$rs['date']?></div>
  <div style="width:7%; float:left;"><?=number_format($rs['cash'],'0','.',',')?></div>
  <div style="width:7%; float:left;"><?=number_format($rs['k_krungsri'],'0','.',',')?></div>
  <div style="width:7%; float:left;"><?=number_format($rs['k_kasikorn'],'0','.',',')?></div>
  <div style="width:7%; float:left;"><?=number_format($rs['k_thai'],'0','.',',')?></div>
  <div style="width:7%; float:left;"><?=number_format($rs['k_amax'],'0','.',',')?></div>
	<div style="width:7%; float:left;"><?=number_format($rs['k_uob'],'0','.',',')?></div>
  <div style="width:7%; float:left;"><?=number_format($rs['k_ktc'],'0','.',',')?></div>
	<div style="width:7%; float:left;"><?=number_format($rs['k_tana'],'0','.',',')?></div>
	<div style="width:7%; float:left;"><?=number_format($rs['total'],'0','.',',')?></div>
	<div style="width:7%; float:left;"><?=$rs['efname'].'    '.$rs['elname']  ?></div>
  <div style="width:7%; float:left;"><?=$rs['cfname'].'    '.$rs['clname']  ?></div>
  <div style="width:7%; float:left;"><?=$rs['ckfname'].'    '.$rs['cklname']  ?></div>
  <div style="width:7%; float:left;">&nbsp;<?=$rs['datenow']?></div>
	
								
	
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
	<a href="javascript: ajaxLoad('post','Monthly_report/retypepay_list.php','Page=<?=$Prev_Page?>&sdate=<?=$sdate?>&edate=<?=$_POST['edate']?>','d_list')">	
	<img src='images/icon/back.png'  border='0' align="absmiddle"/>
	</a>
	<?
	}
	
	echo " <b>$Page </b>";
	
	if($Page!=$Num_Pages)
	{
	?>

	<a href="javascript: ajaxLoad('post','Monthly_report/retypepay_list.php','Page=<?=$Next_Page?>&sdate=<?=$sdate?>&edate=<?=$_POST['edate']?>','d_list')">	
	<img src='images/icon/next.png'  border='0' align="absmiddle" />
	</a>	
    <?		
	}
	
	mysql_close($dblink);

?>
</div>

<? } ?>

</div>



<!--รวม-->

<div id="d_list2" style=" width: 99%; margin-top:5px; margin-top:5px; overflow:auto; text-align:center; height:80px; background-color:#FFCC99;  ">
	
<?

include('../class/config.php');
$cl = '';
/*$sdate = $_POST['sdate'];
$edate = $_POST['edate'];*/
if(empty($_POST['sdate'])){
$sdate ='0000-00-00';
$edate ='0000-00-00';
} else {


$t0 = strtotime($_POST['sdate']);
$t1 = strtotime($_POST['edate']) + (1*24*3600); 

$sdate = date("Y-m-d", $t0); 
$edate = date("Y-m-d", $t1); 
}


$sql = "select sum(cash) s_cash,sum(k_krungsri) s_krungsri,sum(k_kasikorn) s_kasikorn,sum(k_thai) s_thai,sum(k_amax) s_amax,sum(k_uob) s_uob  from tb_totalprice  where date between  '$sdate%' and '$edate%'  "; 

$s_result = mysql_query($sql) or die ("Error Query [".$sql."]");  
$row=mysql_fetch_array($s_result);

?>	

	<div class="line" style="margin-top: 2px;">
      <div style="width:15%; float:left; text-align:right;">รวมเงินสด :&nbsp;</div>
      <div style="width:10%; float:left;">
        <input style="font-weight:bold; text-align:right;" name="text2" type="text" id="" size="12"; value="<?=number_format($row['s_cash'],'0','.',',')?>"/>   
      </div>
      <div style="width:20%; float:left; text-align:right;"> ธนาคารกรุงศรีฯ  :&nbsp;</div>
      <div style="width:10%; float:left;">
        <input style="font-weight:bold; text-align:right;" name="text2" type="text" id="" size="12"; value="<?=number_format($row['s_krungsri'],'0','.',',')?>"/>
      </div>
	  <div style="width:25%; float:left; text-align:right;">ธนาคารกสิกร :&nbsp;</div>
      <div style="width:10%; float:left;">
        <input  style="font-weight:bold; text-align:right;" name="text2" type="text" id="" size="12"; value="<?=number_format($row['s_kasikorn'],'0','.',',')?>" />
      </div>
    </div>	
	
	<div class="line">
      <div style="width:15%; float:left; text-align:right;">ธนาคารไทยพาณิชย์  :&nbsp;</div>
      <div style="width:10%; float:left;">
        <input  style="font-weight:bold; text-align:right;" name="text2" type="text" id="" size="12"; value="<?=number_format($row['s_thai'],'0','.',',')?>" />
      </div>
      <div style="width:20%; float:left; text-align:right;">ธนาคาร Amax :&nbsp;</div>
      <div style="width:10%; float:left;">
        <input style="font-weight:bold; text-align:right;" name="text2" type="text" id="" size="12"; value="<?=number_format($row['s_amax'],'0','.',',')?>" />
      </div>
	  <div style="width:25%; float:left; text-align:right;"> ธนาคาร OUB :&nbsp;</div>
      <div style="width:10%; float:left;">
        <input style="font-weight:bold; text-align:right;" name="text2" type="text" id="" size="12"; value="<?=number_format($row['s_uob'],'0','.',',')?>"/>
      </div>
    </div>	

    <div class="line">
      <div style="width:15%; float:left; text-align:right;">ธนาคารกรุงไทย  :&nbsp;</div>
      <div style="width:10%; float:left;">
        <input  style="font-weight:bold; text-align:right;" name="text2" type="text" id="" size="12"; value="<?=number_format($row['s_thai'],'0','.',',')?>" />
      </div>
      <div style="width:20%; float:left; text-align:right;">ธนาคารธนชาติ :&nbsp;</div>
      <div style="width:10%; float:left;">
        <input style="font-weight:bold; text-align:right;" name="text2" type="text" id="" size="12"; value="<?=number_format($row['s_amax'],'0','.',',')?>" />
      </div>
	  <div style="width:25%; float:left; text-align:right;"> ธนาคารกรุงเทพ:&nbsp;</div>
      <div style="width:10%; float:left;">
        <input style="font-weight:bold; text-align:right;" name="text2" type="text" id="" size="12"; value="<?=number_format($row['s_uob'],'0','.',',')?>"/>
      </div>
    </div>	
	
	
	
	
	
	
	
	
	</div>









