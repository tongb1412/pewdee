<?
include('../class/config.php');

$dis = "";
$dis2 = "";

if(empty($_GET['an'])){

	$an = 'AN'.date('ymdHis');
	$mod = 'NEW'; $dis='none';
	$dat = date('d-m-Y');
	$hn = $_POST['hn']; 
	if(!empty($hn)){
		 
		$sql = "select concat(pname,fname,'   ',lname) as pname,hn,cn from tb_patient where hn='$hn'";
		$str = mysql_query($sql) or die ("Error Query [".$sql."]"); 
		$rs=mysql_fetch_array($str); 	
	}
	
} else {
    $mod = 'EDIT'; 
	$an = substr($_GET['an'],0,14);
	$sql = "select a.*,concat(b.pname,b.fname,b.lname) as cname from tb_appointment a,tb_staff b  where a.pid=b.staffid and a.an='$an'";
	$str = mysql_query($sql) or die ("Error Query [".$sql."]"); 
	$rs = mysql_fetch_array($str); 
	if($rs['atyp']=='A'){ 
		$dis = 'none'; 
		$dis2 = '';  
	} else { 
		$dis = ''; 
		$dis2 = 'none';
	} 
	$dat = substr($rs['dat'],8,2).'-'.substr($rs['dat'],5,2).'-'.substr($rs['dat'],0,4);
}




?>

<div style="width:60%; height:40px; margin:auto; margin-top:10px; border:<?= $tabcolor ?> 1px solid; line-height:20px;">

	<div class="line" style="margin-top:10px;">
		<div style="width:20%; float:left; text-align:right; font-weight:bold;">ค้นคนไข้ :&nbsp;&nbsp;</div>
		<div style="width:70%; float:left;">
			<input type="text" id="txtserch" size="60" onkeyup="serchlab('appointment/patient_list.php','ll',this)" />
			<div id="ll" class="bl" style="width:100%;"></div>
		</div>
		<div style="width:10%; float:left; text-align:right;"></div>

	</div>
</div>
<div style="width:60%; height:100px; margin:auto; margin-top:10px; border:<?= $tabcolor ?> 1px solid; line-height:10px; background:<?= $tabcolor ?>;">
	<div class="line" style="margin-top:10px;">
		<div style="width:20%; float:left; text-align:right;">รหัสนัด :&nbsp;</div>
		<div style="width:30%; float:left;"><input type="text" id="an" size="20" readonly="true" value="<?= $an ?>" /> </div>

	</div>
	<div class="line" style="margin-top:10px;">
		<div style="width:20%; float:left; text-align:right;">รหัสคนไข้ :&nbsp;</div>
		<div style="width:30%; float:left;"><input type="text" id="hn" size="20" readonly="true" value="<?= $rs['hn'] ?>" /> </div>
		<div style="width:17%; float:left; text-align:right;">Crad No :&nbsp;</div>
		<div style="width:30%; float:left;"><input type="text" id="cn" size="20" readonly="true" value="<?= $rs['cn'] ?>" /> </div>
	</div>
	<div class="line">
		<div style="width:20%; float:left; text-align:right;">ชื่อ - สกุล :&nbsp;</div>
		<div style="width:80%; float:left;">
			<input type="text" id="pname" size="60" readonly="true" value="<?= $rs['pname'] ?>" />
		</div>

	</div>
</div>
<div style="width:60%; height:275px; margin:auto; margin-top:10px; border:<?= $tabcolor ?> 1px solid; line-height:10px;">
	<div class="line" style="margin-top:10px;">
		<div style="width:20%; float:left; text-align:right;">ประเภท :&nbsp;</div>
		<div style="width:30%; float:left;">
			<select id="atyp" onchange="switchtime(this)">
				<? if($mod == 'NEW'){ ?>
				<option value="A">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;นัด &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</option>
				<option value="S">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จอง </option>
				<? } else  if($rs['atyp']!='A'){ ?>
				<option value="A">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;นัด &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</option>
				<option value="S" selected>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จอง &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</option>
				<? } else { ?>
				<option value="A">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;นัด &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</option>
				<option value="S">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จอง </option>
				<? } ?>
			</select>
		</div>
		<div style="width:8%; float:left; text-align:right;">ผู้นัด :&nbsp;</div>
		<div style="width:40%; float:left; ">
			<select id="pid">
				<? if($mod=='NEW'){ ?>
				<option value="9999">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เลือกผู้นัด&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
				<? } else { ?>
				<option value="<?= $rs['pid'] ?>"><?= $rs['cname'] ?></option>
				<?
		}
		$sql = "select * from tb_staff where  eshow='Y' order by fname  ";
		$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
		while($row=mysql_fetch_array($result)){
		?>
				<option value="<?= $row['staffid'] ?>"><?= $row['pname'] . $row['fname'] . '    ' . $row['lname']  ?></option>
				<? 
		} 
		if($mod!='NEW'){
		?>
				<option value="9999">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</option>
				<? } ?>
			</select>

		</div>
	</div>
	<div class="line" style="margin-top:10px;">
		<div style="width:20%; float:left; text-align:right;">วันที่ :&nbsp;</div>
		<div style="width:23%; float:left;">
			<input type="text" id="dat" size="19" readonly="readonly" value="<?= $dat ?>" />
		</div>
		<div style="width:7%; float:left;">
			<img src="calendar/calendar.jpg" width="16" onclick="calendar('<?= date('m') ?>','<?= date('Y') ?>','cl','dat','cl1')" style="margin-top:5px; cursor:pointer;" />
			<div id="cl" class="calendar" style="width:152px; height:auto; display:none;"></div>
			<div id="cl1" class="calendar" style="width:152px; height:auto; display:none;"></div>
		</div>
		<div id="tl1" style="width:8%; float:left; text-align:right; display:<?= $dis ?>;">เวลา :&nbsp;</div>
		<div id="tl2" style="width:40%; float:left; display:<?= $dis ?>;">
			<select id="fh">
				<?
		if($mod!='NEW'){
		?>
				<option value="<?= substr($rs['stim'], 0, 2); ?>"><?= substr($rs['stim'], 0, 2); ?></option>
				<?
		}
		for($i=10;$i<21;$i++){
		?>
				<option value="<?= $i ?>"><?= $i ?></option>
				<? } ?>
			</select>
			:
			<select id="fn">
				<? 
		if($mod=='NEW'){
		?>
				<option value="00">00</option>
				<option value="30">30</option>
				<? } else if(substr($rs['stim'],3,2)=='00'){ ?>
				<option value="00">00</option>
				<option value="30">30</option>
				<? } else { ?>
				<option value="30">30</option>
				<option value="00">00</option>
				<? } ?>
			</select>
			--
			<select id="lh">
				<?
		if($mod!='NEW'){
		?>
				<option value="<?= substr($rs['etim'], 0, 2); ?>"><?= substr($rs['etim'], 0, 2); ?></option>
				<?
		}
		
		for($i=10;$i<21;$i++){
		?>
				<option value="<?= $i ?>"><?= $i ?></option>
				<? } ?>
			</select>
			:
			<select id="ln">
				<? 
		if($mod=='NEW'){
		?>
				<option value="00">00</option>
				<option value="30">30</option>
				<? } else if(substr($rs['etim'],3,2)=='00'){ ?>
				<option value="00">00</option>
				<option value="30">30</option>
				<? } else { ?>
				<option value="30">30</option>
				<option value="00">00</option>
				<? } ?>
			</select>

		</div>
		<div id="div_atime" name="div_atime" style="display: <?php echo $dis2; ?>;">&nbsp;&nbsp; เวลา : &nbsp;<input type="text" id="atime" name="atime" value="<?= $rs['atime'] ?>" onkeyup="addAppAtimeChange2(this)" placeholder="ตย.12:30">&nbsp;นาฬิกา</div>
	</div>
	<div class="line" id="div_atime2" name="div_atime2" style="margin-top:10px;display:<?php echo $dis; ?>;">
		<div style="width:56%; float:left; text-align:right;">&nbsp;&nbsp; เวลา : <input type="text" id="atime2" value="<?= $rs['atime'] ?>" onkeyup="addAppAtimeChange(this)" placeholder="ตย.12:30">&nbsp;นาฬิกา</div>
	</div>

	<div class="line" style="margin-top:10px; margin-bottom:10px; height:90px;">
		<div style="width:20%; float:left; text-align:right;">รายละเอียด :&nbsp;</div>
		<div style="width:80%; float:left; ">
			<textarea id="mem" cols="62" rows="5"><?= $rs['mem'] ?></textarea>

		</div>
	</div>
	<div class="line" style="text-align:right; width:90%;">
		<input type="button" value="  บันทึกข้อมูล  " style="font-size:14px; font-weight:bold; height:40px;" onclick="addAppointment('appointment/add_app.php','content')" />
		<? if($mod!='NEW'){ ?>
		<input type="button" value="  ลบข้อมูล  " style="font-size:14px; font-weight:bold; height:40px;" onclick="ConfDelete('appointment/del_app.php','content','an=<?= $an ?>')" />

		<? } ?>
	</div>

</div>