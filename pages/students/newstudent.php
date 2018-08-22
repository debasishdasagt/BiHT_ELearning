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
            
            function getcourse()
            {
                document.getElementById('cdtxt').innerHTML="Please Wait......";
                var a= document.getElementById('sccd').value;
                $.get('getcourse.php?ccd='+a,function(data,status)
                {
                var str=data.split("^");
                document.getElementById('cdtxt').innerHTML=str[0];
                document.getElementById('scduration').value=str[1];
                document.getElementById('scdurationunit').value=str[2];
                document.getElementById('sctfee').value=str[4];
                document.getElementById('scafee').value=str[3];
                document.getElementById('sctotalfee').value=str[5];
                });
            }
            
            function preperadd()
            {
                if(document.getElementById('prepersame').checked)
                {
                    document.getElementById('speradd').value=document.getElementById('spreadd').value;
                }
                else
                {
                   document.getElementById('speradd').value=""; 
                }
            
    }
            
            function savestudent()
            {
                document.getElementById('ssubmitbtn').innerHTML="<img src='../../images/loading2.gif' width=13 height=13> Saving...";
                $.post('savestudent.php',
                {
                    regdt: document.getElementById('sregdt').value,
                    coursecd: document.getElementById('sccd').value,
                    course_duration: document.getElementById('scduration').value,
                    duration_unit: document.getElementById('scdurationunit').value,
                    admission_fee: document.getElementById('scafee').value,
                    tuition_fee: document.getElementById('sctfee').value,
                    total_fee: document.getElementById('sctotalfee').value,
                    remarks: document.getElementById('sremarks').value,
                    student_name: document.getElementById('sname').value,
                    student_fname: document.getElementById('sfname').value,
                    student_mname: document.getElementById('smname').value,
                    student_sname: document.getElementById('ssname').value,
                    present_address: document.getElementById('spreadd').value,
                    permanent_address: document.getElementById('speradd').value,
                    uidai_number: document.getElementById('suaid').value,
                    dob: document.getElementById('sdob').value,
                    mobile_number: document.getElementById('smob').value,
                    email: document.getElementById('semail').value,
                    academic_qualification: document.getElementById('saq').value,
                    occupation: document.getElementById('soccu').value,
                    category: document.getElementById('scate').value,
                    gender: document.getElementById('sgender').value,
                    rc_type: document.getElementById('srctype').value,
                    medium: document.getElementById('smed').value
                    }, function(data,status){
                        
                        var d=data.split('^');
                        if(d[0]=='1')
                        {
                            alert('Student Saved with Registration Number: '+d[1]);
                            document.location="newstudent.php";
                        }
                        else
                        {
                            document.getElementById('ssubmitbtn').innerHTML="Submit";
                            alert('Something Went Wrong. Please Try Again');
                        }
                    }
    
    );
            }
            
            </script>
        
   
           
            
    </head>
         
    <body>
        <?php
       
        include '../../config.php';
        if($_SERVER['REQUEST_METHOD']=="POST")
        {
            if($_POST['submittyp']=='new')
            {
                submt();
            }
            else if($_POST['submittyp']=='modify')
            {
                mdfy();
            }
           
        }
        
        
        
        
        
        
        function submt()
            {
            include '../config.php';
                if(isset($_POST['ccd']) && $_POST['ccd']!="")
                {
                    
                        $newcq=  mysql_query("insert into d_courses(course_code,course_name,"
                                . "course_content,course_duration,"
                                . "duration_unit,admission_fee,"
                                . "tuition_fee,total_fee,created_on,record_status) values("
                                . "'".$_POST['ccd']."','".$_POST['cname']."',"
                                . "'".$_POST['ccontent']."','".$_POST['cduration']."',"
                                . "'".$_POST['cdurationunit']."','".$_POST['afee']."',"
                                . "'".$_POST['tfee']."','".$_POST['totalfee']."',now(),'A')",$conn);
                        
                        if($newcq)
                        {
                            echo "<script>alert('Course Saved Successfully')</script>";
                        }
                        else
                        {
                            echo "<script>alert('Something Went Wrong while Saving Course')</script>";
                        }
                    
                }
                else
                {
                    echo "<script>alert('Please Enter Course Code')</script>";
                }
            }
        
            function mdfy()
            {
                include '../config.php';
                $cupdateq=  mysql_query("update d_courses set "
                        . "course_code='".$_POST['ccd']."',course_name='".$_POST['cname']."',"
                        . "course_content='".$_POST['ccontent']."', course_duration='".$_POST['cduration']."',"
                        . "duration_unit='".$_POST['cdurationunit']."',admission_fee='".$_POST['afee']."',"
                        . "tuition_fee='".$_POST['tfee']."',total_fee='".$_POST['totalfee']."',updated_on=now() where id='".$_POST['idd']."'" , $conn);
                
                if($cupdateq)
                {
                    echo "<script>alert('Course Updated Successfully')</script>";
                }
                else
                {
                    echo "<script>alert('Something Went wrong while updating the Course')</script>";
                }
            }
        
        ?>
        
        
        <span style="font-family: 'calibri'; color:#bdbdbd; font-size: 50px">Students : <?php if(isset($_POST['submittyp']))
        {echo "Edit / Update";}
        else
           {echo "New";} ?> </span><br>
    <center>
        <div class="bodytext" style="border:1px solid #dddddd;border-radius:5px">
            <form name="lc" action="courses.php" method="post">
            <table cellspacin="0" cellpadding="5" border="0">
                <tr>
                    <td>Registration No.</td>
                    <td><input type="text" class="txtbx" name="sregno" id="sregno" disabled="yes"></td>
                    <td colspan="3" rowspan="4" align="center">
                        
                        
                        
                    </td>
                    
                </tr>
                <tr>
                    <td>Registration Date</td>
                    <td><input type="text" class="txtbx" name="sregdt" id="sregdt"></td>
                    
                </tr>
                <tr>
                    <td>Course Code</td>
                    <td>
                        
                        <select name='sccd' id='sccd' class='txtbx' style="height: 25px;"  onchange="javascript:getcourse()" selectedIndex="-1">
                        <?php
                        $courseq=  mysql_query("select course_code from d_courses where record_status='A'",$conn);
                        while ($courser=mysql_fetch_array($courseq))
                        {
                            echo "<option value='".$courser['course_code']."'>".$courser['course_code']."</option>";
                        }
                        ?>
                        </select>
                        
                        <br>
                        <div style="font-size: xx-small" id="cdtxt"></div>
                        
                    </td>
                    
                </tr>
                
                <tr>
                    <td>Course Duration</td>
                    <td><input type="text" class="txtbx" name="scduration" id="scduration" style="width:50px">
                    <input type="text" class="txtbx" name="scdurationunit" id="scdurationunit" style="width: 140px">
                    </td>
                    
                    
                </tr>
                <tr>
                    <td>Tuition Fee</td>
                    <td><input type="text" class="txtbx" name="sctfee" id="sctfee"></td>
                    <td>Admission Fee</td>
                    <td><input type="text" class="txtbx" name="scafee" id="scafee"></td>
                    
                    
                </tr>
                
                 <tr>
                    <td>Total Fee</td>
                    <td><input type="text" class="txtbx" name="sctotalfee" id="sctotalfee"></td>
                    <td>Remarks</td>
                    <td><input type="text" class="txtbx" name="sremarks" id="sremarks"></td>
                    
                </tr>
                <tr><td colspan="4"><div class="deviderline"></div></td></tr>
                <tr>
                    <td>Student Name</td>
                    <td><input type="text" class="txtbx" name="sname" id="sname"></td>
                    <td>Father's Name</td>
                    <td><input type="text" class="txtbx" name="sfname" id="sfname"></td>
                    
                </tr>
                
                 <tr>
                    <td>Mother's Name</td>
                    <td><input type="text" class="txtbx" name="smname" id="smname"></td>
                    <td>Spouse Name</td>
                    <td><input type="text" class="txtbx" name="ssname" id="ssname"></td>
                    
                </tr>
                <tr>
                    <td>Present Address</td>
                    <td colspan='3'><input type="text" class="txtbx" name="spreadd" id="spreadd" style="width: 99%"></td>
                </tr>
                <tr>
                    <td>Permanent Address</td>
                    <td colspan='3'>
                        <div style="font-size: x-small"><input type="checkbox" id="prepersame" onchange="javascript:preperadd()">Present and Permanent Address Are Same</div>
                        
                        <input type="text" class="txtbx" name="speradd" id="speradd" style="width: 99%"></td>
                </tr>
                 <tr><td colspan="4"><div class="deviderline"></div></td></tr>
                <tr>
                    <td>Aadhar Number</td>
                    <td><input type="text" class="txtbx" name="suaid" id="suaid"></td>
                    <td>Date of Birth</td>
                    <td><input type="text" class="txtbx" name="sdob" id="sdob"></td>
                </tr>
                <tr>
                    <td>Mobile Number</td>
                    <td><input type="text" class="txtbx" name="smob" id="smob"></td>
                    <td>Email ID</td>
                    <td><input type="text" class="txtbx" name="semail" id="semail"></td>
                </tr>
                <tr>
                    <td>Academic Qualification</td>
                    <td>
                        <select name='saq' id='saq' class='txtbx' style="height: 25px;">
                        <?php
                        $aqq=  mysql_query("select qualification from m_qualifications where record_status='A'",$conn);
                        while ($aqr=mysql_fetch_array($aqq))
                        {
                            echo "<option value='".$aqr['qualification']."'>".$aqr['qualification']."</option>";
                        }
                        ?>
                        </select>
                        
                        
                    </td>
                    <td>Occupation</td>
                    <td><select name='soccu' id='soccu' class='txtbx' style="height: 25px;">
                        <?php
                        $occuq=  mysql_query("select occupation from m_occupations where record_status='A'",$conn);
                        while ($occur=mysql_fetch_array($occuq))
                        {
                            echo "<option value='".$occur['occupation']."'>".$occur['occupation']."</option>";
                        }
                        ?>
                        </select></td>
                </tr>
                <tr>
                    <td>Category</td>
                    <td>
                    <select name='scate' id='scate' class='txtbx' style="height: 25px;">
                        <?php
                        $cateq=  mysql_query("select category from m_categories where record_status='A'",$conn);
                        while ($cater=mysql_fetch_array($cateq))
                        {
                            echo "<option value='".$cateur['Category']."'>".$cater['category']."</option>";
                        }
                        ?>
                        </select>
                    
                    
                    </td>
                    <td>Gender</td>
                    <td>
                        <select name='sgender' id='sgender' class='txtbx' style="height: 25px;">
                        <?php
                        $genderq=  mysql_query("select gender from m_genders where record_status='A'",$conn);
                        while ($genderr=mysql_fetch_array($genderq))
                        {
                            echo "<option value='".$genderr['gender']."'>".$genderr['gender']."</option>";
                        }
                        ?>
                        </select>
                        
                    </td>
                </tr>
                <tr>
                    <td>Ration Card Type</td>
                    <td>
                    
                     <select name='srctype' id='srctype' class='txtbx' style="height: 25px;">
                        <?php
                        $rctypeq=  mysql_query("select rc_type from m_rc_types where record_status='A'",$conn);
                        while ($rctyper=mysql_fetch_array($rctypeq))
                        {
                            echo "<option value='".$rctyper['rc_type']."'>".$rctyper['rc_type']."</option>";
                        }
                        ?>
                        </select>
                    
                    </td>
                    <td>Medium</td>
                    <td>
                        
                         <select name='smed' id='smed' class='txtbx' style="height: 25px;">
                        <?php
                        $medq=  mysql_query("select medium from m_mediums where record_status='A'",$conn);
                        while ($medr=mysql_fetch_array($medq))
                        {
                            echo "<option value='".$medr['medium']."'>".$medr['medium']."</option>";
                        }
                        ?>
                        </select>
                        
                        
                    </td>
                </tr>
                <tr>
                    <td colspan="4" align="center">
                        <input type="hidden" name='idd' id='idd' value='<?php echo $_GET['editcid'] ?>'>
                        <input type="hidden" name="submittyp" id="submittyp" value="new">
                        <div id="ssubmitbtn" class="btn" onclick="javascript:savestudent()"> Submit </div>
                        
                    </td>
                    
                </tr>
            </table></form>
            
            
            
            
            
            
            
        </div>
        <br>
        
    </center>
    </body>
    
    
<script type="text/javascript">
    $('#sregdt').datetimepicker({
    dayOfWeekStart : 1,
    lang:'en',
    step:5,
    format: 'Y-m-d',
    timepicker: false,
    closeOnDateSelect: true,
    });
$('#sdob').datetimepicker({
    dayOfWeekStart : 1,
    lang:'en',
    step:5,
    format: 'Y-m-d',
    timepicker: false,
    closeOnDateSelect: true,
    });

</script>    
   
</html>
