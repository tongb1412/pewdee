<? include('../class/config.php'); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div id="t_main" class="tmain" style="width:100%; height:495px; overflow:hidden; ">
<div class="littleDD" style="font-size:14px; font-weight:bold;" >ข้อมูลพนักงาน-แพทย์</div> <br />

<div style="width:45%; height:470px; margin-left:5px; float:left;">
	<div class="line">
		<div style="width:20%; float:left; text-align:right;">รหัสพนักงาน :&nbsp;</div>
		<div style="width:30%; float:left;"><input type="text" id="staffid" size="15"  /></div>
		
<?
$sql = "select branchname from tb_branch ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
?>		
		<div style="width:20%; float:left; text-align:right;">สาขา :&nbsp;</div>
		<div style="width:30%; float:left;">
		<select id="branch" style="width:117px;">
		<? while($rs=mysql_fetch_array($result)){  ?>
		<option value="<?=$rs['branchname']?>"><?=$rs['branchname']?></option>
        <? } ?>
		</select>
		</div>	
		
	</div>
	

<?
$sql = "select * from tb_gernaral where typ='PN'";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
?>

	<div class="line">
		<div style="width:20%; float:left; text-align:right;">คำนำหน้าชื่อ :&nbsp;</div>
		<div style="width:30%; float:left;">
		<select id="pname" style="width:117px;">
		<? while($rs=mysql_fetch_array($result)){  ?>
		<option value="<?=$rs['name']?>"><?=$rs['name']?></option>
		<? } ?>
		</select>
		</div>
		<div style="width:20%; float:left; text-align:right;">เพศ :&nbsp;</div>
		<div style="width:30%; float:left;">
		<select id="sex" style="width:117px;">
		<option value="นาย">ชาย</option>
		<option value="นางสาว">หญิง</option>
		</select>
		</div>				
			
	</div>	
	<div class="line">
		<div style="width:20%; float:left; text-align:right;">ชื่อ :&nbsp;</div>
		<div style="width:30%; float:left;"><input type="text" id="fname" size="15" /></div>
		<div style="width:20%; float:left; text-align:right;">สกุล :&nbsp;</div>
		<div style="width:30%; float:left;"><input type="text" id="lname" size="15" /></div>		
	</div>


	<div class="line">
		<div style="width:20%; float:left; text-align:right;">ชื่อเล่น:&nbsp;</div>
		<div style="width:30%; float:left;"><input type="text" id="nname" size="15" /></div>	
		
<?
$sql = "select * from tb_gernaral where typ='ST'";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
?>			
		<div style="width:20%; float:left; text-align:right;">สถานะภาพ :&nbsp;</div>
		<div style="width:30%; float:left;">
		<select id="st" style="width:117px;">
		<option value="ไม่ระบุ">ไม่ระบุ</option>
		<? while($rs=mysql_fetch_array($result)){  ?>
		<option value="<?=$rs['name']?>"><?=$rs['name']?></option>
		<? } ?>
		</select>
		</div>	
	</div>

<?
$sql = "select * from tb_gernaral where typ='BL'";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
?>
	<div class="line">
		<div style="width:20%; float:left; text-align:right;">หมู่เลือด :&nbsp;</div>
		<div style="width:30%; float:left;">
		<select id="bl" style="width:117px;">
		<option value="ไม่ระบุ">ไม่ระบุ</option>
		<? while($rs=mysql_fetch_array($result)){  ?>
		<option value="<?=$rs['name']?>"><?=$rs['name']?></option>
		<? } ?>
		</select>
		</div>	
<?
$sql = "select * from tb_gernaral where typ='DE'";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
?>
		<div style="width:20%; float:left; text-align:right;">วุฒิการศึกษา :&nbsp;</div>
		<div style="width:30%; float:left;">
		<select id="degree" style="width:117px;">
		<? while($rs=mysql_fetch_array($result)){  ?>
		<option value="<?=$rs['name']?>"><?=$rs['name']?></option>
		<? } ?>
		</select>
		</div>	
		
	</div>

	
	<div class="line">
		<div style="width:20%; float:left; text-align:right;">วัน-เดือน-ปี เกิด :&nbsp;</div>
		<div style="width:30%; float:left;"><input type="text" id="dd" size="2" style="width:22px"  maxlength="2" />-<input type="text" id="dm" size="2" style="width:22px" maxlength="2"  />-<input type="text" id="dy" size="4" style="width:35px" maxlength="4"  /> </div>
	    <div style="width:20%; float:left; text-align:right;">บัตรประชาชน :&nbsp;</div>
		<div style="width:30%; float:left;"><input type="text" id="dob" size="15" value="000-0000-0000" /></div>
	</div>	
	<div class="line">
	
	    <div style="width:20%; float:left; text-align:right;">แสดง :&nbsp;</div>
		<div style="width:30%; float:left;">
        <select id="eshow">
        <option value="N">ไม่แสดง</option>
        <option value="Y">แสดง</option>
        </select>
        </div>			

		<div style="width:20%; float:left; text-align:right;">&nbsp;</div>
		<div style="width:30%; float:left; display:none;">
        <input type="text" id="age" size="5"  style="width:20px" readonly="TRUE" style="display:none;"  />
        </div>			
	</div>
	
	<div class="line">&nbsp;</div>
	
	<div class="line">
		<div style="width:20%; float:left; text-align:right;">ที่อยู่ :&nbsp;</div>
		<div style="width:80%; float:left;"><input type="text" id="address" size="45" /></div>		
	</div>	
		
	<div class="line">
		<div style="width:20%; float:left; text-align:right;">เบอร์มือถือ :&nbsp;</div>
		<div style="width:30%; float:left;"><input type="text" id="tel" size="15" /></div>	
		<div style="width:20%; float:left; text-align:right;">E-mail :&nbsp;</div>
		<div style="width:30%; float:left;"><input type="text" id="mail" size="15" /></div>	
	</div>	
	
	<div class="line">&nbsp;</div>

<?
$sql = "select * from tb_gernaral where typ='PS'";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
?>		
	<div class="line">
	  <div style="width:20%; float:left; text-align:right;">ตำแหน่ง :&nbsp;</div>
		<div style="width:30%; float:left;">
		<select id="pos" style="width:117px;">
		<? while($rs=mysql_fetch_array($result)){  ?>
		<option value="<?=$rs['name']?>"><?=$rs['name']?></option>
		<? } ?>
		</select>
		</div>	

	</div>
	
	<div class="line">
		<div style="width:20%; float:left; text-align:right;">สถานะ :&nbsp;</div>
		<div style="width:30%; float:left;">
		<select id="status" style="width:117px;">
		<option value="ทำงาน">ทำงาน</option>
		<option value="พักร้อน">พักร้อน</option>
		</select>
		</div>	
		
		<div style="width:20%; float:left; text-align:right;">ประเภท :&nbsp;</div>
		<div style="width:30%; float:left;">
		<select id="tpy" style="width:117px;">
		<option value="รายเดิอน">รายเดือน</option>
		<option value="รายวัน">รายวัน</option>
		</select>
		</div>	
		
	
</div>				

	



		
	<div class="line">
	  <div style="width:20%; float:left; text-align:right;">วันเริ่มทำงาน :&nbsp;</div>
	  <div style="width:30%; float:left;"><input type="text" id="sdate" size="15" /></div>	
	  	  <div style="width:20%; float:left; text-align:right;">อายุงาน :&nbsp;</div>
	  <div style="width:30%; float:left;"><input type="text" id="dday" size="15" /></div>
	  
	</div>
	
	<div class="line">
	  <div style="width:20%; float:left; text-align:right;">สิทธิวันลา :&nbsp;</div>
	  <div style="width:30%; float:left;"><input type="text" id="ll" size="15" /></div>
	  <div style="width:20%; float:left; text-align:right;">เลขที่บัญชี:&nbsp;</div>
	  <div style="width:30%; float:left;"><input type="text" id="acc" size="15"  /></div>
	  
	</div>
	  <div class="line">
	  	<div style="width:20%; float:left; text-align:right;">ประกันสังคม :&nbsp;</div>
		<div style="width:30%; float:left;">
		<select id="sso" style="width:117px;">
		<option value="มี">มี</option>
		<option value="ไม่มี">ไม่มี</option>
		</select>
		</div>	
	  <div style="width:22%; float:left; text-align:right;">เลขที่ประกันสังคม :&nbsp;</div>
	  <div style="width:28%; float:left;"><input type="text" id="ssonum" size="13" /></div>
	  
	</div>
	
	
	<div class="line">&nbsp;</div>
	
	
	<div style="width:78%; text-align:right; float:left;">
	<input type="button" value="      บันทึก       " onclick="addstaff('setting/staff_add','d_tall')" style="height:25px; font-size:13px; line-height:25px;" />
	<input type="button" value=" รายการใหม่ " onclick="clearstaff()" style="height:25px; font-size:13px; line-height:25px;"/>
	</div>
	
</div>   

<div id="d_tall" style="width:45%; height:auto; float:left; margin-left:50px; "> 
   
	<div style="width:43%; height:20px; margin-left:5px; float:left; color:#000000; font-weight:bold; font-size:13px; background:<?=$tabcolor?>; "> 
		<div style="width:25%;text-align:left; float:left;">&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รหัสพนักงาน</div>
		<div style="width:75%;text-align:left; float:left;">&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ชื่อพนักงาน</div>	
	</div>	

<? 
$cl = $color1;
$sql = "select * from tb_staff ";
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
$sql .=" order by staffid asc LIMIT $Page_Start , $Per_Page";
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
		
<div class="list_out" onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')" background:<?=$cl?>">

	<div style="width:10%; float:left;"><?=$rs['staffid']?>&nbsp;</div>
	<div style="width:20%; float:left;"><?=$rs['pname'].$rs['fname'].'    '.$rs['lname']  ?>&nbsp;</div>
	<div style="width:10%; float:left; text-align:right">

	<img src="images/icon/pedit.png" align="แก้ไขข้อมูล" title="แก้ไขข้อมูล" style="cursor:pointer;" onClick="editgernaral('<?=$rs['name']?>','<?=$rs['id']?>');" />
	<img src="images/icon/pdelete.png" align="ลบข้อมูล" title="ลบข้อมูล" style="cursor:pointer;" onClick="ConfDelete('setting/gernaral_del.php','d_tall','id=<?=$rs['id']?>&mode=<?=$mode?>')" />
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
	<a href="javascript: ajaxLoad('get','setting/gernaral_list.php','mode=<?=$mode?>&Page=<?=$Prev_Page?>','d_tall')">	
	<img src='images/icon/back.png'  border='0' align="absmiddle"/>
	</a>
	<?
	}
	for($i=1; $i<=$Num_Pages; $i++){
		if($i != $Page)
		{
	?>		
	<a href="javascript: ajaxLoad('get','setting/staff_list.php','mode=<?=$mode?>&Page=<?=$i?>','d_tall')"><?=$i?></a>	
	<?
		}
		else
		{ 	
			if($Num_Pages!= 1){	echo " <b>$i </b>";}	
		}
	}
	if($Page!=$Num_Pages)
	{
	?>

	<a href="javascript: ajaxLoad('get','setting/staff_list.php','mode=<?=$mode?>&Page=<?=$Next_Page?>','d_tall')">	
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


