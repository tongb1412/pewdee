<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
session_start();
include('../class/config.php');
include('../class/permission_user.php');
$cl = $color1;
$txt = $_GET['txt'];
$type = $_GET['type'];

$branch_id = $_SESSION['branch_id'];
$company_code = $_SESSION['company_code'];
$company_data = $_SESSION['company_data'];
$where_user =  set_where_user_data('',$branch_id, $company_code, $company_data);

if(! empty($txt)){

	if($type == 'C'){
		$sql = "select * from tb_course where cname like '%$txt%' " . $where_user['where_company_code'] . " order by cname asc limit 7";
	} else {
		$sql = "select * from tb_package where name like '%$txt%' " . $where_user['where_company_code'] . " order by name asc limit 7";
	}
	// echo $sql;
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
			if($type=='C'){
				$id = $rs['cid'];
				$name = $rs['cname'];
				$price = $rs['price'];
			} else {
				$id = $rs['pid'];
				$name = $rs['name'];
				$price = $rs['price'];
			}
			?>
			<div  style="width:99%; height:25px; line-height:25px; text-align:left; margin-left:1px; border-bottom:#CCCCCC 1px dotted;background:<?=$cl?>; cursor:pointer;" onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')" onclick="movepct('<?=$id?>','<?=$name?>','<?=$price?>')"  >
				<div style="width:97%; float:left; line-height:25px; padding-left:20px;"  >
				<?=$name?>&nbsp;
				</div>
			
			</div>
			<? 
		} 
	} 

	?>

	<br />
	</div>
<? } ?>