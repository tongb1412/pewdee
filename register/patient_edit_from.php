<? 
include('../class/config.php'); 
$hn = $_POST['hn'];
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div style="width:12%; height:auto; margin-left:5px; float:left; text-align:right;">



  <div id="imgZone" style="width:95%; height:100px; float:right; text-align:center; ">
	<IFRAME name="up_iframe" id="up_iframe"  src="showImg.php?hn=<?=$hn?>" align="middle" width="100" height="100" frameborder="0" style="text-align:center; padding:0px; overflow:hidden; border:1px solid #CCCCCC; ">
    </IFRAME>
  
  
  
  
  </div>
  <div style="width:100%; height:auto; float:left; margin-top:10px;">
  
            <form action="upload.php" target="up_iframe" method="post"  enctype="multipart/form-data" name="form1" id="form1">       
            <input type="file" size="5"name="filUpload" id="filUpload" value="" />&nbsp;&nbsp;
             <input type="hidden" id="phn" name="phn" value="<?=$hn?>" />            
            <input type="submit" id="iSubmit" value=" Upload " style="cursor:pointer;" /> 
            </form>   
  
  </div>
  <div style="width:100%; height:auto; float:left; display:none;">
  <input type="button" value="  ถ่ายรูปจากกล้อง  " style="cursor:pointer;" onclick="popupWebcamet('<?=$hn?>');"/>
  
  </div>


<?

$sql = "select * from tb_patient where hn='$hn'";
$patient_result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$row=mysql_fetch_array($patient_result);
if(! empty($row['birthday'])){

$y = date('Y',time());
$age = intval($y) - intval(substr($row['birthday'],6,4));
if($age < 0) {
	$age = (intval($y) + 543 ) - intval(substr($row['birthday'],6,4)) ;
}
} else {
	$age = '';
}


?>

</div>
<div style="width:43%; height:470px; margin-left:5px; float:left;">
	<div class="line" >
		<div style="width:20%; float:left; text-align:right;">รหัสคนไข้ :&nbsp;</div>
		<div style="width:30%; float:left;"><input type="text" id="hn" size="15" value="<?=$row['hn']?>" disabled="disabled"/></div>	
		<div style="width:20%; float:left; text-align:right;">Card No :&nbsp;</div>
		<div style="width:30%; float:left;"><input type="text" id="cn" size="15"  value="<?=$row['cradno']?>" /></div>		
	</div>
<?
$sql = "select * from tb_gernaral where typ='PN'";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
?>
	<div class="line">
		<div style="width:20%; float:left; text-align:right;">คำนำหน้าชื่อ :&nbsp;</div>
		<div style="width:30%; float:left;">
		<select id="pname" style="width:117px;">
		<option value="<?=$row['pname']?>"><?=$row['pname']?></option>
		<? 
		while($rs=mysql_fetch_array($result)){  
		if($rs['name']!=$row['pname']){
		?>
		<option value="<?=$rs['name']?>"><?=$rs['name']?></option>
		<? } } ?>
		</select>
		</div>	
 	
		
		<div style="width:20%; float:left; text-align:right;">เพศ :&nbsp;</div>
		<div style="width:30%; float:left;">
		  <select name="select" id="sex" style="width:117px;">
            <? if($row['sex']=='ชาย'){ ?>
            <option value="ชาย">ชาย</option>
            <option value="หญิง">หญิง</option>
            <? } else { ?>
            <option value="หญิง">หญิง</option>
            <option value="ชาย">ชาย</option>
            <? } ?>
          </select>
		</div>	
		
					
			
	</div>	
	<div class="line">
		<div style="width:20%; float:left; text-align:right;">ชื่อ :&nbsp;</div>

		<div style="width:30%; float:left;"><input type="text" id="fname" size="15" value="<?=$row['fname']?>" /></div>
		<div style="width:20%; float:left; text-align:right;">สกุล :&nbsp;</div>
		<div style="width:30%; float:left;"><input type="text" id="lname" size="15" value="<?=$row['lname']?>" /></div>		
	</div>
<?
$pt = $row['level'];

$sql5 = "select velid,velname from tb_level where velname <> '$pt' order by velid asc";
$result5 = mysql_query($sql5) or die ("Error Query [".$sql5."]"); 


$sql = "select * from tb_gernaral where typ='ST'";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
?>	
	
	<div class="line">
		<div style="width:20%; float:left; text-align:right;">ระดับคนไข้ :&nbsp;</div>
		<div style="width:30%; float:left;">
		<select id="plevel" style="width:117px;">
		<option value="<?=$row['level']?>"><?=$row['level']?></option>
		<? while($rs=mysql_fetch_array($result5)){  ?>
		<option value="<?=$rs['velname']?>"><?=$rs['velname']?></option>
		<? } ?>
		</select>
		</div>	
		<div style="width:20%; float:left; text-align:right;">สถานะภาพ :&nbsp;</div>
		<div style="width:30%; float:left;">
		<select id="st" style="width:117px;">	
		<? if(($row['state']!='ไม่ระบุ') && (! empty($row['state'])) ){ ?>
		<option value="<?=$row['state']?>"><?=$row['state']?></option>
		<? } else { ?>
		<option value="ไม่ระบุ">ไม่ระบุ</option>
		<? 
		}		
		while($rs=mysql_fetch_array($result)){  
		if($rs['name']!=$row['state']){
		?>
		<option value="<?=$rs['name']?>"><?=$rs['name']?></option>
		<? } } ?>
		</select>
		</div>	
	</div>

	<div class="line">
		<div style="width:20%; float:left; text-align:right;">บัตรประชาชน :&nbsp;</div>
		<div style="width:30%; float:left;"><input type="text" id="pno" size="15" maxlength="17" value="<?=$row['personalid']?>"/></div>
		<div style="width:20%; float:left; text-align:right;">Passport No :&nbsp;</div>
		<div style="width:30%; float:left;"><input type="text" id="pass" size="15" maxlength="15" value="<?=$row['passport']?>" /></div>
	</div>	
	<div class="line">
		<div style="width:20%; float:left; text-align:right;">วัน-เดือน-ปี เกิด :&nbsp;</div>
		<div style="width:30%; float:left;"><input type="text" id="dd" size="2" style="width:25px"  maxlength="2" value="<?=substr($row['birthday'],0,2)?>" onkeyup="chk_dob('1')" />-<input type="text" id="dm" size="2" style="width:25px" maxlength="2" value="<?=substr($row['birthday'],3,2)?>"  onkeyup="chk_dob('2')" />-<input type="text" id="dy" size="4" style="width:45px" maxlength="4" value="<?=substr($row['birthday'],6,4)?>" onkeyup="calage(<?=date('Y',time())?>)" /> </div>
		<div style="width:20%; float:left; text-align:right;">อายุ :&nbsp;</div>
		<div style="width:30%; float:left;"><input type="text" id="age" size="5"  style="width:20px" readonly="TRUE" value="<?=$age?>" /> ปี</div>		
	</div>	
    
<?


$sql = "select * from tb_gernaral where typ='OC' order by name asc";
$result1 = mysql_query($sql) or die ("Error Query [".$sql."]"); 

$news = array('ไม่ระบุ','นิตยสาร','เวปไซด์','อินเตอร์เน็ต','เพื่อน','ญาติ');

?>		
	<div class="line">
		<div style="width:20%; float:left; text-align:right;">อาชีพ :&nbsp;</div>
		<div style="width:30%; float:left;">
		<select id="oc" style="width:117px;">
		<? if(($row['occupation']!='ไม่ระบุ') && (! empty($row['occupation'])) ){ ?>
		<option value="<?=$row['occupation']?>"><?=$row['occupation']?></option>
		<? } else { ?>
		<option value="ไม่ระบุ">ไม่ระบุ</option>
		<? 
		}		
		while($rs=mysql_fetch_array($result1)){  
		if($rs['name']!=$row['occupation']){
		?>
		<option value="<?=$rs['name']?>"><?=$rs['name']?></option>
		<? } } ?>
		</select>
		</div>	    
    
    
		<div style="width:20%; float:left; text-align:right;">แหล่งข่าว :&nbsp;</div>
		<div style="width:30%; float:left;">
		<select id="bl" style="width:117px;">
		
		<option value="<?=$row['blood']?>"><?=$row['blood']?></option>
	
		<?
		for($i=0;$i < 6; $i++){
		if($news[$i]!=$row['blood']){
		?>
		<option value="<?=$news[$i]?>"><?=$news[$i]?></option>
		<? } } ?>
		</select>
		</div>	

	</div>	    
    
    
    
    
	<div class="line">
		<div style="width:20%; float:left; text-align:right;">&nbsp;</div>
		<div style="width:30%; float:left;"><span id="txtdate"></span></div>
		<div style="width:20%; float:left; text-align:right;">&nbsp;</div>
		<div style="width:30%; float:left;"></div>		
	</div>	
	<div class="line">&nbsp;</div>		

	<div class="line">
		<div style="width:20%; float:left; text-align:right;">ที่อยู่ :&nbsp;</div>
		<div style="width:80%; float:left;"><input type="text" id="address" size="45" value="<?=$row['address']?>" /></div>		
	</div>	
	<!-- <div class="line">
		<div style="width:20%; float:left; text-align:right;">ตำบล/แขวง :&nbsp;</div>
		<div style="width:30%; float:left;"  >
		<input type="text" id="tum" size="15"  value="<?=$row['tum']?>" onkeyup="serchtxt('register/sql_tum.php','tumz',this)" />
		<div id="tumz" class="bl"></div>
		</div>	
		<div style="width:20%; float:left; text-align:right;">อำเภอ/เขต :&nbsp;</div>
		<div style="width:30%; float:left;" >
		<input type="text" id="aum" size="15" value="<?=$row['aum']?>" onkeyup="serchtxt('register/sql_aum.php','aumz',this)"  onfocus="serchtxt('register/sql_tum.php','tumz','')"/>
        <div id="aumz" class="bl"></div>
		</div>	
	</div>	
	<div class="line">
		<div style="width:20%; float:left; text-align:right;">จังหวัด :&nbsp;</div>
		<div style="width:30%; float:left;">
		<input type="text" id="province" size="15" value="<?=$row['province']?>" onkeyup="serchtxt('register/sql_pro.php','proz',this)" onfocus="serchtxt('register/sql_aum.php','aumz','')"/>
		<div id="proz" class="bl"></div>
		</div>

		<div style="width:20%; float:left; text-align:right;">รหัสไปรษณีย์ :&nbsp;</div>
		<div style="width:30%; float:left;"><input type="text" id="post" size="15" maxlength="5" value="<?=$row['post']?>" onfocus="serchtxt('register/sql_pro.php','proz','')" /></div>	
	</div>	
 -->	
 	<div class="line">
		<div style="width:20%; float:left; text-align:right;">จังหวัด :&nbsp;</div>
		<div style="width:30%; float:left;">
		<select name='province' id='province' onchange="data_show(this.value,'amphur');" style="width:117px;">
			<?
			$rstTemp=mysql_query('select * from province Order By PROVINCE_ID ASC');
			while($arr_2=mysql_fetch_array($rstTemp)){
				if($row['province']==$arr_2['PROVINCE_ID']){
			?>
			<option value="<?=$arr_2['PROVINCE_ID']?>" selected><?=$arr_2['PROVINCE_NAME']?></option>
			<? }else{ ?>
			<option value="<?=$arr_2['PROVINCE_ID']?>"><?=$arr_2['PROVINCE_NAME']?></option>
			<? } }?>
		</select>
		</div>
		<div style="width:20%; float:left; text-align:right;">อำเภอ/เขต :&nbsp;</div>
		<div style="width:30%; float:left; " >
			<select name='amphur' id='amphur'onchange="data_show(this.value,'district');" style="width:117px;">
			<?
			$rstTemp=mysql_query("select * from amphur where PROVINCE_ID ='".$row['province']."' Order By AMPHUR_ID ASC");
			while($arr_2=mysql_fetch_array($rstTemp)){
				if($row['aum']==$arr_2['AMPHUR_ID']){
			?>
			<option value="<?=$arr_2['AMPHUR_ID']?>" selected><?=$arr_2['AMPHUR_NAME']?></option>
			<? }else{ ?>
			<option value="<?=$arr_2['AMPHUR_ID']?>"><?=$arr_2['AMPHUR_NAME']?></option>
			<? } }?>
			</select>
		</div>	
	</div>	
	<div class="line">

		<div style="width:20%; float:left; text-align:right;">ตำบล/แขวง :&nbsp;</div>
		<div style="width:30%; float:left;"  >
			<select name='district' id='district'onchange="data_show(this.value,'zipcode');" style="width:117px;">
			<?
			$rstTemp=mysql_query("select * from district where AMPHUR_ID ='".$row['aum']."' Order By DISTRICT_ID ASC");
			while($arr_2=mysql_fetch_array($rstTemp)){
				if($row['tum']==$arr_2['DISTRICT_ID']){
			?>
			<option value="<?=$arr_2['DISTRICT_ID']?>" selected><?=$arr_2['DISTRICT_NAME']?></option>
			<? }else{ ?>
			<option value="<?=$arr_2['DISTRICT_ID']?>"><?=$arr_2['DISTRICT_NAME']?></option>
			<? } }?>
			</select>
		</div>	
		<div style="width:20%; float:left; text-align:right;">รหัสไปรษณีย์ :&nbsp;</div>
		<div style="width:30%; float:left;">
			<select name='zipcode' id='zipcode' style="width:117px;">
			<?
			$rstTemp=mysql_query("select * from zipcode where ZIPCODE_ID ='".$row['post']."' Order By ZIPCODE_ID ASC");
			while($arr_2=mysql_fetch_array($rstTemp)){
				if($row['post']==$arr_2['ZIPCODE_ID']){
			?>
			<option value="<?=$arr_2['ZIPCODE_ID']?>" selected><?=$arr_2['ZIP_NAME']?></option>
			<? }else{ ?>
			<option value="<?=$arr_2['ZIPCODE_ID']?>"><?=$arr_2['ZIP_NAME']?></option>
			<? } }?>
			</select>
			</select>
		</div>	
	</div>	

 
 <div class="line">
		<div style="width:20%; float:left; text-align:right;">ประเทศ :&nbsp;</div>
		<div style="width:30%; float:left;"><input type="text" id="country" size="15"  value="<?=$row['country']?>" /></div>	
	</div>	
	<div class="line">&nbsp;</div>
	<div class="line">
		<div style="width:20%; float:left; text-align:right;">เบอร์โทร :&nbsp;</div>
		<div style="width:30%; float:left;"><input type="text" id="tel" size="15" value="<?=$row['telephone']?>"/></div>	
		<div style="width:20%; float:left; text-align:right;">เบอร์มือถือ :&nbsp;</div>
		<div style="width:30%; float:left;"><input type="text" id="mtel" size="15" value="<?=$row['selfphone']?>" /></div>	
	</div>	
	<div class="line">
		<div style="width:20%; float:left; text-align:right;">E-mail :&nbsp;</div>
		<div style="width:80%; float:left;"><input type="text" id="email" size="45" value="<?=$row['email']?>"/></div>	

	</div>	
	<div class="line" style=" border-bottom:#CCCCCC 1px dotted;">
		<div style="width:20%; float:left; text-align:right;">Facebook :&nbsp;</div>
		<div style="width:80%; float:left;"><input type="text" id="facebook" size="45"  value="<?=$row['facebook']?>"/></div>	

	</div>

</div>
<div style="width:43%; height:470px; margin-left:5px; float:left; ">
<?
$sql = "select * from tb_gernaral where typ='BL' order by name asc";
$result1 = mysql_query($sql) or die ("Error Query [".$sql."]"); 

?>
	<div class="line">
		<div style="width:20%; float:left; text-align:right;">อาการเบื้องต้น :&nbsp;</div>
		<div style="width:80%; float:left;">
		<select id="lt" style="width:117px;" onchange="getlt(this)">
		<option value="ไม่ระบุ">ไม่ระบุ</option>
		<? while($rs=mysql_fetch_array($result1)){  ?>
		<option value="<?=$rs['name']?>"><?=$rs['name']?></option>
		<? } ?>
		</select>        
        </div>	

	</div>
	<div class="line" style="height:80px;">
		<div style="width:20%; float:left; text-align:right;">:&nbsp;</div>
		<div style="width:80%; float:left;"><textarea id="mem" cols="45" rows="3"><?=$row['mem']?></textarea></div>	

	</div>
	<div class="line">
		<div style="width:20%; float:left; text-align:right;">แพ้ยา :&nbsp;</div>
		<div style="width:80%; float:left;"><input type="hidden" id="did" value="" />
		<input type="text" id="drug" size="40" onkeyup="serchtxt('register/sql_druge.php','dl',this)"  />&nbsp;<input type="button" value="  เพิ่ม "  onClick="adddruganti('register/sql_adddruganti.php','dz','register/druganti_list.php')"  />
		<div id="dl" class="bl"></div>
		</div>	
	</div>
	<div class="line">
		<div style="width:20%; float:left; text-align:right;">&nbsp;</div>
		<div style="width:80%; float:left;">
			<div style="width:99%; height:20px; line-height:20px; color:#000000; margin:auto; font-weight:bold; font-size:13px; background:<?=$tabcolor?>;">
				<div style="width:80%;text-align:left; float:left;">&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รายการ</div>
	
			</div>
		</div>
	</div>
	<div class="line" style="height:99px; overflow:hidden;">
		<div style="width:20%; float:left; text-align:right;">&nbsp;</div>
		<div id="dz" style="width:80%; float:left;">
		
<?		
$cl = $color1;
$sql = "select * from tb_druganti where hn='$hn'";
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
$sql .=" order by dname asc LIMIT $Page_Start , $Per_Page";
$result  = mysql_query($sql);
$Num = mysql_num_rows($result);

if($result){

$n=1;
while($rs=mysql_fetch_array($result)){  
if($cl != $color1){
	$cl = $color1;
} else {
	$cl = $color2;
}


?>


<div style="width:88%; height:20px; line-height:20px; text-align:left; padding-left:20px; border-bottom:#CCCCCC 1px dotted;background:<?=$cl?>; cursor:pointer;" onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')" >
	
	<div style="width:92%; float:left; line-height:20px;"><?=$rs['dname']?></div>
	<div style="width:8%; float:left; text-align:right; line-height:20px;">
	<img src="images/icon/pdelete.png" align="ลบข้อมูล" title="ลบข้อมูล" style="cursor:pointer;" onClick="ConfDelete('register/sql_druganti_del.php','dz','id=<?=$rs['did']?>&hn=<?=$hn?>&url=register/druganti_list.php')" />
	</div>
</div>
<? 
$n++; 
} 
}

?>		
		
		
		
		
		</div>
	</div>
	<div class="line">
		<div style="width:20%; float:left; text-align:right;">โรคประจำตัว :&nbsp;</div>
		<div style="width:80%; float:left;"><input type="hidden" id="doid" value="" />
		<input type="text" id="dio" size="40" onkeyup="serchtxt('register/sql_dio.php','dol',this)"  />&nbsp;<input type="button" value="  เพิ่ม " onClick="adddinose('register/sql_adddinoseanti.php','doz','register/dinoseanti_list.php')" />
		<div id="dol" class="bl"></div>
		</div>	
	</div>
	<div class="line">
		<div style="width:20%; float:left; text-align:right;">&nbsp;</div>
		<div style="width:80%; float:left;">
			<div style="width:99%; height:20px; line-height:20px; color:#000000; margin:auto; font-weight:bold; font-size:13px; background:<?=$tabcolor?>;">
				<div style="width:80%;text-align:left; float:left;">&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รายการ</div>
	
			</div>
		</div>
	</div>	
	<div class="line" style="height:95px; overflow:hidden;  border-bottom:#CCCCCC 1px dotted;">
		<div style="width:20%; float:left; text-align:right;">&nbsp;</div>
		<div id="doz" style="width:80%; float:left; ">
<?
$cl = $color1;
$sql = "select * from tb_dinoseanti where hn='$hn'";
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
$sql .=" order by dname asc LIMIT $Page_Start , $Per_Page";
$result  = mysql_query($sql);
$Num = mysql_num_rows($result);

if($result){

$n=1;
while($rs=mysql_fetch_array($result)){  
if($cl != $color1){
	$cl = $color1;
} else {
	$cl = $color2;
}


?>


<div style="width:88%; height:20px; line-height:20px; text-align:left; padding-left:20px; border-bottom:#CCCCCC 1px dotted;background:<?=$cl?>; cursor:pointer;" onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')" >
	
	<div style="width:92%; float:left; line-height:20px;"><?=$rs['dname']?></div>
	<div style="width:8%; float:left; text-align:right; line-height:20px;">
	<img src="images/icon/pdelete.png" align="ลบข้อมูล" title="ลบข้อมูล" style="cursor:pointer;" onClick="ConfDelete('register/sql_dinoseanti_del.php','doz','id=<?=$rs['did']?>&hn=<?=$hn?>&url=register/druganti_list.php')" />
	</div>
</div>
<? 
$n++; 
} 
}

?>

		</div>       
	</div>	
    
     <div class="line" style="border-bottom:#CCCCCC 1px dotted;" >
	      <div style="width:20%; float:left; text-align:right;">รู้จักผิวดีจาก :&nbsp;</div>
          <div style="width:80%; float:left;">
			<select id="how" style="width:117px;">
			<option value="">--- เลือกหัวข้อ ---</option>
				<?php 
				$catagory = array("เว็บไซต์คลีนิก","เว็บไซต์อื่น","เดินผ่าน","นิตยสาร","เฟสบุคคลีนิก","วิทยุ/ทีวี","อินเตอร์เน็ต","โบรชัวร์","เพื่อน/คนรู้จัก","ยูทูป","การแนะนำของเน็ตไอดอล","อื่นๆ");
						foreach($catagory as $value){
							if($row["how"]==$value){
								echo "<option value='$value' selected>$value</option>";
							}else{
								echo "<option value='$value'>$value</option>";
							}
				 } ?>
			</select>
				&nbsp;&nbsp;อื่นๆ : <input type="text" id="other" size="15" value="<?=$row["other"];?>"/>
		  </div>
    </div>
    
    
    
	
	<div class="line" style="margin-top:10px;">
		<div style="width:45%; float:left; text-align:right; font-weight:bold">&nbsp;
			คนไข้ :&nbsp;
			
				<select id="typ" style="width:60px;">
				<option value="O">เก่า</option>
				<option value="N">ใหม่</option>
				</select>
		
		</div>
		<div id="doz" style="width:55%; float:left; text-align:right;">
		<input type="button" value="  บันทึกข้อมูล  " style="font-size:14px; font-weight:bold; height:35px;" onclick="addpatient('EDIT')" />&nbsp;
		<input type="button" value="  ส่งเข้าระบบ  "  style="font-size:14px; font-weight:bold; height:35px;" onclick="sendpatient('hn=<?=$hn?>','register/sendpatient.php','sd')"/>&nbsp;
		</div>
	</div>

</div>

<? mysql_close($dblink); ?>