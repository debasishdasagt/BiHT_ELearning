<?php
include_once '../config.php';
include_once 'setpassword.php';
$msg="";
if(isset($_POST['can_uid']))
{
    $can_name=$_POST['can_name'];
    $can_fname=$_POST['can_fname'];
    $can_dob=$_POST['can_dob'];
    $can_uid=$_POST['can_uid'];
    $can_mob=$_POST['can_mob'];
    $can_email=$_POST['can_email'];
    
    $s=  mysql_query("select get_candidate_reg() as reg",$conn);
    $qr=mysql_fetch_array($s);
    if($qr['reg']!="")
    {
        $regsql=  mysql_query("insert into d_candidate(candidate_reg,"
                . "candidate_name,"
                . "candidate_fname,"
                . "candidate_dob,"
                . "candidate_uid,"
                . "candidate_mob,"
                . "candidate_email,"
                . "created_on,"
                . "record_status) values('"
                . $qr['reg']."','"
                . $can_name."','"
                . $can_fname."','"
                . $can_dob."','"
                . $can_uid."','"
                . $can_mob."','"
                . $can_email."',"
                . "now(),'A')",$conn);
        if($regsql)
        {
            $pas=passwd();
            //echo "Registration Number is: ".$qr['reg']."\n Password is: ".$pas;
            if(setpassword($qr['reg'],$pas)=='done')
            {
                echo "d~".$qr['reg']."~".$pas;
            }
            else
            {
                echo "Server: Something went Wrong while setting password";
            }
        }
 else {echo "Server: Something went wrong \n\n".$regsql;}
    }
}

function passwd()
{
    $chars="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRDTUVWXYZ1234567890@######@@@@@@";
    $password=substr(str_shuffle($chars),0,8);
    return $password;
}
?>