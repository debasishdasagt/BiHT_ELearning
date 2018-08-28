<?php

include_once '../config.php';

if(isset($_POST['reg'])&&isset($_POST['pass']))
{
    $r=  mysql_query("select count(*) as a from d_user_password where user_id='".$_POST['reg']."' and passwd=md5('".$_POST['pass']."') and record_status='A'",$conn);
    $res=  mysql_fetch_array($r);
    if($res['a']>=1)
    {
        $rr=  mysql_query("select role_code as rc from d_user_roles where staff_id =(select staff_id from d_user_password where user_id='".$_POST['reg']."' and record_status='A') and record_status='A'",$conn);
        $ress=mysql_fetch_array($rr);
        $lccdq=  mysql_query("select lc_id,lc_name from d_learning_center where lc_id="
."(select staff_under_lc from d_staffs where staff_id ="
."(select staff_id from d_user_password where user_id='".$_POST['reg']."' and record_status='A')"
."and record_status='A') and record_status='A'",$conn);
        $lccdr=  mysql_fetch_array($lccdq);

        session_start();
        $_SESSION["rolecode"] = $ress['rc'];
        $_SESSION["userid"] = $_POST['reg'];
        $_SESSION["lccd"] = $lccdr['lc_id'];
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