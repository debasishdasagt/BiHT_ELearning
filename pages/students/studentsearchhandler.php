<?php
include_once 'loginChecker.php';
include '../../config.php';
if ($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['sdata']) && isset($_POST['stype']))
{
    echo "<table cellspacing='0' cellpadding='5' border='1'><tr><th>Rrgistration Number</th><th>Name</th><th>UID</th><th>Mobile Number</th><th>Select</th></tr>";
    if($_POST['stype']=='regnum')
    {
        $sq=  mysql_query("select id,reg_num,student_name,uidai_number,mobile_number from d_students where reg_num='".$_POST['sdata']."' and record_status='A'",$conn);
        while($sr=  mysql_fetch_array($sq))
        {
            echo "<tr><td>".$sr['reg_num']."</td><td>".$sr['student_name']."</td><td>".$sr['uidai_number']."</td><td>".$sr['mobile_number']."</td><td><a href=javascript:selectS('".$sr['id']."')>Select</a></td></tr>";
        }
    }
    
    
    echo "</table>";
}

