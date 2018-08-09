<?php
include_once '../config.php';

if(isset($_GET['userid']))
{
    $q= mysql_query("select count(staff_id) as sc,staff_email,staff_id,staff_name from d_staffs where staff_email='".$_GET['userid']."' or staff_id=(select staff_id from d_user_password where user_id='".$_GET['userid']."' and record_status='A') and record_status='A' limit 1;",$conn);
    $qr= mysql_fetch_array($q);
    if($qr['sc']>=1)
    {
        //Getting UserID
    $userQ=  mysql_query("select user_id from d_user_password where staff_id='".$qr['staff_id']."' and record_status='A'",$conn);
    $UQres=  mysql_fetch_array($userQ);
    $newpass=passwd();
    
    $disablePSWD=  mysql_query("update d_user_password set record_status='B', updated_on=now() where staff_id='".$qr['staff_id']."' and user_id='".$UQres['user_id']."' and record_status='A'",$conn);
    $setNEWpswd= mysql_query("insert into d_user_password(staff_id,user_id,passwd,record_status,created_on) values('".$qr['staff_id']."','".$UQres['user_id']."',md5('".$newpass."'),'A',now())",$conn);
    if($disablePSWD && $setNEWpswd)
    {
        $mailbdy="<div style='font-family:calibri;font-size:14px'>Hello ".$qr['staff_name'].",<br> As per your request, we have resetted your password. Below are your new password and login id.<br><br>Login ID: <b>".$UQres['user_id']."</b><br>New Password: <b>".$newpass."</b><br><br>Please use the same new password lo login and it is recommanded to set a strong password.</div>";
       header("location:../mailer.php?mailadd=".$qr['staff_email']."&mailnam=".$qr['staff_name']."&mailsub=BiHT e-Learning New Password&mailbdy=".$mailbdy);
    }
    }
    echo "0";
    }
function passwd()
{
    $chars="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRDTUVWXYZ1234567890";
    $password=substr(str_shuffle($chars),0,8);
    return $password;
}
?>