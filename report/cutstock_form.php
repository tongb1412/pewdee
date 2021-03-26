<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?
//session_start();

include('../class/config.php');
include('../class/permission_user.php');

$lno = $_GET['lno'];


if(!empty($_REQUEST['branchid'])){
	$branch_id = $_REQUEST['branchid'];
} else {
	$branch_id = $_SESSION['branch_id'];
}

$as = "a";
$data = set_where_user_data($as ,$branch_id, $_SESSION['company_code'], $_SESSION['company_data']);
$where_branch_id = "";
$where_branch_id .= $data['where_branch_id'];
$where_branch_id .= $data['where_company_code'];

$sql = "select * from tb_clinicinformation  where cn = '$branch_id'";
$clinic_result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$row=mysql_fetch_array($clinic_result); 


$sql1 = "select a.*,b.pname,b.fname,b.lname from tb_cutstock a,tb_staff b  where a.empid=b.staffid and a.lno='$lno' " . $where_branch_id;
$str1 = mysql_query($sql1) or die ("Error Query [".$sql1."]"); 
$rs1=mysql_fetch_array($str1); 


$as = "a";
$data = set_where_user_data($as ,$branch_id, $_SESSION['company_code'], $_SESSION['company_data']);
$where_branch_id = "";
$where_branch_id .= $data['where_branch_id'];
$where_branch_id .= $data['where_company_code'];

$sql2 = "select * from tb_drugecutstock  where lno='$lno' " . $where_branch_id . " order by typ asc, dname asc ";
$str2 = mysql_query($sql2) or die ("Error Query [".$sql2."]"); 


?>
<style type="text/css">
body { font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; text-align:center; margin:0px; }
.h_line { width:100%; height:30px; line-height:30px; float:left; }
</style>
<body>
<div style="width:100%; height:auto; text-align:center; margin:auto;">
	<div class="h_line" style="font-size:20px; font-weight:bold; text-align:center;">
    ใบปรับสต็อค
    </div>
	<div class="h_line" style="text-align:left;">
    สาขา : <?=$row['clinicname']?>
    </div>
	<div class="h_line" style="text-align:left;">  
        <div style="width:50%; float:left;">เลขที่บิล : <?=$lno?></div>  	
        <div style="width:50%; float:left; text-align:right;">วันที่ : <?=$rs1['ldate']?></div>
    </div>
	<div class="h_line" style="text-align:left;">    	
        <div style="width:100%; float:left; text-align:right;">หมายเหตุ : <?=$rs1['mem']?></div>
    </div>
    <div class="h_line">&nbsp;</div>
	<div class="h_line" style="text-align:center; background:#CCCCCC">
        <div style="width:4%; border:#999999 1px solid;  float:left;">ลำดับ</div>
        <div style="width:10%;  border:#999999 1px solid;  border-left:none;float:left;">รหัสยา</div>
        <div style="width:30%;  border:#999999 1px solid;   border-left:none;float:left;">ชื่อยา</div>
        <div style="width:10%; border:#999999 1px solid;   border-left:none;float:left;">จำนวน</div>
        <div style="width:15%;  border:#999999 1px solid;   border-left:none;float:left;">หน่วย</div>
        <div style="width:15%; border:#999999 1px solid;  border-left:none;float:left;">ประเภท</div>
        <div style="width:12%; border:#999999 1px solid; border-left:none;float:left;">ราคา</div>   
    </div>

<?
$n = 1;
while( $rs2=mysql_fetch_array($str2) ){


?>
	<div class="h_line" style="text-align:left; height:20px; line-height:20px;">
        <div style="width:4%; border:#999999 1px solid; text-align:center;  float:left;"><?=$n?></div>
        <div style="width:10%;  border:#999999 1px solid;  border-left:none; text-align:center; float:left;">
        <?=$rs2['did']?>
        </div>
        <div style="width:30%;  border:#999999 1px solid; border-left:none;float:left;"><?=$rs2['dname']?></div>
        <div style="width:10%; border:#999999 1px solid;  text-align:center;  border-left:none;float:left;"><?=$rs2['qty']?></div>
        <div style="width:15%;  border:#999999 1px solid;  border-left:none;float:left;">
		<?=$rs2['unit']?>&nbsp;&nbsp;</div>
        <div style="width:15%; border:#999999 1px solid; text-align:center; border-left:none;float:left;">
        <? if($rs2['typ']=='I'){ echo 'รับเข้า';  } else { echo 'จ่ายออก'; } ?>
        </div>
          
        <div style="width:12%; border:#999999 1px solid; text-align:right;  border-left:none;float:left;">
		<?=$rs2['price']?>&nbsp;&nbsp;</div>
         
    </div>
<?  $n++;} ?>


</div>











</div>

</body>