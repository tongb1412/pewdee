<?
session_start();
//;
include('class/permission_user.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!-- <script type="text/javascript" src="js/jquery.js"></script> -->
	<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="js/interface.js"></script>
	<script type="text/javascript" src="js/myAjax.js"></script>
	<script type="text/javascript" src="calendar/calendar.js"></script>
	<script type="text/javascript" src="vender/zebra_datepicker/zebra_datepicker.min.js"></script>
	<!-- <script type="text/javascript" src="js/bootstrap.js"></script> -->


	<link href="css/menu_style.css" rel="stylesheet" type="text/css" />
	<link href="calendar/calendar.css" rel="stylesheet" type="text/css" />
	<link href="css/monthly_report.css" rel="stylesheet" type="text/css" />
	<link href="vender/zebra_datepicker/css/default/zebra_datepicker.css" rel="stylesheet" type="text/css" />
	<!-- <link href="css/bootstrap.css" rel="stylesheet" type="text/css" /> -->
	<title>Pewdee Clinic System</title>
</head>

<script type="text/javascript">
	var months = new Array("", "", "", "", "", "", "", "", "", "", "", "");


	function ConfDelete(URL, displayId, data) {
		if (confirm('?')) {
			document.getElementById('loading').style.display = '';
			ajaxEdit('post', URL, data, displayId);
		}
	}

	function drugeDelete(URL, displayId) {
		if (confirm('?')) {
			var data = 'vn=' + document.getElementById('vn').value;
			data += '&did=' + document.getElementById('did').value;
			document.getElementById('loading').style.display = '';
			ajaxEdit('post', URL, data, displayId);
			document.getElementById('did').value = '';
			document.getElementById('dname').value = '';
			document.getElementById('price').value = '';
			document.getElementById('uprice').value = '';
			document.getElementById('qty').value = '';
		}
	}

	function labDelete(URL, displayId) {
		if (confirm('?')) {
			var data = 'vn=' + document.getElementById('vn').value;
			data += '&lid=' + document.getElementById('lid').value;
			document.getElementById('loading').style.display = '';
			ajaxEdit('post', URL, data, displayId);
			document.getElementById('lid').value = '';
			document.getElementById('lname').value = '';
			document.getElementById('lprice').value = '';
			document.getElementById('luprice').value = '';
			document.getElementById('lqty').value = '';
			document.getElementById('lname').focus();
		}
	}


	function laserDelete(URL, displayId) {
		if (confirm('?')) {
			var data = 'vn=' + document.getElementById('vn').value;
			data += '&tid=' + document.getElementById('tid').value;
			data += '&type=' + document.getElementById('ttype').value;
			document.getElementById('loading').style.display = '';
			ajaxEdit('post', URL, data, displayId);
			document.getElementById('tid').value = '';
			document.getElementById('tname').value = '';
			document.getElementById('tprice').value = '';
			document.getElementById('tuprice').value = '';
			document.getElementById('tqty').value = '';
			document.getElementById('ttype').value = '';
			document.getElementById('tunit').innerHTML = '';
			document.getElementById('tname').focus();

		}
	}

	function pctDelete(URL, displayId) {
		if (confirm('?')) {
			var data = 'vn=' + document.getElementById('vn').value;
			data += '&tid=' + document.getElementById('pid').value;
			data += '&type=' + document.getElementById('ptype').value;


			document.getElementById('loading').style.display = '';
			ajaxEdit('post', URL, data, displayId);
			document.getElementById('pid').value = '';
			document.getElementById('pname').value = '';
			document.getElementById('pprice').value = '';
			document.getElementById('puprice').value = '';
			document.getElementById('pqty').value = '';
			document.getElementById('punit').innerHTML = '';
			document.getElementById('pname').focus();

		}
	}

	function rpctDelete(URL, displayId) {
		if (confirm('?')) {
			var data = 'vn=' + document.getElementById('vn').value;
			data += '&hn=' + document.getElementById('hn').value;
			data += '&tid=' + document.getElementById('pid').value;
			data += '&type=' + document.getElementById('ptype').value;
			document.getElementById('loading').style.display = '';
			ajaxEdit('post', URL, data, displayId);
			document.getElementById('pid').value = '';
			document.getElementById('pname').value = '';
			document.getElementById('pprice').value = '';
			document.getElementById('puprice').value = '';
			document.getElementById('pqty').value = '';
			document.getElementById('punit').innerHTML = '';
			document.getElementById('pname').focus();

		}
	}

	function pctUseDelete(URL, displayId, vn, tid, eid, typ, qty, pid, svn) {
		if (confirm('?')) {
			var data = 'vn=' + vn;
			data += '&tid=' + tid;
			data += '&pid=' + pid;
			data += '&eid=' + eid;
			data += '&type=' + typ;
			data += '&qty=' + qty;
			data += '&svn=' + svn;
			document.getElementById('loading').style.display = '';
			ajaxEdit('post', URL, data, displayId);
		}
	}


	function rpctUseDelete(URL, displayId, vn, hn, tid, eid, typ) {
		if (confirm('?')) {
			var data = 'vn=' + vn;
			data += '&hn=' + hn;
			data += '&tid=' + tid;
			data += '&eid=' + eid;
			data += '&type=' + typ;
			document.getElementById('loading').style.display = '';
			ajaxEdit('post', URL, data, displayId);



		}
	}

	function addpatient(mode) {
		if (document.getElementById('cn').value != '') {
			if (document.getElementById('hn').value != '') {
				if (document.getElementById('fname').value != '') {
					if (document.getElementById('lname').value != '') {
						if (document.getElementById('address').value != '') {
							if (document.getElementById('province').value != '') {
								if (document.getElementById('email').value != '') {
									if (document.getElementById('how').value != '') {

										var data = 'cardno=' + document.getElementById('cn').value;
										data += '&hn=' + document.getElementById('hn').value;
										data += '&pname=' + document.getElementById('pname').value;
										data += '&sex=' + document.getElementById('sex').value;
										data += '&fname=' + document.getElementById('fname').value;
										data += '&lname=' + document.getElementById('lname').value;
										data += '&level=' + document.getElementById('plevel').value;
										data += '&st=' + document.getElementById('st').value;
										data += '&bl=' + document.getElementById('bl').value;

										sel_branch = document.getElementById('sel_branchid_p_new');
										if (sel_branch != null) {
											data += "&bid=" + sel_branch.value;
										}

										data += '&oc=' + document.getElementById('oc').value;
										data += '&pno=' + document.getElementById('pno').value;
										data += '&pass=' + document.getElementById('pass').value;
										data += '&dd=' + document.getElementById('dd').value;
										data += '&dm=' + document.getElementById('dm').value;
										data += '&dy=' + document.getElementById('dy').value;
										data += '&adderss=' + document.getElementById('address').value;
										data += '&tum=' + document.getElementById('district').value;
										data += '&aum=' + document.getElementById('amphur').value;
										data += '&province=' + document.getElementById('province').value;
										data += '&post=' + document.getElementById('zipcode').value;
										data += '&country=' + document.getElementById('country').value;
										data += '&tel=' + document.getElementById('tel').value;
										data += '&mtel=' + document.getElementById('mtel').value;
										data += '&email=' + document.getElementById('email').value;
										data += '&facebook=' + document.getElementById('facebook').value;
										data += '&mem=' + document.getElementById('mem').value;
										data += '&typ=' + document.getElementById('typ').value;
										data += '&how=' + document.getElementById('how').value;
										data += '&other=' + document.getElementById('other').value;
										data += '&mode=' + mode;

										document.getElementById('loading').style.display = '';
										ajaxAddpatient('post', 'register/patient_add.php', data)

									} else {
										alert('กรุณาระบบว่า รู้จักผิวดีจากที่ใด ');
									}
								} else {
									alert('กรุณากรอก Email ');
								}
							} else {
								alert('กรุณาเลือก จังหวัด');
							}
						} else {
							alert('กรุณากรอก ที่อยู่');
						}
					} else {
						alert('กรุณากรอก ชื่อ - นามสกุล ');
					}
				} else {
					alert('กรุณากรอก ชื่อ - นามสกุล ');
				}
			} else {
				alert('กรุณากรอก รหัสคนไข้ ');
			}
		} else {
			alert('Card No. ');
		}

	}


	function addAppointment(URL, displayId) {
		if (document.getElementById('hn').value != '') {
			if (document.getElementById('pid').value != '9999') {
				var stime = '';
				var etime = '';
				if (document.getElementById('atyp').value == 'S') {
					stime = document.getElementById('fh').value + ':' + document.getElementById('fn').value;
					etime = document.getElementById('lh').value + ':' + document.getElementById('ln').value;
				}
				var data = 'hn=' + document.getElementById('hn').value;
				data += '&cn=' + document.getElementById('cn').value;
				data += '&an=' + document.getElementById('an').value;
				data += '&pname=' + document.getElementById('pname').value;
				data += '&atyp=' + document.getElementById('atyp').value;
				data += '&pid=' + document.getElementById('pid').value;
				data += '&dat=' + document.getElementById('dat').value;
				data += '&stim=' + stime;
				data += '&etim=' + etime;
				data += '&atime=' + document.getElementById('atime').value;
				data += '&mem=' + document.getElementById('mem').value;
				data += '&bid=' + document.getElementById('branch_id_p').value;
				console.log(data);
				ajaxEdit('post', URL, data, displayId);
			} else {
				alert('');
			}
		} else {
			alert('กรุณากรอก รหัสคนไข้');
		}
	}


	function addtotalprice(URL, displayId) {
		if (document.getElementById('dat').value != '') {
			var data = 'dat=' + document.getElementById('dat').value;
			data += '&cash=' + document.getElementById('cash').value;
			data += '&credit=' + document.getElementById('credit').value;
			data += '&credit1=' + document.getElementById('credit1').value;
			data += '&credit2=' + document.getElementById('credit2').value;
			data += '&credit3=' + document.getElementById('credit3').value;
			data += '&credit4=' + document.getElementById('credit4').value;
			data += '&check=' + document.getElementById('check').value;
			data += '&sempid=' + document.getElementById('asempid').value;
			data += '&cempid=' + document.getElementById('cempid').value;
			data += '&empid=' + document.getElementById('empid').value;
			data += '&credit5=' + document.getElementById('credit5').value;
			data += '&credit6=' + document.getElementById('credit6').value;

			ajaxEdit('post', URL, data, displayId);

			ajaxLoad('post', 'daily_report/totalprice.php', '', 'reportpage');

		} else {
			alert('');
		}
	}


	function addtotalcash(URL, displayId) {
		if (document.getElementById('asempid').value != '') {

			var data = '&cash_yes=' + document.getElementById('cash_yes').value;
			data += '&to_day=' + document.getElementById('to_day').value;
			data += '&coste=' + document.getElementById('coste').value;
			data += '&doctor=' + document.getElementById('doctor').value;
			data += '&bank=' + document.getElementById('bank').value;
			data += '&mem=' + document.getElementById('mem').value;
			data += '&check=' + document.getElementById('check').value;
			data += '&sempid=' + document.getElementById('asempid').value;
			data += '&cempid=' + document.getElementById('cempid').value;
			data += '&empid=' + document.getElementById('empid').value;

			ajaxEdit('post', URL, data, displayId);
			//  alert(data);
			ajaxLoad('post', 'daily_report/totalcash.php', '', 'reportpage');

		} else {
			alert('');
		}
	}




	function adddruge(mode) {
		if (document.getElementById('did').value != '') {
			if (document.getElementById('gname').value != '') {
				if (document.getElementById('tname').value != '') {
					if (document.getElementById('sprice').value != '') {

						var data = 'did=' + document.getElementById('did').value;
						data += '&bcode=' + document.getElementById('bcode').value;
						data += '&gname=' + document.getElementById('gname').value;
						data += '&tname=' + document.getElementById('tname').value;
						data += '&dgid=' + document.getElementById('dgid').value;
						data += '&total=' + document.getElementById('total').value;
						data += '&unit=' + document.getElementById('unit').value;
						data += '&bprice=' + document.getElementById('bprice').value;
						data += '&sprice=' + document.getElementById('sprice').value;
						data += '&sqty=' + document.getElementById('sqty').value;
						data += '&tid=' + document.getElementById('tid').value;
						data += '&duse=' + document.getElementById('duse').value;
						data += '&wuse=' + document.getElementById('wuse').value;
						data += '&huse=' + document.getElementById('huse').value;
						data += '&mode=' + mode;

						document.getElementById('loading').style.display = '';
						ajaxAdddruge('post', 'stock/druge_add.php', data)

					} else {
						alert(' ');
					}
				} else {
					alert(' ');
				}
			} else {
				alert(' ');
			}
		} else {
			alert(' ');
		}
	}

	function add_temp_instock(URL, displayId) {
		if (document.getElementById('did').value != '') {
			if (document.getElementById('qty').value != '') {
				var data = 'lno=' + document.getElementById('lno').value;
				data += '&did=' + document.getElementById('did').value;
				data += '&dname=' + document.getElementById('dname').value;
				data += '&qty=' + document.getElementById('qty').value;
				data += '&unit=' + document.getElementById('dunit').innerHTML;
				data += '&totalprice=' + document.getElementById('totalprice').value;
				data += '&price=' + document.getElementById('price').value;
				data += '&bdate=' + document.getElementById('bdate').value;
				data += '&edate=' + document.getElementById('edate').value;
				ajaxEdit('post', URL, data, displayId);
				document.getElementById('did').value = '';
				document.getElementById('dname').value = '';
				document.getElementById('dunit').innerHTML = '';
				document.getElementById('qty').value = '';
				document.getElementById('bdate').value = '';
				document.getElementById('edate').value = '';
				document.getElementById('totalprice').value = '';
				document.getElementById('price').value = '';
				document.getElementById('txts').value = '';
				document.getElementById('txts').focus();
			} else {
				alert('');
			}
		} else {
			alert('');
		}
	}


	function add_temp_cutstock(URL, displayId) {
		if (document.getElementById('did').value != '') {
			if (document.getElementById('qty').value != '') {

				var data = 'lno=' + document.getElementById('lno').value;
				data += '&typ=' + document.getElementById('dtyp').value;
				data += '&did=' + document.getElementById('did').value;
				data += '&dname=' + document.getElementById('dname').value;
				data += '&qty=' + document.getElementById('qty').value;
				data += '&unit=' + document.getElementById('dunit').innerHTML;
				console.log(URL);
				ajaxEdit('post', URL, data, displayId);
				document.getElementById('did').value = '';
				document.getElementById('dname').value = '';
				document.getElementById('dunit').innerHTML = '';
				document.getElementById('qty').value = '';
			} else {
				alert('');
			}
		} else {
			alert('');
		}
	}



	function addtreatment(URL, displayId) {
		if (document.getElementById('tid').value != '') {
			if (document.getElementById('tname').value != '') {
				if (document.getElementById('price').value != '') {


					var data = 'tid=' + document.getElementById('tid').value;
					data += '&tname=' + document.getElementById('tname').value;
					data += '&price=' + document.getElementById('price').value;
					data += '&mode=' + document.getElementById('mode').value;
					data += '&unit=' + document.getElementById('unit').value;
					data += '&type=' + document.getElementById('typ').value;
					data += '&tgroup=' + document.getElementById('tgroup').value;
					ajaxEdit('post', URL, data, displayId);

				} else {
					alert(' ');
				}
			} else {
				alert(' ');
			}
		} else {
			alert(' ');
		}
	}

	function addcourselist(URL, displayId) {
		if (document.getElementById('cid').value != '') {
			if (document.getElementById('tid').value != '') {

				var data = 'cid=' + document.getElementById('cid').value;
				data += '&tid=' + document.getElementById('tid').value;
				data += '&tname=' + document.getElementById('tname').value;
				data += '&qty=' + document.getElementById('qty').value;
				data += '&uprice=' + document.getElementById('uprice').value;
				data += '&price=' + document.getElementById('price').value;
				data += '&type=' + document.getElementById('typ').value;


				ajaxEdit('post', URL, data, displayId);

				document.getElementById('tid').value = '';
				document.getElementById('tname').value = '';
				document.getElementById('qty').value = '';
				document.getElementById('uprice').value = '';
				document.getElementById('price').value = '';
			} else {
				alert(' ');
			}
		} else {
			alert(' ');
		}

	}

	function addpackagelist(URL, displayId) {
		if (document.getElementById('cid').value != '') {
			if (document.getElementById('tid').value != '') {

				var data = 'cid=' + document.getElementById('cid').value;
				data += '&tid=' + document.getElementById('tid').value;
				data += '&tname=' + document.getElementById('tname').value;
				data += '&qty=' + document.getElementById('qty').value;
				data += '&uprice=' + document.getElementById('uprice').value;
				data += '&price=' + document.getElementById('price').value;
				data += '&ptype=' + document.getElementById('ptyp').value;
				data += '&type=' + document.getElementById('typ').value;

				ajaxEdit('post', URL, data, displayId);
				document.getElementById('tid').value = '';
				document.getElementById('tname').value = '';
				document.getElementById('qty').value = '';
				document.getElementById('uprice').value = '';
				document.getElementById('price').value = '';
				document.getElementById('ptyp').value = '';
			} else {
				alert(' ');
			}
		} else {
			alert(' ');
		}

	}


	function addcourse(URL, displayId) {
		if (document.getElementById('cid').value != '') {
			if (document.getElementById('cname').value != '') {
				if (document.getElementById('sprice').value != '') {
					var data = 'cid=' + document.getElementById('cid').value;
					data += '&cname=' + document.getElementById('cname').value;
					data += '&price=' + document.getElementById('sprice').value;
					if (URL != 'setting/package_add.php') {
						data += '&cgroup=' + document.getElementById('cgroup').value;
					}

					ajaxEdit('post', URL, data, displayId);
				} else {
					alert(' ');
				}
			} else {
				alert(' ');
			}
		} else {
			alert(' ');
		}
	}


	function addsaledlist(URL, displayId) {



		if (document.getElementById('did').value != '') {
			if (document.getElementById('dname').value != '') {
				if (document.getElementById('qty').value != '') {
					var data = 'hn=' + document.getElementById('hn').value;
					data += '&vn=' + document.getElementById('vn').value;
					data += '&did=' + document.getElementById('did').value;
					data += '&dname=' + document.getElementById('dname').value;
					data += '&qty=' + document.getElementById('qty').value;
					data += '&price=' + document.getElementById('price').value;
					data += '&typ=' + document.getElementById('typ').value;
					data += '&fis=' + document.getElementById('fis').value;

					ajaxEdit('post', URL, data, displayId);

					document.getElementById('did').value = '';
					document.getElementById('dname').value = '';
					document.getElementById('qty').value = '';
					document.getElementById('price').value = '';
					document.getElementById('uprice').value = '';
					document.getElementById('did').focus();


				} else {
					alert(' ');
				}
			} else {
				alert(' ');
			}
		} else {
			alert(' ');
		}

	}


	function addvst(URL, st) {
		var data = 'hn=' + document.getElementById('hn').value;
		data += '&vn=' + document.getElementById('vn').value;
		data += '&st=' + st;
		ajaxLoadvst('post', URL, data, 'home');
	}

	function addapayment(URL, displayId) {

		var sum = parseFloat(document.getElementById('sum').value.replace(",", ""));
		if (document.getElementById('cash').value != '') {
			var mm = parseFloat(document.getElementById('cash').value.replace(",", ""));
		} else {
			var mm = 0;
		}
		if (document.getElementById('credit').value != '') {
			var mc = parseFloat(document.getElementById('credit').value.replace(",", ""));
		} else {
			var mc = 0;
		}

		var total = mm + mc;

		var data = 'hn=' + document.getElementById('hn').value;
		data += '&total=' + sum;
		data += '&recive=' + total;
		data += '&mode=' + document.getElementById('mode').value;
		data += '&cash=' + mm;
		data += '&credit=' + mc;
		data += '&bank=' + document.getElementById('bank').value;
		data += '&ctype=' + document.getElementById('ctype').value;
		data += '&rmoney=' + document.getElementById('rmoney').value;

		if (Number(document.getElementById('credit').value) > 0) {
			if (document.getElementById('bank').value != '') {
				if (document.getElementById('ctype').value != '') {
					ajaxLoadapay('post', URL, data, displayId);
				} else {
					alert(' !');
				}
			} else {
				alert(' !');
			}
		} else {
			ajaxLoadapay('post', URL, data, displayId);
		}
	}




	function addsdpayment(URL, displayId) {
		var ptotal = parseFloat(document.getElementById('total').value.replace(",", ""));
		var sum = parseFloat(document.getElementById('sum').value.replace(",", ""));
		var dis = 0;
		if (document.getElementById('discount').value != '') {
			var dis = parseFloat(document.getElementById('discount').value.replace(",", ""));
		} else {
			var dis = 0;
		}

		if (document.getElementById('cash').value != '') {
			var mm = parseFloat(document.getElementById('cash').value.replace(",", ""));
		} else {
			var mm = 0;
		}
		if (document.getElementById('credit').value != '') {
			var mc = parseFloat(document.getElementById('credit').value.replace(",", ""));
		} else {
			var mc = 0;
		}
		if (document.getElementById('kupong').value != '') {
			var mk = parseFloat(document.getElementById('kupong').value.replace(",", ""));
		} else {
			var mk = 0;
		}
		var total = mm + mc + mk;

		var data = 'hn=' + document.getElementById('hn').value;
		data += '&vn=' + document.getElementById('vn').value;
		data += '&total=' + ptotal;
		data += '&recive=' + total;
		data += '&mode=' + document.getElementById('mode').value;
		data += '&cash=' + mm;
		data += '&credit=' + mc;
		data += '&bank=' + document.getElementById('bank').value;
		data += '&ctype=' + document.getElementById('ctype').value;
		data += '&rmoney=' + document.getElementById('rmoney').value;
		data += '&discount=' + dis;
		data += '&ku=' + mk;
		data += '&kno=' + document.getElementById('kno').value;
		data += '&ktype=' + document.getElementById('ktype').value;
		data += '&eid=' + document.getElementById('empid').value;

		if (mc > 0) {
			if (document.getElementById('bank').value != '') {
				if (document.getElementById('empid').value != '00') {
					ajaxLoadpay('post', URL, data, displayId);
				} else {
					alert(' !');
				}
			} else {
				alert(' !');
			}
		} else {
			if (document.getElementById('empid').value != '00') {
				ajaxLoadpay('post', URL, data, displayId);
			} else {
				alert(' !');
			}

		}


	}


	function slippct(hn, vn) {
		var page = 'report/slip_pct.php?hn=' + hn + '&vn=' + vn;
		window.open(page, 'INVOICE/RECEIPT', 'width=400, height=500,resizable=yes, scrollbars=yes');
	}

	function addsdpaymentDC(URL, displayId, pctotal) {

		// $('#paybtn').hide();

		document.getElementById('paybtn').style.display = 'none';

		var ptotal = parseFloat(document.getElementById('total').value.replace(",", ""));
		var sum = parseFloat(document.getElementById('sum').value.replace(",", ""));
		if (document.getElementById('cash').value != '') {
			var mm = parseFloat(document.getElementById('cash').value.replace(",", ""));
		} else {
			var mm = 0;
		}
		if (document.getElementById('credit').value != '') {
			var mc = parseFloat(document.getElementById('credit').value.replace(",", ""));
		} else {
			var mc = 0;
		}
		if (document.getElementById('kupong').value != '') {
			var mk = parseFloat(document.getElementById('kupong').value.replace(",", ""));
		} else {
			var mk = 0;
		}
		var dis = 0;
		if (document.getElementById('discount').value != '') {
			dis = parseFloat(document.getElementById('discount').value.replace(",", ""));
		} else {
			dis = 0;
		}

		var dp = parseFloat(document.getElementById('ds').value.replace(",", ""));
		var lp = parseFloat(document.getElementById('ls').value.replace(",", ""));
		var tp = parseFloat(document.getElementById('ts').value.replace(",", ""));
		var cp = parseFloat(document.getElementById('cs').value.replace(",", ""));
		var pp = parseFloat(document.getElementById('ps').value.replace(",", ""));

		//alert(dp+' '+lp+' '+tp+'  '+cp+' '+pp);
		var total = mm + mc + mk;

		// alert(mm +' '+ mc+' '+ mk);

		var data = 'hn=' + document.getElementById('hn').value;
		data += '&vn=' + document.getElementById('vn').value;
		data += '&total=' + ptotal;
		data += '&recive=' + total;
		data += '&mode=' + document.getElementById('mode').value;
		data += '&cash=' + mm;
		data += '&credit=' + mc;
		data += '&bank=' + document.getElementById('bank').value;
		data += '&ctype=' + document.getElementById('ctype').value;
		data += '&ku=' + mk;
		data += '&kno=' + document.getElementById('kno').value;
		data += '&ktype=' + document.getElementById('ktype').value;
		data += '&rmoney=' + document.getElementById('rmoney').value;
		data += '&discount=' + dis;
		data += '&dp=' + dp;
		data += '&lp=' + lp;
		data += '&tp=' + tp;
		data += '&cp=' + cp;
		data += '&pp=' + pp;


		if (mc > 0) {
			if (document.getElementById('bank').value != '') {
				// if(document.getElementById('ctype').value!=''){
				ajaxLoadpay('post', URL, data, displayId);
				//} else { alert(' !'); }
			} else {
				alert(' !');
			}
		} else {
			ajaxLoadpay('post', URL, data, displayId);
		}

	}

	function sendadd(URL, hn, bid, displayId) {

		var data = 'hn=' + hn;
		data += '&eid=' + document.getElementById('sempid').value;
		data += '&bid=' + bid;
		ajaxLoadsend('post', URL, data, displayId)

	}

	function preprint(vn) {
		if (document.getElementById('pmem').value != '') {
			var page = 'report/slip_paymentpre.php?vn=' + vn + '&eid=' + document.getElementById('empid').value + '&mem=' + document.getElementById('pmem').value;
			window.open(page, 'INVOICE/RECEIPT', 'width=400, height=500,resizable=yes, scrollbars=yes');
			cancelsend();
		}
	}

	function preprint1() {

		if (document.getElementById('pmem').value != '') {
			var page = 'report/slip_paymentpre.php?billno=' + document.getElementById('billno').value + '&eid=' + document.getElementById('empid').value + '&mem=' + document.getElementById('pmem').value;

			window.open(page, 'INVOICE/RECEIPT', 'width=400, height=500,resizable=yes, scrollbars=yes');

			cancelsend();
		}
	}

	function cbil(vn) {
		if (document.getElementById('pmem').value != '') {

			var data = 'vn=' + vn;
			data += '&eid=' + document.getElementById('empid').value;
			data += '&mem=' + document.getElementById('pmem').value;
			data += '&pname=' + document.getElementById('pname').value;
			ajaxLoadsend('post', 'register/cbiladd.php', data, 'home');
		}
	}


	function canceladd(URL, hn, vn, displayId) {
		if (document.getElementById('cmem').value != '') {
			var data = 'hn=' + hn;
			data += '&vn=' + vn;
			data += '&mem=' + document.getElementById('cmem').value;

			ajaxLoadsend('post', URL, data, displayId)
		} else {
			alert(' !');
		}
	}


	function addlaser(URL, displayId) {

		if (document.getElementById('lid').value != '') {
			if (document.getElementById('lname').value != '') {

				var data = 'lid=' + document.getElementById('lid').value;
				data += '&lname=' + document.getElementById('lname').value;
				data += '&total=' + document.getElementById('total').value;
				data += '&sqty=' + document.getElementById('sqty').value;
				data += '&unit=' + document.getElementById('unit').value;
				data += '&type=' + document.getElementById('typ').value;

				document.getElementById('loading').style.display = '';
				ajaxEdit('post', URL, data, displayId);
			} else {
				alert('');
			}
		} else {
			alert('');
		}
	}



	function add_templaser_instock(URL, displayId) {
		if (document.getElementById('lid').value != '') {
			if (document.getElementById('qty').value != '') {
				var data = 'lno=' + document.getElementById('lno').value;
				data += '&lid=' + document.getElementById('lid').value;
				data += '&lname=' + document.getElementById('lname').value;
				data += '&qty=' + document.getElementById('qty').value;
				data += '&unit=' + document.getElementById('lunit').innerHTML;

				ajaxEdit('post', URL, data, displayId);
				document.getElementById('lid').value = '';
				document.getElementById('lname').value = '';
				document.getElementById('lunit').innerHTML = '';
				document.getElementById('qty').value = '';
				document.getElementById('txts').value = '';
				document.getElementById('txts').focus();
			} else {
				alert('');
			}
		} else {
			alert('');
		}
	}

	function add_lab(URL, displayId) {
		if (document.getElementById('lid').value != '') {
			if (document.getElementById('lqty').value != '') {
				if (document.getElementById('hcid').value != '') {

					var data = 'vn=' + document.getElementById('vn').value;
					data += '&hn=' + document.getElementById('hn').value;
					data += '&lid=' + document.getElementById('lid').value;
					data += '&lname=' + document.getElementById('lname').value;
					data += '&qty=' + document.getElementById('lqty').value;
					data += '&price=' + document.getElementById('luprice').value;
					data += '&eid=' + document.getElementById('hcid').value;
					data += '&ename=' + document.getElementById('hcname').value;
					data += '&mem=' + document.getElementById('hmem').value;


					ajaxEdit('post', URL, data, displayId);
					document.getElementById('THl').style.display = '';
					document.getElementById('lid').value = '';
					document.getElementById('lname').value = '';

					document.getElementById('lqty').value = '';
					document.getElementById('lprice').value = '';
					document.getElementById('luprice').value = '';

					document.getElementById('hcid').value = '';
					document.getElementById('hcname').value = '';
					document.getElementById('hmem').value = '';

					document.getElementById('lname').focus();
				} else {
					alert('');
				}
			} else {
				alert('');
			}
		} else {
			alert('');
		}
	}

	function add_pct(URL, displayId) {
		if (document.getElementById('pid').value != '') {
			if (document.getElementById('pqty').value != '') {
				if (document.getElementById('pseid').value != '') {
					var data = 'vn=' + document.getElementById('vn').value;
					data += '&hn=' + document.getElementById('hn').value;
					data += '&pid=' + document.getElementById('pid').value;
					data += '&pname=' + document.getElementById('pname').value;
					data += '&qty=' + document.getElementById('pqty').value;
					data += '&price=' + document.getElementById('pprice').value;
					data += '&tprice=' + document.getElementById('puprice').value;
					data += '&type=' + document.getElementById('ptype').value;
					data += '&seid=' + document.getElementById('pseid').value;
					data += '&sename=' + document.getElementById('psename').value;
					data += '&cid=' + document.getElementById('npseid').value;
					data += '&cname=' + document.getElementById('npsename').value;
					data += '&unit=';

					ajaxEdit('post', URL, data, displayId);
					document.getElementById('pid').value = '';
					document.getElementById('pname').value = '';
					document.getElementById('pqty').value = '';
					document.getElementById('pprice').value = '';
					document.getElementById('puprice').value = '';
					document.getElementById('pseid').value = '';
					document.getElementById('psename').value = '';
					document.getElementById('npseid').value = '';
					document.getElementById('npsename').value = '';
					document.getElementById('pname').focus();
				} else {
					alert('โปรดใส่ ผู้ขาย');
				}
			} else {
				alert('โปรดใส่ จำนวน');
			}
		} else {
			alert('โปรดใส่ รายการ');
		}
	}


	function add_pct_old(URL, displayId) {
		if (document.getElementById('pid').value != '') {
			if (document.getElementById('pqty').value != '') {
				if (document.getElementById('psename').value != '') {
					var data = 'hn=' + document.getElementById('hn').value;

					data += '&pid=' + document.getElementById('pid').value;
					data += '&pname=' + document.getElementById('pname').value;
					data += '&qty=' + document.getElementById('pqty').value;
					data += '&price=' + document.getElementById('pprice').value;
					data += '&tprice=' + document.getElementById('puprice').value;
					data += '&type=' + document.getElementById('ptype').value;
					data += '&seid=' + document.getElementById('pseid').value;
					data += '&sename=' + document.getElementById('psename').value;
					data += '&unit=';
					ajaxEdit('post', URL, data, displayId);
					document.getElementById('pid').value = '';
					document.getElementById('pname').value = '';

					document.getElementById('pqty').value = '';
					document.getElementById('pprice').value = '';
					document.getElementById('puprice').value = '';
					document.getElementById('pseid').value = '';
					document.getElementById('psename').value = '';
					document.getElementById('pname').focus();
				} else {
					alert('');
				}
			} else {
				alert('');
			}
		} else {
			alert('');
		}
	}




	function add_laser(URL, displayId) {
		var con = 'Y';
		if (document.getElementById('tid').value != '') {
			if (document.getElementById('tqty').value != '') {

				if (document.getElementById('tid').value != 'xxxxx') {
					if (document.getElementById('tuprice').value != '' && document.getElementById('tuprice').value != '0') {
						con = 'Y';
					} else {
						alert('');
						con = 'N';
					}
				} else {
					if (document.getElementById('tuprice').value != '0') {
						alert(' 0 ');
						con = 'N';
					}
				}


				if (con == 'Y') {
					if (document.getElementById('eid').value != '') {

						var data = 'vn=' + document.getElementById('vn').value;
						data += '&hn=' + document.getElementById('hn').value;
						data += '&pid=' + document.getElementById('tid').value;
						data += '&pname=' + document.getElementById('tname').value;
						data += '&qty=1';
						data += '&tqty=' + document.getElementById('tqty').value;
						data += '&price=' + document.getElementById('tprice').value;
						data += '&tprice=' + document.getElementById('tuprice').value;
						data += '&type=' + document.getElementById('ttype').value;
						data += '&eid=' + document.getElementById('eid').value;
						data += '&ename=' + document.getElementById('ename').value;
						data += '&seid=' + document.getElementById('seid').value;
						data += '&sename=' + document.getElementById('sename').value;
						data += '&cid=' + document.getElementById('ncid').value;
						data += '&cname=' + document.getElementById('ncname').value;
						data += '&unit=' + document.getElementById('tunit').innerHTML;


						ajaxEdit('post', URL, data, displayId);
						document.getElementById('tid').value = '';
						document.getElementById('tname').value = '';
						document.getElementById('ttype').value = '';
						document.getElementById('tqty').value = '';
						document.getElementById('tprice').value = '';
						document.getElementById('tuprice').value = '';
						document.getElementById('tunit').innerHTML = '';
						document.getElementById('ull').style.display = 'none';
						document.getElementById('eid').value = '';
						document.getElementById('ename').value = '';
						document.getElementById('ncid').value = '';
						document.getElementById('ncname').value = '';
						document.getElementById('seid').value = '';
						document.getElementById('sename').value = '';
						document.getElementById('tname').focus();
					} else {
						alert('');
					}
				}

			} else {
				alert('');
			}
		} else {
			alert('');
		}
	}



	function editlevel(velid, velname, disdrug, dislab, dislaser, distr, disco, dispg) {
		document.getElementById('velname').value = velname;
		document.getElementById('velid').value = velid;
		document.getElementById('typ').value = 'edit';
		document.getElementById('disdrug').value = disdrug;
		document.getElementById('dislab').value = dislab;
		document.getElementById('dislaser').value = dislaser;
		document.getElementById('distr').value = distr;
		document.getElementById('disco').value = disco;
		document.getElementById('dispg').value = dispg;
		document.getElementById('velname').focus();
	}

	function addlevel(URL, displayId) {
		if (document.getElementById('velname').value != '') {
			var data = 'velname=' + document.getElementById('velname').value;
			data += '&velid=' + document.getElementById('velid').value;
			data += '&type=' + document.getElementById('typ').value;
			data += '&disdrug=' + document.getElementById('disdrug').value;
			data += '&dislab=' + document.getElementById('dislab').value;
			data += '&dislaser=' + document.getElementById('dislaser').value;
			data += '&distr=' + document.getElementById('distr').value;
			data += '&disco=' + document.getElementById('disco').value;
			data += '&dispg=' + document.getElementById('dispg').value;


			ajaxEdit('post', URL, data, displayId);
			document.getElementById('velname').value = '';
			document.getElementById('typ').value = '';
			document.getElementById('disdrug').value = '0';
			document.getElementById('dislab').value = '0';
			document.getElementById('dislaser').value = '0';
			document.getElementById('distr').value = '0';
			document.getElementById('disco').value = '0';
			document.getElementById('dispg').value = '0';
		} else {
			alert('');
		}
	}


	function addcosts(URL, displayId) {
		if (document.getElementById('name').value != '') {
			var data = 'name=' + document.getElementById('name').value;
			data += '&unit=' + document.getElementById('unit').value;
			data += '&price=' + document.getElementById('price').value;
			data += '&total=' + document.getElementById('total').value;
			data += '&id=' + document.getElementById('id').value;
			data += '&type=' + document.getElementById('typ').value;
			// alert(data);

			ajaxEdit('post', URL, data, displayId);
			document.getElementById('name').value = '';
			document.getElementById('unit').value = '';
			document.getElementById('id').value = '';
			document.getElementById('typ').value = '';
			document.getElementById('price').value = '0';
			document.getElementById('total').value = '0';
		} else {
			alert('กรุณากรอก รายการค่าใช้จ่าย');
		}
	}


	function editcosts(name, id, unit, price, total) {
		document.getElementById('name').value = name;
		document.getElementById('unit').value = unit;
		document.getElementById('typ').value = 'edit';
		document.getElementById('price').value = price;
		document.getElementById('total').value = total;
		document.getElementById('id').value = id;
		document.getElementById('name').focus();
	}


	function loadmodule_druge(divname, url, hn, vn, bid) {
		document.getElementById('loading').style.display = '';
		var data = 'hn=' + hn;
		ajaxLoad('post', url, data, divname);
	}

	function printpatient() {
		var data = "";
		if (document.getElementById('branchid') != null) {
			data += '&branchid=' + document.getElementById('branchid').value;
		}
		var page = 'daily_report/re_patient.php?' + data;
		window.open(page, 'Patients', 'width=700, height=500,resizable=yes, scrollbars=yes');
	}

	function printtypepay() {
		var page = 'daily_report/re_typepay.php';
		window.open(page, 'Patients', 'width=700, height=500,resizable=yes, scrollbars=yes');
	}

	function printcreditDaily() {
		var data = 'did=' + document.getElementById('bk').value;
		if (document.getElementById('branchid') != null) {
			data += '&branchid=' + document.getElementById('branchid').value;
		}
		var page = 'daily_report/re_credit.php?' + data;
		window.open(page, 'Patients', 'width=1003, height=500,resizable=yes, scrollbars=yes');
	}

	function printapayment() {
		var data = "";
		if (document.getElementById('branchid') != null) {
			data += '?branchid=' + document.getElementById('branchid').value;
		}
		var page = 'daily_report/re_apayment.php' + data;
		window.open(page, 'Patients', 'width=700, height=500,resizable=yes, scrollbars=yes');
	}


	function printsalement() {
		var data = 'did=' + document.getElementById('empid').value;
		if (document.getElementById('branchid') != null) {
			data += '&branchid=' + document.getElementById('branchid').value;
		}
		var page = 'daily_report/re_salement.php?' + data;
		window.open(page, 'Patients', 'width=1003, height=500,resizable=yes, scrollbars=yes');
	}

	function printcourse() {
		var data = 'did=' + document.getElementById('empid').value;
		var page = 'daily_report/re_salecourse.php?' + data;
		window.open(page, 'Patients', 'width=1003, height=500,resizable=yes, scrollbars=yes');
	}

	function printpg() {
		var data = 'did=' + document.getElementById('empid').value;
		if (document.getElementById('branchid') != null) {
			data += '&branchid=' + document.getElementById('branchid').value;
		}
		var page = 'daily_report/re_salepg.php?' + data;
		window.open(page, 'Patients', 'width=1003, height=500,resizable=yes, scrollbars=yes');
	}

	function printeuser() {
		var data = 'did=' + document.getElementById('empid').value;
		if (document.getElementById('branchid') != null) {
			data += '&branchid=' + document.getElementById('branchid').value;
		}
		var page = 'daily_report/re_euser.php?' + data;
		window.open(page, 'Patients', 'width=1003, height=500,resizable=yes, scrollbars=yes');
	}

	function printar() {
		var data = "";
		if (document.getElementById('branchid') != null) {
			data += '?branchid=' + document.getElementById('branchid').value;
		}
		var page = 'daily_report/re_ar.php' + data;
		window.open(page, 'Patients', 'width=700, height=500,resizable=yes, scrollbars=yes');
	}

	function repstock1() {
		var data = "";
		if (document.getElementById('branchid') != null) {
			data += 'branchid=' + document.getElementById('branchid').value;
		}
		var page = 'Monthly_report/rep_stock1.php?' + data;
		window.open(page, 'Patients', 'width=700, height=500,resizable=yes, scrollbars=yes');
	}


	function printmonthpatient() {
		var data = 'sdate=' + document.getElementById('sdate').value;
		data += '&edate=' + document.getElementById('edate').value;
		if (document.getElementById('branchid') != null) {
			data += '&branchid=' + document.getElementById('branchid').value;
		}

		var page = 'Monthly_report/re_patient.php?' + data;
		window.open(page, 'Patients', 'width=700, height=500,resizable=yes, scrollbars=yes');
	}

	function reexpiredrug_excel() {
		branchid = $("#branchid").val()
		window.open('Monthly_report/reexpiredrug_excel.php?branchid=' + branchid, 'blank')
	}

	function printmonthpayment(url) {

		var data = 'sdate=' + document.getElementById('sdate').value;
		data += '&edate=' + document.getElementById('edate').value;
		if (document.getElementById('repempid') != null) {
			data += '&did=' + document.getElementById('repempid').value;
		}
		if (document.getElementById('branchid') != null) {
			data += '&branchid=' + document.getElementById('branchid').value;
		}

		var page = url + data;
		window.open(page, 'Patients', 'width=700, height=500,resizable=yes, scrollbars=yes');
	}

	function printcredit(url) {

		var data = 'sdate=' + document.getElementById('sdate').value;
		data += '&edate=' + document.getElementById('edate').value;



		var page = url + data;
		window.open(page, 'Patients', 'width=700, height=500,resizable=yes, scrollbars=yes');
	}

	function repCbil(url) {
		if (document.getElementById('sdate').value != '') {
			if (document.getElementById('edate').value != '') {
				var data = 'sdate=' + document.getElementById('sdate').value;
				data += '&edate=' + document.getElementById('edate').value;
				var page = url + data;
				window.open(page, 'Patients', 'width=700, height=500,resizable=yes, scrollbars=yes');
			} else {
				alert('');
			}
		} else {
			alert('');
		}
	}

	function printmonth(url) {
		var data = 'sdate=' + document.getElementById('sdate').value;
		data += '&edate=' + document.getElementById('edate').value;
		if (document.getElementById('branchid') != null) {
			data += '&branchid=' + document.getElementById('branchid').value;
		}
		var page = url + data;
		window.open(page, 'Patients', 'width=700, height=500,resizable=yes, scrollbars=yes');
	}

	function printmonthD(url) {
		var data = "";
		if (document.getElementById('branchid') != null) {
			data += '&branchid=' + document.getElementById('branchid').value;
		}
		var page = url + data;
		// var page = url;
		window.open(page, 'Patients', 'width=700, height=500,resizable=yes, scrollbars=yes');
	}

	function printmonthcredit() {
		var data = 'sdate=' + document.getElementById('sdate').value;
		data += '&edate=' + document.getElementById('edate').value;
		data += '&did=' + document.getElementById('bk').value;
		if (document.getElementById('branchid') != null) {
			data += '&branchid=' + document.getElementById('branchid').value;
		}
		var page = 'Monthly_report/re_credit.php?' + data;
		window.open(page, 'Patients', 'width=700, height=500,resizable=yes, scrollbars=yes');
	}

	function printdrug(url) {
		var data = 'did=' + document.getElementById('repempid').value;
		if (document.getElementById('branchid') != null) {
			data += '&branchid=' + document.getElementById('branchid').value;
		}
		var page = url + data;
		window.open(page, 'Patients', 'width=700, height=500,resizable=yes, scrollbars=yes');
	}

	function caldisper(n, dis, total) {
		var x = 0;
		if (n.value != '') {
			x = parseFloat(n.value.replace(",", ""));
		}
		if (x > 100) {
			x = 100;
		}
		var ds = (total * x) / 100;
		var sum = total - ds;
		dis = dis + ds;
		if (x > 0) {
			n.value = x;
		} else {
			n.value = '0';
		}
		if (dis > 0) {
			document.getElementById('discount').value = formatMoney(dis);
		} else {
			document.getElementById('discount').value = '0';
		}
		if (sum > 0) {
			document.getElementById('sum').value = formatMoney(sum);
			document.getElementById('cash').value = formatMoney(sum);
		} else {
			document.getElementById('sum').value = '0';
			document.getElementById('cash').value = '0';
		}
	}

	function caldisperDC(n, dis, total, m) {
		var x = 0;
		if (n.value != '') {
			x = parseFloat(n.value.replace(",", ""));
		}
		if (x > 100) {
			x = 100;
		}
		var ds = (total * x) / 100;

		dis = dis + ds;
		var sum = total - ds;
		if (x > 0) {
			n.value = x;
		} else {
			n.value = '0';
		}

		if (m == 1) {
			if (dis > 0) {
				document.getElementById('dp').value = formatMoney(dis);
			} else {
				document.getElementById('dp').value = '0';
			}
			if (sum > 0) {
				document.getElementById('dsum').value = formatMoney(sum);
			} else {
				document.getElementById('dsum').value = '0';
			}
		}
		if (m == 2) {
			if (dis > 0) {
				document.getElementById('lp').value = formatMoney(dis);
			} else {
				document.getElementById('lp').value = '0';
			}
			if (sum > 0) {
				document.getElementById('lsum').value = formatMoney(sum);
			} else {
				document.getElementById('lsum').value = '0';
			}
		}
		if (m == 3) {
			if (dis > 0) {
				document.getElementById('tp').value = formatMoney(dis);
			} else {
				document.getElementById('tp').value = '0';
			}
			if (sum > 0) {
				document.getElementById('tsum').value = formatMoney(sum);
			} else {
				document.getElementById('tsum').value = '0';
			}
		}
		if (m == 4) {
			if (dis > 0) {
				document.getElementById('cp').value = formatMoney(dis);
			} else {
				document.getElementById('cp').value = '0';
			}
			if (sum > 0) {
				document.getElementById('csum').value = formatMoney(sum);
			} else {
				document.getElementById('csum').value = '0';
			}
		}
		if (m == 5) {
			if (dis > 0) {
				document.getElementById('pp').value = formatMoney(dis);
			} else {
				document.getElementById('pp').value = '0';
			}
			if (sum > 0) {
				document.getElementById('psum').value = formatMoney(sum);
			} else {
				document.getElementById('psum').value = '0';
			}
		}

		var ds = parseFloat(document.getElementById('dp').value.replace(",", ""));
		var ls = parseFloat(document.getElementById('lp').value.replace(",", ""));
		var ts = parseFloat(document.getElementById('tp').value.replace(",", ""));
		var cs = parseFloat(document.getElementById('cp').value.replace(",", ""));
		var ps = parseFloat(document.getElementById('pp').value.replace(",", ""));

		var dstotal = ds + ls + ts + cs + ps;

		var dp = parseFloat(document.getElementById('dsum').value.replace(",", ""));
		var lp = parseFloat(document.getElementById('lsum').value.replace(",", ""));
		var tp = parseFloat(document.getElementById('tsum').value.replace(",", ""));
		var cp = parseFloat(document.getElementById('csum').value.replace(",", ""));
		var pp = parseFloat(document.getElementById('psum').value.replace(",", ""));

		var ptotal = dp + lp + tp + cp + pp;
		if (dstotal > 0) {
			document.getElementById('discount').value = formatMoney(dstotal);
			document.getElementById('tdis').value = formatMoney(dstotal);
		} else {
			document.getElementById('discount').value = '0.00';
			document.getElementById('tdis').value = '0.00';
		}
		if (ptotal > 0) {
			document.getElementById('sum').value = formatMoney(ptotal);
			document.getElementById('ttotal').value = formatMoney(ptotal);
			document.getElementById('cash').value = formatMoney(ptotal);
		} else {
			document.getElementById('sum').value = '0.00';
			document.getElementById('ttotal').value = '0.00';
			document.getElementById('cash').value = '0.00';
		}

	}


	function usepct(URL, displayId) {
		if (document.getElementById('pename').value != '') {
			if (Number(document.getElementById('pctqty').value) > 0 && Number(document.getElementById('pctqty').value) <= Number(document.getElementById('num').value)) {
				if (document.getElementById('pctTqty').value != '') {
					var data = 'hn=' + document.getElementById('hn').value;
					data += '&vn=' + document.getElementById('vn').value;
					data += '&pvn=' + document.getElementById('pvn').value;
					data += '&tid=' + document.getElementById('ptid').value;
					data += '&eid=' + document.getElementById('peid').value;
					data += '&ename=' + document.getElementById('pename').value;

					data += '&eid1=' + document.getElementById('peid1').value;
					data += '&ename1=' + document.getElementById('pename1').value;

					data += '&eid2=' + document.getElementById('peid2').value;
					data += '&ename2=' + document.getElementById('pename2').value;

					data += '&qty=' + document.getElementById('pctqty').value;
					data += '&tqty=' + document.getElementById('pctTqty').value;

					ajaxEdit('post', URL, data, displayId);
				} else {
					alert('');
				}
			} else {
				alert(' 0  ');
			}
		} else {
			alert('');
		}
	}


	function getlt(a) {
		if (document.getElementById('mem').value != '') {
			document.getElementById('mem').value = document.getElementById('mem').value + ' , ' + a.value;
		} else {
			document.getElementById('mem').value = a.value;
		}
	}

	function loadlogin() {
		document.getElementById('bg').style.display = '';
		document.getElementById('login_zone').style.display = '';
		mdrug('Monthly_report/rebuydruge_list.php', 'd_list');
	}

	function login() {
		if (document.getElementById('username').value != '') {
			if (document.getElementById('password').value != '') {
				let user = document.getElementById('username').value;
				let pass = document.getElementById('password').value;
				$.ajax({
					type: 'POST',
					url: 'register/login.php',
					dataType: 'json',
					data: {
						FN: "check_user",
						user: user,
						pass: pass
					},
					success: function(data) {
						console.log(data);
						if (data[1] == "login_success") {
							// checkModeUser(data[0]);
							location.reload();
						} else if (data == "user_not_found") {
							alert('Username หรือ Password ไม่ถูกต้อง');
						}
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {
						console.log(errorThrown)
					}
				});
				// ajaxLogin('post', 'register/login.php', data, 'dock');
			} else {
				alert('กรุณากรอก Password');
			}
		} else {
			alert('กรุณากรอก Username');
		}
	}

	function checkUser() {
		let sessionUser = "";
		if (document.getElementById('session_user') != null) {
			sessionUser = document.getElementById('session_user').value;
		}
		if (sessionUser == "") {
			document.getElementById('bg').style.display = '';
			document.getElementById('login_zone').style.display = '';
		} else {
			lll();
		}
	}

	function logout() {
		if(confirm("คุณจะออกจากระบบ ใช่ หรือ ไม่")){
			$.ajax({
			type: 'POST',
			url: 'register/login.php',
			dataType: 'json',
			data: {
				FN: "logout_user",
			},
				success: function(data) {
					console.log(data);
					if (data == "logout_success") {
						alert('ออกจากระบบเรียบร้อย');
						location.reload();
					}
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					console.log(errorThrown)
				}
			});
		}
	}

	function dtime() {
		if (document.getElementById('empid').value != '00') {
			var data = 'eid=' + document.getElementById('empid').value;
			data += '&tin=' + document.getElementById('tin').value;
			data += '&tout=' + document.getElementById('tout').value;
			data += '&mem=' + document.getElementById('mem').value;
			data += '&mode=add';
			ajaxLoad('post', 'daily_report/dtime.php', data, 'reportpage')
		} else {
			alert('กรุณาเลือกแพทย์');
		}

	}

	function cdtime() {
		if (document.getElementById('empid').value != '00') {
			var data = 'eid=' + document.getElementById('empid').value;
			data += '&mode=del';
			ajaxLoad('post', 'daily_report/dtime.php', data, 'reportpage')
		} else {
			alert('กรุณาเลือกแพทย์');
		}

	}


	function showdtime(eid, tin, tout, mem) {
		var data = 'eid=' + eid;
		data += '&tin=' + tin;
		data += '&tout=' + tout;
		data += '&mem=' + mem;
		data += '&mode=show';
		ajaxLoad('post', 'daily_report/dtime.php', data, 'reportpage')
	}



	function ajaxLogin(method, URL, data, displayId) {
		document.getElementById('loading').style.display = '';
		var ajax = null;
		if (window.ActiveXObject) {
			ajax = new ActiveXObject("Microsoft.XMLHTTP");
		} else if (window.XMLHttpRequest) {
			ajax = new XMLHttpRequest();
		} else {
			alert("Your brower doesn't support Ajax");
			return;
		}
		method = method.toLowerCase();
		URL += "?dummy=" + (new Date()).getTime();
		if (method.toLowerCase() == 'get') {
			URL += "&" + data;
			data = null;
		}

		ajax.open(method, URL);
		if (method.toLowerCase() == 'post') {
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		}
		ajax.onreadystatechange = function() {
			if (ajax.readyState == 4 && ajax.status == 200) {
				var ctype = ajax.getResponseHeader("Content-Type");
				ctype = ctype.toLowerCase();
				ajaxcallLogin(ctype, displayId, ajax.responseText);
				delete ajax;
				ajax = null;
			}
		}
		ajax.send(data);
	}

	function lll() {
		ajaxLoad('post', 'Monthly_report/rebuydruge.php', '', 'home')
	}


	function Check_txt() {
		if (document.getElementById('province').value == "") {
			alert("  ");
			document.getElementById('province').focus();
			return false;
		}
		if (document.getElementById('amphur').value == 'No') {
			alert("  ");
			document.getElementById('amphur').focus();
			return false;
		}

		if (document.getElementById('district').value == "") {
			alert("  ");
			document.getElementById('district').focus();
			return false;
		}
	}


	// Start XmlHttp Object
	function uzXmlHttp() {
		var xmlhttp = false;
		try {
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {
				xmlhttp = false;
			}
		}

		if (!xmlhttp && document.createElement) {
			xmlhttp = new XMLHttpRequest();
		}
		return xmlhttp;
	}
	// End XmlHttp Object

	function data_show(select_id, result) {
		var url = 'register/data.php?select_id=' + select_id + '&result=' + result;

		xmlhttp = uzXmlHttp();
		xmlhttp.open("GET", url, false);
		xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8"); // set Header
		xmlhttp.send(null);
		document.getElementById(result).innerHTML = xmlhttp.responseText;
	}
	//window.onLoad=data_show(5,'amphur');

	function thisFileUpload() {
		document.getElementById("filUpload").click();
		$("#filUpload").change(function(e) {
			var file;
			if ((file = this.files[0])) {
				document.getElementById('file_upload_name').innerHTML = file.name;
			}
		});
	};
</script>



<body>

	<div id="dialog-overlay"></div>
	<div id="dialog-box"></div>
	<input type="hidden" id="session_user" name="session_user" value="<?php echo $_SESSION["SYS_EID"]; ?>" />
	<input type="hidden" id="mode_user" name="mode_user" value="<?php echo $_SESSION["mode"]; ?>" />
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





	<div class="dock" id="dock" style="z-index:888; ">

		<div style="width:auto; padding-left:50px;float:left; font-weight:bold; font-size:18px; text-align:left; line-height:40px; ">
			!!!
		</div>

		<div class="dock-container">

			<div id="menu1" style="float:left; width:auto; cursor:pointer; ">
				<a class="dock-item" href="javascript: loadmodule('home','register/register.php','')">
					<span></span><img src="images/register.png" alt="home" />
				</a>
			</div>

			<div id="menu2" style="float:left; width:auto; cursor:pointer;">
				<a class="dock-item" href="javascript: loadmodule('home','doctor/doctor.php','')"><span></span><img src="images/doctor.png" alt="doctor" /></a>
			</div>

			<div id="menu5" style="float:left; width:auto; cursor:pointer; ">
				<a class="dock-item" href="javascript: loadmodule('home','daily_report/report.php','')"><span></span><img src="images/report.png" alt="daily_report" /></a>
			</div>

			<div id="menu7" style="float:left; width:auto; cursor:pointer;">
				<a class="dock-item" href="javascript: loadmodule('home','promotion/promotion.php','') "><span></span><img src="images/promotion.png" alt="promotion" /></a>
			</div>

			<?php 
				if($_SESSION['mode'] == "S" || $_SESSION['mode'] == "A"){
					?>
					<div id="menu8" style="float:left; width:auto; cursor:pointer; ">
						<a class="dock-item" href="javascript: loadmodule('home','stock/stock_show.php','') "><span></span><img src="images/addstock.png" alt="addstock" /></a>
					</div>
					<?
				}
				if($_SESSION['mode'] == "A"){
					?>
					<div id="menu6" style="float:left; width:auto; cursor:pointer;">
						<a class="dock-item" href="javascript: loadmodule('home','Monthly_report/report.php','')"><span></span><img src="images/Peport_M.png" alt="Monthly_report" /></a>
					</div>

					<div id="menu3" style="float:left; width:auto; cursor:pointer;">
						<a class="dock-item" href="javascript: loadmodule('home','stock/stock.php','') "><span></span><img src="images/stock1.png" alt="stock" /></a>
					</div>

					<div id="menu4" style="float:left; width:auto; cursor:pointer; ">
						<a class="dock-item" href="javascript: loadmodule('home','setting/setting.php','') "><span></span><img src="images/setting.png" alt="setting" /></a>
					</div>
					<?
				}
			?>

			<div id="menu9" style="float:left; width:auto; cursor:pointer;">
				<a class="dock-item" href="javascript: logout()"><span></span><img src="images/logout_icon.png" alt="logout" /></a>
			</div>

		</div>

		<div style="width:auto; padding-right:20px;float:right; font-weight:bold; font-size:16px; text-align:right; line-height:40px; ">
			!!
		</div>

	</div>

	<div id="home" style="width:1003px; margin:auto;">

	</div>
	<div style="width:100%; height:10px; color:#FFFFFF;">&nbsp;</div>
	<script type="text/javascript">
		$(document).ready(
			function() {
				$('#dock').Fisheye({
					maxWidth: 50,
					items: 'a',
					itemsText: 'span',
					container: '.dock-container',
					itemWidth: 40,
					proximity: 30,
					halign: 'center'
				})
				openWhenReady();
				document.getElementById('username').focus();
				
			}
		);
		
		$(".datepicker").Zebra_DatePicker();

		function openWhenReady() {
			var c = (gWH().width / 2) - 200;
			document.getElementById('sd').style.marginLeft = c + 'px';
			document.getElementById('login_zone').style.marginLeft = c + 'px';
			// loadlogin();
			checkUser();
			// var pH1 = $(window).height();
			// if($(window).height() >= 628){ var pH = $(window).height() - 99; } else { pH = 628 - 99;  }
			// var pHl= pH - 20;
		}
		function showIMG() {
			$("#dialog-box").load('webcam.php?hn=' + hn, function() {
			});
		}

	</script>

</body>

</html>