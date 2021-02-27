<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div style=" width: 98%; margin-top:5px;  overflow:auto;  text-align:center; height:400px; ">

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





?>
    <div style="width:2000px; height:20px; padding-top:5px; color:#000000; margin:auto;  font-weight:bold; font-size:12px; background:<?=$tabcolor?>;">
      <div style="width:3%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ลำดับ</div>
      <div style="width:5%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;วันที่</div>
      <div style="width:7%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ยอดยกมา</div>
      <div style="width:7%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ยอดขาย </div>
      <div style="width:7%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ค่าใช้จ่าย </div>
      <div style="width:7%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;แพทย์เบิก </div>
      <div style="width:7%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ฝากธนาคาร </div>
	  <div style="width:21%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;หมายเหตุ</div>
	  <div style="width:7%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;คงเหลือ</div>

	  <div style="width:7%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ผู้บันทึก</div>
	  <div style="width:7%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;แคชเขียร์ประจำวัน </div>
	  <div style="width:7%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;พนักงานตรวจ</div>
      <div style="width:7%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;เวลาบันทึก</div>
    </div>


<?




$cl = $color1;
$sql = "select a.*,b.fname efname,b.lname elname ,c.fname cfname,c.lname clname,d.fname ckfname ,d.lname cklname from tb_totalcash a,tb_staff b,tb_staff c,tb_staff d where a.empname = b.staffid and a.cashier = c.staffid and a.cashier_check = d.staffid and (a.date between '$sdate%' and '$edate%') ";

$result = mysql_query($sql) or die ("Error Query [".$sql."]");
$Num_Rows = mysql_num_rows($result);



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
    <div style="width:7%; float:left;"><?=number_format($rs['cash_yes'],'0','.',',')?></div>
    <div style="width:7%; float:left;"><?=number_format($rs['today_total'],'0','.',',')?></div>
    <div style="width:7%; float:left;"><?=number_format($rs['coste'],'0','.',',')?></div>
    <div style="width:7%; float:left;"><?=number_format($rs['doctor_cos'],'0','.',',')?></div>
    <div style="width:7%; float:left;"><?=number_format($rs['bank'],'0','.',',')?></div>
	<div style="width:21%; float:left;">&nbsp;<?=$rs['mem']?></div>
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
