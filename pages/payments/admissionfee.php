<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="../../css/style.css">
        <link rel="stylesheet" href="../../css/jquery.datetimepicker.css">
        
        <script type="text/javascript" src="../../js/jquery-latest.js"></script>
        <script type="text/javascript" src="../../js/jquery.datetimepicker.full.js"></script>
        <script type="text/javascript">
            function searchstudent()
            {
                var ssdata=document.getElementById('searchbox').value;
                var type,result;
                if(document.getElementById('regnum').checked)
                {
                    type='regnum';
                }
                else if(document.getElementById('sname').checked)
                {
                    type='sname';
                }
                else if(document.getElementById('uid').checked)
                {
                    type='uid';
                }
                else if(document.getElementById('mob').checked)
                {
                    type='mob';
                }
                
                if(ssdata=="")
                {
                    alert("Please Enter Something");
                }
                else
                {
                    $.get('studentsearchhandler.php',
                    {
                        sdata: ssdata,
                        stype: type,
                        page: 'admissionfee'
                    },
                    function(data,status)
                    {
                        document.getElementById('result').innerHTML=data;
                    });
                }
            }
            
            function sbmt()
            {
                if(confirm("Do you realy want to submit this?"))
                {
                    document.getElementById('rcptsbmt').submit();
                }
            }
            </script>
    </head>
    <?php
    include '../../config.php';
    include_once 'loginChecker.php';
   
    if($_SERVER['REQUEST_METHOD']=="POST")
    {
        
         $chkrcpt=  mysql_query("select count(*) as c from d_fee_payments where student_reg_num='".$_POST['regn']."' and fee_type='admission' and record_status='A'",$conn);
    $chkrcptr=  mysql_fetch_array($chkrcpt);
    if($chkrcptr['c']<=0){
        $ridq=  mysql_query("select get_Arcpt_id() as rid",$conn);
    $ridr=  mysql_fetch_array($ridq);
    
        $rq="INSERT INTO `d_fee_payments`
(`rcpt_id`,`student_reg_num`,`student_name`,`student_father_name`,`learning_center`,`course_code`,`course_name`,
`admission_fee`,`fee_paid`,`fee_type`,`payment_date`,`next_installment`,
`class_start_on`,`course_duration`,`duration_unit`,`created_by`,
`record_status`,`created_on`)
VALUES
('".$ridr['rid']."','".$_POST['regn']."','".$_POST['sn']."','".$_POST['sfn']."','".$_POST['lc']."','".$_POST['ccd']."','".$_POST['cname']."','".
$_POST['admission_fee']."','".$_POST['fee_paid']."','admission','".$_POST['payment_date']."','".$_POST['nextinst']."','".
 $_POST['classstart']."','".$_POST['c_duration']."','".$_POST['duration_unit']."','".$_SESSION['userid']."','".
 "A',now())";
        
        $rqq=  mysql_query($rq,$conn);
        
        if($rqq)
        {
            header("location:admissionfee.php?info=Receipt Saved Sucessfully&rcptnum=".$ridr['rid']);
        }
 else {header("location:admissionfee.php?info=Something Went Wrong while submitting");}
 }
    else
    {
        header("location:admissionfee.php?info=Admission Fee Already Paid for this Student");
    }
    }
    ?>
    
    
    <body>
        
       <span style="font-family: 'calibri'; color:#bdbdbd; font-size: 50px">Admission Fee Payment </span> 
    <center>
        <div class="bodytext">
        <br><br>
        <form action="javascript:searchstudent()">
            <table border="0" celspacind="0" cellpadding="0" width="70%">
                <tr>
                    <td align="right"><input type="text" style="border: 1px #6666ff solid; border-radius: 13px 0px 0px 13px; width:500px; padding-left: 10px; height:25px" name="searchbox" id="searchbox"></td>
                    <td align="left"><input type="submit" value="Search" style="border: 1px #6666ff solid; border-radius: 0px 13px 13px 0px; width:100px; height:29px; background-color: #6666ff; margin: 0px;color: #ffffff; cursor: pointer"></td>
                </tr>
                <tr><td align="center" colspan="0"><input type="radio" name="susing" value="regnum" checked="true" id="regnum">By Registration Number &nbsp; 
                        <input type="radio" name="susing" value="sname" id="sname">By Name &nbsp; 
                        <input type="radio" name="susing" value="uid" id="uid">By UID &nbsp; 
                        <input type="radio" name="susing" value="mob" id="mob">By Mobile Number</td></tr>
            </table>
        </form>
        </div>
        <br><br>
        
        <div id="result"></div>
        <br><br>
        <div class="bodytext" style="border:1px solid #dddddd;border-radius:5px">
            <form id="rcptsbmt" method="post" >
            <table cellspacing="0" cellpadding="5" border="0">
                <tr>
                    <td>Registration Number</td><td><input type="text" class="txtbx" id="regn" name="regn"></td>
                    <td>Student Name</td><td><input type="text" class="txtbx" id="sn" name="sn"></td>
                </tr>
                <tr>
                    <td>Father Name</td><td><input type="text" class="txtbx" id="sfn" name="sfn"></td>
                    <td>Learning Center</td><td><input type="text" class="txtbx" id="lc" name="lc"></td>
                </tr>
                <tr>
                    <td>Course Name</td><td><input type="text" class="txtbx" id="cname" name="cname"><input type="hidden" id="ccd" name="ccd"></td>
                    <td>Course Duration</td><td><input type="text" class="txtbx" id="c_full_duration" name="c_full_duration"><input type="hidden" id="c_duration" name="c_duration"><input type="hidden" id="duration_unit" name="duration_unit"></td>
                </tr>
                <tr>
                    <td>Admission Fee</td><td><input type="text" class="txtbx" id="fee_paid" name="fee_paid"><input type="hidden" id="admission_fee" name="admission_fee"></td>
                    <td>Payment Date</td><td><input type="text" class="txtbx" id="payment_date" name="payment_date"></td>
                    
                </tr>
                <tr>
                    <td>Next Installment Date</td><td><input type="text" class="txtbx" id="nextinst" name="nextinst"></td>
                    <td>Class Starts On</td><td><input type="text" class="txtbx" id="classstart" name="classstart"></td>
                    
                </tr>
                <tr><td colspan="4" align="center"><div id="sbtn" class="btn" onclick="javascript:sbmt()">Submit</div></td></tr>
            </table>
            </form>
        </div>
        
    </center>
        
    </body>
    
    <?php
        if(isset($_GET['regnum']))
    {
    $pq=  mysql_query("SELECT `id`,
    `reg_num`,`reg_date`,`student_under_lc`,`course_code`,get_course_name(course_code) as course_name,
    `course_duration`,`duration_unit`,`admission_fee`,`tuition_fee`,get_lc_name(`student_under_lc`) as lc_name,
    `total_fee`,`student_name`,`student_father_name`
FROM `d_students` where record_status='A' and reg_num=".$_GET['regnum'],$conn);
    $pr=  mysql_fetch_array($pq);
    ?>
    <script type="text/javascript">
        document.getElementById('regn').value="<?php echo $pr['reg_num']?>";
        document.getElementById('sn').value="<?php echo $pr['student_name']?>";
        document.getElementById('sfn').value="<?php echo $pr['student_father_name']?>";
        document.getElementById('lc').value="<?php echo $pr['lc_name'] ?>";
        document.getElementById('cname').value="<?php echo $pr['course_name']?>";
        document.getElementById('ccd').value="<?php echo $pr['course_code']?>";
        document.getElementById('c_full_duration').value="<?php echo $pr['course_duration'].' '.$pr['duration_unit'].'(s)'?>";
        document.getElementById('c_duration').value="<?php echo $pr['course_duration']?>";
        document.getElementById('duration_unit').value="<?php echo $pr['duration_unit']?>";
        document.getElementById('fee_paid').value="<?php echo $pr['admission_fee']?>";
        document.getElementById('admission_fee').value="<?php echo $pr['admission_fee']?>";
        document.getElementById('payment_date').value="<?php echo $pr['reg_date']?>";
        document.getElementById('regnum').value="ggg";
        </script>
    <?php
    }    
        if(isset($_GET['info']))
{
    echo "<script>alert('".$_GET['info']."')</script>";
}


if(isset($_GET['rcptnum']))
{
    ?>
        <script>
        if(confirm('Do You want to Generate PDF receipt: <?php echo $_GET['rcptnum'];?>?'))
        {
            document.location="arcptprint.php?rcptnum=<?php echo $_GET['rcptnum'];?>";
        }
        </script>
        
        <?php
}
?>
        <script type="text/javascript">
             $('#payment_date').datetimepicker({
                dayOfWeekStart : 1,
                lang:'en',
                step:5,
                format: 'Y-m-d',
                timepicker: false,
                closeOnDateSelect: true,
                });
                
               $('#nextinst').datetimepicker({
                dayOfWeekStart : 1,
                lang:'en',
                step:5,
                format: 'Y-m-d',
                timepicker: false,
                closeOnDateSelect: true,
                });
                
               $('#classstart').datetimepicker({
                dayOfWeekStart : 1,
                lang:'en',
                step:5,
                format: 'Y-m-d',
                timepicker: false,
                closeOnDateSelect: true,
                });
            </script>
    
</html>
