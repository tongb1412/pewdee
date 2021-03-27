<?php

include('../class/config.php');

$sql = "select * from tb_autonumber where typ='PR'";
$result = mysql_query($sql) or die("Error Query [" . $sql . "]");
$rs = mysql_fetch_array($result);
$x = explode('-', $rs['number']);
$n = strlen($x[1]);
$pro = $x[0] . '-';
$txt = explode('-', $rs['last']);
$num = intval($txt[1]) + 1;
$m = strlen($num);

$i = 0;
$t = '';
while ($i < $n - $m) {
	$t .= '0';
	$i++;
}
$t .= $num;
$pro .= $t;

//$sql_del = "delete from tb_temp_drugeinstock where pro='$pro'";
//mysql_query($sql_del) or die ("Error Query [".$sql_del."]"); 

?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div style="width:99%; margin:auto; margin-top:5px; height:30px;">
	<div style="width:300px; font-size:16px; font-weight:bold;"><img src="./images/icon/d_report.png" align="absmiddle" />&nbsp;โปรโมชั่น</div>
</div>
<div style="width:99%; height:auto; margin:auto; margin-top:5px; text-align:center;">
	<div id="main" class="main" style="width:30%; margin:auto; height:495px; overflow:hidden; float:left;">
		<div id="main1" class="littleDD" style="font-size:14px; font-weight:bold;">โปรโมชั่น </div>
		<div class="line">
			<div class="txt_serch" style="width:85%; margin:auto;">
				<input class="input_serch" type="text" id="txts" size="10" placeholder="ค้นหา" onkeyup="serchtxt('promotion/promotion_list.php','d_tall',this)" />
				<input type="button" class="btn_serch" onclick="serchtxt('promotion/promotion_list.php','d_tall',this)" />
			</div>
		</div>
		<?php
		if ($_SESSION['company_data'] == "1") {
		?>
			<div class="line" style="margin-top: 2%;">
				<div style="width:25%; float:left; text-align:right; margin-left:13%;">เลือกสาขา :&nbsp;</div>
				<div style="width:30%; float:left; margin:auto">
					<?php
					include('../class/config.php');
					$sql = "select * from tb_branch ";
					$result = mysql_query($sql) or die("Error Query [" . $sql . "]");
					?>
					<select name="select" id="branchid" style="width:120px;" onchange="serchtxt('promotion/promotion_list.php','d_tall','')">
						<option value="00">ทั้งหมด</option>
						<?php while ($rs = mysql_fetch_array($result)) {
							if ($rs['branchid'] == $_SESSION['branch_id']) {
						?>
								<option value="<?= $rs['branchid'] ?>" selected> <?= $rs['branchname'] ?></option>
							<?php
							} else {
							?>
								<option value="<?= $rs['branchid'] ?>"> <?= $rs['branchname'] ?></option>
							<?php
							}
							?>

						<?php } ?>
					</select>
				</div>

			</div>
		<?php
		}
		?>
		<div style="width:99%; height:20px; margin-top:5px;  float:left; color:#000000; font-weight:bold; font-size:13px; background:<?= $tabcolor ?>; ">
			<div style="width:30%;text-align:left; float:left;">&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รหัส</div>
			<div style="width:70%;text-align:left; float:left;">&nbsp;&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;โปรโมชั่น</div>
		</div>
		<div id="d_tall" style="width:99%; height:auto;  float:left;  margin-left:5px; margin-top:5px ">
			<?  require("promotion_list.php");	 ?>
		</div>
	</div>
	<div id="promotionpage" class="main" style="float:left; margin:auto; width:69%; height:495px;  margin-left:5px;">
		<div class="littleDD" style="font-size:14px; font-weight:bold;">รายละเอียด</div>
		<div id="staffedit" style="width:98%; height:470px;  margin-top:5px; margin-left:5px; float:left; background:#CCCCCC">

			<div class="line">&nbsp;</div>

			<input type="hidden" id="typ" value="new" />
			<div style="width:25%; float:left; text-align:right;">รหัสโปรโมชั่น :&nbsp;</div>
			<div style="width:25%; float:left;">
				<input name="text2" type="text" id="proid" size="30" value="<?= $pro ?>" />
			</div>

			<div class="line" style="margin-top: 4px;">
				<div style="width:25%; float:left; text-align:right;">ชื่อโปรโมชั่น :&nbsp;</div>
				<div style="width:25%; float:left;">
					<input name="text2" type="text" id="proname" size="53" />
				</div>
			</div>

			<div class="line">
				<div style="width:25%; float:left; text-align:right;">วันที่เริ่ม :&nbsp;</div>
				<div style="width:18%; float:left;">
					<input type="text" id="dat" class="datepicker" size="15" readonly="readonly" value="<?= $dat ?>" />
				</div>
				<!--	<div style="width:3%; float:left;">
        		<img src="calendar/calendar.jpg" width="15" onclick="calendar('<?= date('m') ?>','<?= date('Y') ?>','cl','dat')" style="margin-top:5px; cursor:pointer;"  />        
        	<div id="cl" class="calendar" style="width:152px; height:auto; display:none;"></div>
        </div> -->
				<div style="width:10%; float:left; text-align:right; margin-left:2%">วันที่หมด :&nbsp;</div>
				<div style="width:18%; float:left;">
					<input type="text" id="dat1" class="datepicker-end" size="15" readonly="readonly" value="<?= $dat ?>" />
				</div>
				<!--	<div style="width:3%; float:left;">
        		<img src="calendar/calendar.jpg" width="15" onclick="calendar('<?= date('m') ?>','<?= date('Y') ?>','cl1','dat1')" style="margin-top:5px; cursor:pointer;"  />        
        	<div id="cl1" class="calendar" style="width:152px; height:auto; display:none;"></div>
        </div> -->
			</div>

			<div class="line">
				<?php
				if ($_SESSION['company_data'] == "1") {
				?>
					<div style="width:25%; float:left; text-align:right;">สาขา :&nbsp;</div>
					<div style="width:18%; float:left;">
						<input type="text" id="branch_name" size="15" readonly="readonly" value="" />
					</div>
				<?php
				}
				?>
			</div>

			<div class="line" style="height:270px;">
				<div style="width:25%; float:left; text-align:right;">รายละเอียด:&nbsp;</div>
				<div style="width:20%; float:left;">
					<textarea name="textarea" cols="50" rows="15" id="mem"></textarea>
				</div>
			</div>

			<div class="line"> </div>

			<div class="line">
				<div style="width:25%; float:left; text-align:right;">เบอร์โทร :&nbsp;</div>
				<div style="width:25%; float:left;"><input type="text" id="tel" size="15" /></div>

			</div>

			<!-- <div style="width:78%; text-align:right; float:left;">
      <input name="button" type="button" style="height:25px; font-size:13px; line-height:25px;"  onclick="addpromotion('promotion/promotion_add.php','home')" value="      บันทึก       " />
      <input name="button" type="button" style="height:25px; font-size:13px; line-height:25px;" onclick="loadmodule('home','promotion/promotion.php')" value=" รายการใหม่ "/>
    </div>



   
   </div> -->
		</div>