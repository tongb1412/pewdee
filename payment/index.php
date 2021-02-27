<?
include('../class/config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="../js/myAjax.js"></script>
<link href="../css/menu_style.css" rel="stylesheet" type="text/css" />

<title>ขายคอร์ส  ผิวดีคลีนิค</title>
</head>
<style type="text/css">

#Pmain {width:500px; height:500px; background:#DBDBDB; border:#999999 1px solid; margin:auto; margin-top:10px; }
.Pheader {width:100%; height:30px; line-height:30px; color:#0099CC; font-size:16px; font-weight:bold; text-align:left; float:left;}
.Pline {width:100%; height:20px; line-height:20px; float:left; margin-top:5px; }
</style>
<body>
<div id="loading" style="position:fixed; right:0px; top:0px; z-index:1000; display:none;">
	<img src="../images/loading.gif"  width="50" height="50"/>
</div>
<div id="Pmain">
	<div class="Pheader">&nbsp;&nbsp;ขายคอร์ส</div>
	<div class="Pline">
    	<div style="width:100px; float:left; font-weight:bold; text-align:right;">หมายเลข :&nbsp;&nbsp;</div>
        <div style="width:400px; float:left; text-align:left;">
        <input type="text" id="cno" size="20" /> 
        </div>
    </div>
	<div class="Pline">
    	<div style="width:100px; float:left; font-weight:bold; text-align:right;">ประเภท :&nbsp;&nbsp;</div>
        <div style="width:400px; float:left; text-align:left;">
        <select id="ptype" onchange="clearpct()">
		<option value="C">คอร์ส</option>
		<option value="P">แพ็คเกจ</option>
		</select>&nbsp;
        </div>
    </div>    
	<div class="Pline">
    	<div style="width:100px; float:left; font-weight:bold; text-align:right;">รายการ :&nbsp;&nbsp;</div>
        <div style="width:300px; float:left; text-align:left;">
		<input type="hidden" id="pid" />
		<input type="text" id="pname" style="width:300px;" onkeyup="serchpct('../payment/pct_list.php','pl',this)"  />
		<div id="pl" class="bl" style="width:100%;"></div>&nbsp;
        </div>

    </div> 
    <div class="Pline" >&nbsp;</div>     
	<div class="Pline" >
    	<div style="width:100px; float:left; font-weight:bold; text-align:right;">จำนวน :&nbsp;&nbsp;</div>
        <div style="width:100px; float:left; text-align:left;">
		<input type="text" id="pqty" style="width:60px; text-align:right" />&nbsp;
        </div>
        <div style="width:50px; float:left; font-weight:bold; text-align:right;">ราคา :&nbsp;&nbsp;</div>
        <div style="width:100px; float:left; text-align:left;">
        <input type="text" id="price" style="width:100px; text-align:right" onkeyup="calprice()" />&nbsp;บาท
        </div>

    </div>     
	<div class="Pline">
    	<div style="width:100px; float:left; font-weight:bold; text-align:right;">ผู้ขาย :&nbsp;&nbsp;</div>
        <div style="width:300px; float:left; text-align:left;">
		<input type="hidden" id="pseid" />				    
		<input type="text" id="psename"  style="width:300px;" onkeyup="serchtxt('../payment/psemp_list.php','psel',this)"  />		
		<div id="psel" class="bl" style="width:100%; background:#FFFFFF"></div>	
        </div>

 	</div>    

 
 	<div class="Pheader" style="margin-top:20px;">&nbsp;&nbsp;ชำระเงิน</div>
 
	<div class="Pline">
    	<div style="width:200px; float:left; font-weight:bold; text-align:right;">จำนวนเงินทั้งหมด :&nbsp;&nbsp;</div>
        <div style="width:300px; float:left; text-align:left;">					    
		<input type="text" id="total"  size="20" readonly="readonly" style="text-align:right; background:#FF0000; " />		
		
        </div>

 	</div>  
	<div class="Pline" style="margin-top:10px;">
    	<div style="width:200px; float:left; font-weight:bold; text-align:right;">เงินสด :&nbsp;&nbsp;</div>
        <div style="width:300px; float:left; text-align:left;">					    
		<input type="text" id="cash"  size="20" style="text-align:right; "  value="0" onkeyup="calrecive()"/>&nbsp;&nbsp;บาท	
		
        </div>

 	</div> 
	<div class="Pline" style="margin-top:10px;">
    	<div style="width:200px; float:left; font-weight:bold; text-align:right;">บัตรเครดิต :&nbsp;&nbsp;</div>
        <div style="width:300px; float:left; text-align:left;">					    
		<input type="text" id="credit"  size="20" style="text-align:right; " value="0" onkeyup="calcredit()"/>&nbsp;&nbsp;บาท	
		
        </div>

 	</div>  
    <?
	$sql = "select * from tb_gernaral where typ='BK'";
	$str = mysql_query($sql) or die ("Error Query [".$sql."]"); 
	
	?>
	<div class="Pline" style="margin-top:10px;">
    	<div style="width:200px; float:left; font-weight:bold; text-align:right;">ธนาคาร :&nbsp;&nbsp;</div>
        <div style="width:300px; float:left; text-align:left;">					    
		<select name="select" id="bank" style="font-size:18px; width:200px;">
          <option value=""></option>
          <? while($rs=mysql_fetch_array($str)){ ?>
          <option value="<?=$rs['name']?>">
            <?=$rs['name']?>
          </option>
          <? } ?>
        </select>&nbsp;
		
        </div>

 	</div>  
	<div class="Pline" style="margin-top:10px;">
    	<div style="width:200px; float:left; font-weight:bold; text-align:right;">เลขที่บัตร :&nbsp;&nbsp;</div>
        <div style="width:300px; float:left; text-align:left;">					    
			<input type="text" id="creditno" style="width:195px;" value="0" />
		
        </div>

 	</div>  
    
	<div class="Pline" style="margin-top:10px;">
    	<div style="width:200px; float:left; font-weight:bold; text-align:right;">เงินทอน :&nbsp;&nbsp;</div>
        <div style="width:300px; float:left; text-align:left;">					    
		<input type="text" id="recive"  size="20" style="text-align:right; background:#FFCCCC; "  />&nbsp;&nbsp;บาท	
		
        </div>

 	</div>    
    
        
     
 
 	<div class="Pline" style="margin-top:30px;" >
    	<div style="width:200px; float:left; font-weight:bold; text-align:right;">&nbsp;&nbsp;</div>
        <div style="width:300px; float:left; text-align:left;">
        <input type="button" value="  บันทึก  " onclick="addSelcourse()" />
        &nbsp;&nbsp;
        <input type="button" value="  ยกเลิก  " onclick="clearSpct()" />
        </div>
    </div> 
    
</div>

<script language="javascript">
function clearSpct(){
	document.getElementById('cno').value='';
	document.getElementById('ptype').value='C';
	document.getElementById('pid').value='';
	document.getElementById('pname').value='';
	document.getElementById('pqty').value='';
	document.getElementById('price').value='';
	document.getElementById('pseid').value='';
	document.getElementById('psename').value='';
	
	document.getElementById('total').value='';
	document.getElementById('cash').value='0';
	document.getElementById('credit').value='0';
	document.getElementById('bank').value='';
	document.getElementById('creditno').value='';
	document.getElementById('recive').value='0';
	
	document.getElementById('cno').focus();
}

function calprice(){
	document.getElementById('total').value = document.getElementById('price').value;
	document.getElementById('cash').value = document.getElementById('price').value;
	document.getElementById('recive').value='0';
	document.getElementById('credit').value='0';
}

function calrecive(){
	var total = Number(document.getElementById('total').value);
	var cash =  Number(document.getElementById('cash').value);
	var credit =  Number(document.getElementById('credit').value);
	var recive =  Number(document.getElementById('recive').value);
	total = total - credit;
	recive = cash - total;
	document.getElementById('recive').value = recive;	
}

function calcredit(){
	var total = Number(document.getElementById('total').value);
	var cash =  Number(document.getElementById('cash').value);
	var credit =  Number(document.getElementById('credit').value);
	document.getElementById('cash').value = total - credit; 
	calrecive()
}

function addSelcourse(){
if(confirm('คุณต้องการบันทึกข้อมูลใช่หรือไม่?')){
	var total = Number(document.getElementById('total').value);
	var cash =  Number(document.getElementById('cash').value);
	var credit =  Number(document.getElementById('credit').value);
	if(total <= cash + credit){	
		var data  = 'cno='+document.getElementById('cno').value;
			data += '&ptype='+document.getElementById('ptype').value;
			data += '&pid='+document.getElementById('pid').value;
			data += '&pname='+document.getElementById('pname').value;
			data += '&pqty='+document.getElementById('pqty').value;
			data += '&price='+document.getElementById('price').value;
			data += '&pseid='+document.getElementById('pseid').value;
			data += '&psename='+document.getElementById('psename').value;
			data += '&cash='+document.getElementById('cash').value;
			data += '&credit='+document.getElementById('credit').value;
			data += '&bank='+document.getElementById('bank').value;
			data += '&creditno='+document.getElementById('creditno').value;				
			ajaxAddsel('post','addSale.php',data);
	} else { alert('จำนวนเงินที่รับน้อยกว่าจำนวนเงินทั้งหมด ไม่สามารถบันทึกได้');  }
}

}




function ajaxAddsel(method,URL,data){
	document.getElementById('loading').style.display = '';
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
			ajaxcallAddsel(ctype,ajax.responseText);
		    delete ajax;
			ajax = null;
		}
	}
	ajax.send(data);	
}

function ajaxcallAddsel(contentType,responseText){
	
	document.getElementById('loading').style.display = 'none';
	if(contentType.match("text/javascript")){
		eval(responseText);
	} else {		
	    
			var mode = responseText.split('||');	
	   		
		   if( mode[1] != 'N' ){		        					
				var page = 'slip_apayment.php?cno='+mode[2];		
				window.open(page, 'INVOICE/RECEIPT', 'width=400, height=500,resizable=yes, scrollbars=yes');
				clearSpct();
			} else {
				alert(mode[2]);
			}
	}	
}


</script>

</body>
</html>
