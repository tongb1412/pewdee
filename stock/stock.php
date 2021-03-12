<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- Tabs -->
<div class="relativeWrap">
	<div class="widget widget-tabs widget-tabs-double-2 widget-tabs-responsive">

		<!-- Tabs Heading -->
		<div class="widget-head">
			<ul>
				<li class="active"><a class="glyphicons list" href="#tabAll" onclick="stockFunc()" data-toggle="tab"><i></i><span>รายการทั้งหมด</span></a></li>
				<?php
				session_start();
				// if ($_SESSION['branch_id'] == "07" || $_SESSION['branch_id'] == "00" ) {
				?>
				<li><a class="glyphicons plus" href="#tabAccount" onclick="loadmodule('content-stock','stock/druge_new_from.php','')" data-toggle="tab"><i></i><span>เพิ่มรายการใหม่</span></a></li>
				<?php
				// }
				?>
				<li><a class="glyphicons down_arrow" href="#tabPayments" onclick="loadmodule('content-stock','stock/instock.php','')" data-toggle="tab"><i></i><span>รับเข้า</span></a></li>
				<li><a class="glyphicons edit" href="#tabSupport" onclick="loadmodule('content-stock','stock/cutstock.php','')" data-toggle="tab"><i></i><span>ปรับสต็อค</span></a></li>
			</ul>
		</div>
		<!-- // Tabs Heading END -->

		<div class="widget-body">
			<div class="tab-content">

				<!-- Tab content -->
				<div id="tabAll" class="tab-pane active widget-body-regular">

					<!-- <div style="width:99%; margin:auto; margin-top:30px; height:20px;">
						<div style="width:20%; font-size:16px; font-weight:bold; float:left;line-height:20px;">
							<img src="images/icon/group.png" align="absmiddle" />&nbsp;คลังยา
						</div>
						<div style="width:80%; text-align:right; float:left;line-height:20px;">
							<input type="button" value="  รายการทั้งหมด  " onclick="loadmodule('home','stock/stock.php','') " style="height:25px; font-size:13px; line-height:25px;" />
							<?php
							// session_start();
							// if ($_SESSION['branch_id'] == "07" || $_SESSION['branch_id'] == "00") {
							?>
								<input type="button" value="  เพิ่มรายการใหม่ " onclick="swabtab(4,6,'stock/druge_new_from.php','content','')" style="height:25px; font-size:13px; line-height:25px; " />
							<?php
							// }
							?>
							<!--	<input type="button" value="  สั่งซื้อ  " onclick="swabtab(2,5,'','content','')" style="height:25px; font-size:13px; line-height:25px;" />-->
					<!-- <input type="button" value="  รับเข้า  " onclick="swabtab(3,6,'stock/instock.php','content','')" style="height:25px; font-size:13px; line-height:25px;" /> -->
					<!-- <input type="button" value="  ปรับสต็อค  " onclick="swabtab(6,6,'stock/cutstock.php','content','')" style="height:25px; font-size:13px; line-height:25px;" /> -->
					<div id="content-stock" style=" width:100%; margin-top:5px; text-align:center; height:auto;">

						<?php  
						// require("druge.php");	 
						?>
					</div>
					<!-- Widget -->
					<div class="widget">
						<div class="widget-body">
							<!-- Table -->
							<table class="table table-hover" id="stock_druge_table">
								<!-- Table heading -->
								<thead>
									<tr>
										<th>รหัส</th>
										<th>ชื่อยา</th>
										<th>กลุ่มยา</th>
										<th>คงเหลือ (ทั้งหมด)</th>
										<th>คงเหลือ (เฉพาะสาขา)</th>
										<th>หน่วย</th>
									</tr>
								</thead>
								<!-- // Table heading END -->
							</table>
							<!-- // Table END -->
						</div>
					</div>
					<!-- // Widget END -->

				</div>
			</div>
		</div>
		<!-- // Tab content END -->
	</div>
</div>
<!-- // Tabs END -->
