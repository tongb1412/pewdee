<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');

?>
<div id="t_main" class="tmain" style="width:100%; margin:auto; height:495px; overflow:hidden; text-align:center ">
  <div class="littleDD" style="font-size:14px; font-weight:bold;" >เพิ่มคอร์ทเก่า</div>
  <div style="width:70%; height:auto; margin:auto; margin-top:10px;">
  
		<div class="line">
    		<div style="width:10%; float:left; text-align:right;">HN :&nbsp;</div>
			<div style="width:90%; float:left;"><input type="text" id="hn" size="10"></div>   
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
					<input type="text" id="pname" style="width:200px;" onkeyup="serchpct('setting/pct_list.php','pl',this)"  />
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
				<input type="button" id="ppadd" value="  " class="btn_add" onclick="add_pct_old('setting/pct_add.php','settingpage')" title="เพิ่ม" alt="เพิ่ม" />
							
				</div>	
				
				<div id="cll" class="bl" style="width:100%;  background:#FFFFFF; margin-top:26px; height:50px; display:none;">
				
						<div class="line" style="margin-top:0px;">
							<div style="width:10%; float:left; text-align:right;">ผู้ขาย :&nbsp;</div>
							<div style="width:56%; float:left;">
							<input type="hidden" id="pseid" />				    
							<input type="text" id="psename"  style="width:280px;" onkeyup="serchtxt('setting/psemp_list.php','psel',this)"  />		
							<div id="psel" class="bl" style="width:100%; background:#FFFFFF"></div>				
							</div>	
							<div style="width:10%; float:left; text-align:right;">&nbsp;</div>
							<div style="width:24%; float:left;">&nbsp;</div>																		
						</div>				

				</div>				
				
				
							
		</div>		
		
		
		
		
		  
  </div>
  
</div>