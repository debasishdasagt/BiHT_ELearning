<?php

include_once '../config.php';

if(isset($_POST['reg'])&&isset($_POST['pass']))
{
    $r=  mysql_query("select count(*) as a from d_passwd where candidate_reg='".$_POST['reg']."' and candidate_password=md5('".$_POST['pass']."') and record_status='A'",$conn);
    $res=  mysql_fetch_array($r);
    if($res['a']>=1)
    {
        echo "1";
    }
 else 
 {
     echo "0";
 }
}
 else {
echo "Something Went Wrong";    
}