<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');
$PID = $_POST['pid'];
$sql = "select * from promotion where proid='$PID'";
$patient_result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$row=mysql_fetch_array($patient_result);

$dat = substr($row['datestart'],8,2).'-'.substr($row['datestart'],5,2).'-'.substr($row['datestart'],0,4);
$dat1 = substr($row['datestop'],8,2).'-'.substr($row['datestop'],5,2).'-'.substr($row['datestop'],0,4);


?>
            
	
		
        	<div id="staffedit" style="width:98%; height:470px;  margin-top:5px; margin-left:5px; float:left; background:#CCCCCC">
		
		 <div class="line">&nbsp;</div>
		
		
        	<div style="width:25%; float:left; text-align:right;">รหัสโปรโมชั่น :&nbsp;</div>
			<div style="width:25%; float:left;">
        		<input name="text2" type="text" id="proid" size="30" />
      		</div> 
			
			
			
    		<div class="line">
      			<div style="width:25%; float:left; text-align:right;">ชื่อโปรโมชั่น:&nbsp;</div>
      			<div style="width:25%; float:left;">
        			<input name="text2" type="text" id="address" size="53" />
      			</div>
    		</div>
			
			<div class="line">
				
		<div style="width:25%; float:left; text-align:right;">วันที่เริ่ม :&nbsp;</div>
			<div style="width:18%; float:left;">
        		<input type="text" id="dat" size="15" readonly="readonly" value="<?=$dat?>" />
        	</div>
			<div style="width:3%; float:left;">
        		<img src="calendar/calendar.jpg" width="15" onclick="calendar('<?=date('m')?>','<?=date('Y')?>','cl','dat')" style="margin-top:5px; cursor:pointer;"  />        
        	<div id="cl" class="calendar" style="width:152px; height:auto; display:none;"></div>
        </div>
		
		<div style="width:10%; float:left; text-align:right;">วันที่หมด :&nbsp;</div>
			<div style="width:18%; float:left;">
        		<input type="text" id="dat1" size="15" readonly="readonly" value="<?=$dat?>" />
        	</div>
			<div style="width:3%; float:left;">
        		<img src="calendar/calendar.jpg" width="15" onclick="calendar('<?=date('m')?>','<?=date('Y')?>','cl1','dat1')" style="margin-top:5px; cursor:pointer;"  />        
        	<div id="cl1" class="calendar" style="width:152px; height:auto; display:none;"></div>
        </div>
				
		
			</div>	
			
			<div class="line">

		
			</div>	
			
			
    		<div class="line" style="height:270px;">
      			<div style="width:25%; float:left; text-align:right;">รายละเอียด:&nbsp;</div>
				<div style="width:20%; float:left;">
		  			<textarea name="textarea" cols="50" rows="15" id="mem"></textarea>
				</div>
			</div>



			<div class="line">
				<div style="width:25%; float:left; text-align:right;">เบอร์โทร :&nbsp;</div>
				<div style="width:25%; float:left;"><input type="text" id="tel" size="15" /></div>	

			</div>	

<div style="width:78%; text-align:right; float:left;">
      <input name="button" type="button" style="height:25px; font-size:13px; line-height:25px;"  onclick="addstaff('setting/staff_add.php','settingpage')" value="      บันทึก       " />
      <input name="button" type="button" style="height:25px; font-size:13px; line-height:25px;" onclick="ajaxLoad('post','promotion/promotion_new.php','','promotionpage')" value=" รายการใหม่ "/>
    </div>



   
   </div>