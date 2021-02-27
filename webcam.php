<?php
session_start();
session_register("WEB_HN");	
$WEB_HN = $_GET['hn'];

?>
<div class="diaTop" style="width:600px;">
	<div style="width:480px; float:left; text-align:right; margin-right:10px; font-size:17px; font-weight:normal;">
    	ถ่ายรูป
    </div>
</div>
<div style="width:600px; height:500px; background:#666666;">
<iframe name="up_iframe" src="cam.php?hn=<?=$hn?>" width="550" height="400" frameborder="0" style="padding:0px; text-align:center; overflow:hidden;">      
        
</iframe>
</div>
<div class="diaFoot" style="width:600px;">
	<div  class="btnMenu"  style="width:98%; float:right; margin-right:5px;">
    <ul> 
    <li><a href="javascript: ;"><span id="btnClose"> ปิด </span></a></li>
    </ul>	
   	</div>
</div>