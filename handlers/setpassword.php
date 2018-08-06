<?php

include_once '../config.php';
function setpassword($reg,$pass)
{
    
    $disableoldpwd=  mysql_query("update d_passwd set record_status='B' where candidate_reg='".$reg."'",$GLOBALS['conn']);
    //echo "insert into d_passwd(candidate_reg,candidate_password,created_on,record_status) values('".$reg."',md5('".$pass."'),now(),'A')";
    $pwdsql=  mysql_query("insert into d_passwd(candidate_reg,candidate_password,created_on,record_status) values('".$reg."',md5('".$pass."'),now(),'A')",$GLOBALS['conn']);
    if($pwdsql)
    {
        return 'done';
    }
 else    
 {
        return 'error';
 }
}
?>