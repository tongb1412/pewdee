<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
$month = (int) $_GET['month'];
$year = (int) $_GET['year'];


$dShow = $_GET['dShow'];
$dis1 = $_GET['dis1'];
$msMonth = array("ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค");
$msDay = array(31,0,31,30,31,30,31,31,30,31,30,31);
$msDow = array("อา","จ","อ","พ","พฤ","ศ","ส");
$msDay[1] = ($year % 4 == 0)?29:28;

$sYear = $year - 0;

$n = date('w',mktime(0,0,0,$month,1,$year));
$ln = date('w',mktime(0,0,0,$month,$msDay[11],$year));



?>

<div style="width:152px; height:195px; margin:auto; ; background:#EEF2F7; border:#999999 1px solid; font-size:11px;">
	<div style="width:100%; height:25px; line-height:20px; text-align:center; ">

        <div style="width:100%; float:left; padding-top:3px;">
        <select id="month" onChange="calendarYear('<?=$dis1?>','<?=$dShow?>')">
        <option value="<?=$month?>"><?=$msMonth[$month-1]?></option>
        <? 
		for($i=1;$i<13;$i++){ 
		if($i!=$month){
			if(strlen($i)==1){ $txt = '0'.$i; } else { $txt=$i; }
		?>
        	<option value="<?=$txt?>"><?=$msMonth[$i-1]?></option>
        <? 
		}	
		} 
		?>
        </select>&nbsp;&nbsp;
        <select id="year" onChange="calendarYear('<?=$dis1?>','<?=$dShow?>')">
        <option value="<?=$year?>"><?=$year?></option>
		
        
        
        <? for($i=$sYear-1;$i<$year+5;$i++){ 
	
		?>
        	<option value="<?=$i?>"><?=$i?></option>
        <? 
		
		} 
		?>        
        </select>
        </div>
  
    </div>
    <div style="width:100%; height:25px; line-height:20px; text-align:center; padding-left:8px; font-weight:bold;  ">
    	<div style="width:20px; float:left;">อา</div>
    	<div style="width:20px; float:left;">จ</div>
        <div style="width:20px; float:left;">อ</div>
        <div style="width:20px; float:left;">พ</div>
        <div style="width:20px; float:left;">พฤ</div>
        <div style="width:20px; float:left;">ศ</div>
        <div style="width:20px; float:left;">ส</div>
    </div>
	<div style="width:100%; height:120px; line-height:20px; text-align:center; padding-left:8px;">
		<? 
		//แสดงวันของเดือนที่ผ่านมา
		for($i=0;$i<$n;$i++){ 
		?>
        <div style="width:20px; height:20px; float:left;   ">&nbsp;</div>        
        <? 
		} 
		//แสดงวันของเดือนปัจจุบัน
		for($i=1;$i<$msDay[$month-1]+1;$i++){
		if(strlen($i)==1){ $dat = '0'.$i; } else { $dat = $i;  }
		
		$mm = (int) $_GET['month'];
		if(strlen($mm)==1){
			$mt = '0'.$mm;
		} else { $mt = $mm; }
		
		
		$dat .= '-'.$mt.'-'.$year;
		?>
    	<div style="width:20px; height:20px; float:left; ">
		<a href="javascript: getcalendarDate('<?=$dat?>','<?=$dShow?>','<?=$dis1?>')" style="text-decoration:none; color:#000000;"><?=$i;?></a>
        </div>
        <? 
		} 
		?>
    </div>
    <div style="width:100%; height:20px; line-height:20px; margin-top:5px; text-align:right; font-weight:bold">
    Today : <?=date('d-m-Y')?>&nbsp;
    </div>

</div>


