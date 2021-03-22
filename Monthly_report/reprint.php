<?
include('../class/config.php');

?>
<!-- <div id="t_main" class="tmain" style="width:100%; height:495px; overflow:hidden;"> -->
<div id="t_main_monthly" class="tmain h-100">
	<div class="littleDD" style="font-size:14px; font-weight:bold;">Reprint</div>
	<div style="width:95%; margin-top:10px; margin-left:20px; text-align:left; height:35%;  border:<?= $tabcolor ?> 1px solid; background-color: #FFD1A4;">

		<div class="line" style="margin-top:5px; width:80%; margin-bottom:2%">

			<div style="width:30%; float:left; margin-top:10px; text-align:right; line-height:20px; font-size:14px;">เลขที่บิล :&nbsp;</div>
			<div style="width:40%; float:left; margin-top:10px;">&nbsp;<input type="text" id="billno" size="13" style="width: 150px" /></div>



			<div style="width:30%; float:left; margin-top:10px;">&nbsp;&nbsp;
				<input type="button" value="  พิมพ์ใบเสร็จ  " style="font-size:14px; font-weight:bold; height:30px;" onclick="preprint1()" />
			</div>


		</div>

		<div style="width:100%; height:100px;">
			<div class="line" style="margin-top:10px; height:30px; font-size:14px;">
				<div style="width:25%; float:left; text-align:right; line-height:30px; height:30px;">ผู้พิมพ์ : &nbsp;</div>
				<div style="width:75%; float:left; line-height:30px; height:30px;">
					<select id="empid" style="width:330px; font-size:14px;">
						<?
		$sql = "select * from tb_staff where typ<>'D' order by fname  ";
		$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
		while($rs=mysql_fetch_array($result)){
		?>
						<option value="<?= $rs['staffid'] ?>"><?= $rs['pname'] . $rs['fname'] . '    ' . $rs['lname']  ?></option>
						<? } ?>
					</select>&nbsp;
				</div>
			</div>

			<div class="line" style="margin-top:10px; height:30px; font-size:14px;">
				<div style="width:25%; float:left; text-align:right; line-height:30px; height:30px;">หมายเหตุ : &nbsp;</div>
				<div style="width:75%; float:left; line-height:30px; height:30px;">
					<input type="text" id="pmem" size="50" />&nbsp;

				</div>
			</div>



		</div>



	</div>