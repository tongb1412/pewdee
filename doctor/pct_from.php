<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/menu_style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/myAjax.js"></script>
<script language="javascript">

function add_pct_old(URL,displayId){
if(document.getElementById('pid').value!= ''){	
if(document.getElementById('pqty').value!= ''){
if(document.getElementById('psename').value!= ''){
	var data  = 'hn='+document.getElementById('hn').value;
		data +='&vn='+document.getElementById('vn').value; 
		data +='&pid='+document.getElementById('pid').value; 
		data +='&pname='+document.getElementById('pname').value; 
		data +='&qty='+document.getElementById('pqty').value; 
		data +='&price='+document.getElementById('pprice').value; 
		data +='&tprice='+document.getElementById('puprice').value; 
		data +='&type='+document.getElementById('ptype').value; 
		data +='&seid='+document.getElementById('pseid').value; 
		data +='&sename='+document.getElementById('psename').value; 
		data +='&unit='; 
	    ajaxAdddruge('post',URL,data,displayId);	
		document.getElementById('pid').value = '';
		document.getElementById('pname').value = '';
		
		document.getElementById('pqty').value = '';	
		document.getElementById('pprice').value = '';	
		document.getElementById('puprice').value = '';
		document.getElementById('pseid').value = ''; 
		document.getElementById('psename').value = ''; 
		document.getElementById('pname').focus();
} else { alert('ยังไม่ได้เลือกผู้ขาย');  }
} else { alert('ยังไม่ได้กรอกจำนวน');  }
} else { alert('ยังไม่ได้เลือกรายการ');  }
}

</script>



<?
include('../class/config.php');

?>
<div id="loading" style="position:fixed; right:0px; top:0px; z-index:1000; display:none;">
	<img src="../images/loading.gif"  width="50" height="50"/>
</div>
<input type="hidden" id="vn" size="10" value="<?=$_GET['vn']?>"></div>  

<div id="t_main" class="tmain" style="width:95%; margin:auto; height:350px; overflow:hidden; text-align:center ">
  <div class="littleDD" style="font-size:14px; font-weight:bold;" >เพิ่มคอร์ทเก่า</div>
  <div style="width:70%; height:auto; margin:auto; margin-top:10px;">
          
		<div class="line">
    		<div style="width:10%; float:left; text-align:right;">HN :&nbsp;</div>
			<div style="width:90%; float:left;"><input type="text" id="hn" size="10" value="<?=$_GET['hn']?>"></div>   
        </div>
		<div class="line" >
			    <div style="width:10%; float:left; text-align:right;">ประเภท :&nbsp;</div>
				<div style="width:90%; float:left; text-align:right; text-align:left;">
		        <select id="ptype" onchange="clearpct()">
				<option value="C">คอร์ส</option>
				<option value="P">แพ็คเกจ</option>
				</select>
				</div>
		</div>	
		<div class="line">
				<div style="width:10%; float:left; text-align:right;">รายการ :&nbsp;</div>
				<div style="width:40%; float:left;">
				    <input type="hidden" id="pid" />
					<input type="text" id="pname" style="width:200px;" onkeyup="serchpct('opct_list.php','pl',this)"  />
					<div id="pl" class="bl" style="width:100%;"></div>
				</div>
				<div style="width:10%; float:left; text-align:right;">จำนวน :&nbsp;</div>
				<div style="width:10%; float:left;">
				<input type="text" id="pqty" style="width:20px;" onkeyup="calnum('pprice','pqty','puprice')" />
				</div>	
				<div style="width:6%; float:left; text-align:right;">ราคา:&nbsp;</div>
				<div style="width:14%; float:left;">
				<input type="text" id="puprice" style="width:50px;" /><input type="hidden" id="pprice"/>
				</div>			
				<div style="width:10%; float:left;">
				<input type="button" id="ppadd" value="  " class="btn_add" onclick="add_pct_old('opct_add.php','')" title="เพิ่ม" alt="เพิ่ม" />
							
				</div>	
				
				<div id="cll" class="bl" style="width:100%;  background:#FFFFFF; margin-top:26px; height:50px; display:none;">
				
						<div class="line" style="margin-top:0px;">
							<div style="width:10%; float:left; text-align:right;">ผู้ขาย :&nbsp;</div>
							<div style="width:56%; float:left;">
							<input type="hidden" id="pseid" />				    
							<input type="text" id="psename"  style="width:280px;" onkeyup="serchtxt('opsemp_list.php','psel',this)"  />		
							<div id="psel" class="bl" style="width:100%; background:#FFFFFF"></div>				
							</div>	
							<div style="width:10%; float:left; text-align:right;">&nbsp;</div>
							<div style="width:24%; float:left;">&nbsp;</div>																		
						</div>				

				</div>				
				
				
							
		</div>		
		
		
		
		
		  
  </div>
  
</div>

