<?php
include_once '../config.php';
if(isset($_GET['can_uid']))
{
    $sql= mysql_query("select count(*) as c from d_candidate where candidate_uid='".$_GET['can_uid']."' and record_status!='D'",$conn);
    $crr= mysql_fetch_array($sql);
    if($crr['c']==0)
    {
        echo "1";
    }
 else {
        echo "0";
 }
}
 else {
     echo "No paramiter passed";
 }
 ?>