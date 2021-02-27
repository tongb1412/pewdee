<?
include('../class/config.php');
$mode = $_POST['mode'];
switch($mode){
case 'PN' : $head = 'คำนำหน้าชื่อ'; break;
case 'PT' : $head = 'ระดับคนไข้'; break;
case 'BL' : $head = 'อาการเริ่มต้น'; break;
case 'ST' : $head = 'สถานภาพ'; break;
case 'OC' : $head = 'อาชีพ'; break;
case 'TM' : $head = 'ตำบล'; break;
case 'AM' : $head = 'อำเภอ'; break;
case 'PV' : $head = 'จังหวัด'; break;
case 'CT' : $head = 'ประเภทบัตรเครดิต'; break;
case 'BK' : $head = 'ธนาคาร'; break;
case 'AP' : $head = 'รายการนัด'; break;
case 'DG' : $head = 'กลุ่มยา'; break;
case 'DN' : $head = 'หน่วยยา'; break;
case 'DS' : $head = 'ขนาดยา'; break;
case 'RM' : $head = 'ห้องตรวจ'; break;
case 'CN' : $head = 'ข้อมูลสาขา'; break;
case 'PS' : $head = 'ตำแหน่ง'; break;
case 'DE' : $head = 'วุฒิการศึกษา'; break;
case 'SS' : $head = 'สถานะการทำงาน'; break;
case 'TW' : $head = 'ประเภทการทำงาน'; break;
case 'GTR' : $head = 'กลุ่มทรีทเมนท์'; break;   
case 'GTC' : $head = 'กลุ่มคอร์ส'; break;                         
case 'DT' : $head = 'ประเภทยา'; break;
case 'DU' : $head = 'วิธีใช้ยา'; break;
case 'DW' : $head = 'ข้อควรระวัง'; break;
case 'DH' : $head = 'วิธีเก็บยา'; break;
case 'LB' : $head = 'หัตถการ / แล็บ'; break;
}

$page = 'gernaral.php?mode='.$mode;
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<input type="hidden" id="typ"  value="">
<input type="hidden" id="gid"  value="">
<input type="hidden" id="mode"  value="<?=$mode?>">
<div id="t_main" class="tmain" style="width:100%; height:495px; overflow:hidden; ">
		<div class="littleDD" style="font-size:14px; font-weight:bold;" ><?=$head?></div>	
		<? if($mode!='PT' && $mode!='LB' && $mode!='GTR' && $mode!='GTC'){ ?>
		<div style="width:95%; margin-top:10px; margin-left:20px; text-align:left; height:30px;">
			<div style="width:20%; float:left; text-align:right; line-height:20px;"><?=$head?> : </div>
			<div style="width:75%; float:left;"><input type="hidden" id="dis" value="0" />
			&nbsp;&nbsp;<input type="text" id="gname" size="50">&nbsp;<input type="button" value=" บันทึกข้อมูล " onClick="addgernaral('setting/gernaral_add.php','d_list')">&nbsp;<input type="button" value=" รายการใหม่ " onclick="cleargenaral()" />
		    </div>
		</div>
		<? } 
		if($mode=='PT'){
		?>
		<div style="width:95%; margin-top:10px; margin-left:20px; text-align:left; height:30px;">
			<div style="width:20%; float:left; text-align:right; line-height:20px;"><?=$head?> : </div>
			<div style="width:75%; float:left;">
			&nbsp;&nbsp;<input type="text" id="gname" size="50">
		    </div>
		</div>		
		<div style="width:95%; margin-top:10px; margin-left:20px; text-align:left; height:30px;">
			<div style="width:20%; float:left; text-align:right; line-height:20px;">ส่วนลด : </div>
			<div style="width:50%; float:left;">
			&nbsp;&nbsp;<input type="text" id="dis" size="10" value="0">&nbsp;%
		    </div>
			<div style="width:30%; float:left;">
			<input type="button" value=" บันทึกข้อมูล " onClick="addgernaral('setting/gernaral_add.php','d_list')">&nbsp;<input type="button" value=" รายการใหม่ " onclick="cleargenaral()" />
			</div>
		</div>		
		<? } 
		if($mode=='LB'){
		?>
		<div style="width:95%; margin-top:10px; margin-left:20px; text-align:left; height:30px;">
			<div style="width:20%; float:left; text-align:right; line-height:20px;"><?=$head?> : </div>
			<div style="width:75%; float:left;">
			&nbsp;&nbsp;<input type="text" id="gname" size="50">
		    </div>
		</div>		
		<div style="width:95%; margin-top:10px; margin-left:20px; text-align:left; height:30px;">
			<div style="width:20%; float:left; text-align:right; line-height:20px;">ราคา : </div>
			<div style="width:50%; float:left;">
			&nbsp;&nbsp;<input type="text" id="dis" size="10" value="0">
		    </div>
			<div style="width:30%; float:left;">
			<input type="button" value=" บันทึกข้อมูล " onClick="addgernaral('setting/gernaral_add.php','d_list')">&nbsp;<input type="button" value=" รายการใหม่ " onclick="cleargenaral()" />
			</div>
		</div>		
		<? } 		
		if($mode=='GTR' || $mode=='GTC'){
		?>
		<div style="width:95%; margin-top:10px; margin-left:20px; text-align:left; height:30px;">
			<div style="width:20%; float:left; text-align:right; line-height:20px;"><?=$head?> : </div>
			<div style="width:75%; float:left;">
			&nbsp;&nbsp;<input type="text" id="gname" size="50">
		    </div>
		</div>		
		<div style="width:95%; margin-top:10px; margin-left:20px; text-align:left; height:30px;">
			<div style="width:20%; float:left; text-align:right; line-height:20px;">เปอเซนต์ : </div>
			<div style="width:50%; float:left;">
			&nbsp;&nbsp;<input type="text" id="dis" size="10" value="0">
		    </div>
			<div style="width:30%; float:left;">
			<input type="button" value=" บันทึกข้อมูล " onClick="addgernaral('setting/gernaral_add.php','d_list')">&nbsp;<input type="button" value=" รายการใหม่ " onclick="cleargenaral()" />
			</div>
		</div>		
		<? } ?>				
		
		
		
		<div id="d_list" style="width:100%; height:auto; ">


<!--แสดงรายการ-->

<div style="width:83%; height:20px; padding-top:5px; color:#000000; margin:auto; font-weight:bold; font-size:13px; background:<?=$tabcolor?>;">
			<div style="width:20%;text-align:left; float:left;">&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ลำดับ</div>
			<? if($mode!='PT' && $mode!='LB' && $mode!='GTR' && $mode!='GTC' ){ ?>
			<div style="width:80%;text-align:left; float:left;">&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รายการ</div>
			<? } else { 
			if($mode=='LB'){ $ss ='ราคา'; } else { $ss = 'ส่วนลด';  }
			if($mode=='GTR' || $mode=='GTC'){ $ss ='เปอเซนต์'; }
			?>
			<div style="width:50%;text-align:left; float:left;">&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รายการ</div>
			<div style="width:30%;text-align:left; float:left;">&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;<?=$ss?></div>
			<? } ?>
</div>
		
<? 
$cl = $color1;
$sql = "select * from tb_gernaral where typ='$mode'";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$Num_Rows = mysql_num_rows($result);

$Per_Page = 15;   // Per Page

$Page = $_GET["Page"];
if(!$_GET["Page"])	{	$Page=1;	}
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
$sql .=" order by name asc LIMIT $Page_Start , $Per_Page";
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
		
<div class="list_out" onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')" style="width:80%;background:<?=$cl?>; ">
	<div style="width:22%; float:left;"><?=$n?></div>
	<? if($mode!='PT' && $mode!='LB' && $mode!='GTR' && $mode!='GTC' ){ ?>	
	<div style="width:68%; float:left;"><?=$rs['name']?></div>
	<? } else { ?>
	<div style="width:53%; float:left;"><?=$rs['name']?></div>
	<div style="width:15%; float:left;"><?=$rs['discount']?></div>
	<? } ?>
	<div style="width:10%; float:left; text-align:right">
    <img src="images/icon/pedit.png" align="แก้ไขข้อมูล" title="แก้ไขข้อมูล" style="cursor:pointer;" onClick="editgernaral('<?=$rs['name']?>','<?=$rs['id']?>','<?=$rs['discount']?>');" />
	<img src="images/icon/pdelete.png" align="ลบข้อมูล" title="ลบข้อมูล" style="cursor:pointer;" onClick="ConfDelete('setting/gernaral_del.php','d_list','id=<?=$rs['id']?>&mode=<?=$mode?>')" />
	</div>
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
	<a href="javascript: ajaxLoad('get','setting/gernaral_list.php','mode=<?=$mode?>&Page=<?=$Prev_Page?>','d_list')">	
	<img src='images/icon/back.png'  border='0' align="absmiddle"/>
	</a>
	<?
	}
	
	echo " <b>$Page </b>";
	
	if($Page!=$Num_Pages)
	{
	?>

	<a href="javascript: ajaxLoad('get','setting/gernaral_list.php','mode=<?=$mode?>&Page=<?=$Next_Page?>','d_list')">	
	<img src='images/icon/next.png'  border='0' align="absmiddle" />
	</a>	
    <?		
	}
	
	mysql_close($dblink);

?>
</div>

<? } ?>
<!--จบการแสดงรายการ-->



		</div>		
		
</div>