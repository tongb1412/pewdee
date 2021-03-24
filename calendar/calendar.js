// JavaScript Document
var cshow = 'N';

function ajaxCarlendar(method,URL,data,displayId){	
    
	var ajax = null;
	if(window.ActiveXObject){
		ajax = new ActiveXObject("Microsoft.XMLHTTP");		
	} else if(window.XMLHttpRequest) {
		ajax = new XMLHttpRequest();		
	} else {
		alert("Your brower doesn't support Ajax");
		return;
	}
	method = method.toLowerCase();
	URL += "?dummy="+ (new Date()).getTime();
	if(method.toLowerCase()=='get'){
		URL += "&"+ data;
		data = null;
	}
	
	ajax.open(method,URL);
	if(method.toLowerCase()=='post'){
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");		
	}
	ajax.onreadystatechange = function(){		
		if(ajax.readyState==4 && ajax.status==200){
			var ctype = ajax.getResponseHeader("Content-Type");	
		    ctype = ctype.toLowerCase();			
			ajaxcallcalendar(ctype,ajax.responseText,displayId);
		    delete ajax;
			ajax = null;
		}
	}
	ajax.send(data);	
}

function ajaxcallcalendar(contentType,responseText,displayId){	
	if(contentType.match("text/javascript")){
		eval(responseText);
	} else {		
		var el = document.getElementById(displayId);
		el.innerHTML = responseText;	    
	}	
}


function calendar(m,y,displayId,dat,dis){

	clickCalendar(dat);
	// 	document.getElementById(dis).innerHTML = 'hhh';

	// if(cshow=='N'){
	// 	document.getElementById(displayId).style.display = '';
	// 	var data = 'month='+m+'&year='+y+'&dShow='+dat+'&dis1='+displayId;
		
	// 	ajaxCarlendar('get','calendar/calendar.php',data,displayId);
	// 	cshow='Y';
		
	// } else{  
	// 	document.getElementById(displayId).style.display = 'none';  
	// 	cshow='N';
	// }
	
}

function calendarYear(displayId,dat){	

	var data = 'month='+document.getElementById('month').value;
		data += '&year='+document.getElementById('year').value+'&dShow='+dat+'&dis1='+displayId;	
		
		ajaxCarlendar('get','calendar/calendar.php',data,displayId);
}


function getcalendarDate(dat,dis,dis1){	
   
	document.getElementById(dis).value = dat;
	document.getElementById(dis1).style.display = 'none';  
	cshow='N';
}

