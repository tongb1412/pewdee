<? include('../class/config.php'); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?

$lno = 'NO'; 


$sql_delete="delete from tb_temp_drugecutstock where lno='$lno'";
mysql_query($sql_delete);

//$sql_del = "delete from tb_temp_drugeinstock where lno='$lno'";
//mysql_query($sql_del) or die ("Error Query [".$sql_del."]"); 
?>
<div style="width:27%; height:450px; float:left; text-align:center; margin-left:10px;">

	<div style="width:98%; height:auto; margin:auto; margin-top:10px;">
		<div class="txt_serch" style="width:260px">
			<input class="input_serch" type="text" id="txts" size="30" value="ค้นหา" onclick="clickclear(this, 'ค้นหา')" onblur="clickrecall(this,'ค้นหา')" onkeyup="serchtxt('stock/druge_cut_list.php','p_list',this)" /><input type="button" class="btn_serch" onclick="ajaxLoad('get','stock/druge_in_list.php','txt=','p_list')" />
		</div>
	</div>
	<div style="width:98%; height:20px; padding-top:5px; color:#000000; margin:auto; margin-top:5px; font-weight:bold; font-size:13px; background:<?= $tabcolor ?>;">
		<div style="width:100%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ชื่อยา</div>
	</div>

	<div id="p_list" style="width:98%; height:400px; margin:auto;  border:<?= $tabcolor ?> 1px solid;">
		<?  require("druge_cut_list.php");	 ?>

	</div>

</div>
<div style="width:65%; height:auto; float:left; margin-left:40px;">

	<div style="width:100%; height:auto; float:left;">

		<input type="hidden" id="lno" value="<?= $lno ?>" />
		<div class="line" style="height:20px;">
			<div style="width:12.5%; float:left; text-align:left;">ประเภท &nbsp;</div>
			<div style="width:15%; float:left; text-align:left; margin-right: 3%">รหัสยา &nbsp;</div>
			<div style="width:37%; float:left; text-align:left; margin-right: 6.9%">ชื่อยา &nbsp;</div>
			<div style="width:15%; float:left; text-align:left;">จำนวน &nbsp;</div>
		</div>
		<div class="line">
			<div style="width:12.5%; float:left;">
				<select id="dtyp">
					<option value="I">รับเข้า</option>
					<option value="P">จ่ายออก</option>
				</select>
			</div>
			<div style="width:15%; float:left; margin-right: 3%"><input type="text" id="did" size="10" style="border:1px solid #CCCCCC; background:#CCCCCC" /></div>
			<div style="width:37%; float:left; margin-right: 7%"><input type="text" id="dname" size="34" style="border:1px solid #CCCCCC; background:#CCCCCC" /></div>
			<div style="width:15%; float:left;"><input type="text" id="qty" size="4" />&nbsp;<span id="dunit"></span></div>
			<div style="width:10%; float:left; text-align:right;">
				<input type="button" id="btnadd" value=" เพิ่ม " onclick="add_temp_cutstock('stock/add_temp_cutstock.php','dlist')">
			</div>
		</div>



	</div>
	<div style="width:100%; height:auto; float:left; border:<?= $tabcolor ?> 1px solid;">
		<div style="width:100%; height:20px; padding-top:5px; color:#000000; margin:auto; margin-top:5px; font-weight:bold; font-size:13px; background:<?= $tabcolor ?>;">
			<div style="width:15%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รหัส</div>
			<div style="width:40%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ชื่อยา</div>
			<div style="width:15%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;จำนวน</div>
			<div style="width:10%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;หน่วย</div>
			<div style="width:15%;text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ประเภท</div>
		</div>

	</div>
	<div id="dlist" style="width:100%; height:280px; float:left; overflow:auto; border:<?= $tabcolor ?> 1px solid;">
		<?
include('../class/config.php');	
$cl = $color1;
$sql = "select * from tb_temp_drugeinstock where lno='$lno' order by dname";
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


		<div style="width:95%; height:20px; line-height:20px; text-align:left; padding-left:20px; border-bottom:#CCCCCC 1px dotted;background:<?= $cl ?>; cursor:pointer;" onmouseover="linkover(this)" onmouseout="linkout(this,'<?= $cl ?>')">

			<div style="width:42%; float:left; line-height:20px;"><?= $rs['dname'] ?></div>
			<div style="width:15%; float:left; line-height:20px; text-align:right">
				<? echo number_format($rs['qty'],'0','.',',') ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</div>
			<div style="width:11%; float:left; line-height:20px;"><?= $rs['unit'] ?></div>
			<div style="width:16%; float:left; line-height:20px; text-align:right">
				<? echo number_format($rs['price'],'2','.',',') ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</div>
			<div style="width:10%; float:left; line-height:20px; text-align:right">
				<? echo number_format($rs['totalprice'],'2','.',',') ?>&nbsp;&nbsp;&nbsp;
			</div>
			<div style="width:5%; float:left; text-align:right; line-height:20px;">
				<img src="images/icon/pdelete.png" align="ลบข้อมูล" title="ลบข้อมูล" style="cursor:pointer;" onClick="ConfDelete('stock/del_temp_instock.php','dlist','did=<?= $rs['did'] ?>&lno=<?= $rs['lno'] ?>')" />
			</div>
		</div>
		<? 

} 
}
mysql_close($dblink);
?>

	</div>
	<div style="width:100%; height:auto; float:left;  text-align:right; padding-top:5px;">
		<div style="width:60%; height:auto; float:left;">
			<textarea id="cmem" rows="3" style="width:100%" placeholder="รายละเอียดการปรับสต็อค"></textarea>
		</div>
		<div style="width:40%; height:auto; float:left;  text-align:right;">
			<input type="button" value="  ปรับสต็อค " style="font-size:14px; font-weight:bold; height:35px;" onclick="addcutstock('stock/cut_instock.php','content')">
			<input type="button" value="  รายการใหม่  " style="font-size:14px; font-weight:bold; height:35px;" onclick="swabtab(6,6,'stock/cutstock.php','content','')">
		</div>
	</div>


</div>