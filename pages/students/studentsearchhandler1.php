<?php
include_once 'loginChecker.php';
include '../../config.php';
if (isset($_GET['sdata']) && isset($_GET['stype']))
{
    echo "<div class='bodytext'><table cellspacing='1' cellpadding='5' border='0'><tr style='color: white; background-color: #1b7b95; border-radius: 2px; text-align: center'><th>Rrgistration Number</th><th>Name</th><th>UID</th><th>Mobile Number</th><th>Select</th></tr>";
    if($_GET['stype']=='regnum')
    {
        $sq=  mysql_query("select id,reg_num,student_name,uidai_number,mobile_number,concat(`id`,'^',`reg_num`,'^',`reg_date`,'^',ifnull(`student_under_lc`,''),'^',`course_code`,'^',`course_duration`,'^',`duration_unit`,'^',`admission_fee`,'^',`tuition_fee`,'^',`total_fee`,'^',`student_name`,'^',`student_father_name`,'^',`student_mother_name`,'^',`student_spouse_name`,'^',`present_address`,'^',`permanent_address`,'^',`uidai_number`,'^',`student_dob`,'^',`mobile_number`,'^',`email_id`,'^',`academic_qualification`,'^',`occupation`,'^',`category`,'^',`gender`,'^',`rc_type`,'^',`medium`,'^',`remarks`,'^',ifnull(`student_pic`,'')) as all_data from d_students where reg_num='".$_GET['sdata']."' and record_status='A'",$conn);
        while($sr=  mysql_fetch_array($sq))
        {
            echo "<tr style='color: black; background-color: #bababa; border-radius: 2px; text-align: center'><td>".$sr['reg_num']."</td><td>".$sr['student_name']."</td><td>".$sr['uidai_number']."</td><td>".$sr['mobile_number']."</td><td><a href='newstudent.php?id=".$sr["id"]."&submittyp=modify'>Select</a></td></tr>";
        }
    }
    else if($_GET['stype']=='sname')
    {
        $sq=  mysql_query("select id,reg_num,student_name,uidai_number,mobile_number,concat(`id`,'^',`reg_num`,'^',`reg_date`,'^',ifnull(`student_under_lc`,''),'^',`course_code`,'^',`course_duration`,'^',`duration_unit`,'^',`admission_fee`,'^',`tuition_fee`,'^',`total_fee`,'^',`student_name`,'^',`student_father_name`,'^',`student_mother_name`,'^',`student_spouse_name`,'^',`present_address`,'^',`permanent_address`,'^',`uidai_number`,'^',`student_dob`,'^',`mobile_number`,'^',`email_id`,'^',`academic_qualification`,'^',`occupation`,'^',`category`,'^',`gender`,'^',`rc_type`,'^',`medium`,'^',`remarks`,'^',ifnull(`student_pic`,'')) as all_data from d_students where student_name like'%".$_GET['sdata']."%' and record_status='A'",$conn);
        while($sr=  mysql_fetch_array($sq))
        {
            echo "<tr style='color: black; background-color: #bababa; border-radius: 2px; text-align: center'><td>".$sr['reg_num']."</td><td>".$sr['student_name']."</td><td>".$sr['uidai_number']."</td><td>".$sr['mobile_number']."</td><td><a href='newstudent.php?id=".$sr["id"]."&submittyp=modify'>Select</a></td></tr>";
        }
    }
    else if($_GET['stype']=='uid')
    {
        $sq=  mysql_query("select id,reg_num,student_name,uidai_number,mobile_number,concat(`id`,'^',`reg_num`,'^',`reg_date`,'^',ifnull(`student_under_lc`,''),'^',`course_code`,'^',`course_duration`,'^',`duration_unit`,'^',`admission_fee`,'^',`tuition_fee`,'^',`total_fee`,'^',`student_name`,'^',`student_father_name`,'^',`student_mother_name`,'^',`student_spouse_name`,'^',`present_address`,'^',`permanent_address`,'^',`uidai_number`,'^',`student_dob`,'^',`mobile_number`,'^',`email_id`,'^',`academic_qualification`,'^',`occupation`,'^',`category`,'^',`gender`,'^',`rc_type`,'^',`medium`,'^',`remarks`,'^',ifnull(`student_pic`,'')) as all_data from d_students where uidai_number like'%".$_GET['sdata']."%' and record_status='A'",$conn);
        while($sr=  mysql_fetch_array($sq))
        {
            echo "<tr style='color: black; background-color: #bababa; border-radius: 2px; text-align: center'><td>".$sr['reg_num']."</td><td>".$sr['student_name']."</td><td>".$sr['uidai_number']."</td><td>".$sr['mobile_number']."</td><td><a href='newstudent.php?id=".$sr["id"]."&submittyp=modify'>Select</a></td></tr>";
        }
    }
    else if($_GET['stype']=='mob')
    {
        $sq=  mysql_query("select id,reg_num,student_name,uidai_number,mobile_number,concat(`id`,'^',`reg_num`,'^',`reg_date`,'^',ifnull(`student_under_lc`,''),'^',`course_code`,'^',`course_duration`,'^',`duration_unit`,'^',`admission_fee`,'^',`tuition_fee`,'^',`total_fee`,'^',`student_name`,'^',`student_father_name`,'^',`student_mother_name`,'^',`student_spouse_name`,'^',`present_address`,'^',`permanent_address`,'^',`uidai_number`,'^',`student_dob`,'^',`mobile_number`,'^',`email_id`,'^',`academic_qualification`,'^',`occupation`,'^',`category`,'^',`gender`,'^',`rc_type`,'^',`medium`,'^',`remarks`,'^',ifnull(`student_pic`,'')) as all_data from d_students where mobile_number like'%".$_GET['sdata']."%' and record_status='A'",$conn);
        while($sr=  mysql_fetch_array($sq))
        {
            echo '<tr style="color: black; background-color: #bababa; border-radius: 2px; text-align: center"><td>'.$sr["reg_num"].'</td><td>'.$sr["student_name"].'</td><td>'.$sr["uidai_number"].'</td><td>'.$sr["mobile_number"].'</td><td><a href="newstudent.php?id='.$sr["id"].'&submittyp=modify">Select</a></td></tr>';
        }
    }
    
    
    echo "</table></div>";
}

