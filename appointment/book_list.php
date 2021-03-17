<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');

$branch_id = "";
$where_branch_id = "";
if(empty($_GET['bid'])){
    if($_SESSION['branch_id'] != ""){
        $branch_id = $_SESSION['branch_id'];
        $where_branch_id = "and a.branchid = '$branch_id'";
    }
}
else{
    if($_GET['bid'] != "00"){
        $branch_id = $_GET['bid'];
        $where_branch_id = "and a.branchid = '$branch_id'";
    }
}

if(empty($_GET['dat'])){
	$dat = date('Y-m-d');
	$sdat = date('d-m-Y');
} else {
	$dat = substr($_GET['dat'],6,4).'-'.substr($_GET['dat'],3,2).'-'.substr($_GET['dat'],0,2)  ;
	$sdat = substr($_GET['dat'],0,2).'-'.substr($_GET['dat'],3,2).'-'.substr($_GET['dat'],6,4);
}

?>
<?
$sql  = "select a.*,concat(b.pname,b.fname,b.lname) as cname,c.selfphone from tb_appointment a,tb_staff b,tb_patient c  ";
$sql .= "where a.pid=b.staffid and a.hn=c.hn and a.dat like '%$dat%'  and atyp='S' " . $where_branch_id . " order by pid,cname   ";
// echo $sql;exit();

$str = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$n = 1;
while($rs=mysql_fetch_array($str)){ 
if($cl != $color1){
	$cl = $color1;
} else {
	$cl = $color2;
}
?>

<div  style="width:99%; height:25px; line-height:25px; text-align:left; margin-left:1px; border-bottom:#CCCCCC 1px dotted;background:<?=$cl?>;  cursor:pointer;" onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')" onclick="cleartabreg(6,4,7,'appointment/new_form.php?an=<?=$rs['an']?>','content','')"  >

    <div style="width:6%; float:left; line-height:25px;text-align:center"  >
	<?=$n?>
	</div>
    <div style="width:10%; float:left; line-height:25px;"  >
	&nbsp;<?=$rs['cn']?>
	</div>
    <div style="width:18%; float:left; line-height:25px;"  >
	&nbsp;<?=$rs['pname']?>
	</div>   
    <div style="width:15%; float:left; line-height:25px;"  >
	&nbsp;<?=$rs['selfphone']?>
	</div>   
    <div style="width:18%; float:left; line-height:25px;"  >
	&nbsp;<?=$rs['cname']?>
	</div>  
    <div style="width:13%; float:left; line-height:25px; text-align:center"  >
	<?=$rs['stim'].'-'.$rs['etim']?>
	</div>  
    <div style="width:20%; float:left; line-height:25px;"  >
	&nbsp;<?=$rs['mem']?>
	</div> 
</div>
<? $n++; } ?>

<div style="width:100%; float:left; height:10px;">&nbsp;</div>
