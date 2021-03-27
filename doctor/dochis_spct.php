<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');

$txt = $_POST['dat'];
$cl = $color1;



if(empty($txt)){
    //if($dat=='-'){
	//$sql = "select a.*,b.status from tb_pctrec a,tb_vst b where a.hn='$hn' and a.dat = '-' and a.vn = b.vn and (b.status='COM')  ";
	//} else {
		$sql = "select a.*,b.status from tb_pctrec  a,tb_vst b where a.hn='$hn' and a.vn = b.vn and (b.status='COM') ";
	//}

} else {
	$hn = $_POST['hn'];
	if($txt=='00'){
		$sql = "select a.*,b.status from tb_pctrec a,tb_vst b where a.hn='$hn' and a.vn = b.vn and (b.status='COM') ";
	} else {
		$sql = "select  a.*,b.status from tb_pctrec  a,tb_vst b where a.hn='$hn' and a.vn = b.vn and (b.status='COM') and a.dat like '%$txt%' ";
	}
}

$sql .=" order by a.dat asc ";
// echo $sql;exit();

$result  = mysql_query($sql);

$dat = '';

while($rs=mysql_fetch_array($result)){

	if($cl != $color1){
		$cl = $color1;
	} else {
		$cl = $color2;
	}

	if($dat!=$rs['dat']){ $dat=$rs['dat']; $dd= $rs['dat']; } else { $dd='-';  }

	?>

	<div class="list_out" onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')" style="background:<?=$cl?>; width:94%; cursor:pointer;" onClick="loadmodule('d_list','doctor/doctor_hislist.php','vn=<?=$rs['vn']?>&tid=<?=$rs['tid']?>&tname=<?=$rs['tname']?>')">
		<div style="width:18%; float:left;"  ><?=$dd?>&nbsp;</div>
		<div style="width:30%; float:left; overflow:hidden; height:20px; "><?=$rs['tname']?>&nbsp;</div>
		<div style="width:10%; float:left; text-align:right;" ><?=$rs['qty']?>&nbsp;</div>
		<div style="width:20%; float:left; text-align:right;" ><?=number_format($rs['totalprice'],'0','.',',')?>&nbsp;</div>
		<div style="width:10%; float:left; text-align:right;" ><?=$rs['total']?>&nbsp;</div>
	</div>

<? } ?>