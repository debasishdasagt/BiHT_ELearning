<?php
 include_once 'loginChecker.php';
 include '../../config.php';
 

 
 $savestudentq=  mysql_query("UPDATE `d_students`
set `reg_num`='". $_POST['regnum']."',
`reg_date`='". $_POST['regdt']."',
`student_under_lc`='". $_POST['slc']."',
`course_code`='". $_POST['coursecd']."',
`course_duration`='". $_POST['course_duration']."',
`duration_unit`='". $_POST['duration_unit']."',
`admission_fee`='". $_POST['admission_fee']."',
`tuition_fee`='". $_POST['tuition_fee']."',
`total_fee`='". $_POST['total_fee']."',
`student_name`='". $_POST['student_name']."',
`student_father_name`='". $_POST['student_fname']."',
`student_mother_name`='". $_POST['student_mname']."',
`student_spouse_name`='". $_POST['student_sname']."',
`present_address`='". $_POST['present_address']."',
`permanent_address`='". $_POST['permanent_address']."',
`uidai_number`='". $_POST['uidai_number']."',
`student_dob`='". $_POST['dob']."',
`mobile_number`='". $_POST['mobile_number']."',
`email_id`='". $_POST['email']."',
`academic_qualification`='". $_POST['academic_qualification']."',
`occupation`='". $_POST['occupation']."',
`category`='". $_POST['category']."',
`gender`='". $_POST['gender']."',
`rc_type`='". $_POST['rc_type']."',
`medium`='". $_POST['medium']."',
`remarks`='". $_POST['remarks']."',
`updated_on`=now() where id='".$_POST['id']."'",$conn);
 
 if($savestudentq)
 {
     echo "1";
 }
 else
 {
     echo "0";
 }
 ?>