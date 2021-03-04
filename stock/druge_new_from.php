<? include('../class/config.php'); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
$sql = "select * from tb_autonumber where typ='DG'";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$rs=mysql_fetch_array($result);
 //explode('-',$rs['number']);

$hn = substr($rs['number'],0,3);
$x =  substr($rs['last'],3,3);
$n = strlen($x);

$num = intval($x) + 1;
$m = strlen($num);

$i = 0; $t = ''; 
while($i < $n - $m){
	$t .= '0';
    $i++;
}
$t .= $num;
$hn .= $t; 

?>
<div style="width:100%; height:470px; margin:auto; margin-top:20px; text-align:center;">

	<div style="width:50%; height:470px; margin:auto;">
		<div class="line">
			<div style="width:20%; float:left; text-align:right;">รหัสยา :&nbsp;</div>
			<div style="width:30%; float:left;"><input type="text" id="did" size="20" value="<?= $hn ?>" /></div>
			<div style="width:20%; float:left; text-align:right;">Barcode :&nbsp;</div>
			<div style="width:30%; float:left;"><input type="text" id="bcode" size="20" /></div>
		</div>
		<div class="line">
			<div style="width:20%; float:left; text-align:right;">ชื่อสามัญทางยา :&nbsp;</div>
			<div style="width:80%; float:left;"><input type="text" id="gname" size="58" /></div>
		</div>
		<div class="line">
			<div style="width:20%; float:left; text-align:right;">ชื่อทางการค้า :&nbsp;</div>
			<div style="width:80%; float:left;"><input type="text" id="tname" size="58" /></div>
		</div>
		<div class="line" style="height:20px;">&nbsp;</div>
		<?
$sql = "select * from tb_gernaral where typ='DG'";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
?>
		<div class="line">
			<div style="width:20%; float:left; text-align:right;">กลุ่มยา :&nbsp;</div>
			<div style="width:80%; float:left;">
				<select id="dgid" style="width:360px;">
					<? while($rs=mysql_fetch_array($result)){  ?>
					<option value="<?= $rs['id'] ?>"><?= $rs['name'] ?></option>
					<? } ?>
				</select>
			</div>
		</div>
		<?
$sql = "select * from tb_gernaral where typ='DT'";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
?>
		<div class="line">
			<div style="width:20%; float:left; text-align:right;">ประเภท :&nbsp;</div>
			<div style="width:80%; float:left;">
				<select id="tid" style="width:360px;">
					<? while($rs=mysql_fetch_array($result)){  ?>
					<option value="<?= $rs['id'] ?>"><?= $rs['name'] ?></option>
					<? } ?>
				</select>
			</div>
		</div>

		<div class="line" style="height:20px;">&nbsp;</div>
		<?
$sql = "select * from tb_gernaral where typ='DN'";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
?>
		<div class="line">
			<div style="width:20%; float:left; text-align:right;">คงเหลือ :&nbsp;</div>
			<div style="width:30%; float:left;"><input type="text" id="total" size="20" value="0" readonly="true" /></div>
			<div style="width:20%; float:left; text-align:right;">หน่วย :&nbsp;</div>
			<div style="width:30%; float:left;">
				<select id="unit" style="width:131px;">
					<? while($rs=mysql_fetch_array($result)){  ?>
					<option value="<?= $rs['name'] ?>"><?= $rs['name'] ?></option>
					<? } ?>
				</select>
			</div>
		</div>

		<div class="line">
			<div style="width:20%; float:left; text-align:right;">ต้นทุน :&nbsp;</div>
			<div style="width:30%; float:left;"><input type="text" id="bprice" size="20" value="0" readonly="true" /></div>
			<div style="width:20%; float:left; text-align:right;">ราคาขาย :&nbsp;</div>
			<div style="width:30%; float:left;"><input type="text" id="sprice" size="20" /></div>
		</div>
		<div class="line">
			<div style="width:20%; float:left; text-align:right;">จุดสั่งซื้อ :&nbsp;</div>
			<div style="width:30%; float:left;"><input type="text" id="sqty" size="20" value="0" /></div>
			<div style="width:20%; float:left; text-align:right;">&nbsp;</div>
			<div style="width:30%; float:left;">&nbsp;</div>
		</div>
		<div class="line" style="height:20px;">&nbsp;</div>

		<?
$sql = "select * from tb_gernaral where typ='DU'";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
?>
		<div class="line">
			<div style="width:20%; float:left; text-align:right;">วิธีใช้ :&nbsp;</div>
			<div style="width:80%; float:left;">
				<select id="duse" style="width:360px;">
					<option value=""></option>
					<? while($rs=mysql_fetch_array($result)){  ?>
					<option value="<?= $rs['name'] ?>"><?= $rs['name'] ?></option>
					<? } ?>
				</select>
			</div>
		</div>
		<?
$sql = "select * from tb_gernaral where typ='DW'";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
?>
		<div class="line">
			<div style="width:20%; float:left; text-align:right;">ข้อควรระวัง :&nbsp;</div>
			<div style="width:80%; float:left;">
				<select id="wuse" style="width:360px;">
					<option value=""></option>
					<? while($rs=mysql_fetch_array($result)){  ?>
					<option value="<?= $rs['name'] ?>"><?= $rs['name'] ?></option>
					<? } ?>
				</select>
			</div>
		</div>
		<?
$sql = "select * from tb_gernaral where typ='DH'";
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
?>
		<div class="line">
			<div style="width:20%; float:left; text-align:right;">วิธีเก็บ :&nbsp;</div>
			<div style="width:80%; float:left;">
				<select id="huse" style="width:360px;">
					<option value=""></option>
					<? while($rs=mysql_fetch_array($result)){  ?>
					<option value="<?= $rs['name'] ?>"><?= $rs['name'] ?></option>
					<? } ?>
				</select>
			</div>
		</div>



		<div class="line" style="height:20px;">&nbsp;</div>
		<div class="line">
			<div style="width:20%; float:left; text-align:right;">&nbsp;</div>
			<div style="width:80%; float:left;"><input type="button" value="  บันทึกข้อมูล  " style="font-size:14px; font-weight:bold; height:35px;" onclick="adddruge('ADD')" />&nbsp;&nbsp;<input type="button" value="   ยกเลิก  " style="font-size:14px; font-weight:bold; height:35px;" onclick="loadmodule('home','stock/stock.php','') " /></div>

		</div>

	</div>
</div>