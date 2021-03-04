<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?
include('../class/config.php');

$branch_id = $_SESSION['branch_id'];

$sql = "select * from tb_clinicinformation where cn = '$branch_id' ";
$clinic_result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$row=mysql_fetch_array($clinic_result);
$edit = "Y";
if($row['cn'] == "" || $row['cn'] == null) {
	$edit = "N";
	$row['cn'] = $branch_id;
}
?>

<div id="t_main" class="tmain" style="width:100%; height:495px; overflow:hidden; text-align:center; ">
   <div class="littleDD" style="font-size:14px; font-weight:bold;" >ข้อมูลสาขา</div>


<div style="width:100%; height:auto;  margin:auto; margin-top:10px; float:left;">
  <div class="line" style="height:100px;">
		<div style="width:30%; float:left; text-align:right;">&nbsp;</div>
		<div style="width:70%; float:left;">
			<div style="width:120px; height:100px; border:#CCCCCC 1px solid;"></div>
		
		</div>
		
  </div>


  <div class="line" style="height:10px;"></div>
  <input type="hidden" id="edit" value="<?=$edit?>" />
  <!-- <input type="hidden" id="cn" value="<?=$row['cn']?>" /> -->
  <div class="line">
		<div style="width:30%; float:left; text-align:right;">รหัสสาขา :&nbsp;</div>
		<div style="width:70%; float:left;"><input type="text" id="cn" size="15" value="<?=$row['cn']?>" /></div>
  </div>
  
  <div class="line">
		<div style="width:30%; float:left; text-align:right;">ชื่อสาขา :&nbsp;</div>
		<div style="width:70%; float:left;"><input type="text" id="name" size="60" value="<?=$row['clinicname']?>" /></div>
  </div>
  
  <div class="line">
		<div style="width:30%; float:left; text-align:right;">ClinicName:&nbsp;</div>
		<div style="width:70%; float:left;"><input type="text" id="engname" size="60" value="<?=$row['nameeng']?>" /></div>
  </div>
  <div class="line" style="height:10px;"></div>
  <div class="line">
		<div style="width:30%; float:left; text-align:right;">หมายเลขผู้เสียภาษี :&nbsp;</div>
		<div style="width:70%; float:left;"><input type="text" id="texid" size="60" value="<?=$row['taxnumber']?>"  /></div>
  </div>
  
   <div class="line">
		<div style="width:30%; float:left; text-align:right;">เลขที่ผู้ประกอบการ :&nbsp;</div>
		<div style="width:70%; float:left;"><input type="text" id="number" size="60" value="<?=$row['clinicnumber']?>"  /></div>
  </div>
    
  
  
  <div class="line">
		<div style="width:30%; float:left; text-align:right;">เวลาทำการ :&nbsp;</div>
		<div style="width:20%; float:left;"><input type="text" id="otime" size="15" value="<?=$row['timeopen']?>" /></div>
		<div style="width:13%; float:left; text-align:right;">ถึง :&nbsp;</div>
		<div style="width:25%; float:left;"><input type="text" id="ctime" size="15" value="<?=$row['timeclose']?>" /></div>		
  </div>
  
  <div class="line" style="height:10px;"></div>
  
  <div class="line">
		<div style="width:30%; float:left; text-align:right;">ที่อยู่ :&nbsp;</div>
		<div style="width:70%; float:left;"><input type="text" id="add" size="60" value="<?=$row['address']?>" /></div>
  </div>
  
  <div class="line">
		<div style="width:30%; float:left; text-align:right;">Address :&nbsp;</div>
		<div style="width:70%; float:left;"><input type="text" id="engadd" size="60" value="<?=$row['addeng']?>" /></div>
  </div>
  
   <div class="line">
		<div style="width:30%; float:left; text-align:right;">จังหวัด :&nbsp;</div>
		<div style="width:20%; float:left;"><input type="text" id="pro" size="15" value="<?=$row['province']?>" /></div>
		<div style="width:13%; float:left; text-align:right;">รหัสไปรณีย์ :&nbsp;</div>
		<div style="width:25%; float:left;"><input type="text" id="pos" size="15" value="<?=$row['post']?>" /></div>		
  </div>
  

  <div class="line">
		<div style="width:30%; float:left; text-align:right;">โทรศัพท์ :&nbsp;</div>
		<div style="width:70%; float:left;"><input type="text" id="tel" size="60" value="<?=$row['telephone']?>"  /></div>
  </div>
  
  <div class="line">
		<div style="width:30%; float:left; text-align:right;">โทรสาร :&nbsp;</div>
		<div style="width:70%; float:left;"><input type="text" id="fax" size="60" value="<?=$row['fax']?>" /></div>
  </div> 
  <div class="line" style="height:10px;"></div>
  <div class="line">
 		<div style="width:30%; float:left; text-align:right;">&nbsp;</div>
		<div style="width:70%; float:left;">
		<input name="add" type="button" value="บันทึกข้อมูล" onclick="addclinic('setting/clinic_add.php','d_list')">
		</div> 
  
  </div>

</div>

</div>
