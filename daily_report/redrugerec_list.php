<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div style=" width: 98%; margin-top:5px;  text-align:center; height:345px; ">
<?
session_start();
include('../class/config.php');
include('../class/permission_user.php');
$cl = '';
$dat = date('Y-m-d');
$did = $_POST['did'];

// $dat = "2020-03-01";
?>
    <div style="width:98%; height:20px; padding-top:5px; color:#000000; margin:auto;  font-weight:bold; font-size:12px; background:<?=$tabcolor?>;">
      <div style="width:8%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ลำดับ</div>
      <div style="width:15%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รหัส</div>
      <div style="width:32%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ชื่อยา</div>
      <div style="width:20%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;จำนวน</div>
      <div style="width:25%;text-align:left; float:left;">&nbsp;<img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;หน่วย</div>

    </div>
	
		
<? 


if(!empty($_REQUEST['branchid'])){
	$branchid = $_REQUEST['branchid'];
} else {
	$branchid = '';
}
$as = "a";
$data = set_where_user_data($as ,$branchid, $_SESSION['company_code'], $_SESSION['company_data']);
$where_branch_id = "";
$where_branch_id .= $data['where_branch_id'];
$where_branch_id .= $data['where_company_code'];
$cl = $color1;
if(empty($did)){
$sql  = "select a.did,a.dname,sum(a.qty) qty,a.unit from tb_drugerec a,tb_vst b where a.vn = b.vn and b.status = 'COM'   and (b.vdate like '%$dat%') $where_branch_id group by a.did,a.dname,a.unit ";
} else {
$sql  = "select a.did,a.dname,sum(a.qty) qty,a.unit from tb_drugerec a,tb_vst b,tb_patient c where a.vn = b.vn and b.status = 'COM'  and a.hn=c.hn  and ( b.vdate like '%$dat%' )and (a.did like '%$did%') $where_branch_id group by a.did,a.dname,a.unit ";
}
$result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$Num_Rows = mysql_num_rows($result); 



$Per_Page = 14;   // Per Page

$Page = $_GET["Page"];
if(!$_GET["Page"])	{	$Page=1;	}
$Prev_Page = $Page-1;
$Next_Page = $Page+1;
$Page_Start = (($Per_Page*$Page)-$Per_Page);
if($Num_Rows<=$Per_Page)
{
		$Num_Pages =1;
}
else if(($Num_Rows % $Per_Page)==0)
{
		$Num_Pages =($Num_Rows/$Per_Page) ;
}
else
{
		$Num_Pages =($Num_Rows/$Per_Page)+1;
		$Num_Pages = (int)$Num_Pages;
}
$sql .=" order by a.dname asc LIMIT $Page_Start , $Per_Page";
$result  = mysql_query($sql);
if($result){
$n=1; $total = 0;
while($rs=mysql_fetch_array($result)){  
if($cl != $color1){
	$cl = $color1;
} else {
	$cl = $color2;
}

?>	
		
<div class="list_out" onmouseover="linkover(this)" onmouseout="linkout(this,'<?=$cl?>')" style="width:98%;;background:<?=$cl?>; ">
	<div style="width:8%; float:left;"><?=$n?></div>
	<div style="width:15%; float:left;"><?=$rs['did']?></div>
	<div style="width:32%; float:left;"><?=$rs['dname']?></div>
	<div style="width:19%; float:left;"><?=$rs['qty']?></div>
	<div style="width:25%; float:left;"><?=$rs['unit']?></div>
	
								
	
</div>






<? $n++; } ?>
<div style="width:83%; margin:auto; margin-top:10px; text-align:right; line-height:20px;">
 <?=$Num_Rows;?> 
  รายการ : 
  <?=$Num_Pages;?> 
  หน้า :
  <?
	if($Prev_Page)
	{
	?>
	<a href="javascript: ajaxLoad('get','daily_report/redrugerec_list.php','mode=<?=$mode?>&Page=<?=$Prev_Page?>','d_list')">	
	<img src='images/icon/back.png'  border='0' align="absmiddle"/>
	</a>
	<?
	}
	
	echo " <b>$Page </b>";
	
	if($Page!=$Num_Pages)
	{
	?>

	<a href="javascript: ajaxLoad('get','daily_report/redrugerec_list.php','mode=<?=$mode?>&Page=<?=$Next_Page?>','d_list')">	
	<img src='images/icon/next.png'  border='0' align="absmiddle" />
	</a>	
    <?		
	}
	
	mysql_close($dblink);

?>
</div>

<? } ?>
</div>



<!--รวม

<div id="d_list2" style=" width: 99%; margin-top:10px;   text-align:center; height:30px; background-color:#FFCC99;  ">
	


	<div class="line" style="margin-top: 4px;">
	  <div style="width:20%; float:left; text-align:right;">รวมทั้งหมด :&nbsp;</div>
      <div style="width:10%; float:left;">
        <input  style="font-weight:bold; text-align:right;" name="text2" type="text" id="" size="12"; value="<?=number_format($total,'0','.',',')?>" />
      </div>
    </div>	
	
	
	
	
	</div>-->
