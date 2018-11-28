<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
include '../../config.php';
        include_once 'loginChecker.php';
        ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="../../css/style.css">
        <link rel="stylesheet" href="../../css/jquery.datetimepicker.css">
        <link rel="stylesheet" type="text/css" href="../../css/featherlight.css">
        
        <script type="text/javascript" src="../../js/jquery-latest.js"></script>
        <script type="text/javascript" src="../../js/jquery.datetimepicker.full.js"></script>
        <script type="text/javascript" src="../../js/featherlight.js" charset="utf-8"></script>
        
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
                    slc: document.getElementById('slc').value,
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
                    userid: document.getElementById('userid').value,
                    medium: document.getElementById('smed').value
                    }, function(data,status){
                        
                        var d=data.split('^');
                        if(d[0]=='1')
                        {
                            document.getElementById('regnum').value=d[1];
                            alert('Student Saved with Registration Number: '+d[1]+"\n\n Now uploading Student Picture");
                            document.getElementById('picuploader').submit();
                        }
                        else
                        {
                            document.getElementById('ssubmitbtn').innerHTML="Submit";
                            alert('Something Went Wrong. Please Try Again');
                        }
                    }
    
    );
            }
            
            
            function modifystudent()
            {
                document.getElementById('ssubmitbtn').innerHTML="<img src='../../images/loading2.gif' width=13 height=13> Modifying...";
                $.post('modifystudent.php',
                {
                    id:<?php if(isset($_GET['id'])) {echo $_GET['id'];} else{echo "''";} ?>,
                    regnum: document.getElementById('sregno').value,
                    regdt: document.getElementById('sregdt').value,
                    slc: document.getElementById('slc').value,
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
                    userid: document.getElementById('userid').value,
                    medium: document.getElementById('smed').value
                    }, function(data,status){
                        
                        var d=data;
                        if(d=='1')
                        {
                            
                            alert('Student Record Modified Successfully');
                            document.location="searchstudent.php";
                        }
                        else
                        {
                            document.getElementById('ssubmitbtn').innerHTML="Modify";
                            alert('Something Went Wrong while Modifying Student Data');
                        }
                    }
    
    );
            }
            
            
            function readURL(input){
                var ext = input.files[0]['name'].substring(input.files[0]['name'].lastIndexOf('.') + 1).toLowerCase();
               if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) 
               {var reader = new FileReader();
                   reader.onload = function (e) {
                       $('#pic').attr('src', e.target.result);
                   }

                   reader.readAsDataURL(input.files[0]);
               }else{
                    $('#pic').attr('src', '../../images/student_icon.png');
               }
              }
              
              
              
              
            </script>
        
   
           
            
    </head>
         
    <body>
        
        
        
        <span style="font-family: 'calibri'; color:#bdbdbd; font-size: 50px">Students : <?php if(isset($_GET['submittyp']))
        {echo "Edit / Update";}
        else
           {echo "New";} ?> </span><br>
    <center>
        <div class="bodytext" style="border:1px solid #dddddd;border-radius:5px">
            
            <table cellspacin="0" cellpadding="5" border="0">
                <tr>
                    <td>Registration No.</td>
                    <td><input type="text" class="txtbx" name="sregno" id="sregno" disabled="yes"></td>
                    <td colspan="3" rowspan="5" align="center">
                        
                        <form action="picuploader.php" id="picuploader" method="POST" enctype ="multipart/form-data" >
                            <img src="../../images/student_icon.png" width="100" height="120" id="pic" style="border: 5px solid #ffffff; box-shadow:1px 1px 2px #000000">
                            <br><br><input type="hidden" name="MAX_FILE_SIZE" value="3000000" /><input type="file" id="picc" name="picc" onchange="readURL(this)">
                            <input type="hidden" id="regnum" name="regnum">
                        </form>
                        
                        
                        
                    </td>
                    
                </tr>
                <tr>
                    <td>Registration Date</td>
                    <td><input type="text" class="txtbx" name="sregdt" id="sregdt"></td>
                    
                </tr>
                <tr>
                    <td>Learning Center</td>
                    <td>
                        <select id="slc" class="txtbx" style="height:25px">
                            <?php
                            $slcq=  mysql_query("select lc_id,lc_name from d_learning_center where record_status='A' and lc_id='".$_SESSION['lccd']."'",$conn);
                            while($slcr=  mysql_fetch_array($slcq))
                            {
                                echo "<option value=".$slcr['lc_id'].">".$slcr['lc_name']."</option>";
                            }
                            
                            
                            ?>
                            
                            
                            
                        </select>
                        
                        
                        
                    </td>
                    
                </tr>
                <tr>
                    <td>Course Code</td>
                    <td><?php 
        if(isset($_GET['submittyp'])&&$_GET['submittyp']=="modify")
        {
        ?>
                        <input type="text" name="sccd" id="sccd" class="txtbx">
        <?php } else { ?>
                        
                        <select name='sccd' id='sccd' class='txtbx' style="height: 25px;"  onchange="javascript:getcourse()" selectedIndex="-1">
                            <option value="">---Select---</option>
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
        <?php } ?>
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
                    <td><input type="text" class="txtbx" name="suaid" id="suaid" style="width:175px"><a onclick="this.href='studentsearchhandler.php?sdata='+document.getElementById('suaid').value+'&stype=uid'" href="" data-featherlight="ajax"><img src="../../images/find.png" style="margin-bottom: -7px;" border="0"></a></td>
                    <td>Date of Birth</td>
                    <td><input type="text" class="txtbx" name="sdob" id="sdob"></td>
                </tr>
                <tr>
                    <td>Mobile Number</td>
                    <td><input type="text" class="txtbx" name="smob" id="smob" style="width:175px"><a onclick="this.href='studentsearchhandler.php?sdata='+document.getElementById('smob').value+'&stype=mob'" href="" data-featherlight="ajax"><img src="../../images/find.png" style="margin-bottom: -7px;" border="0"></a></td>
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
                        <input type="hidden" id="userid" value="<?php echo $_SESSION['userid'];?>">
                         <?php 
        if(isset($_GET['submittyp']) && $_GET['submittyp']=="modify")
        {
        ?>
                        <div id="ssubmitbtn" class="btn" onclick="javascript:modifystudent()"> Modify </div>
        <?php } else{?>
                        <div id="ssubmitbtn" class="btn" onclick="javascript:savestudent()"> Submit </div>
                        <?php }?>
                        
                    </td>
                    
                </tr>
            </table>
            
            
            
            
            
            
            
        </div>
        <br>
        
    </center>
    </body>
    <?php
    if(isset($_GET['id'])&&$_GET['submittyp'])
    {
        $sq=  mysql_query("select `id`,`reg_num`,`reg_date`,"
                . "ifnull(`student_under_lc`,'') as lc,`course_code`,"
                . "`course_duration`,`duration_unit`,`admission_fee`,"
                . "`tuition_fee`,`total_fee`,`student_name`,"
                . "`student_father_name`,`student_mother_name`,"
                . "`student_spouse_name`,`present_address`,"
                . "`permanent_address`,`uidai_number`,`student_dob`,"
                . "`mobile_number`,`email_id`,`academic_qualification`,"
                . "`occupation`,`category`,`gender`,`rc_type`,`medium`,"
                . "`remarks`,ifnull(`student_pic`,'student_icon.png') as pic from d_students where id='".$_GET['id']."'",$conn);
        
        $sr=  mysql_fetch_array($sq);
        ?>
    <script type="text/javascript">
        <?php 
        if($_GET['submittyp']=="modify")
        {
        ?>
        document.getElementById('sregno').value='<?php echo $sr['reg_num'];?>';
        document.getElementById('sregdt').value='<?php echo $sr['reg_date'];?>';document.getElementById('slc').value='<?php echo $sr['lc'];?>';
        document.getElementById('sccd').value='<?php echo $sr['course_code'];?>';document.getElementById('scduration').value='<?php echo $sr['course_duration'];?>';
        document.getElementById('scdurationunit').value='<?php echo $sr['duration_unit'];?>';document.getElementById('sctfee').value='<?php echo $sr['tuition_fee'];?>';
        document.getElementById('scafee').value='<?php echo $sr['admission_fee'];?>';document.getElementById('sctotalfee').value='<?php echo $sr['total_fee'];?>';
        
        /* Disabling  Fields */
        document.getElementById('sregno').disabled=false;document.getElementById('sregno').readOnly=true;
        document.getElementById('sregdt').readOnly=false;document.getElementById('slc').readOnly=true;
        document.getElementById('sccd').readOnly=true;document.getElementById('scduration').readOnly=true;
        document.getElementById('scdurationunit').readOnly=true;document.getElementById('sctfee').readOnly=true;
        document.getElementById('scafee').readOnly=true;document.getElementById('sctotalfee').readOnly=true;
        <?php } ?>
        document.getElementById('sname').value='<?php echo $sr['student_name'];?>';document.getElementById('sfname').value='<?php echo $sr['student_father_name'];?>';
        document.getElementById('smname').value='<?php echo $sr['student_mother_name'];?>';document.getElementById('ssname').value='<?php echo $sr['student_spouse_name'];?>';
        document.getElementById('spreadd').value='<?php echo $sr['present_address'];?>';document.getElementById('speradd').value='<?php echo $sr['permanent_address'];?>';
        document.getElementById('suaid').value='<?php echo $sr['uidai_number'];?>';document.getElementById('sdob').value='<?php echo $sr['student_dob'];?>';
        document.getElementById('smob').value='<?php echo $sr['mobile_number'];?>';document.getElementById('semail').value='<?php echo $sr['email_id'];?>';
        document.getElementById('saq').value='<?php echo $sr['academic_qualification'];?>';document.getElementById('soccu').value='<?php echo $sr['occupation'];?>';
        document.getElementById('scate').value='<?php echo $sr['category'];?>';document.getElementById('sgender').value='<?php echo $sr['gender'];?>';
        document.getElementById('srctype').value='<?php echo $sr['rc_type'];?>';document.getElementById('smed').value='<?php echo $sr['medium'];?>';
        document.getElementById('sremarks').value=document.getElementById('sremarks').value+'Old Registration:<?php echo $sr['reg_num'];?>';
        $('#pic').attr('src', 'pics/<?php echo $sr['pic'];?>');
    </script>
    
    
    
    <?php
    }   
    ?>
    
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
<?php if(isset($_GET['info']))
{
    echo "alert('".$_GET['info']."')";
}
?>
</script>    
   
</html>
