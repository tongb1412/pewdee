<?
session_start();
//;

?>
<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> -->
<!-- <html xmlns="http://www.w3.org/1999/xhtml"> -->
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<!-- <script type="text/javascript" src="js/jquery.js"></script> -->
	<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
	<!-- <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script> -->
	<script type="text/javascript" src="js/interface.js"></script>
	<script type="text/javascript" src="js/myAjax.js"></script>
	<script type="text/javascript" src="js/global.js"></script>
	<script type="text/javascript" src="calendar/calendar.js"></script>
	<!-- <script type="text/javascript" src="js/bootstrap.js"></script> -->



	<link href="calendar/calendar.css" rel="stylesheet" type="text/css" />
	<!-- <link href="css/bootstrap.css" rel="stylesheet" type="text/css" /> -->

	<!-- Theme CSS -->
	<link rel="stylesheet" href="assets/css/admin/module.admin.stylesheet-complete.min.css" />

	<!-- Custom CSS -->
	<link href="css/menu_style.css" rel="stylesheet" type="text/css" />
	<link href="css/index.css" rel="stylesheet" type="text/css" />

	<!-- Theme script -->
	<script src="assets/plugins/core_ajaxify_loadscript/script.min.js?v=v1.0.0-rc1&amp;sv=v0.0.1.2"></script>
	<script>
		var App = {};
	</script>

	<script data-id="App.Scripts">
		App.Scripts = {

			/* CORE scripts always load first; */
			core: [
				// 'assets/library/jquery/jquery.min.js?v=v1.0.0-rc1&sv=v0.0.1.2', 
				'assets/library/modernizr/modernizr.js?v=v1.0.0-rc1&sv=v0.0.1.2'
			],

			/* PLUGINS_DEPENDENCY always load after CORE but before PLUGINS; */
			plugins_dependency: [
				'assets/library/bootstrap/js/bootstrap.min.js?v=v1.0.0-rc1&sv=v0.0.1.2',
				'assets/library/jquery/jquery-migrate.min.js?v=v1.0.0-rc1&sv=v0.0.1.2'
			],

			/* PLUGINS always load after CORE and PLUGINS_DEPENDENCY, but before the BUNDLE / initialization scripts; */
			plugins: [
				'assets/plugins/core_ajaxify_davis/davis.min.js?v=v1.0.0-rc1&sv=v0.0.1.2',
				'assets/plugins/core_ajaxify_lazyjaxdavis/jquery.lazyjaxdavis.min.js?v=v1.0.0-rc1&sv=v0.0.1.2',
				'assets/plugins/core_preload/pace.min.js?v=v1.0.0-rc1&sv=v0.0.1.2',
				'assets/plugins/core_nicescroll/jquery.nicescroll.min.js?v=v1.0.0-rc1&sv=v0.0.1.2',
				'assets/plugins/core_breakpoints/breakpoints.js?v=v1.0.0-rc1&sv=v0.0.1.2',
				'assets/plugins/ui_modals/bootbox.min.js?v=v1.0.0-rc1&sv=v0.0.1.2',
				'assets/plugins/admin_notifications_gritter/js/jquery.gritter.min.js?v=v1.0.0-rc1',
				'assets/plugins/forms_editors_wysihtml5/js/wysihtml5-0.3.0_rc2.min.js?v=v1.0.0-rc1&sv=v0.0.1.2',
				'assets/plugins/forms_editors_wysihtml5/js/bootstrap-wysihtml5-0.0.2.js?v=v1.0.0-rc1&sv=v0.0.1.2',
				'assets/plugins/forms_wizards/jquery.bootstrap.wizard.js?v=v1.0.0-rc1&sv=v0.0.1.2',
				'assets/plugins/forms_elements_bootstrap-select/js/bootstrap-select.js?v=v1.0.0-rc1&sv=v0.0.1.2',
				'assets/plugins/forms_elements_bootstrap-datepicker/js/bootstrap-datepicker.js?v=v1.0.0-rc1&sv=v0.0.1.2',
				'assets/plugins/core_less-js/less.min.js?v=v1.0.0-rc1&sv=v0.0.1.2',
				'assets/plugins/charts_flot/excanvas.js?v=v1.0.0-rc1&sv=v0.0.1.2',
				'assets/plugins/core_browser/ie/ie.prototype.polyfill.js?v=v1.0.0-rc1&sv=v0.0.1.2'
			],

			/* The initialization scripts always load last and are automatically and dynamically loaded when AJAX navigation is enabled; */
			bundle: [
				'assets/components/core_ajaxify/ajaxify.init.js?v=v1.0.0-rc1&sv=v0.0.1.2',
				'assets/components/core_preload/preload.pace.init.js?v=v1.0.0-rc1&sv=v0.0.1.2',
				'assets/components/forms_elements_fuelux-checkbox/fuelux-checkbox.init.js?v=v1.0.0-rc1&sv=v0.0.1.2',
				'assets/components/ui_modals/modals.init.js?v=v1.0.0-rc1&sv=v0.0.1.2',
				'assets/components/admin_notifications_gritter/gritter.init.js?v=v1.0.0-rc1&sv=v0.0.1.2',
				'assets/components/forms_editors_wysihtml5/wysihtml5.init.js?v=v1.0.0-rc1&sv=v0.0.1.2',
				'assets/components/forms_wizards/form-wizards.init.js?v=v1.0.0-rc1&sv=v0.0.1.2',
				'assets/components/menus/sidebar.main.init.js?v=v1.0.0-rc1',
				'assets/components/menus/sidebar.collapse.init.js?v=v1.0.0-rc1',
				'assets/components/forms_elements_bootstrap-select/bootstrap-select.init.js?v=v1.0.0-rc1&sv=v0.0.1.2',
				'assets/components/forms_elements_bootstrap-datepicker/bootstrap-datepicker.init.js?v=v1.0.0-rc1&sv=v0.0.1.2',
				'assets/components/core/core.init.js?v=v1.0.0-rc1'
			]
		};
	</script>

	<script>
		$script(App.Scripts.core, 'core');

		$script.ready(['core'], function() {
			$script(App.Scripts.plugins_dependency, 'plugins_dependency');
		});
		$script.ready(['core', 'plugins_dependency'], function() {
			$script(App.Scripts.plugins, 'plugins');
		});
		$script.ready(['core', 'plugins_dependency', 'plugins'], function() {
			$script(App.Scripts.bundle, 'bundle');
		});
	</script>
	<script>
		if ( /*@cc_on!@*/ false && document.documentMode === 10) {
			document.documentElement.className += ' ie ie10';
		}
	</script>

	<title>Pewdee Clinic System</title>



</head>

<body onload="lll();" class="scripts-async">


	<div id="dialog-overlay"></div>
	<div id="dialog-box"></div>




	<div id="loading" style="position:fixed; right:0px; top:0px; z-index:1000; display:none;">
		<img src="images/loading.gif" width="50" height="50" />
	</div>
	<div id="bg" style=" width:100%; height:100%; position:fixed; left:0px; bottom:0px; z-index:999; display:none; background:#CCCCCC; filter:alpha(opacity=50); opacity: 0.5;
-moz-opacity:0.5; ">

	</div>
	<div id="sd" style="width:500px; height:200px; position:fixed; margin:auto;z-index:1000;display:none; margin-top:250px; background:#FFFFFF; border:#666666 3px solid;">


	</div>
	<div id="login_zone" style="width:500px; height:200px; position:fixed; margin:auto;z-index:1000;display:none; margin-top:150px; background:#FFFFFF; border:#666666 3px solid;">
		<div style="width:100%; float:left; margin-top:50px; float:20px; font-weight:bold;">
			<div class="line">
				<div style="width:40%; float:left; text-align:right;">Username :&nbsp;</div>
				<div style="width:60%; float:left;"><input type="text" id="username" size="30" /></div>

			</div>
			<div class="line" style="margin-top:20px;">
				<div style="width:40%; float:left; text-align:right;">Password :&nbsp;</div>
				<div style="width:60%; float:left;"><input type="password" id="password" size="30" /></div>

			</div>
			<div class="line" style="margin-top:20px;">
				<div style="width:40%; float:left; text-align:right;">&nbsp;</div>
				<div style="width:60%; float:left;"><input type="button" value="Login" onclick="login()" id="login_btn" /></div>
			</div>
		</div>
	</div>

	<!-- <div class="dock" id="dock" style="z-index:888; ">
		<div style="width:auto; padding-left:50px;float:left; font-weight:bold; font-size:18px; text-align:left; line-height:40px; ">
			!!!
		</div>

		<div class="dock-container">
			<div id="menu1" style="float:left; width:auto; cursor:pointer; display:; ">
				<a class="dock-item" href="javascript: loadmodule('home','register/register.php','')">
					<span></span><img src="images/register.png" alt="home" />
				</a>
			</div>
			<div id="menu2" style="float:left; width:auto; cursor:pointer; display:;">
				<a class="dock-item" href="javascript: loadmodule('home','doctor/doctor.php','')"><span></span><img src="images/doctor.png" alt="doctor" /></a>
			</div>

			<div id="menu5" style="float:left; width:auto; cursor:pointer; display:;">
				<a class="dock-item" href="javascript: loadmodule('home','daily_report/report.php','')"><span></span><img src="images/report.png" alt="daily_report" /></a>
			</div>

			<div id="menu7" style="float:left; width:auto; cursor:pointer; display:;">
				<a class="dock-item" href="javascript: loadmodule('home','promotion/promotion.php','') "><span></span><img src="images/promotion.png" alt="promotion" /></a>
			</div>

			<div id="menu8" style="float:left; width:auto; cursor:pointer; display:; ">
				<a class="dock-item" href="javascript: loadmodule('home','stock/stock_show.php','') "><span></span><img src="images/addstock.png" alt="addstock" /></a>
			</div>
			<div id="menu6" style="float:left; width:auto; cursor:pointer; display:;">
				<a class="dock-item" href="javascript: loadmodule('home','Monthly_report/report.php','')"><span></span><img src="images/Peport_M.png" alt="Monthly_report" /></a>
			</div>

			<div id="menu3" style="float:left; width:auto; cursor:pointer;display:; ">
				<a class="dock-item" href="javascript: loadmodule('home','stock/stock.php','') "><span></span><img src="images/stock1.png" alt="stock" /></a>
			</div>

			<div id="menu4" style="float:left; width:auto; cursor:pointer; display:;">
				<a class="dock-item" href="javascript: loadmodule('home','setting/setting.php','') "><span></span><img src="images/setting.png" alt="setting" /></a>
			</div>
		</div>
		<div style="width:auto; padding-right:20px;float:right; font-weight:bold; font-size:16px; text-align:right; line-height:40px; ">
			!!
		</div>
	</div> -->

	<!-- Sidebar Left -->
	<div class="modal fade left" id="sidebar-left" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;&nbsp;เมนูการใช้งาน</h4>
				</div>
				<div class="modal-body">
					<!-- Sidebar Menu -->
					<ul class="menu list-unstyled">

						<li>
							<a href="javascript: loadmodule('home','register/register.php','')" class="btn btn-block btn-default btn-lg">
								<img src="images/register.png" alt="home" class="side-menu-icon" />
								<span>&nbsp;เวชระเบียน</span>
							</a>
						</li>

						<li>
							<a href="javascript: loadmodule('home','doctor/doctor.php','')" class="btn btn-block btn-default btn-lg">
								<img src="images/doctor.png" alt="home" class="side-menu-icon" />
								<span>&nbsp;ตรวจรักษา</span>
							</a>
						</li>

						<li class="hasSubmenu btn btn-block btn-default btn-lg" id="daily_report_side_menu">
							<div id="daily_report_side_menu_btn">
								<img src="images/report.png" alt="home" class="side-menu-icon" />
								<span>&nbsp;รายงานประจำวัน</span>
								<i class="fa fa-caret-down" aria-hidden="true"></i>
							</div>
							<ul class="collapse sub-menu" id="sub-menu-daily-report-1">
								<li>
									<a class="btn btn-block btn-default btn-lg" data-toggle="collapse" href="#sub-menu-daily-report-1-sub-1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
										<span>รายงานรายได้</span>
										<i class="fa fa-caret-down" aria-hidden="true"></i>
									</a>
									<ul class="collapse" id="sub-menu-daily-report-1-sub-1">
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','daily_report/repayment.php','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานรายได้ทั้งหมด</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','daily_report/rear.php','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานรายได้จากค้างชำระ</a>
										</div>

										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','daily_report/reapayment.php','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานคนไข้ค้างชำระ</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','daily_report/recredit.php','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานรายได้แยกตามบัตรเครดิต</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','daily_report/resalement.php','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานรายได้การขายทรีทเมนท์</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','daily_report/resalecourse.php','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานรายได้การขายคอร์ส</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','daily_report/resalepg.php','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานรายได้การขายแพ็คเกจ</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','daily_report/reeuser.php','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานรายได้ผู้ทำ</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','daily_report/repatient.php','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานคนไข้ประจำวัน</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','daily_report/rediscount.php','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานส่วนลด 100%</a>
										</div>
									</ul>
								</li>
								<li>
									<a class="btn btn-block btn-default btn-lg" data-toggle="collapse" href="#sub-menu-daily-report-1-sub-2" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
										<span>รายงานรวม</span>
										<i class="fa fa-caret-down" aria-hidden="true"></i>
									</a>
									<ul class="collapse" id="sub-menu-daily-report-1-sub-2">
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/retotalsalecourse.php	','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานขายคอร์สรวม</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/retotalsalepg.php	','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานขายแพ็คเกจรวม</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/retotaldrugerec.php ','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานการจ่ายยารวม</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/rediscounttotal.php ','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานส่วนลดทั้งหมด</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/rediscount.php ','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานส่วนลด100%</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/repKupong.php ','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานคูปอง</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/repCbil.php ','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานยกเลิกบิล</a>
										</div>
									</ul>
								</li>
								<li>
									<a class="btn btn-block btn-default btn-lg" data-toggle="collapse" href="#sub-menu-daily-report-1-sub-3" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
										<span>รายงานคนไข้</span>
										<i class="fa fa-caret-down" aria-hidden="true"></i>
									</a>
									<ul class="collapse" id="sub-menu-daily-report-1-sub-3">
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/repatient.php','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานคนไข้</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/renewpatient.php','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานคนไข้ใหม่</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/repatientcancle.php','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานคนไข้ยกเลิก</a>
										</div>
									</ul>
								</li>
								<li>
									<a class="btn btn-block btn-default btn-lg" data-toggle="collapse" href="#sub-menu-daily-report-1-sub-4" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
										<span>รายงานเกี่ยวกับยา</span>
										<i class="fa fa-caret-down" aria-hidden="true"></i>
									</a>
									<ul class="collapse" id="sub-menu-daily-report-1-sub-4">
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','daily_report/redrugerec.php','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานการจ่ายยาประจำวัน</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/rebuydruge.php','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานยาถึงจุดสั่งซื้อ</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/reexpiredruge.php','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานยาใกล้หมดอายุ</a>
										</div>

										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/stockcard.php ','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;Stock Card</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','daily_report/drug_out.php','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;นำยาออกนอกระบบ</a>
										</div>
									</ul>
								</li>
								<li>
									<a class="btn btn-block btn-default btn-lg" data-toggle="collapse" href="#sub-menu-daily-report-1-sub-5" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
										<span>อื่น ๆ</span>
										<i class="fa fa-caret-down" aria-hidden="true"></i>
									</a>
									<ul class="collapse" id="sub-menu-daily-report-1-sub-5">
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/rep_df.php ','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;บัญชีแพทย์</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/rep_treatment.php ','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานการใช้ทรีทเม้นท์</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','daily_report/patient_out.php','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;คนไข้นอกระบบ</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','setting/costs.php','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;ค่าใช้จ่าย</a>
										</div>
										<div class="setting_menu_list" style="display:none;">
											<a href="javascript: ajaxLoad('post','Monthly_report/restockdruge.php','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;จำนวนยาคงเหลือ</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','daily_report/totalprice.php','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;ลงยอดเงินประจำวัน</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','daily_report/totalcash.php','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;ลงยอดเงินสดประจำวัน</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','daily_report/dtime.php','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;ลงเวลาแพทย์</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/retotalprice.php','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานลงยอดเงิน</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/retotalcash.php','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานยอดเงินสด</a>
										</div>
									</ul>
								</li>
							</ul>
						</li>

						<li>
							<a href="javascript: loadmodule('home','promotion/promotion.php','')" class="btn btn-block btn-default btn-lg">
								<img src="images/promotion.png" alt="home" class="side-menu-icon" />
								<span>&nbsp;&nbsp;โปรโมชั่น</span>
							</a>
						</li>

						<li>
							<a href="javascript: loadmodule('home','stock/stock_show.php','')" class="btn btn-block btn-default btn-lg">
								<img src="images/addstock.png" alt="home" class="side-menu-icon" />
								<span>&nbsp;&nbsp;ยาคงคลัง</span>
							</a>
						</li>

						<li class="hasSubmenu btn btn-block btn-default btn-lg" id="monthly_report">
							<!-- <a href="javascript: loadmodule('home','Monthly_report/report.php','')" class="btn btn-block btn-default btn-lg">
								<img src="images/Peport_M.png" alt="home" class="side-menu-icon" />
								<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;รายงานประจำเดือน</span>
							</a> -->
							<div id="monthly_report_side_menu_btn">
								<img src="images/Peport_M.png" alt="home" class="side-menu-icon" />
								<span>&nbsp;&nbsp;รายงานประจำเดือน</span>
								<i class="fa fa-caret-down" aria-hidden="true"></i>
							</div>
							<ul class="collapse sub-menu" id="sub-menu-monthly-report-1">

								<li>
									<a class="btn btn-block btn-default btn-lg" data-toggle="collapse" href="#sub-menu-monthly-report-1-sub-1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
										<span>รายงานคนไข้</span>
										<i class="fa fa-caret-down" aria-hidden="true"></i>
									</a>
									<ul class="collapse" id="sub-menu-monthly-report-1-sub-1">
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/repatient.php','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานคนไข้</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/renewpatient.php','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานคนไข้ใหม่</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/repatientcancle.php','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานคนไข้ยกเลิก</a>
										</div>
									</ul>
								</li>

								<li>
									<a class="btn btn-block btn-default btn-lg" data-toggle="collapse" href="#sub-menu-monthly-report-1-sub-2" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
										<span>รายงานรายได้</span>
										<i class="fa fa-caret-down" aria-hidden="true"></i>
									</a>
									<ul class="collapse" id="sub-menu-monthly-report-1-sub-2">
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/repayment.php','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานรายได้ทั้งหมด</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/rear.php','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานรายได้จากค้างชำระ</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/retypepay.php','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานแยกตามการชำระ</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/recredit.php','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานแยกตามบัตรเคดิต</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/reapayment.php','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานคนไข้ค้างชำระ</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/resalement.php','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานรายได้การขายทรีทเมนท์</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/resalecourse.php','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานรายได้การขายคอร์ส</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/resalepg.php','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานรายได้การขายแพ็คเกจ</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/reeuser.php','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานรายได้ผู้ทำ</a>
										</div>
										<div class="setting_menu_list" style="display:none">
											<a href="javascript: ajaxLoad('post','daily_report/resumdr.php','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานรายได้ตามแพทย์</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/rep_doctor.php','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;บัญชีแพทย์</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/retotalprice.php','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานสรุปบันทึกยอดรายวัน</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/retotalcash.php','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานสรุปบันทึกยอดสด</a>
										</div>
									</ul>
								</li>

								<li>
									<a class="btn btn-block btn-default btn-lg" data-toggle="collapse" href="#sub-menu-monthly-report-1-sub-3" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
										<span>รายงานยา</span>
										<i class="fa fa-caret-down" aria-hidden="true"></i>
									</a>
									<ul class="collapse" id="sub-menu-monthly-report-1-sub-3">
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/restockdruge.php	','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานข้อมูลยาทั้งหมด</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/rebuydruge.php	','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานยาถึงจุดสั่งซื้อ</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/reexpiredruge.php','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานยาใกล้หมดอายุ</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/redrugerec.php	','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานการจ่ายยา</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/redrugeinstock.php	','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานการรับยาเข้าสต็อค</a>
										</div>

									</ul>
								</li>


								<li>
									<a class="btn btn-block btn-default btn-lg" data-toggle="collapse" href="#sub-menu-monthly-report-1-sub-4" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
										<span>รายงานรวม</span>
										<i class="fa fa-caret-down" aria-hidden="true"></i>
									</a>
									<ul class="collapse" id="sub-menu-monthly-report-1-sub-4">
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/retotalsalement.php	','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานขายทรีทเม้นท์รวม</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/retotalsalecourse.php	','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานขายคอร์สรวม</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/retotalsalepg.php	','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานขายแพ็คเกจรวม</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/retotaldrugerec.php ','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานการจ่ายยารวม</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/rediscounttotal.php ','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานส่วนลดทั้งหมด</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/rediscount.php ','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานส่วนลด100%</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/repKupong.php ','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานคูปอง</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/repCbil.php ','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานยกเลิกบิล</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/repStock.php ','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;รายงานยาคงคลัง</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/rep_df.php ','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;บัญชีแพทย์</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/rep_df_new.php ','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;บัญชีแพทย์ ใหม่</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/stockcard.php ','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;Stock Card</a>
										</div>
										<div class="setting_menu_list">
											<a href="javascript: ajaxLoad('post','Monthly_report/reprint.php ','','reportpage')"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;&nbsp;Reprint</a>
										</div>
									</ul>
								</li>

							</ul>
						</li>

						<li>
							<a href="javascript: loadmodule('home','stock/stock.php','')" class="btn btn-block btn-default btn-lg">
								<img src="images/stock1.png" alt="home" class="side-menu-icon" />
								<span>&nbsp;&nbsp;คลังยา</span>
							</a>
						</li>

						<li>
							<a href="javascript: loadmodule('home','setting/setting.php','')" class="btn btn-block btn-default btn-lg">
								<img src="images/setting.png" alt="home" class="side-menu-icon" />
								<span>&nbsp;&nbsp;ตั้งค่า</span>
							</a>
						</li>

					</ul>
					<!-- // Sidebar Menu END -->
				</div>
			</div>
		</div>
	</div>

	<div id="content">
		<div class="navbar hidden-print main navbar-default" role="navigation">
			<div class="user-action user-action-btn-navbar pull-right">
				<button class="btn btn-sm btn-navbar btn-inverse btn-stroke hidden-lg hidden-md"><i class="fa fa-bars fa-2x"></i></button>
			</div>
			<a href="../index.php" class="logo" id="title-header">
				<!-- <img src="../assets/images/logo/logo.jpg" width="32" alt="SMART" /> -->
				<span class="hidden-xs hidden-sm inline-block"><span>Pewdee Clinic System</span>pro</span>
			</a>
		</div>
		<!-- // END navbar -->
		<button type="button" data-toggle="modal" data-target="#sidebar-left" class="btn btn-primary navbar-btn"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;&nbsp;เมนูการใช้งาน</button>

		<h3>
			<img src="images/icon/group.png" align="absmiddle" />&nbsp;&nbsp;คลังยา
		</h3>
		<div id="home" class="innerLR">
		</div>
	</div>


	<div style="width:100%; height:10px; color:#FFFFFF;">&nbsp;</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#dock').Fisheye({
				maxWidth: 50,
				items: 'a',
				itemsText: 'span',
				container: '.dock-container',
				itemWidth: 50,
				proximity: 30,
				halign: 'center'
			});
			clickEventSideMenu();
			// $(".modal a").not(".dropdown-toggle").on("click", function() {
			// 	$(".modal").modal("hide");
			// });
			// openWhenReady();
			// document.getElementById('username').focus();
			// $('#modal-login').modal('show');
		});

		function openWhenReady() {
			var c = (gWH().width / 2) - 200;
			document.getElementById('sd').style.marginLeft = c + 'px';
			document.getElementById('login_zone').style.marginLeft = c + 'px';
			// $('#modal-login').modal();
			loadlogin();

			// var pH1 = $(window).height();
			// if($(window).height() >= 628){ var pH = $(window).height() - 99; } else { pH = 628 - 99;  }
			// var pHl= pH - 20;

		}

		function clickEventSideMenu() {
			$('#daily_report_side_menu_btn').click(function() {
				if ($('#daily_report_side_menu').hasClass('active') == false) {
					loadmodule('home', 'daily_report/report.php', '');
				}
				$('#sub-menu-daily-report-1').collapse('toggle');
				// return false;
			});

			$('#monthly_report_side_menu_btn').click(function() {
				if ($('#monthly_report_side_menu').hasClass('active') == false) {
					loadmodule('home', 'Monthly_report/report.php', '');
				}
				$('#sub-menu-monthly-report-1').collapse('toggle');
				// return false;
			});
		}

		function showIMG() {

			$("#dialog-box").load('webcam.php?hn=' + hn, function() {});

		}
	</script>

</body>

</html>