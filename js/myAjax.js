// JavaScript Document
function MM_openBrWindow(theURL, winName, features) {
	window.open(theURL, winName, features);
}

var pHN = '';

var DD_roundies = {
	ns: 'DD_roundies',
	createVmlNameSpace: function () { /* enable VML */
		if (document.namespaces && !document.namespaces[this.ns]) {
			document.namespaces.add(this.ns, 'urn:schemas-microsoft-com:vml');
		}
	},
	createVmlStyleSheet: function () {
		var style = document.createElement('style');
		document.documentElement.firstChild.insertBefore(style, document.documentElement.firstChild.firstChild);
		if (style.styleSheet) { /* IE */
			var styleSheet = style.styleSheet;
			styleSheet.addRule(this.ns + '\\:*', '{behavior:url(#default#VML)}');
			styleSheet.addRule(this.ns + '\\:shape', 'position:absolute; left:0px; top:0px;  z-index:-1;');
			this.styleSheet = styleSheet;
		}
		else {
			this.styleSheet = style;
		}
	},


	addRule: function (selector, radius, standards) {
		if (this.styleSheet.addRule) { /* IE */
			this.styleSheet.addRule(selector, 'behavior:expression(DD_roundies.roundifyElement.call(this, ' + radius + '))');
		}
		else {
			this.styleSheet.appendChild(document.createTextNode(selector + ' {border-radius:' + radius + 'px; -moz-border-radius:' + radius + 'px; -webkit-border-radius:' + radius + 'px;}'));
		}
	},

	roundifyElement: function (rad) {
		this.style.behavior = 'none';
		this.style.zoom = 1;
		if (this.currentStyle.position == 'static') {
			this.style.position = 'relative';
		}
		this.vml = document.createElement(DD_roundies.ns + ':shape');

		/* methods */
		var self = this;
		this.interceptPropertyChanges = function () {
			switch (event.propertyName) {
				case 'style.border':
				case 'style.borderWidth':
				case 'style.padding':
					self.applyVML.call(self);
					break;
				case 'style.borderColor':
					self.updateVmlStrokeColor.call(self);
					break;
				case 'style.backgroundColor':
					self.updateVmlFill.call(self);
			};
		};
		this.applyVML = function () {
			this.runtimeStyle.cssText = '';
			this.updateVmlFill();
			this.updateVmlStrokeWeight();
			this.updateVmlStrokeColor();
			this.updateVmlDimensions();
			this.updateVmlPath();
			this.hideSourceBorder();
		};
		this.hideSourceBorder = function () {
			this.runtimeStyle.border = 'none';
			var sides = ['Top', 'Left', 'Right', 'Bottom'];
			for (var i = 0; i < 4; i++) {
				this.runtimeStyle['padding' + sides[i]] = parseInt(this.currentStyle['padding' + sides[i]]) + parseInt(this.realBorderWidth) + 'px';
			}
		};
		this.updateVmlStrokeWeight = function () {
			this.realBorderWidth = parseInt(this.currentStyle.borderWidth, 10);
			if (this.realBorderWidth.toString() == 'NaN') {
				this.realBorderWidth = 0;
			}
			this.halfRealBorderWidth = Math.floor(this.realBorderWidth / 2);
			this.vml.strokeweight = this.realBorderWidth + 'px';
			this.vml.stroked = !(this.realBorderWidth === 0);
		};
		this.updateVmlStrokeColor = function () {
			this.vml.strokecolor = this.currentStyle.borderColor;
		};
		this.updateVmlFill = function () {
			this.runtimeStyle.backgroundColor = '';
			if (this.currentStyle && (this.currentStyle.backgroundImage != 'none' || (this.currentStyle.backgroundColor && this.currentStyle.backgroundColor != 'transparent'))) {
				this.vml.filled = true;
				if (!this.vml.filler) {
					this.vml.filler = document.createElement(DD_roundies.ns + ':fill');
					this.vml.appendChild(this.vml.filler);
				}
				if (this.currentStyle.backgroundImage) {
					var bg = this.currentStyle.backgroundImage;
					this.vml.filler.src = bg.substr(5, bg.lastIndexOf('")') - 5);
					this.vml.filler.type = 'tile';
				}
				if (this.currentStyle.backgroundColor) {
					this.vml.filler.color = this.currentStyle.backgroundColor;
				}
				this.runtimeStyle.background = 'none';
			}
			else {
				this.vml.filled = false;
			}
		};
		this.updateVmlDimensions = function () {
			if (!this.dim) {
				this.dim = {};
			}
			this.dim.w = this.offsetWidth;
			this.dim.h = this.offsetHeight;
			this.vml.style.width = this.dim.w;
			this.vml.style.height = this.dim.h;
			this.vml.coordorigin = -this.halfRealBorderWidth + ' ' + -this.halfRealBorderWidth;
			this.vml.coordsize = (this.dim.w + this.realBorderWidth) + ' ' + (this.dim.h + this.realBorderWidth);
		};
		this.updateVmlPath = function () {
			this.vml.path = 'm0,' + rad + 'qy' + rad + ',0l' + (this.dim.w - rad) + ',0qx' + this.dim.w + ',' + rad + 'l' + this.dim.w + ',' + (this.dim.h - rad) + 'qy' + (this.dim.w - rad) + ',' + this.dim.h + 'l' + rad + ',' + this.dim.h + 'qx0,' + (this.dim.h - rad) + 'xe';
		};
		this.handlePseudoHover = function () {
			setTimeout(function () { /* wouldn't work as intended without setTimeout */
				self.runtimeStyle.backgroundColor = '';
				self.updateVmlFill.call(self);
				self.updateVmlStrokeColor.call(self);
			}, 1);
		};

		/* set up element */
		this.insertBefore(this.vml, this.firstChild);
		this.applyVML();

		/* add change handlers */
		if (this.nodeName == 'A') {
			this.attachEvent('onmouseleave', this.handlePseudoHover);
			this.attachEvent('onmouseenter', this.handlePseudoHover);
		}
		this.attachEvent('onpropertychange', this.interceptPropertyChanges);
		this.attachEvent('onresize', function () {
			self.updateVmlDimensions.call(self);
			self.updateVmlPath.call(self);
		});
	}
};
//DD_roundies.createVmlNameSpace();
//DD_roundies.createVmlStyleSheet();

function ajaxLoadsend(method, URL, data, displayId) {
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
	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {
			var ctype = ajax.getResponseHeader("Content-Type");
			ctype = ctype.toLowerCase();
			ajaxcallsendpatient(ctype, displayId, ajax.responseText);
			delete ajax;
			ajax = null;
		}
	}
	ajax.send(data);
}

function ajaxcallsendpatient(contentType, displayId, responseText) {
	document.getElementById('loading').style.display = 'none';
	if (contentType.match("text/javascript")) {
		eval(responseText);
	} else {
		//  alert(responseText);
		var mode = responseText.split('||');
		//alert(responseText);
		if (mode[3] == 'Y') {
			alert(mode[4]);
			var page = 'report/slip_drug.php?hn=' + mode[2];
			window.open(page, 'INVOICE/RECEIPT', 'width=400, height=600,resizable=yes, scrollbars=yes');
		}

		if (mode[3] == 'C') {
			var page = 'register/cbilForm.php?vn=' + mode[2];
			window.open(page, 'CANCEL BILL', 'width=400, height=600,resizable=yes, scrollbars=yes');
			ajaxLoad('post', mode[1], '', displayId);
		}
		if (mode[3] == 'D') {
			alert(mode[4]);
			ajaxLoad('post', mode[1], '', displayId);
		}
		cancelsend();
	}
}


function ajaxLoadpay(method, URL, data, displayId) {

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
	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {
			var ctype = ajax.getResponseHeader("Content-Type");
			ctype = ctype.toLowerCase();
			ajaxcallpay(ctype, displayId, ajax.responseText);
			delete ajax;
			ajax = null;
		}
	}
	ajax.send(data);
}

function ajaxcallpay(contentType, displayId, responseText) {

	document.getElementById('loading').style.display = 'none';
	if (contentType.match("text/javascript")) {
		eval(responseText);
	} else {

		var mode = responseText.split('||');
		var data = 'vn=' + mode[2];
		if (mode[3] == 'ADD') { }

		var page = 'report/slip_payment.php?bno=' + mode[2];
		window.open(page, 'INVOICE/RECEIPT', 'width=400, height=500,resizable=yes, scrollbars=yes');

		if (mode[5] == 'RG') {
			var page = 'report/slip_drugreg.php?hn=' + mode[6] + '&vn=' + mode[7];
			//window.location = 'report/slip_drugreg.php?hn='+mode[6]+'&vn='+mode[7];
			window.open(page, 'INVOICE/RECEIPT', 'width=450, height=550,resizable=yes, scrollbars=yes');
		} else {
			goAppointment(mode[6], mode[7]);
		}
	}
}



function ajaxLoadapay(method, URL, data, displayId) {
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
	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {
			var ctype = ajax.getResponseHeader("Content-Type");
			ctype = ctype.toLowerCase();
			ajaxcallapay(ctype, displayId, ajax.responseText);
			delete ajax;
			ajax = null;
		}
	}
	ajax.send(data);
}

function ajaxcallapay(contentType, displayId, responseText) {

	document.getElementById('loading').style.display = 'none';
	if (contentType.match("text/javascript")) {
		eval(responseText);
	} else {

		var mode = responseText.split('||');
		var data = 'vn=' + mode[2];
		if (mode[3] == 'ADD') { alert(mode[4]); }
		ajaxLoad('post', mode[1], '', displayId);
		var page = 'report/slip_apayment.php?bno=' + mode[2];

		window.open(page, 'INVOICE/RECEIPT', 'width=400, height=500,resizable=yes, scrollbars=yes');

	}
}


function openpop(page) {
	window.open(page, 'Course', 'width=700, height=600,resizable=yes, scrollbars=yes');
}

function ajaxLoadvst(method, URL, data, displayId) {
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
	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {
			var ctype = ajax.getResponseHeader("Content-Type");
			ctype = ctype.toLowerCase();
			ajaxcallvst(ctype, displayId, ajax.responseText);
			delete ajax;
			ajax = null;
		}
	}
	ajax.send(data);
}

function ajaxcallvst(contentType, displayId, responseText) {

	document.getElementById('loading').style.display = 'none';
	if (contentType.match("text/javascript")) {
		eval(responseText);
	} else {
		var mode = responseText.split('||');
		var data = 'vn=' + mode[2];
		if (mode[3] == 'ADD') { alert(mode[4]); }
		ajaxLoad('post', mode[1], data, displayId);
	}
}





function ajaxAddpatient(method, URL, data) {
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
	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {
			var ctype = ajax.getResponseHeader("Content-Type");
			ctype = ctype.toLowerCase();
			ajaxcallAddpatient(ctype, ajax.responseText);
			delete ajax;
			ajax = null;
		}
	}
	ajax.send(data);
}

function ajaxcallAddpatient(contentType, responseText) {
	document.getElementById('loading').style.display = 'none';
	if (contentType.match("text/javascript")) {
		eval(responseText);
	} else {
		var txt = responseText.split('||');

		alert(txt[2]);
		if (txt[1] == 'Yes') {
			cleartabreg(6, 5, 8, 'register/patient_edit_from.php', 'content', 'hn=' + txt[3]);
		}

	}
}




function ajaxAdddruge(method, URL, data) {
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
	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {
			var ctype = ajax.getResponseHeader("Content-Type");
			ctype = ctype.toLowerCase();
			ajaxcallAdddruge(ctype, ajax.responseText);
			delete ajax;
			ajax = null;
		}
	}
	ajax.send(data);
}

function ajaxcallAdddruge(contentType, responseText) {
	document.getElementById('loading').style.display = 'none';
	if (contentType.match("text/javascript")) {
		eval(responseText);
	} else {
		var txt = responseText.split('||');

		alert(txt[2]);
		if (txt[1] == 'Yes') {
			swabtab(5, 5, 'stock/druge_edit_from.php', 'content', 'did=' + txt[3])

		}

	}
}




function ajaxEdit(method, URL, data, displayId) {
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
	ajax.onreadystatechange = function () {

		if (ajax.readyState == 4 && ajax.status == 200) {
			var ctype = ajax.getResponseHeader("Content-Type");
			ctype = ctype.toLowerCase();
			ajaxcallEdit(ctype, displayId, ajax.responseText);
			delete ajax;
			ajax = null;
		}
	}
	ajax.send(data);
}

function ajaxcallEdit(contentType, displayId, responseText) {
	console.log(responseText);
	//alert(responseText);
	document.getElementById('loading').style.display = 'none';
	if (contentType.match("text/javascript")) {
		eval(responseText);
	} else {

		var mode = responseText.split('||');

		if (mode[3] == 'ADD') { alert(mode[4]); }
		if (mode[2] == 'PCT') {
			var txt = mode[4];
			ajaxLoad('get', mode[1], txt, displayId);
		} else if (mode[2] == 'APP') {
			if (mode[5] == 'Y') {
				ajaxLoad('get', mode[1], txt, displayId);
			}

		} else if (mode[2] == 'STOCK') {

			var txt = 'lno=' + mode[3];
			ajaxLoad('get', mode[1], mode[3], displayId);
			if (mode[5] == 'Y') {
				var page = 'report/instock_form.php?' + txt;
				window.open(page, 'Instock', 'width=1003, height=600,resizable=yes, scrollbars=yes');
			}

		} else if (mode[2] == 'ADJSTOCK') {

			var txt = 'lno=' + mode[3];
			ajaxLoad('get', mode[1], mode[3], displayId);
			if (mode[5] == 'Y') {
				var page = 'report/cutstock_form.php?' + txt;
				window.open(page, 'Cutstock', 'width=1003, height=600,resizable=yes, scrollbars=yes');
			}

		} else if (mode[2] == 'PR') {
			loadmodule('home', 'promotion/promotion.php');
		} else {
			var txt = 'mode=' + mode[2];

			ajaxLoad('get', mode[1], txt, displayId);
		}



	}
}



function ajaxcallLogin(contentType, displayId, responseText) {
	document.getElementById('loading').style.display = 'none';
	if (contentType.match("text/javascript")) {
		eval(responseText);
	} else {

		var mode = responseText.split('||');

		if (mode[1] == 'N') { alert(mode[2]); } else {
			//alert(mode[2]);
			switch (mode[2]) {
				case 'A': document.getElementById('menu1').style.display = '';
					document.getElementById('menu2').style.display = '';
					document.getElementById('menu3').style.display = '';
					document.getElementById('menu4').style.display = '';
					document.getElementById('menu5').style.display = '';
					document.getElementById('menu6').style.display = '';
					document.getElementById('menu7').style.display = '';
					document.getElementById('menu8').style.display = '';
					break;
				case 'E': document.getElementById('menu1').style.display = '';
					document.getElementById('menu2').style.display = '';
					document.getElementById('menu3').style.display = 'none';
					document.getElementById('menu4').style.display = 'none';
					document.getElementById('menu5').style.display = '';
					document.getElementById('menu6').style.display = 'none';
					document.getElementById('menu7').style.display = '';
					document.getElementById('menu8').style.display = 'none';
					break;
				case 'S': document.getElementById('menu1').style.display = '';
					document.getElementById('menu2').style.display = '';
					document.getElementById('menu3').style.display = 'none';
					document.getElementById('menu4').style.display = 'none';
					document.getElementById('menu5').style.display = '';
					document.getElementById('menu6').style.display = 'none';
					document.getElementById('menu7').style.display = '';
					document.getElementById('menu8').style.display = '';


					break;
			}

			document.getElementById('bg').style.display = 'none';
			document.getElementById('login_zone').style.display = 'none';
			document.getElementById('username').value = '';
			document.getElementById('password').value = '';
		}


	}
}



function ajaxLoad(method, URL, data, displayId) {
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
	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {
			var ctype = ajax.getResponseHeader("Content-Type");
			ctype = ctype.toLowerCase();
			ajaxcallback(ctype, displayId, ajax.responseText);
			delete ajax;
			ajax = null;
		}
	}
	ajax.send(data);
}

function ajaxcallback(contentType, displayId, responseText) {

	document.getElementById('loading').style.display = 'none';
	if (contentType.match("text/javascript")) {
		eval(responseText);
	} else {
		var el = document.getElementById(displayId);
		el.innerHTML = responseText;

	}
}

function loadpage(divname, n, m, url) {

	var i = 1;
	while (i < m + 1) {
		if (i != n) {
			document.getElementById('tab' + i).style.background = 'none';

		} else {
			document.getElementById('tab' + i).style.background = '#FFFFFF';

		}
		i++;
	}

	document.getElementById('loading').style.display = '';
	ajaxLoad('post', url, '', divname);
}

function loadmodule(divname, url, data) {
	document.getElementById('loading').style.display = '';
	ajaxLoad('post', url, data, divname);
}


function oldcourse(hn, vn) {
	var page = 'doctor/pct_from.php?hn=' + hn + '&vn=' + vn;
	window.open(page, 'SLIP', 'width=800, height=370,resizable=yes, scrollbars=yes');
}




function clickclear(thisfield, defaulttext) {
	if (thisfield.value == defaulttext) {
		thisfield.value = "";
	}
}

function clickrecall(thisfield, defaulttext) {
	if (thisfield.value == "") {
		thisfield.value = defaulttext;
	}
}

function linkover(a) {
	a.style.background = '#FFFFCC  url(images/icon/bulletgo.png) left no-repeat';
}

function linkout(a, color) {
	a.style.background = color;
}

function setbtnSetting(n, m) {
	var i = 1;
	while (i < m + 1) {
		if (i != n) {
			document.getElementById('ST' + i).style.display = 'none';
		} else {
			document.getElementById('ST' + i).style.display = '';
		}
		i++;
	}
}

function serchtxt(URL, displayId, txt) {
	var data = 'txt=' + txt.value;
	// data += '&sel=' + $('#sel_branchid_stock').val();
	ajaxLoad('get', URL, data, displayId);
}
function serchtxtStock(URL, displayId, txt) {
	var data = 'txt=' + txt.value;
	data += '&sel=' + $('#sel_branchid_stock').val();
	ajaxLoad('get', URL, data, displayId);
}
function serchtxtPatient(URL, displayId, txt) {
	var data = 'txt=' + $('#txts').val();
	data += '&sel=' + $('#sel_branchid_patient').val();
	ajaxLoad('get', URL, data, displayId);
}

function serchsel(URL, displayId, txt) {
	var data = 'txt=' + $('#txts').val();
	data += '&sel=' + txt.value
	ajaxLoad('get', URL, data, displayId);
}

function serchlab(URL, displayId, txt) {
	var txt = 'txt=' + txt.value;
	ajaxLoad('get', URL, txt, displayId);
	if (document.getElementById('lname').value == '') {
		document.getElementById('THl').style.display = 'none';
		document.getElementById('lid').value = '';
		document.getElementById('lqty').value = '';
		document.getElementById('lprice').value = '';
		document.getElementById('luprice').value = '';
	}
}

function serchlaer(URL, displayId, txt) {
	var txt = 'txt=' + txt.value;
	ajaxLoad('get', URL, txt, displayId);
	if (document.getElementById('tname').value == '') {
		document.getElementById('ull').style.display = 'none';
		document.getElementById('tid').value = '';
		document.getElementById('ttype').value = '';
		document.getElementById('tqty').value = '';
		document.getElementById('tprice').value = '';
		document.getElementById('tuprice').value = '';
		document.getElementById('tunit').innerHTML = '';
		document.getElementById('eid').value = '';
		document.getElementById('ename').value = '';
		document.getElementById('seid').value = '';
		document.getElementById('sename').value = '';
	}
}


function serchpct(URL, displayId, txt) {
	var txt = 'txt=' + txt.value;
	txt += '&type=' + document.getElementById('ptype').value;

	ajaxLoad('get', URL, txt, displayId);
	if (document.getElementById('pname').value == '') {
		clearpct();
	}
}

function clearpct() {
	document.getElementById('cll').style.display = 'none';
	document.getElementById('pid').value = '';
	document.getElementById('pname').value = '';
	document.getElementById('pprice').value = '';
	document.getElementById('puprice').value = '';
	document.getElementById('pqty').value = '';
	document.getElementById('pseid').value = '';
	document.getElementById('psename').value = '';
	document.getElementById('pname').focus();
}

function addgernaral(URL, displayId) {
	if (document.getElementById('gname').value != '') {
		var data = 'gname=' + document.getElementById('gname').value;
		data += '&id=' + document.getElementById('gid').value;
		data += '&type=' + document.getElementById('typ').value;
		data += '&mode=' + document.getElementById('mode').value;
		data += '&dis=' + document.getElementById('dis').value;
		ajaxEdit('post', URL, data, displayId);
		document.getElementById('gname').value = '';
		document.getElementById('gname').focus();
		document.getElementById('gid').value = '';
		document.getElementById('typ').value = '';
		document.getElementById('dis').value = '0';
	}
}

function cleargenaral() {
	document.getElementById('gname').value = '';
	document.getElementById('gid').value = '';
	document.getElementById('typ').value = '';
	document.getElementById('dis').value = '0';
	document.getElementById('gname').focus();
}

function clearpromotion() {
	document.getElementById('gname').value = '';
	document.getElementById('gid').value = '';
	document.getElementById('typ').value = '';
	document.getElementById('dis').value = '0';
	document.getElementById('gname').focus();
}



function editgernaral(gname, id, dis) {
	document.getElementById('gname').value = gname;
	document.getElementById('gid').value = id;
	document.getElementById('typ').value = 'edit';
	document.getElementById('dis').value = dis;
	document.getElementById('gname').focus();
}

function edittreatment(tid, tname, qty, price, mode, tunit, tgroup) {
	document.getElementById('tname').value = tname;
	document.getElementById('tid').value = tid;
	document.getElementById('mode').value = mode;
	document.getElementById('price').value = price;
	document.getElementById('typ').value = 'edit';
	if (mode == 'T') {
		document.getElementById('tn1').style.display = 'none';
		document.getElementById('unit').style.display = 'none';
		document.getElementById('unit').value = '';
	} else {
		document.getElementById('tn1').style.display = '';
		document.getElementById('unit').style.display = '';
		document.getElementById('unit').value = tunit;
	}
	document.getElementById('tgroup').value = tgroup;
	document.getElementById('tname').focus();
}

function getid(id1, id2, txt1, txt2, displayId, data, URL) {
	document.getElementById(id1).value = txt1;
	document.getElementById(id2).value = txt2;
	document.getElementById(id2).focus();
	ajaxLoad('get', URL, data, displayId);
}

function cleartabreg(id, n, m, URL, displayId, data) {
	var i = 1; pHN = data;
	while (i < m + 1) {
		document.getElementById('tab' + i).style.display = 'none';
		i++;
	}
	document.getElementById('loading').style.display = '';
	document.getElementById('tab' + id).style.display = '';

	if (id == 5) {
		document.getElementById('tab8').style.display = '';
		document.getElementById('tab9').style.display = '';
		document.getElementById('tab10').style.display = '';
	}

	ajaxLoad('post', URL, data, displayId);
}

function regClick(mode, URL, displayId) {
	document.getElementById('loading').style.display = '';

	if (mode == 'F') {
		document.getElementById('tab8').style.background = 'none';
		document.getElementById('tab9').style.background = 'none';
		document.getElementById('tab10').style.background = 'none';
		document.getElementById('tab5').style.background = '#FFFFFF';
	} else if (mode == 'H') {
		document.getElementById('tab5').style.background = 'none';
		document.getElementById('tab9').style.background = 'none';
		document.getElementById('tab10').style.background = 'none';
		document.getElementById('tab8').style.background = '#FFFFFF';
	} else if (mode == 'T') {
		document.getElementById('tab5').style.background = 'none';
		document.getElementById('tab8').style.background = 'none';
		document.getElementById('tab10').style.background = 'none';
		document.getElementById('tab9').style.background = '#FFFFFF';
	} else if (mode == 'U') {
		document.getElementById('tab5').style.background = 'none';
		document.getElementById('tab8').style.background = 'none';
		document.getElementById('tab9').style.background = 'none';
		document.getElementById('tab10').style.background = 'FFFFFF';
	}

	ajaxLoad('post', URL, pHN, displayId);
}

function returtxt(id, txt, displayId, data, URL) {
	document.getElementById(id).value = txt;

	serchtxt(URL, displayId, '');

	document.getElementById(id).focus();
}



function blurtxt(x, URL) {
	var txt = document.getElementById(x).innerHTML.split('||</font>');

	if (txt[1]) {
		//serchtxt(URL,x,'DENO');
	} else {
		serchtxt(URL, x, '');
	}
}


function adddruganti(URL, displayId, pURL) {

	if (document.getElementById('drug').value != '') {

		var data = 'hn=' + document.getElementById('hn').value;
		data += '&did=' + document.getElementById('did').value;
		data += '&dname=' + document.getElementById('drug').value;
		data += '&url=' + pURL;

		ajaxEdit('post', URL, data, displayId);

		document.getElementById('did').value = '';
		document.getElementById('drug').value = '';
		document.getElementById('drug').focus();
	}
}


function adddinose(URL, displayId, pURL) {

	if (document.getElementById('doid').value != '') {

		var data = 'hn=' + document.getElementById('hn').value;
		data += '&did=' + document.getElementById('doid').value;
		data += '&dname=' + document.getElementById('dio').value;
		data += '&url=' + pURL;

		ajaxEdit('post', URL, data, displayId);

		document.getElementById('doid').value = '';
		document.getElementById('dio').value = '';
		document.getElementById('dio').focus();
	}
}


function chk_dob(line) {
	if (line == 1) {
		if (document.getElementById('dd').value.length > 1) { document.getElementById('dm').focus(); }
	} else {
		if (document.getElementById('dm').value.length > 1) { document.getElementById('dy').focus(); }
	}
}

function calage(y) {
	if (document.getElementById('dy').value.length > 3) {
		var age = y - document.getElementById('dy').value;
		if (age < 0) {
			age = (y + 543) - document.getElementById('dy').value;
		}
		document.getElementById('age').value = age;
	} else {
		document.getElementById('age').value = '';
	}
}

function swabtab(id, n, URL, displayId, data) {
	pHN = data;
	var i = 1;
	while (i < n + 1) {
		document.getElementById('tab' + i).style.display = 'none';
		i++;
	}
	document.getElementById('tab' + id).style.display = '';
	if (id == '2') {
		document.getElementById('tab3').style.display = '';
	}
	ajaxLoad('get', URL, data, displayId);
}


function doctorClick(mode, URL, displayId) {
	document.getElementById('loading').style.display = '';



	if (mode == 'F') {
		document.getElementById('tab3').style.background = 'none';
		document.getElementById('tab2').style.background = '#FFFFFF';
	} else if (mode == 'T') {
		document.getElementById('tab2').style.background = 'none';
		document.getElementById('tab3').style.background = '#FFFFFF';
	}


	ajaxLoad('get', URL, pHN, displayId);
}



function addclinic(URL, displayId) {
	if (document.getElementById('cn').value != '') {
		var data = 'cn=' + document.getElementById('cn').value;
		data += '&name=' + document.getElementById('name').value;
		data += '&engname=' + document.getElementById('engname').value;
		data += '&otime=' + document.getElementById('otime').value;
		data += '&ctime=' + document.getElementById('ctime').value;
		data += '&add=' + document.getElementById('add').value;
		data += '&engadd=' + document.getElementById('engadd').value;
		data += '&pro=' + document.getElementById('pro').value;
		data += '&pos=' + document.getElementById('pos').value;
		data += '&texid=' + document.getElementById('texid').value;
		data += '&number=' + document.getElementById('number').value;
		data += '&tel=' + document.getElementById('tel').value;
		data += '&fax=' + document.getElementById('fax').value;
		data += '&edit=' + document.getElementById('edit').value;
		ajaxEdit('post', URL, data, displayId);

	}
}

function instock_movetxt(did, dname, dunit, mode) {
	document.getElementById('did').value = did;
	document.getElementById('dname').value = dname;
	document.getElementById('dunit').innerHTML = dunit;
	document.getElementById('qty').value = '';
	document.getElementById('qty').focus();
	if (mode == 'I') {
		document.getElementById('bdate').value = '';
		document.getElementById('edate').value = '';
		document.getElementById('totalprice').value = '';
		document.getElementById('price').value = '';
	}
}

function treatment_movetxt(tid, tname, price) {
	document.getElementById('tid').value = tid;
	document.getElementById('tname').value = tname;
	document.getElementById('qty').value = '1';
	document.getElementById('price').value = price;
	document.getElementById('uprice').value = price;
	document.getElementById('qty').focus();

}

function treatment_movetxt_pc(tid, tname, price, typ) {
	document.getElementById('tid').value = tid;
	document.getElementById('tname').value = tname;
	document.getElementById('qty').value = '1';
	document.getElementById('price').value = price;
	document.getElementById('uprice').value = price;
	document.getElementById('ptyp').value = typ;
	document.getElementById('qty').focus();

}


function xprice(total) {
	var price = total.value * document.getElementById('uprice').value;
	document.getElementById('price').value = price;
}

function divprice(total) {
	var price = total.value / document.getElementById('qty').value;
	document.getElementById('price').value = price;
	document.getElementById('bdate').focus();
}


function autoDate(obj, did) {
	if (obj.value.length == 2) {
		obj.value = obj.value + '/';
	} else if (obj.value.length == 5) {
		obj.value = obj.value + '/';
	} else if (obj.value.length == 10) {
		document.getElementById(did).focus();
	}

}




function addinstock(URL, displayId) {
	if (document.getElementById('lno').value != '') {
		if (document.getElementById('sid').value != '') {
			var data = 'lno=' + document.getElementById('lno').value;
			data += '&sid=' + document.getElementById('sid').value;
			data += '&sname=' + document.getElementById('sname').value;
			ajaxEdit('post', URL, data, 'content');
		}
	}
}


function addcutstock(URL, displayId) {
	if (document.getElementById('lno').value != '') {
		if (document.getElementById('cmem').value != '') {
			var data = 'lno=' + document.getElementById('lno').value;
			data += '&cmem=' + document.getElementById('cmem').value;
			ajaxEdit('post', URL, data, 'content');
		}
	}
}



function addstaff(URL, displayId) {
	if (document.getElementById('staffid').value != '') {
		var data = 'staffid=' + document.getElementById('staffid').value;
		data += '&branch=' + document.getElementById('branch').value;
		data += '&pname=' + document.getElementById('pname').value;
		data += '&sex=' + document.getElementById('sex').value;
		data += '&fname=' + document.getElementById('fname').value;
		data += '&lname=' + document.getElementById('lname').value;
		data += '&nname=' + document.getElementById('nname').value;
		data += '&pos=' + document.getElementById('pos').value;
		data += '&st=' + document.getElementById('st').value;
		data += '&bl=' + document.getElementById('bl').value;
		data += '&dd=' + document.getElementById('dd').value;
		data += '&dm=' + document.getElementById('dm').value;
		data += '&dy=' + document.getElementById('dy').value;
		data += '&degree=' + document.getElementById('degree').value;
		data += '&acc=' + document.getElementById('acc').value;
		data += '&address=' + document.getElementById('address').value;
		data += '&tel=' + document.getElementById('tel').value;
		data += '&idcard=' + document.getElementById('idcard').value;
		data += '&mail=' + document.getElementById('mail').value;
		data += '&status=' + document.getElementById('status').value;
		data += '&tpy=' + document.getElementById('tpy').value;
		data += '&sdate=' + document.getElementById('sdate').value;
		data += '&dday=' + document.getElementById('dday').value;
		data += '&ll=' + document.getElementById('ll').value;
		data += '&sso=' + document.getElementById('sso').value;
		data += '&ssonum=' + document.getElementById('ssonum').value;
		data += '&mode=' + document.getElementById('mode').value;
		data += '&type=' + document.getElementById('typ').value;
		data += '&eshow=' + document.getElementById('eshow').value;
		data += '&user=' + document.getElementById('user').value;
		data += '&pass=' + document.getElementById('pass').value;
		ajaxEdit('post', URL, data, displayId);
	}
}

function addpromotion(URL, displayId) {
	if (document.getElementById('proid').value != '') {
		var data = 'proid=' + document.getElementById('proid').value;
		data += '&proname=' + document.getElementById('proname').value;
		data += '&dat=' + document.getElementById('dat').value;
		data += '&dat1=' + document.getElementById('dat1').value;
		data += '&mem=' + document.getElementById('mem').value;
		data += '&tel=' + document.getElementById('tel').value;
		data += '&type=' + document.getElementById('typ').value;
		ajaxEdit('post', URL, data, displayId);
	}
}


function clearmenu(id, n) {
	var i = 1;
	for (i = 1; i < n + 1; i++) {
		document.getElementById('td' + i).style.display = 'none';
	}
	document.getElementById('td' + id).style.display = '';
}

function movedruge(did, dname, price, dunit) {
	document.getElementById('did').value = did;
	document.getElementById('dname').value = dname;
	document.getElementById('qty').value = '1';
	document.getElementById('price').value = price;
	document.getElementById('uprice').value = price;
	document.getElementById('unit').innerHTML = dunit;
	serchtxt('register/druge_list.php', 'dl', '');
	document.getElementById('qty').focus();
}

function movedrugeD(did, dname, price, dunit) {
	document.getElementById('did').value = did;
	document.getElementById('dname').value = dname;
	document.getElementById('qty').value = '1';
	document.getElementById('price').value = price;
	document.getElementById('uprice').value = price;
	document.getElementById('unit').innerHTML = dunit;
	serchtxt('doctor/druge_list.php', 'dl', '');
	document.getElementById('qty').focus();
}

function movelaser(id, tname, price, tunit, typ) {
	document.getElementById('tid').value = id;
	document.getElementById('tname').value = tname;
	document.getElementById('tqty').value = '1';
	document.getElementById('tprice').value = price;
	document.getElementById('tuprice').value = price;
	document.getElementById('ttype').value = typ;
	document.getElementById('tunit').innerHTML = tunit;
	serchtxt('doctor/treatment_list.php', 'tl', '');
	document.getElementById('ull').style.display = '';
	document.getElementById('tuprice').focus();
}


function smovepct(id, name, price) {
	document.getElementById('pid').value = id;
	document.getElementById('pname').value = name;
	document.getElementById('pqty').value = '1';
	serchpct('../payment/pct_list.php', 'pl', '');
	document.getElementById('pqty').focus();

}

function movepct(id, name, price) {
	document.getElementById('pid').value = id;
	document.getElementById('pname').value = name;
	document.getElementById('pqty').value = '1';
	document.getElementById('pprice').value = price;
	document.getElementById('puprice').value = price;
	serchpct('doctor/pct_list.php', 'pl', '');
	document.getElementById('cll').style.display = '';
	document.getElementById('pqty').focus();
}

function omovepct(id, name, price) {
	document.getElementById('pid').value = id;
	document.getElementById('pname').value = name;
	document.getElementById('pqty').value = '1';
	document.getElementById('pprice').value = price;
	document.getElementById('puprice').value = price;
	serchpct('opct_list.php', 'pl', '');
	document.getElementById('cll').style.display = '';
	document.getElementById('pqty').focus();
}


function movelab(lid, lname, lprice) {
	document.getElementById('lid').value = lid;
	document.getElementById('lname').value = lname;
	document.getElementById('lqty').value = '1';
	document.getElementById('lprice').value = lprice;
	document.getElementById('luprice').value = lprice;
	serchtxt('doctor/lab_list.php', 'll', '');
	document.getElementById('THl').style.display = '';
	document.getElementById('lqty').focus();
}

function movepname(hn, cn, pname) {
	document.getElementById('hn').value = hn;
	document.getElementById('cn').value = cn;
	document.getElementById('pname').value = pname;
	serchtxt('appointment/patient_list.php', 'll', '');
	document.getElementById('txtserch').value = '';
	document.getElementById('atyp').focus();
}

function showapplist(URL, displayId) {
	var data = 'dat=' + document.getElementById('dat').value;
	ajaxLoad('get', URL, data, displayId);
}

function moveemp(eid, ename) {
	document.getElementById('eid').value = eid;
	document.getElementById('ename').value = ename;

	serchtxt('doctor/emp_list.php', 'el', '');
	document.getElementById('tadd').focus();
}

function moveempn(eid, ename) {
	document.getElementById('ncid').value = eid;
	document.getElementById('ncname').value = ename;

	serchtxt('doctor/emp_list.php', 'snl', '');
	document.getElementById('ename').focus();
}

function movesemp(eid, ename) {
	document.getElementById('seid').value = eid;
	document.getElementById('sename').value = ename;

	serchtxt('doctor/semp_list.php', 'sel', '');
	document.getElementById('ename').focus();
}

function movehemp(eid, ename) {
	document.getElementById('hcid').value = eid;
	document.getElementById('hcname').value = ename;

	serchtxt('doctor/hemp_list.php', 'hnl', '');
	document.getElementById('hmem').focus();
}

function movepsemp(eid, ename) {
	document.getElementById('pseid').value = eid;
	document.getElementById('psename').value = ename;

	serchtxt('doctor/psemp_list.php', 'psel', '');

	document.getElementById('npseid').focus();
}

function smovepsemp(eid, ename) {
	document.getElementById('pseid').value = eid;
	document.getElementById('psename').value = ename;

	serchtxt('../payment/psemp_list.php', 'psel', '');


}

function movepsempn(eid, ename) {
	document.getElementById('npseid').value = eid;
	document.getElementById('npsename').value = ename;

	serchtxt('doctor/npsemp_list.php', 'npsel', '');

	document.getElementById('ppadd').focus();
}

function omovepsemp(eid, ename) {
	document.getElementById('pseid').value = eid;
	document.getElementById('psename').value = ename;

	serchtxt('opsemp_list.php', 'psel', '');

	document.getElementById('ppadd').focus();
}



function moveempp(eid, ename) {
	document.getElementById('peid').value = eid;
	document.getElementById('pename').value = ename;

	serchtxt('doctor/pemp_list.php', 'eul', '');
	document.getElementById('eul').style.display = 'none';
	document.getElementById('pctqty').focus();
}

function moveempp1(eid, ename) {
	document.getElementById('peid1').value = eid;
	document.getElementById('pename1').value = ename;
	serchtxt('doctor/pemp_list1.php', 'eul1', '');
	document.getElementById('eul1').style.display = 'none';
}

function moveempp2(eid, ename) {
	document.getElementById('peid2').value = eid;
	document.getElementById('pename2').value = ename;
	serchtxt('doctor/pemp_list2.php', 'eul2', '');
	document.getElementById('eul2').style.display = 'none';
}

function movedrugeEdit(did, dname, qty, dunit, price) {
	document.getElementById('did').value = did;
	document.getElementById('dname').value = dname;
	document.getElementById('qty').value = qty;
	document.getElementById('price').value = price;
	document.getElementById('uprice').value = price * qty;
	document.getElementById('unit').innerHTML = dunit;

	document.getElementById('qty').focus();
}


function movelabEdit(lid, lname, qty, price, eid, ename, mem) {
	document.getElementById('lid').value = lid;
	document.getElementById('lname').value = lname;
	document.getElementById('lqty').value = qty;
	document.getElementById('lprice').value = price;
	document.getElementById('luprice').value = price * qty;

	document.getElementById('THl').style.display = '';
	document.getElementById('hcid').value = eid;
	document.getElementById('hcname').value = ename;
	document.getElementById('hmem').value = mem;

	document.getElementById('lqty').focus();


}

function movelaserEdit(lid, lname, qty, price, type, tprice, tunit, eid, ename, cid, cname) {
	document.getElementById('tid').value = lid;
	document.getElementById('tname').value = lname;
	document.getElementById('tqty').value = qty;
	document.getElementById('tprice').value = price;
	document.getElementById('tuprice').value = tprice;
	document.getElementById('ttype').value = type;
	document.getElementById('tunit').innerHTML = tunit;
	document.getElementById('ull').style.display = '';
	document.getElementById('eid').value = eid;
	document.getElementById('ename').value = ename;
	document.getElementById('ncid').value = cid;
	document.getElementById('ncname').value = cname;
	document.getElementById('tuprice').focus();

}

function movepctEdit(lid, lname, qty, price, type, tprice, sid, sname, cid, cname) {
	document.getElementById('pid').value = lid;
	document.getElementById('pname').value = lname;
	document.getElementById('pqty').value = qty;
	document.getElementById('pprice').value = price;
	document.getElementById('puprice').value = tprice;
	document.getElementById('ptype').value = type;
	document.getElementById('cll').style.display = '';
	document.getElementById('pseid').value = sid;
	document.getElementById('psename').value = sname;
	document.getElementById('npseid').value = cid;
	document.getElementById('npsename').value = cname;
	document.getElementById('pqty').focus();
}


function changediscount() {
	document.getElementById('sum').value = Number(document.getElementById('total').value) - Number(document.getElementById('discount').value);
	document.getElementById('cash').value = document.getElementById('sum').value;


}

function calnum(div1, div2, div3) {
	document.getElementById(div3).value = Number(document.getElementById(div1).value) * Number(document.getElementById(div2).value);


}

function formatMoney(inum) {

	var s_inum = new String(inum);
	var num2 = s_inum.split(".", s_inum);
	var l_inum = num2[0].length;
	var n_inum = "";
	for (i = 0; i < l_inum; i++) {
		if (parseInt(l_inum - i) % 3 == 0) {
			if (i == 0) {
				n_inum += s_inum.charAt(i);
			} else {
				n_inum += "," + s_inum.charAt(i);
			}
		} else {
			n_inum += s_inum.charAt(i);
		}
	}
	if (num2[1] != undefined) {
		n_inum += "." + num2[1];
	}
	return n_inum;
}

function sumdiscount() {
	var ds = parseFloat(document.getElementById('ds').value.replace(",", ""));
	var ls = parseFloat(document.getElementById('ls').value.replace(",", ""));
	var ts = parseFloat(document.getElementById('ts').value.replace(",", ""));
	var cs = parseFloat(document.getElementById('cs').value.replace(",", ""));
	var ps = parseFloat(document.getElementById('ps').value.replace(",", ""));

	if (document.getElementById('dp').value != '') {
		var dp = parseFloat(document.getElementById('dp').value.replace(",", ""));
	} else { var dp = 0; }
	if (document.getElementById('lp').value != '') {
		var lp = parseFloat(document.getElementById('lp').value.replace(",", ""));
	} else { var lp = 0; }
	if (document.getElementById('tp').value != '') {
		var tp = parseFloat(document.getElementById('tp').value.replace(",", ""));
	} else { var tp = 0; }
	if (document.getElementById('cp').value != '') {
		var cp = parseFloat(document.getElementById('cp').value.replace(",", ""));
	} else { var cp = 0; }
	if (document.getElementById('pp').value != '') {
		var pp = parseFloat(document.getElementById('pp').value.replace(",", ""));
	} else { var pp = 0; }

	if (dp >= ds) {
		var dsum = 0;
	} else {
		var dsum = ds - dp;
	}

	if (lp >= ls) {

		var lsum = 0;
	} else {
		var lsum = ls - lp;

	}
	if (tp >= ts) {

		var tsum = 0;
	} else {
		var tsum = ts - tp;

	}
	if (cp >= cs) {

		var csum = 0;
	} else {
		var csum = cs - cp;

	}
	if (pp >= ps) {

		var psum = 0;
	} else {
		var psum = ps - pp;

	}


	var dis = dp + lp + tp + cp + pp;
	var total = dsum + lsum + tsum + csum + psum;

	if (dsum > 0) {
		document.getElementById('dsum').value = formatMoney(dsum);
	} else {
		document.getElementById('dsum').value = '0.00';
	}
	if (lsum > 0) {
		document.getElementById('lsum').value = formatMoney(lsum);
	} else {
		document.getElementById('lsum').value = '0.00';
	}
	if (tsum > 0) {
		document.getElementById('tsum').value = formatMoney(tsum);
	} else {
		document.getElementById('tsum').value = '0.00';
	}
	if (csum > 0) {
		document.getElementById('csum').value = formatMoney(csum);
	} else {
		document.getElementById('csum').value = '0.00';
	}
	if (psum > 0) {
		document.getElementById('psum').value = formatMoney(psum);
	} else {
		document.getElementById('psum').value = '0.00';
	}




	if (dis != 0) {
		document.getElementById('tdis').value = formatMoney(dis);
		document.getElementById('discount').value = formatMoney(dis);
	} else {
		document.getElementById('tdis').value = '0.00';
		document.getElementById('discount').value = '0.00';
	}

	if (total > 0) {
		document.getElementById('ttotal').value = formatMoney(total);
		document.getElementById('sum').value = formatMoney(total);
		document.getElementById('cash').value = formatMoney(total);
	} else {
		document.getElementById('ttotal').value = '0.00';
		document.getElementById('sum').value = '0.00';
		document.getElementById('cash').value = '0.00';
	}


}


function totalcash() {

	var sum = parseFloat(document.getElementById('cash_yes').value.replace(",", "")) + parseFloat(document.getElementById('to_day').value.replace(",", ""));

	var dis = parseFloat(document.getElementById('coste').value.replace(",", "")) + parseFloat(document.getElementById('doctor').value.replace(",", "")) + parseFloat(document.getElementById('bank').value.replace(",", ""));


	var total = sum - dis;
	document.getElementById('check').value = total;


}


function changemoney(n) {
	var sum = 0;
	var mm = 0;
	var mc = 0;
	var mk = 0;
	if (document.getElementById('sum').value != '') {
		sum = parseFloat(document.getElementById('sum').value.replace(",", ""));
	}
	if (document.getElementById('cash').value != '') {
		mm = parseFloat(document.getElementById('cash').value.replace(",", ""));
	}
	if (document.getElementById('credit').value != '') {
		mc = parseFloat(document.getElementById('credit').value.replace(",", ""));
	}
	if (document.getElementById('kupong').value != '') {
		mk = parseFloat(document.getElementById('kupong').value.replace(",", ""));
	}
	if (n == 1) {

		if (mc + mk >= sum) {
			mm = 0;
		}
	}

	if (n == 2) {
		if (mc >= sum) {
			mm = 0; mk = 0; mc = sum;
		} else if (mc + mk >= sum) {
			mm = 0; mk = sum - mc;
		} else {
			mm = sum - (mc + mk);
		}
	}
	if (n == 3) {
		if (mk >= sum) {
			mm = 0; mk = sum; mc = 0;
		} else if (mc + mk >= sum) {
			mm = 0; mc = sum - mk;
		} else {
			mm = sum - (mc + mk);
		}
	}

	if (mm > 0) { document.getElementById('cash').value = formatMoney(mm); } else { document.getElementById('cash').value = '0.00'; }
	if (mc > 0) { document.getElementById('credit').value = formatMoney(mc); } else { document.getElementById('credit').value = '0.00'; }
	if (mk > 0) { document.getElementById('kupong').value = formatMoney(mk); } else { document.getElementById('kupong').value = '0.00'; }

	//var total =  mm + mc + mk ;
	var cash = sum - (mc + mk);
	document.getElementById('ptxt').innerHTML = '';
	document.getElementById('rtxt').innerHTML = '';

	if (mm > cash) {
		document.getElementById('ptxt').innerHTML = 'ทอนเงิน : ';
		document.getElementById('mode').value = 'P';
		document.getElementById('rmoney').value = mm - cash;
		if (mm - cash > 0) {
			document.getElementById('rtxt').innerHTML = formatMoney(mm - cash);
		}
	}

	if (mm < cash) {
		document.getElementById('ptxt').innerHTML = 'ค้างชำระ : ';
		document.getElementById('mode').value = 'A';
		document.getElementById('rmoney').value = cash - mm;
		if (cash - mm > 0) {
			document.getElementById('rtxt').innerHTML = formatMoney(cash - mm);
		}
	}


}


function changemoneyar(n) {
	var sum = 0;
	var mm = 0;
	var mc = 0;

	if (document.getElementById('sum').value != '') {
		sum = parseFloat(document.getElementById('sum').value.replace(",", ""));
	}
	if (document.getElementById('cash').value != '') {
		mm = parseFloat(document.getElementById('cash').value.replace(",", ""));
	}
	if (document.getElementById('credit').value != '') {
		mc = parseFloat(document.getElementById('credit').value.replace(",", ""));
	}


	if (n == 1) {

		if (mc >= sum) {
			mm = 0;
		}
	}

	if (n == 2) {
		if (mc >= sum) {
			mm = 0; mc = sum;
		} else {
			mm = sum - mc;
		}
	}

	if (mm > 0) { document.getElementById('cash').value = formatMoney(mm); } else { document.getElementById('cash').value = '0.00'; }
	if (mc > 0) { document.getElementById('credit').value = formatMoney(mc); } else { document.getElementById('credit').value = '0.00'; }


	var total = mm + mc;

	document.getElementById('ptxt').innerHTML = '';
	document.getElementById('rtxt').innerHTML = '';






	if (sum < total) {
		document.getElementById('ptxt').innerHTML = 'ทอนเงิน : ';
		document.getElementById('mode').value = 'P';
		document.getElementById('rmoney').value = total - sum;
		if (total - sum > 0) {
			document.getElementById('rtxt').innerHTML = formatMoney(total - sum);
		}
	}
	if (sum > total) {
		document.getElementById('ptxt').innerHTML = 'ค้างชำระ : ';
		document.getElementById('mode').value = 'A';
		document.getElementById('rmoney').value = sum - total;
		if (sum - total > 0) {
			document.getElementById('rtxt').innerHTML = formatMoney(sum - total);
		}
	}


}

function movear(total, n) {
	var sum = 0;
	if (n == 1) { document.getElementById('sum').value = ''; }
	if (document.getElementById('sum').value != '') {
		sum = parseFloat(document.getElementById('sum').value.replace(",", ""));
	}

	sum = sum + total;
	document.getElementById('sum').value = formatMoney(sum);
}


function sendpatient(data, URL, displayId) {
	document.getElementById('bg').style.display = '';
	document.getElementById('sd').style.display = '';
	ajaxLoad('post', URL, data, displayId);
}

function formpreprint(data, URL, displayId) {
	document.getElementById('bg').style.display = '';
	document.getElementById('sd').style.display = '';
	ajaxLoad('post', URL, data, displayId);
}



function gWH() {
	var e = window, a = 'inner';
	if (!('innerWidth' in window)) {
		a = 'client';
		e = document.documentElement || document.body;
	}
	return { width: e[a + 'Width'], height: e[a + 'Height'] }
}

function cancelsend() {
	document.getElementById('bg').style.display = 'none';
	document.getElementById('sd').style.display = 'none';
}

function laserinstock_movetxt(lid, lname, lunit) {
	document.getElementById('lid').value = lid;
	document.getElementById('lname').value = lname;
	document.getElementById('lunit').innerHTML = lunit;
	document.getElementById('qty').value = '';
	document.getElementById('sid').focus();

}

function cleartemplaser() {
	document.getElementById('lid').value = '';
	document.getElementById('lname').value = '';
	document.getElementById('lunit').innerHTML = '';
	document.getElementById('qty').value = '';
	document.getElementById('txts').focus();
}

function swbmode(a) {
	if (a.value == 'T') {
		document.getElementById('tn1').style.display = 'none';
		document.getElementById('unit').style.display = 'none';
	} else {
		document.getElementById('tn1').style.display = '';
		document.getElementById('unit').style.display = '';
	}
}

function pctuse(vn, tid, num, name) {
	document.getElementById('pzone').style.display = '';
	document.getElementById('pctl').style.display = '';
	document.getElementById('pctname').innerHTML = name;
	document.getElementById('pctnum').innerHTML = num;
	document.getElementById('pvn').value = vn;
	document.getElementById('ptid').value = tid;
	document.getElementById('num').value = num;
	document.getElementById('pename').focus();
}

function switchtime(a) {
	if (a.value == 'A') {
		document.getElementById('tl1').style.display = 'none';
		document.getElementById('tl2').style.display = 'none';
	} else {
		document.getElementById('tl1').style.display = '';
		document.getElementById('tl2').style.display = '';
	}
}

function celpct() {
	document.getElementById('pzone').style.display = 'none';
	document.getElementById('pctl').style.display = 'none';
}

function test() {
	var t = parseFloat(document.getElementById('csum').value.replace(",", ""));


}


function moveuser(staffid, fname) {
	document.getElementById('staffid').value = staffid;
	document.getElementById('fname').value = fname;
	document.getElementById('user').focus();
}

function showpayment() {
	var data = 'did=' + document.getElementById('repempid').value;

	loadmodule('d_list', 'daily_report/repayment_list.php', data);
}

function showdiscount() {
	var data = 'did=' + document.getElementById('repempid').value;

	loadmodule('d_list', 'daily_report/rediscount_list.php', data);
}

function printpaytotal() {
	var data = 'did=' + document.getElementById('repempid').value;
	var page = 'daily_report/rep_paymenttotal.php?' + data;
	window.open(page, 'Patients', 'width=1003, height=500,resizable=yes, scrollbars=yes');
}

function printdiscount() {
	var data = 'did=' + document.getElementById('repempid').value;
	var page = 'daily_report/re_discount.php?' + data;
	window.open(page, 'Patients', 'width=1003, height=500,resizable=yes, scrollbars=yes');
}


function printdrec() {
	var data = 'did=' + document.getElementById('empid').value;
	var page = 'daily_report/re_drugerec.php?' + data;
	window.open(page, 'Patients', 'width=1003, height=500,resizable=yes, scrollbars=yes');
}

function forDate(obj) {
	if (obj.value.length == 2) {
		obj.value = obj.value + '-';
	} else if (obj.value.length == 5) {
		obj.value = obj.value + '-';
	} else if (obj.value.length == 10) {

	}

}


function mpatient(URL, displayId) {
	if (document.getElementById('sdate').value != '') {
		if (document.getElementById('edate').value != '') {
			var data = 'sdate=' + document.getElementById('sdate').value;
			data += '&edate=' + document.getElementById('edate').value;


			/*alert(data); */
			alert(data);
			loadmodule(displayId, URL, data);
		}
	}
}

function mpayment(URL, displayId) {
	if (document.getElementById('sdate').value != '') {
		if (document.getElementById('edate').value != '') {
			var data = 'sdate=' + document.getElementById('sdate').value;
			data += '&edate=' + document.getElementById('edate').value;
			data += '&did=' + document.getElementById('repempid').value;

			/*alert(data); */
			loadmodule(displayId, URL, data);
		}
	}
}

function repDoctor(URL, displayId) {
	if (document.getElementById('sdate').value != '') {
		if (document.getElementById('edate').value != '') {
			var data = 'sdate=' + document.getElementById('sdate').value;
			data += '&edate=' + document.getElementById('edate').value;
			loadmodule(displayId, URL, data);
		}
	}
}



//function repCbil(URL,displayId){
//if(document.getElementById('sdate').value!= ''){
//if(document.getElementById('edate').value!= ''){
//	var data  = 'sdate='+document.getElementById('sdate').value;
//		data +='&edate='+document.getElementById('edate').value;
//	    loadmodule(displayId,URL,data);
//}
//}
//}

function repCbil(URL) {
	if (document.getElementById('sdate').value != '') {
		if (document.getElementById('edate').value != '') {
			var data = 'sdate=' + document.getElementById('sdate').value;
			data += '&edate=' + document.getElementById('edate').value;

			var page = url + data;
			window.open(page, 'Patients', 'width=700, height=500,resizable=yes, scrollbars=yes');
		}
	}
}


function repKU(URL, displayId) {
	if (document.getElementById('sdate').value != '') {
		if (document.getElementById('edate').value != '') {
			var data = 'sdate=' + document.getElementById('sdate').value;
			data += '&edate=' + document.getElementById('edate').value;
			loadmodule(displayId, URL, data);
		}
	}
}


function repStock(URL, displayId) {
	loadmodule(displayId, URL, '');

}



function mdrug(URL, displayId) {

	var data = 'did=' + document.getElementById('repempid').value;

	loadmodule(displayId, URL, data);
}







function mcredit(URL, displayId) {
	if (document.getElementById('sdate').value != '') {
		if (document.getElementById('edate').value != '') {
			var data = 'sdate=' + document.getElementById('sdate').value;
			data += '&edate=' + document.getElementById('edate').value;
			data += '&did=' + document.getElementById('bk').value;


			loadmodule(displayId, URL, data);
		}
	}
}

function goAppointment(hn, vn) {
	var data = 'hn=' + hn + '&an=';
	loadmodule('home', 'appointment/new_form.php', data);
}
