<?
include('../class/config.php');
?>

	<div id="t_main" class="tmain" style="width:100%; height:495px; overflow:hidden;">
		<form action="Monthly_report/report2.php" method="post" target="_blank">
			<div class="littleDD" style="font-size:14px; font-weight:bold;" >รายงานการใช้ทรีทเม้นท์</div>

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
					<div style="float:left; margin-top:10px; margin-left:20px; text-align:right; line-height:20px; font-size:14px; font-weight:bold;">ถึง : </div>
					<div style="float:left; margin-top:10px; margin-left:10px;">&nbsp;<input type="text" id="edate" name="edate" size="13" maxlength="10"  value="<?=$dat?>" /></div>
					<div style="float:left; margin-top:10px; margin-left:10px;">
						<img src="calendar/calendar.jpg" width="15" onclick="calendar('<?=date('m')?>','<?=date('Y')?>','cl1','edate','cl')" style="margin-top:5px; cursor:pointer;" />
						<div id="cl1" class="calendar" style="width:152px; height:auto; display:none;"></div>
					</div>
				</div>
				<div style="width:100%; height:100px;">
					<div class="line" style="margin-top:10px; height:50px; font-size:16px;">
						<div style="margin-left:144px; float:left; text-align:right; line-height:50px; height:50px; font-size:14px;">แพทย์ผู้ตรวจ :&nbsp;</div>
						<div style="margin-left:9px; float:left; line-height:50px; height:50px; padding-top:15px;">
							<select id="sempid" name="sempid" style="width:<?=$css_width?>; font-size:16px;">
								<option value="">ทั้งหมด</option>
								<?
									$sql = "select * from tb_staff where eshow='Y' and typ='D' order by CONVERT(fname USING tis620)";
									$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
									while($rs=mysql_fetch_array($result)){
								?>
										<option value="<?=$rs['staffid']?>"><?=$rs['fname'].' '.$rs['lname']  ?></option>
								<? } ?>		
							</select>
						</div>

						<?php 
							if ($_SESSION['company_data'] == "1") {
						?>
						<div style="width:10%; float:left; margin-top:16px; text-align:right; line-height:20px;margin-left:10px;font-size:14px;">เลือกสาขา : </div>
					
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
						<?php
						} else { 
							echo " <input type='hidden' id='branchid' value ='' />";
						}
						?>
					</div>
				</div>
				<div style="width:25%; float:left;margin-top:10px;"><input type="submit" value="แสดงรายงาน" /></div>
			</div>
		</form>
	</div>
