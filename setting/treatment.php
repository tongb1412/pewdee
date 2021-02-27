<?
include('../class/config.php');

$sql = "select * from tb_autonumber where typ='TM'";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$rs=mysql_fetch_array($result);
$x = substr($rs['number'],0,2);

$tid = $x ; 
$txt = substr($rs['last'],2,3);
$n = strlen($txt);
$num = intval($txt) + 1;
$m = strlen($num);

$i = 0; $t = ''; 
while($i < $n - $m){
	$t .= '0';
    $i++;
}
$t .= $num;
$tid .= $t; 


$sqlG = "select * from tb_gernaral where typ= 'GTR' ";
$strG = mysql_query($sqlG) or die ("Error Query [".$sql."]"); 


?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<div id="t_main" class="tmain" style="width:100%; margin:auto; height:495px; overflow:hidden; ">
  <div class="littleDD" style="font-size:14px; font-weight:bold;" >สร้างรายการเลเซอร์ / ทรีทเม้นท์</div>
	<div style="width:95%; margin-top:10px; margin-left:20px; text-align:left; height:30px;">
	
	
        
        <input type="hidden" id="typ" value="new" />  
		
		<div class="line">
    	<div style="width:20%; float:left; text-align:right;">ประเภท :&nbsp;</div>
		<div style="width:5%; float:left;">
		<select id="mode" onchange="swbmode(this)">
		<option value="T">ทรีทเม้นท์</option>
		<option value="L">เลเซอร์</option>
		</select>
		</div> 
		<div style="width:20%; float:left; text-align:right;">กลุ่ม :&nbsp;</div>
		<div style="width:55%; float:left; ">
		<select id="tgroup" >
        <? while($rsG = mysql_fetch_array($strG)){ ?>
		<option value="<?=$rsG['id']?>"><?=$rsG['name']?></option>
        <? }?>
	
		</select>        
        
        </div>   
		</div>
					
		<div class="line">
    	<div style="width:20%; float:left; text-align:right;">รหัสเลเซอร์/ทรีทเม้นท์ :&nbsp;</div>
		<div style="width:5%; float:left;"><input type="text" id="tid" size="10"  value="<?=$tid?>" /></div> 
		<div style="width:20%; float:left; text-align:right;">ชื่อ :&nbsp;</div>
		<div style="width:55%; float:left; "><input type="text" id="tname" size="50"  /></div>   
		</div>	
	
	
		<div class="line">
		<div style="width:20%; float:left; text-align:right;">ราคา :&nbsp;</div>
		<div style="width:5%; float:left;"><input type="text" id="price" size="10" /></div>	
		<div style="width:20%; float:left; text-align:right;">
		<span id="tn1"  style="display:none;">หน่วย :</span>&nbsp;</div>
		<div style="width:22%; float:left; ">
		<input type="text" id="unit" size="10" style="display:none;" />&nbsp;
		</div>
		<div style="width:30%; float:left;"> 
		<input type="button" value=" บันทึกข้อมูล " onClick="addtreatment('setting/treatment_add.php','settingpage')">&nbsp;<input type="button" value=" รายการใหม่ " onclick="ajaxLoad('post','setting/treatment.php','mode=TR','settingpage')" /></div>	
		</div>	



		<div style="width:100%; height:auto; margin-top:10px; float:left;">
 
        <div style="width:83%; height:20px; margin-left:50px; float:left; color:#000000; font-weight:bold; font-size:13px; background:<?=$tabcolor?>; "> 
	
		<div style="width:15%;text-align:left; float:left;">&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รหัส</div>
		<div style="width:45%;text-align:left; float:left;">&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ชื่อรายการ</div>
		
		<div style="width:15%;text-align:left; float:left;">&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ราคาต่อหน่วย</div>
		<div style="width:15%;text-align:left; float:left;">&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ประเภท</div>
		</div>	
		
		
		<div style="width:83%; height:auto; float:left; margin-left:50px;">
		
		
<? 
$cl = $color1;
$sql = "select * from tb_treatment ";
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
$sql .=" order by tid asc LIMIT $Page_Start , $Per_Page";
$result  = mysql_query($sql);
$Num = mysql_num_rows($result);

if($result){


while($rs=mysql_fetch_array($result)){  
if($cl != $color1){
	$cl = $color1;
} else {
	$cl = $color2;
}

?>	


		
<div class="list_out" onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')" style="width:96%; margin:auto; background:<?=$cl?>">
	<div style="width:15%; float:left;"><?=$rs['tid']?></div>
	<div style="width:45%; float:left;"><?=$rs['tname']?></div>

	<div style="width:20%; float:left; text-align:right">
	<? echo number_format($rs['price'],'0','.',',') ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</div>
	<div style="width:10%; float:left;">
	<? if($rs['typ']=='T'){ echo 'ทรีทเม้นท์'; } else { echo 'เลเซอร์'; } ?>
	</div>
	<div style="width:10%; float:left; text-align:right;">

	<img src="images/icon/pedit.png" align="แก้ไขข้อมูล" title="แก้ไขข้อมูล" style="cursor:pointer;" onClick="edittreatment('<?=$rs['tid']?>','<?=$rs['tname']?>','<?=$rs['qty']?>','<?=$rs['price']?>','<?=$rs['typ']?>','<?=$rs['unit']?>','<?=$rs['tgroup']?>')" />
	<img src="images/icon/pdelete.png" align="ลบข้อมูล" title="ลบข้อมูล" style="cursor:pointer;" onClick="ConfDelete('setting/treatment_del.php','settingpage','id=<?=$rs['tid']?>')" />
	</div>
</div>
<? } ?>


<div style="width:100%; margin:auto; margin-top:10px; text-align:right; line-height:20px;">
 <?=$Num_Rows;?> 
  รายการ : 
  <?=$Num_Pages;?> 
  หน้า :
  <?
	if($Prev_Page)
	{
	?>
	<a href="javascript: ajaxLoad('get','setting/treatment.php','mode=<?=$mode?>&Page=<?=$Prev_Page?>','settingpage')">	
	<img src='images/icon/back.png'  border='0' align="absmiddle"/>
	</a>
	<?
	}
    echo " <b>$Page </b>";	
	if($Page!=$Num_Pages)
	{
	?>

	<a href="javascript: ajaxLoad('get','setting/treatment.php','mode=<?=$mode?>&Page=<?=$Next_Page?>','settingpage')">	
	<img src='images/icon/next.png'  border='0' align="absmiddle" />
	</a>	
    <?		
	}
	
	mysql_close($dblink);

?>
</div>


<? } ?>		
		
		
		
		
	    </div> 

		</div>



 </div>

</div>