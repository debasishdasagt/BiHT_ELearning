<?php
include_once 'loginChecker.php';
include '../../config.php';
if(isset($_GET['ccd']))
{
    $getcourseq=mysql_query("select course_name,course_duration,duration_unit,admission_fee,tuition_fee,total_fee from d_courses where record_status='A' and course_code='".$_GET['ccd']."' limit 1",$conn);
    $getcourser=  mysql_fetch_array($getcourseq);
    echo $getcourser['course_name']."^".$getcourser['course_duration']."^".$getcourser['duration_unit']."^".$getcourser['admission_fee']."^".$getcourser['tuition_fee']."^".$getcourser['total_fee'];
}
else
{
    echo "Something Went Wrong";
}
?>
