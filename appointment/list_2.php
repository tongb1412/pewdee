<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include('../class/config.php');

$branch_id = "";
if($_SESSION['branch_id'] != ""){
	$branch_id = $_SESSION['branch_id'];
	$where_branch_id = "and a.branchid = '$branch_id'";
}


if(empty($_GET['dat'])){
	$dat = date('Y-m-d');
	$sdat = date('d-m-Y');
} else {
	$dat = substr($_GET['dat'],6,4).'-'.substr($_GET['dat'],3,2).'-'.substr($_GET['dat'],0,2)  ;
	$sdat = substr($_GET['dat'],0,2).'-'.substr($_GET['dat'],3,2).'-'.substr($_GET['dat'],6,4);
}

?>
<div style="width:100%; height:35px;">
	<div class="line" style="margin-top:0.5%;" >
		<div style="width:10%; float:left; text-align:right;">วันที่ :&nbsp;</div>
		<div style="width:14%; float:left;">
        <input type="text" id="dat" size="19" readonly="readonly" value="<?=$sdat?>" />
        </div>
		<div style="width:5%; float:left;">
        <img src="calendar/calendar.jpg" width="16" onclick="calendar('<?=date('m')?>','<?=date('Y')?>','cl','dat','cl1')" style="margin-top:5px; cursor:pointer;"  />        
        <div id="cl" class="calendar" style="width:152px; height:auto; display:none;"></div>
		<div id="cl1" class="calendar" style="width:152px; height:auto; display:none;"></div>
        </div>	
        <div style="width:14%; float:left;">
        <input type="button" value="  แสดงข้อมูล "  onclick="showapplist('appointment/book_list.php','applist')" /> 
        </div>
     </div>
</div>
<div style="position: absolute;left: 40%;top: 16%;">
    <?php
    if ($_SESSION['branch_id'] != "") {
        $branch_id = $_SESSION['branch_id'];
        $sql = "";
        if ($branch_id == "00" || $branch_id == "07") {
            $sql = "select * from tb_branch order by branchid";
        } else {
            $sql = "select * from tb_branch where branchid = '$branch_id' order by branchid";
        }
        $result = mysql_query($sql) or die("Error Query [" . $sql . "]");
        $Num_Rows = mysql_num_rows($result);
    ?>
        <span>
            สาขา
            &nbsp;
        </span>
        <select name="sel_branchid_app" id="sel_branchid_app" onchange="showapplist('appointment/book_list.php','applist')">
            <?php
            if ($Num_Rows > 0) {
                $flag = 0;
                if ($branch_id == "00" || $branch_id == "07") {
            ?>
                    <option value="00">ทั้งหมด</option>
                    <?php
                }
                while ($rs = mysql_fetch_array($result)) {
                    if ($branch_id == $rs['branchid']) {
                    ?>
                        <option value="<?php echo $rs['branchid'] ?>" selected><?php echo $rs['branchname']; ?></option>
                    <?php
                    } else {
                    ?>
                        <option value="<?php echo $rs['branchid'] ?>"><?php echo $rs['branchname']; ?></option>
            <?php
                    }
                }
            }
            ?>
        </select>
    <?php
        mysql_close($dblink);
        // ajaxLoad('get','stock/druge_list.php','txt=','p_list');
    } else if ($_SESSION['branch_id'] == "") {
    }
    ?>

</div>
<div style=" width:98%; height:25px;; border:<?=$tabcolor?> 1px solid; background:<?=$tabcolor?>; margin-left:10px;">

    <div style="width:100%; height:20px; padding-top:5px; color:#000000; margin:auto; font-weight:bold; font-size:13px; ">    
        <div style="width:6%;  text-align:left; float:left;">
        <img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ลำดับ
        </div>
        <div style="width:10%;  text-align:left; float:left;">
        <img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;Card No.
        </div>
        <div style="width:18%;  text-align:left; float:left;">
        <img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ชื่อ - สกุล
        </div>    
        <div style="width:15%;  text-align:left; float:left;">
        <img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;เบอร์โทร
        </div>    
        <div style="width:18%;  text-align:left; float:left;">
        <img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;ผู้นัด
        </div>  
        <div style="width:10%;  text-align:left; float:left;">
        <img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;เวลา
        </div>    
        <div style="width:23%;  text-align:left; float:left;">
        <img src="images/icon/bullet_arrow_down.png" align="absmiddle" />&nbsp;รายละเอียด
        </div>    
    </div>
</div>
<div id="applist" style=" width:98%; height:400px; border:<?=$tabcolor?> 1px solid;  margin-left:10px; overflow:auto">
    <?php  require("book_list.php"); ?>
</div>