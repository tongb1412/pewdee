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


	<link href="css/menu_style.css" rel="stylesheet" type="text/css" />
	<link href="calendar/calendar.css" rel="stylesheet" type="text/css" />
	<!-- <link href="css/bootstrap.css" rel="stylesheet" type="text/css" /> -->

	<!-- Theme CSS -->
	<link rel="stylesheet" href="assets/css/admin/module.admin.stylesheet-complete.min.css" />

	<!-- Custom CSS -->
	<link rel="stylesheet" href="css/index.css" />

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

	<button type="button" data-toggle="modal" data-target="#sidebar-left" class="btn btn-primary navbar-btn">เมนูการใช้งาน</button>

	<!-- Sidebar Left -->
	<div class="modal fade left" id="sidebar-left" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Left Sidebar</h4>
				</div>
				<div class="modal-body">
					<!-- Sidebar Menu -->
					<div id="menu" class="hidden-print hidden-xs">
						<div id="sidebar-fusion-wrapper">
							<!--        <input class="form-control search" type="text" placeholder="Search...">-->
							<ul class="menu list-unstyled">
								<li class="active">
									<a href="index.html" class="index">
										<i class="fa fa-home"></i>
										<span>Overview</span>
									</a>
								</li>
								<li class="hasSubmenu">
									<a href="#menu-4905a8758e2b9b737de284e3c796cd55" data-toggle="collapse">
										<i class="fa fa-lock"></i>
										<span>Access</span>
									</a>
									<ul class="collapse" id="menu-4905a8758e2b9b737de284e3c796cd55">
										<li class="">
											<a href="login.html" class="no-ajaxify">
												<i class="fa fa-lock"></i>
												<span>Login</span>
											</a>
										</li>
										<li class="">
											<a href="signup.html" class="no-ajaxify">
												<i class="fa fa-pencil"></i>
												<span>Sign up</span>
											</a>
										</li>
									</ul>
								</li>
							</ul>
						</div>
					</div>
					<!-- // Sidebar Menu END -->
				</div>
			</div>
		</div>
	</div>

	<div id="home" style="width:1003px; margin:auto;">

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

		function showIMG() {

			$("#dialog-box").load('webcam.php?hn=' + hn, function() {});

		}
	</script>

</body>

</html>