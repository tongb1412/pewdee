<?
include('../class/config.php');
?>

	<!-- <div id="t_main" class="tmain" style="width:100%; height:495px; overflow:hidden;"> -->
  <div id="t_main_monthly" class="tmain h-100">
		<form action="Monthly_report/report1_new.php" method="post" target="_blank">
			<div class="littleDD" style="font-size:14px; font-weight:bold;" >บัญชีแพทย์</div>

			<?php
				$css_width = "330px";
				$margin_left = "";
				if ($_SESSION['company_data'] == "1") {
					$css_width = "150px";
					$margin_left = "margin-left:55px;"; 
				}
			?>

			<div style="width:95%; margin-top:10px; margin-left:20px; text-align:left; height:15%;  border:<?=$tabcolor?> 1px solid; background-color: #FFD1A4;">
				<div class="line" style="margin-top:5px;">
					<div style="float:left; margin-top:10px; margin-left:150px; text-align:right; line-height:20px; font-size:14px;">ระหว่างวันที่ :</div>
					<div style="float:left; margin-top:10px; margin-left:10px;">&nbsp;<input type="text" id="sdate" name="sdate" size="13" maxlength="10"  value="<?=$dat?>" /></div>
					<div style="float:left; margin-top:10px; margin-left:10px;">
						<img src="calendar/calendar.jpg" width="15" onclick="calendar('<?=date('m')?>','<?=date('Y')?>','cl','sdate','cl1')" style="margin-top:5px; cursor:pointer;" />
						<div id="cl" class="calendar" style="width:152px; height:auto; display:none;"></div>
					</div>
					<div style="float:left; margin-top:10px; margin-left:20px; text-align:right; line-height:20px; font-size:14px;">ถึง : </div>
					<div style="float:left; margin-top:10px; margin-left:10px;">&nbsp;<input type="text" id="edate" name="edate" size="13" maxlength="10"  value="<?=$dat?>" /></div>
					<div style="float:left; margin-top:10px; margin-left:10px;">
						<img src="calendar/calendar.jpg" width="15" onclick="calendar('<?=date('m')?>','<?=date('Y')?>','cl1','edate','cl')" style="margin-top:5px; cursor:pointer;" />
						<div id="cl1" class="calendar" style="width:152px; height:auto; display:none;"></div>
					</div>
				</div>
				<div style="width:100%; height:100px;">
					<div class="line" style="margin-top:10px; height:50px; font-size:16px;">
						<?php 
							if ($_SESSION['company_data'] == "1") {
						?>
						<div style="width:10%; float:left; margin-top:16px; text-align:right; line-height:20px;margin-left:19.5%;font-size:14px;">เลือกสาขา : </div>
					
						<div style="width:20%; float:left; margin-top:16px;  ">&nbsp;&nbsp;
						<?php
							$sql = "select branchid,branchname from tb_branch ";
						$result = mysql_query($sql) or die("Error Query [".$sql."]"); ?>
						<select name="branchid" id="branchid" style="width:117px;height: 21px;">
							<option value="00">ทั้งหมด</option>
							<?php while ($rs=mysql_fetch_array($result)) {  ?>
							<option value="<?= $rs['branchid'] ?>"> <?= $rs['branchname'] ?></option>
							<?php } ?>
						</select>
						</div>
            <div style="width:25%; float:left; margin-top:17px;"><input type="submit" value="แสดงบัญชีแพทย์" /></div>
						<?php
						} else { 
							echo " <input type='hidden' id='branchid' value ='' />";
						}
						?>

            
					</div>
				</div>
				
			</div>
		</form>
	</div>
