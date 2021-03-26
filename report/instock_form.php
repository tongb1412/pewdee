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


$sql = "select * from tb_clinicinformation where cn = '$branch_id' ";
$clinic_result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
$row = mysql_fetch_array($clinic_result); 


$sql1 = "select a.*,b.pname,b.fname,b.lname from tb_instock a,tb_staff b where a.empid = b.staffid and a.lno='$lno' " . $where_branch_id;
$str1 = mysql_query($sql1) or die ("Error Query [".$sql1."]"); 
$rs1 = mysql_fetch_array($str1); 

$as = "";
$data = set_where_user_data($as ,$branch_id, $_SESSION['company_code'], $_SESSION['company_data']);
$where_branch_id = "";
$where_branch_id .= $data['where_branch_id'];
$where_branch_id .= $data['where_company_code'];

$sql2 = "select * from tb_drugeinstock  where lno='$lno' " . $where_branch_id;
$str2 = mysql_query($sql2) or die ("Error Query [".$sql2."]"); 


?>
<style type="text/css">
    body {
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 12px;
        text-align: center;
        margin: 0px;
    }

    .h_line {
        width: 100%;
        height: 30px;
        line-height: 30px;
        float: left;
    }
</style>

<body>
    <div style="width:100%; height:auto; text-align:center; margin:auto;">
        <div class="h_line" style="font-size:20px; font-weight:bold; text-align:center;">
            ใบรับยา
        </div>
        <div class="h_line" style="text-align:left;">
            สาขา : <?= $row['clinicname'] ?>
        </div>
        <div class="h_line" style="text-align:left;">
            <div style="width:50%; float:left;">Lot Number : <?= $lno ?></div>
            <div style="width:50%; float:left; text-align:right;">วันที่ : <?= $rs1['ldate'] ?></div>
        </div>
        <div class="h_line" style="text-align:left;">
            <div style="width:50%; float:left;">เลขที่บิล : <?= $rs1['sid'] ?></div>
            <div style="width:50%; float:left; text-align:right;">ผู้ขาย : <?= $rs1['sname'] ?></div>
        </div>
        <div class="h_line">&nbsp;</div>
        <div class="h_line" style="text-align:center; background:#CCCCCC">
            <div style="width:4%; border:#999999 1px solid;  float:left;">ลำดับ</div>
            <div style="width:10%; border:#999999 1px solid;  border-left:none;float:left;">รหัสยา</div>
            <div style="width:20%; border:#999999 1px solid;   border-left:none;float:left;">ชื่อยา</div>
            <div style="width:10%; border:#999999 1px solid;   border-left:none;float:left;">จำนวนรับ</div>
            <div style="width:15%; border:#999999 1px solid;   border-left:none;float:left;">ราคารวม</div>
            <div style="width:15%; border:#999999 1px solid;  border-left:none;float:left;">ราคา/หน่วย</div>
            <div style="width:12%; border:#999999 1px solid; border-left:none;float:left;">วันที่ผลิต</div>
            <div style="width:13%; border:#999999 1px solid;  border-left:none;float:left;">วันที่หมดอายุ</div>
        </div>

        <?
$n = 1;
while( $rs2=mysql_fetch_array($str2) ){
if(empty($rs2['totalprice'])){ $tprice = '-'; } else { $tprice = $rs2['totalprice']; }
if(empty($rs2['price'])){ $price = '-'; } else { $price = $rs2['price']; }

if(empty($rs2['bdate'])){ $bdate = '-'; } else { $bdate = $rs2['bdate']; }
if(empty($rs2['edate'])){ $edate = '-'; } else { $edate = $rs2['edate']; }

?>
        <div class="h_line" style="text-align:left; height:20px; line-height:20px;">
            <div style="width:4%; border:#999999 1px solid; text-align:center;  float:left;"><?= $n ?></div>
            <div style="width:10%;  border:#999999 1px solid;  border-left:none; text-align:center; float:left;">
                <?= $rs2['did'] ?>
            </div>
            <div style="width:20%;  border:#999999 1px solid;   border-left:none;float:left;"><?= $rs2['dname'] ?></div>
            <div style="width:10%; border:#999999 1px solid; text-align:center;  border-left:none;float:left;"><?= $rs2['qty'] ?></div>
            <div style="width:15%;  border:#999999 1px solid; text-align:right;   border-left:none;float:left;">
                <?= $tprice ?>&nbsp;&nbsp;</div>
            <div style="width:15%; border:#999999 1px solid; text-align:right;  border-left:none;float:left;">
                <?= $price ?>&nbsp;&nbsp;</div>
            <div style="width:12%; border:#999999 1px solid; text-align:center; border-left:none;float:left;"><?= $bdate ?></div>
            <div style="width:13%; border:#999999 1px solid; text-align:center;  border-left:none;float:left;"><?= $edate ?></div>
        </div>
        <?  $n++;} ?>


    </div>











    </div>

</body>