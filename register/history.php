<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$hn = $_POST['hn'];
$cl = $color1;
$sql = "select * from tb_patient where hn='$hn'";
$patient_result = mysql_query($sql) or die ("Error Query [".$sql."]");
$row=mysql_fetch_array($patient_result);
?>

<div style="width:99%; margin:auto;  height:25px; float:left; display:none;">
	<div style="width:20%; font-size:16px; font-weight:bold; float:left; line-height:20px;">
		<img src="images/icon/group.png" align="absmiddle" />&nbsp;ประวัติการรักษา
	</div>
	<div style="width:80%; text-align:right; float:left; line-height:20px;">
		<input type="button" value="  รายชื่อทั้งหมด  " onclick="loadmodule('home','register/register.php','')" style="height:25px; font-size:13px; line-height:25px;" />
	</div>
</div>

<div id="main" class="main" style="width:99%; margin:auto; margin-top:5px; height:500px; overflow:hidden;">
	<div class="littleDD" style="font-size:18px; font-weight:bold; height:50px;">
		<div style="width:30%; height:50px; line-height:50px; text-align:right; float:left;">รหัสคนไข้ : <?= $hn; ?></div>
		<div style="width:65%; height:50px; padding-left:30px; line-height:50px; text-align:left; float:left;"><?= $row['pname'] . $row['fname'] . '    ' . $row['lname']; ?></div>
	</div>
	<div style="width:100%; height:auto; margin-top:10px; text-align:left;">
		<div style="width:47%; margin-left:15px; margin-right:10px; float:left; height:auto;">
			<div class="line" style="font-size:14px; font-weight:bold; height:20px; line-height:20px;">
				รายการ
			</div>
			<div style="width:99%; height:382px; float:left; border:#CCCCCC 1px solid;">
				<div style="width:98%; height:20px;padding-top:5px;margin-left:5px; margin-top:5px; color:#000000; font-weight:bold; float:left; font-size:13px;background:<?= $tabcolor ?>;">
					<div style="width:17%;text-align:left; float:left;">&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ลำดับ</div>
					<div style="width:30%;  text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;วันที่</div>
					<div style="width:27%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;Bill No.</div>
					<div style="width:25%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ประเภท</div>
				</div>
				<div id="p_list" style=" width:99%; margin-left:5px; float:left; height:350px; overflow:auto;">
					<?
			$sql = "select a.*,b.billno from tb_vst a,tb_payment b where a.vn=b.vn  and  a.hn='$hn' and a.status = 'COM' order by a.vdate asc ";
			$str  = mysql_query($sql);
			$n=1;
			while($rs=mysql_fetch_array($str)){
			if($cl != $color1){
				$cl = $color1;
			} else {
				$cl = $color2;
			}
			if($rs['mode']=='00'){ $txt ='-'; } else { $txt='ซื้อยา'; }
			?>
					<div class="list_out" onmouseover="linkover(this)" onmouseout="linkout(this,'<?= $cl ?>')" style="background:<?= $cl ?>; width:94%; cursor:pointer;" onClick="loadmodule('d_list','register/history_list.php','vn=<?= $rs['vn'] ?>')">
						<div style="width:8%; float:left;"><?= $n ?>&nbsp;</div>
						<div style="width:39%; float:left; "><?= $rs['vdate'] ?>&nbsp;</div>
						<div style="width:30%; float:left;"><?= $rs['billno'] ?>&nbsp;</div>
						<div style="width:20%; float:left; text-align:left;"><?= $txt; ?>&nbsp;</div>
					</div>
					<? $n++; } ?>

				</div>
			</div>
		</div>
		<div style="width:48%; margin-left:10px; margin-right:10px; float:left; height:auto;">
			<div class="line" style="font-size:14px; font-weight:bold; height:20px; line-height:20px;">
				<div style="width:50%; float:left;">ประวัติการรักษา</div>
			</div>
			<div id="d_list" style="width:99%; height:382px; float:left; border:#CCCCCC 1px solid; overflow:auto;">

			</div>

		</div>
	</div>
</div>