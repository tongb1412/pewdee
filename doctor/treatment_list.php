<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?
include('../class/config.php');
$cl = $color1;
$txt = $_GET['txt'];
$branch_id = $_SESSION['branch_id'];
$company_code = $_SESSION['company_code'];
$company_data = $_SESSION['company_data'];

if(! empty($txt)){
	$sql = "select * from tb_treatment where tname like '%$txt%' and company_code = '$company_code' order by tname asc limit 8";
	$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
	$n = mysql_num_rows($result);
	if(! empty($n)){
		?>
		<div style=" width:100%; height:auto; border:<?=$tabcolor?> 1px solid; background:#FFFFFF">
		<div style="width:100%; height:20px; padding-top:5px; color:#000000; margin:auto; font-weight:bold; font-size:13px; background:<?=$tabcolor?>;">    
			<div style="width:100%;  text-align:left; float:left;"><img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รายการ</div>	
		</div>

		<?
		while($rs = mysql_fetch_array($result)){ 
			if($cl != $color1){
				$cl = $color1;
			} else {
				$cl = $color2;
			}
			?>
			<div  style="width:99%; height:25px; line-height:25px; text-align:left; margin-left:1px; border-bottom:#CCCCCC 1px dotted;background:<?=$cl?>; cursor:pointer;" class="cut-text" onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')" onclick="movelaser('<?=$rs['tid']?>','<?=$rs['tname']?>','<?=$rs['price']?>','<?=$rs['unit']?>','<?=$rs['typ']?>')"  >
				<div style="width:97%; float:left; line-height:25px; padding-left:20px;" >
				<?=$rs['tname']?>&nbsp;
				</div>
			</div>
			<? 
		} 
	} 
	?>
	<br />
	</div>
<? } ?>