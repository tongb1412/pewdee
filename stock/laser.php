<? include('../class/config.php'); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
if( empty($_GET['mode']) && empty($_POST['mode']) ){

$sql = "select * from tb_autonumber where typ='LS'";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$rs=mysql_fetch_array($result);
$x = substr($rs['number'],0,1);

$lid = $x ;  
$txt = substr($rs['last'],1,5);
$n = strlen($txt);
$num = intval($txt) + 1;
$m = strlen($num);

$i = 0; $t = ''; 
while($i < $n - $m){
	$t .= '0';
    $i++;
}
$t .= $num;
$lid .= $t; 
$lname = '';
$total = '0';
$unit = '';
$qty = '0';
$type = 'ADD';
} else {
if(empty($_GET['mode'])){
	$lid = $_POST['mode'];
} else {
	$lid = $_GET['mode'];
}
$sql = "select * from tb_laser where lid='$lid'";
$patient_result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$row=mysql_fetch_array($patient_result);
$lname = $row['lname'];
$total = $row['total'];
$unit = $row['unit'];
$qty = $row['sqty'];
$type = 'EDIT';
}
?>
<div style="width:99%; margin:auto; margin-top:5px; height:30px;">
	<div style="width:20%; font-size:16px; font-weight:bold; float:left;">
	<img src="images/icon/group.png" align="absmiddle" />&nbsp;เลเซอร์
	</div>
	<div style="width:78%; text-align:right; float:left;">
	<input type="button" value="  รายการทั้งหมด  " onclick="loadmodule('home','stock/laser.php','') " style="height:25px; font-size:13px; line-height:25px;" />
	<input type="button" value="  รับเข้า  " onclick="swabtab(2,3,'stock/laserinstock.php','content','')" style="height:25px; font-size:13px; line-height:25px;" />
	</div>
</div>
<div id="main" class="main" style="width:99%; margin:auto; margin-top:5px; height:500px; overflow:hidden;">
<div class="littleDD" >
	<div id="tab1" class="tab" style="width:150px; background-color:#FFFFFF; display: ;  line-height:30px;">
	รายการทั้งหมด
	</div>
	<div id="tab2" class="tab" style="width:100px; background-color:#FFFFFF; display:none; line-height:30px;">
    รับเข้า
	</div>
	<div id="tab3" class="tab" style="width:100px; background-color:#FFFFFF; display:none; line-height:30px;">
	สั่งซื้อ
	</div>	
</div>
<div id="content" style="width:100%; height:auto;">
	<div style="width:45%; height:300px; float:left; margin-left:10px; margin-right:10px;">
		<div style="width:98%; height:auto; margin:auto; margin-top:10px;">
			<div class="txt_serch" style="width:260px">
			<input class="input_serch" type="text" id="txts" size="30" value="ค้นหา" onclick="clickclear(this, 'ค้นหา')" onblur="clickrecall(this,'ค้นหา')" onkeyup="serchtxt('stock/laser_list.php','p_list',this)" /><input type="button" class="btn_serch" onclick="ajaxLoad('get','stock/laser_list.php','txt=','p_list')" />
			</div>
		</div>
		<div style="width:98%; height:20px; padding-top:5px;color:#000000;margin:auto; margin-top:5px; font-weight:bold; font-size:13px;background:<?=$tabcolor?>;">    
			<div style="width:18%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รหัส</div>
			<div style="width:42%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รายการ</div>
			<div style="width:15%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;คงเหลือ</div>
			<div style="width:25%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;หน่วย</div>
		</div>	
    	<div id="p_list" style="width:98%; height:400px; margin:auto;  border:<?=$tabcolor?> 1px solid;">
		<?  require("laser_list.php");	 ?>

    	</div>		
		
		
		
	
    </div>
	<div style="width:51%; height:465px; float:left; margin-left:5px;  margin-right:10px;">
		<div id="lform" style="width:100%; height:200px;  margin-top:10px; overflow:auto; border:<?=$tabcolor?> 1px solid; ">
		    <input type="hidden" id="typ" value="<?=$type?>" />
			<div class="line" style="margin-top:5px;"  >
				<div style="width:20%; float:left; text-align:right;">รหัสเลเซอร์ :&nbsp;</div>
				<div style="width:20%; float:left;"><input type="text" id="lid" size="10" value="<?=$lid?>" /></div>
				<div style="width:15%; float:left; text-align:right;">ชื่อเลเซอร์ :&nbsp;</div>
				<div style="width:45%; float:left;"><input type="text" id="lname" size="30" value="<?=$lname?>" /></div>				
			</div>
			<div class="line" >

			</div>	
			
			<div class="line" style="height:10px;" >&nbsp;</div>
<?
include('../class/config.php');

$unit = $row['unit'];
$sql = "select * from tb_gernaral where typ='DN' and  name <> '$unit' ";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 

?>
			<div class="line" >
				<div style="width:20%; float:left; text-align:right;">คงเหลือ :&nbsp;</div>
				<div style="width:20%; float:left;"><input type="text" id="total" size="10" value="<?=$total?>" readonly="true" /></div>
				<div style="width:15%; float:left; text-align:right;">หน่วย :&nbsp;</div>
				<div style="width:45%; float:left;">
					<select id="unit" style="width:131px;  ">
					<? if(!empty($unit)){ ?>
					<option value="<?=$unit?>"><?=$unit?></option>
					<? }
					 while($rs=mysql_fetch_array($result)){  
					 ?>
					<option value="<?=$rs['name']?>"><?=$rs['name']?></option>
					<? } ?>
					</select>				
				</div>			
			</div>	
	
	

			<div class="line" >
				<div style="width:20%; float:left; text-align:right;">จุดสั่งซื้อ :&nbsp;</div>
				<div style="width:20%; float:left;"><input type="text" id="sqty" size="10"  value="<?=$qty?>" /></div>
				<div style="width:10%; float:left; text-align:right;">&nbsp;</div>
				<div style="width:50%; float:left;">&nbsp;</div>	
			</div>	
			<div class="line" style="height:20px;" >&nbsp;</div>
			
			<div class="line" >
				<div style="width:20%; float:left; text-align:right;">&nbsp;</div>
				<div style="width:80%; float:left;">				
				<input type="button" value="  บันทึกข้อมูล  " style="font-size:14px; font-weight:bold; height:35px;" onclick="addlaser('stock/laser_add.php','home')"  />
				<input type="button" value="  รายการใหม่  " style="font-size:14px; font-weight:bold; height:35px;" onclick="loadmodule('home','stock/laser.php','')"  />
				</div>
			</div>
		
		
		</div>
		<div id="llist" style="width:100%; height:100px; ">
		
			<div style="width:100%; height:auto; float:left; margin-top:-5px; border:<?=$tabcolor?> 1px solid;">
				<div style="width:100%; height:20px; padding-top:5px; color:#000000; margin:auto; margin-top:5px; font-weight:bold; font-size:13px; background:<?=$tabcolor?>;">  			
					<div style="width:25%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;Lot No.</div>
					<div style="width:45%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;วันที่</div>
					<div style="width:15%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;จำนวน</div>
					<div style="width:15%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;คงเหลือ</div>			
				</div>
				<div id="dlist" style="width:100%; height:226px; float:left; overflow:auto;">
<? 
include('../class/config.php');	
$cl = $color1;
$sql = "select * from tb_laserinstock,tb_instock where tb_laserinstock.lno = tb_instock.lno and tb_laserinstock.lid='$lid' and tb_laserinstock.total > 0 order by tb_laserinstock.lno asc, tb_laserinstock.lname asc";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$Num_Rows = mysql_num_rows($result);

if($result){

while($rs=mysql_fetch_array($result)){  
if($cl != $color1){
	$cl = $color1;
} else {
	$cl = $color2;
}

?>


<div style="width:95%; height:20px; line-height:20px; text-align:left; padding-left:20px; border-bottom:#CCCCCC 1px dotted;background:<?=$cl?>;" onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')" >
	
	<div style="width:25%; float:left; line-height:20px;"><?=$rs['lno']?></div>
	<div style="width:45%; float:left; line-height:20px;"><?=$rs['ldate']?></div>
	<div style="width:17%; float:left; line-height:20px; text-align:right">
	<? echo number_format($rs['qty'],'0','.',',') ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
	</div>
	<div style="width:13%; float:left; line-height:20px; text-align:right">
	<? echo number_format($rs['total'],'0','.',',') ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
	</div>



</div>
<? 

} 
}
mysql_close($dblink);
?>	
			</div>
	
		
		
			</div>	
	
    </div>

</div>
