<?php
 include_once 'loginChecker.php';
 include '../../config.php';
 
 $getregnumq=  mysql_query("select get_student_id() as sid",$conn);
 $getregnumr=  mysql_fetch_array($getregnumq);
 
 $savestudentq=  mysql_query("INSERT INTO `d_students`
(`reg_num`,
`reg_date`,
`course_code`,
`course_duration`,
`duration_unit`,
`admission_fee`,
`tuition_fee`,
`total_fee`,
`student_name`,
`student_father_name`,
`student_mother_name`,
`student_spouse_name`,
`present_address`,
`permanent_address`,
`uidai_number`,
`student_dob`,
`mobile_number`,
`email_id`,
`academic_qualification`,
`occupation`,
`category`,
`gender`,
`rc_type`,
`medium`,
`remarks`,
`created_on`)
VALUES
('"
.$getregnumr['sid']."','"
.$_POST['regdt']."','"
.$_POST['coursecd']."','"
.$_POST['course_duration']."','"
.$_POST['duration_unit']."','"
.$_POST['admission_fee']."','"
.$_POST['tuition_fee']."','"
.$_POST['total_fee']."','"
.$_POST['student_name']."','"
.$_POST['student_fname']."','"
.$_POST['student_mname']."','"
.$_POST['student_sname']."','"
.$_POST['present_address']."','"
.$_POST['permanent_address']."','"
.$_POST['uidai_number']."','"
.$_POST['dob']."','"
.$_POST['mobile_number']."','"
.$_POST['email']."','"
.$_POST['academic_qualification']."','"
.$_POST['occupation']."','"
.$_POST['category']."','"
.$_POST['gender']."','"
.$_POST['rc_type']."','"
.$_POST['medium']."','"
.$_POST['remarks']."',now())",$conn);
 
 if($savestudentq)
 {
     echo "1^".$getregnumr['sid'];
 }?>