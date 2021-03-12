<?php 

include('../class/config.php'); 
date_default_timezone_set("Asia/Bangkok");

$fn = $_POST['FN'];

if($fn == "get_druge_data"){
    get_druge_data();
}


function get_druge_data(){

    $branch_id = $_SESSION['branchid'];
    $data = array();
    $data_return = array();

    $sql = "select * from tb_druge where status='IN' ORDER BY did asc";
    $result = mysql_query($sql) or die ("Error Query [".$sql."]"); 
    $Num_Rows = mysql_num_rows($result);
    if($Num_Rows > 1){
        while($line = mysql_fetch_array($result)){
            // $data[] = $line;
            $data['did'] = $line['did'];
            $data['tname'] = $line['tname'];
            $data['unit'] = $line['unit'];
            $data['dgroup'] = $line['dgroup'];
            $data['total'] = $line['total'];
            array_push($data_return, $data);
        }
        foreach($data_return as $key => $val){
            // echo json_encode($key);exit();
            $did = $val['did'];
            $sql1 = "select sum(total) as total from tb_drugeinstock where did='$did' and total > 0 and branchid ='$branch_id'";
            $rst = mysql_query($sql1) or die ("Error Query [".$sql1."]"); 
            $num  = mysql_num_rows($rst);
            $dtotal = 0;
            if(!empty($num)){
                $rss = mysql_fetch_array($rst);
                $dtotal = $rss['total'];
            }
            
            if($dtotal === null){
                $dtotal = 0;
            }
            $data_return[$key]['total_branch'] = $dtotal;
        }
    }
    echo json_encode($data_return);
}
