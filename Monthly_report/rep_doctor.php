<?
include('../class/config.php');
?>
<input type="hidden" id="typ" value="">
<input type="hidden" id="id" value="">
<div id="t_main" class="tmain" style="width:100%; height:495px; overflow:hidden;">
	<div class="littleDD" style="font-size:14px; font-weight:bold;">บัญชีแพทย์</div>
	<div style="width:95%; margin-top:10px; margin-left:20px; text-align:left; height:10%; background-color:#FFCC99;  border:<?= $tabcolor ?> 1px solid;">
		<div class="line" style="margin-top:5px; width:75%;">
			<div style="width:10%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:14px;">วันที่ : </div>
			<div style="width:19%; float:left; margin-top:10px;">&nbsp;<input type="text" id="sdate" size="8.5" maxlength="10" readonly="readonly" value="<?= $dat ?>" /></div>
			<div style="width:3%; float:left; margin-top:10px;">
				<img src="calendar/calendar.jpg" width="15" onclick="calendar('<?= date('m') ?>','<?= date('Y') ?>','cl','sdate','cl1')" style="margin-top:5px; cursor:pointer;" />
				<div id="cl" class="calendar" style="width:152px; height:auto; display:none;"></div>
			</div>


			<div style="width:7%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:14px; ">ถึง : </div>
			<div style="width:19%; float:left; margin-top:10px;">&nbsp;<input type="text" id="edate" size="8.5" maxlength="10" readonly="readonly" value="<?= $dat ?>" /></div>
			<div style="width:3%; float:left; margin-top:10px;">
				<img src="calendar/calendar.jpg" width="15" onclick="calendar('<?= date('m') ?>','<?= date('Y') ?>','cl1','edate','cl')" style="margin-top:5px; cursor:pointer;" />
				<div id="cl1" class="calendar" style="width:152px; height:auto; display:none;"></div>
			</div>

		</div>

		<div style="width:25%; float:left;margin-top:10px;">
			<input name="button" type="button" style="font-size:14px; font-weight:bold; height:28px;" onclick="repDoctor('Monthly_report/rep_doctor_start.php','d_list')" value="เตรียมข้อมูล" />


		</div>
	</div>
	<div style="width: auto; margin-top:5px; margin-left:20px; text-align:left; height:80%; border:<?= $tabcolor ?> 1px solid;">



		<div id="d_list" style=" width: 98%; margin-top:5px;  text-align:center; height:310px; ">






		</div>

	</div>
</div>