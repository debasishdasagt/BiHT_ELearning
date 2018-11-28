<?php
include_once 'loginChecker.php';
include '../../config.php';
$pg="";
$rcpttype="";
if (isset($_GET['sdata']) && isset($_GET['stype']))
{
    echo "<div class='bodytext'><table cellspacing='1' cellpadding='5' border='0'><tr style='color: white; background-color: #1b7b95; border-radius: 2px; text-align: center'><th>Rrgistration Number</th><th>Student Name</th><th>Receipt Type</th><th>Receipt Number</th><th>Fee Paid</th><th>Receipt</th></tr>";
    if($_GET['stype']=='regnum')
    {
        $sq=  mysql_query("SELECT `id`,
    `rcpt_id`,
    `student_reg_num`,
    `course_code`,
    `course_name`,
    `learning_center`,
    `admission_fee`,
    `fee_paid`,
    `fee_type`,
    `student_name`,
    `student_father_name`,
    `payment_date`,
    `next_installment`,
    `class_start_on`,
    `course_duration`,
    `duration_unit`
FROM `d_fee_payments` where student_reg_num='".$_GET['sdata']."' and record_status='A'",$conn);
        while($sr=  mysql_fetch_array($sq))
        {
            if($sr['fee_type']=='admission'){$pg='arcptprint';$rcpttype="Admission Fee";}
            else if($sr['fee_type']=='tuition'){$pg='trcptprint';$rcpttype="Tuition Fee";}
            echo "<tr style='color: black; background-color: #bababa; border-radius: 2px; text-align: center'><td>".$sr['student_reg_num']."</td><td>".$sr['student_name']."</td><td>$rcpttype</td><td>".$sr['rcpt_id']."</td><td>".$sr['fee_paid']."</td><td><a href='$pg.php?rcptnum=".$sr["rcpt_id"]."'>Receipt</a></td></tr>";
        }
    }
    
    /*
    else if($_GET['stype']=='sname')
    {
        $sq=  mysql_query("select id,reg_num,student_name,uidai_number,mobile_number,concat(`id`,'^',`reg_num`,'^',`reg_date`,'^',ifnull(`student_under_lc`,''),'^',`course_code`,'^',`course_duration`,'^',`duration_unit`,'^',`admission_fee`,'^',`tuition_fee`,'^',`total_fee`,'^',`student_name`,'^',`student_father_name`,'^',`student_mother_name`,'^',`student_spouse_name`,'^',`present_address`,'^',`permanent_address`,'^',`uidai_number`,'^',`student_dob`,'^',`mobile_number`,'^',`email_id`,'^',`academic_qualification`,'^',`occupation`,'^',`category`,'^',`gender`,'^',`rc_type`,'^',`medium`,'^',`remarks`,'^',ifnull(`student_pic`,'')) as all_data from d_students where student_name like'%".$_GET['sdata']."%' and record_status='A'",$conn);
        while($sr=  mysql_fetch_array($sq))
        {
            echo "<tr style='color: black; background-color: #bababa; border-radius: 2px; text-align: center'><td>".$sr['reg_num']."</td><td>".$sr['student_name']."</td><td>".$sr['uidai_number']."</td><td>".$sr['mobile_number']."</td><td><a href='".$_GET['page'].".php?regnum=".$sr["reg_num"]."&submittyp=modify'>Select</a></td></tr>";
        }
    }
    else if($_GET['stype']=='uid')
    {
        $sq=  mysql_query("select id,reg_num,student_name,uidai_number,mobile_number,concat(`id`,'^',`reg_num`,'^',`reg_date`,'^',ifnull(`student_under_lc`,''),'^',`course_code`,'^',`course_duration`,'^',`duration_unit`,'^',`admission_fee`,'^',`tuition_fee`,'^',`total_fee`,'^',`student_name`,'^',`student_father_name`,'^',`student_mother_name`,'^',`student_spouse_name`,'^',`present_address`,'^',`permanent_address`,'^',`uidai_number`,'^',`student_dob`,'^',`mobile_number`,'^',`email_id`,'^',`academic_qualification`,'^',`occupation`,'^',`category`,'^',`gender`,'^',`rc_type`,'^',`medium`,'^',`remarks`,'^',ifnull(`student_pic`,'')) as all_data from d_students where uidai_number like'%".$_GET['sdata']."%' and record_status='A'",$conn);
        while($sr=  mysql_fetch_array($sq))
        {
            echo "<tr style='color: black; background-color: #bababa; border-radius: 2px; text-align: center'><td>".$sr['reg_num']."</td><td>".$sr['student_name']."</td><td>".$sr['uidai_number']."</td><td>".$sr['mobile_number']."</td><td><a href='".$_GET['page'].".php?regnum=".$sr["reg_num"]."&submittyp=modify'>Receipt</a></td></tr>";
        }
    }
    else if($_GET['stype']=='mob')
    {
        $sq=  mysql_query("select id,reg_num,student_name,uidai_number,mobile_number,concat(`id`,'^',`reg_num`,'^',`reg_date`,'^',ifnull(`student_under_lc`,''),'^',`course_code`,'^',`course_duration`,'^',`duration_unit`,'^',`admission_fee`,'^',`tuition_fee`,'^',`total_fee`,'^',`student_name`,'^',`student_father_name`,'^',`student_mother_name`,'^',`student_spouse_name`,'^',`present_address`,'^',`permanent_address`,'^',`uidai_number`,'^',`student_dob`,'^',`mobile_number`,'^',`email_id`,'^',`academic_qualification`,'^',`occupation`,'^',`category`,'^',`gender`,'^',`rc_type`,'^',`medium`,'^',`remarks`,'^',ifnull(`student_pic`,'')) as all_data from d_students where mobile_number like'%".$_GET['sdata']."%' and record_status='A'",$conn);
        while($sr=  mysql_fetch_array($sq))
        {
            echo '<tr style="color: black; background-color: #bababa; border-radius: 2px; text-align: center"><td>'.$sr["reg_num"].'</td><td>'.$sr["student_name"].'</td><td>'.$sr["uidai_number"].'</td><td>'.$sr["mobile_number"].'</td><td><a href="'.$_GET['page'].'.php?regnum='.$sr["reg_num"].'&submittyp=modify">Select</a></td></tr>';
        }
    }
    */
    
    echo "</table></div>";
}

