<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div style=" width: 98%; margin-top:5px;  text-align:center; height:345px; ">
<?
include('../class/config.php');
$cl = '';
$did = $_POST['did'];


?>
    <div style="width:98%; height:20px; padding-top:5px; color:#000000; margin:auto;  font-weight:bold; font-size:12px; background:<?=$tabcolor?>;">
      <div style="width:8%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ลำดับ</div>
      <div style="width:15%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;Lot</div>
      <!-- <div style="width:15%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รหัสยา</div> -->
      <div style="width:25%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ชื่อยา</div>
      <div style="width:13%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;คงเหลือ</div>
      <div style="width:13%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;วันหมดอายุ</div>
      <div style="width:23%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;จำนวนวันก่อนหมดอายุ</div>
    </div>
		
<? 
$cl = $color1;
$datenow=date("Y-m-d");
if(empty($did)){
$sql  = "select * from tb_temp_drugeinstock where bdate !='' and edate !='' and edate >= '$datenow' " ;
}else {
$sql  = "select * from tb_temp_drugeinstock where bdate !='' and edate !='' and edate >= '$datenow' ";
}
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$Num_Rows = mysql_num_rows($result); 


$Per_Page =10;   // Per Page

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
$sql .=" order by edate asc LIMIT $Page_Start , $Per_Page";
$result  = mysql_query($sql);
if($result){
$n=1;
while($rs=mysql_fetch_array($result)){  
if($cl != $color1){
	$cl = $color1;
} else {
	$cl = $color2;
}
	$str_date = $rs['edate'];
    $str_datesh = date("d/m/Y",strtotime(str_replace('-','/',$str_date)));
	$expire_date = $str_date;
	$today_date = date("Y-m-d");
	if($today_date<=$expire_date){

		list($expire_year,$expire_month,$expire_day) = explode("-", $expire_date);
		list($today_year,$today_month,$today_day) = explode("-", $today_date);
		$expire = gregoriantojd($expire_month,$expire_day,$expire_year);
		$today = gregoriantojd($today_month,$today_day,$today_year);
		$date_current = $expire-$today; //หาวันที่ยังเหลืออยู่
	if($date_current<=150){
		
		if($date_current=='0'){
			$date_current="<font color='red'>หมดอายุวันนี้</font>";
		}

?>	
		
<div class="list_out" onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')" style="width:98%;background:<?=$cl?>; ">
	<div style="width:8%; float:left;"><?=$n?></div>
	<div style="width:15%; float:left;"><?=$rs['lno']?></div>
	<!-- <div style="width:12%; float:left;"><?=$rs['did']?></div> -->
	<div style="width:25%; float:left;overflow:hidden;border:0px solid;height:13px;"><?=$rs['dname']?></div>
	<div style="width:12%; float:left;"><?=$rs['qty']?></div>
	<div style="width:16%; float:left;padding-left:10px;"><?=$str_datesh;?></div>
	<div style="width:12%; float:left;text-align:center;"><?=$date_current; ?></div>
	<div style="width:4%; float:left;">วัน</div>
</div>
	<? $n++;
		} //end if date_current
	} //end if str_date<=today_date
	?>





<?  } ?>
<div style="width:83%; margin:auto; margin-top:10px; text-align:right; line-height:20px;">
  <!--<?=$Num_Rows;?>  
  รายการ :-->
  <?=$Num_Pages;?> 
  หน้า :
  <?
	if($Prev_Page)
	{
	?>
	<a href="javascript: ajaxLoad('post','Monthly_report/reexpiredruge_list.php','Page=<?=$Prev_Page?>','d_list')">	
	<img src='images/icon/back.png'  border='0' align="absmiddle"/>
	</a>
	<?
	}
	
	echo " <b>$Page </b>";
	
	if($Page!=$Num_Pages)
	{
	?>

	<a href="javascript: ajaxLoad('post','Monthly_report/reexpiredruge_list.php','Page=<?=$Next_Page?>','d_list')">	
	<img src='images/icon/next.png'  border='0' align="absmiddle" />
	</a>	
    <?		
	}
	
	mysql_close($dblink);

?>
</div>

<? } ?>
</div>



