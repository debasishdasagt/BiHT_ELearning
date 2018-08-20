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
        <link rel="stylesheet" href="../css/style.css">
       
        
        
        
        
        
        <script type="text/javascript">
            function calfee()
            {
                if(document.getElementById('cdurationunit').value === 'month')
                {
                    var a,b,c,r;
                    a=parseFloat(document.getElementById('afee').value);
                   
                    b=parseFloat(document.getElementById('tfee').value);
             
                    c=parseFloat(document.getElementById('cduration').value);
               
                    document.getElementById('totalfee').value=(c*b)+a;
                }
            }
            </script>
            
           
            
    </head>
         
    <body>
        <?php
       include_once 'loginChecker.php';
        include '../config.php';
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
        
        
        <span style="font-family: 'calibri'; color:#bdbdbd; font-size: 50px">Courses</span><br>
    <center>
        <div class="bodytext" style="border:1px solid #dddddd;border-radius:5px">
            <form name="lc" action="courses.php" method="post">
            <table cellspacin="0" cellpadding="5" border="0">
                <tr>
                    <td>Course Code</td>
                    <td><input type="text" class="txtbx" name="ccd" id="ccd"></td>
                    <td>Course Name</td>
                    <td><input type="text" class="txtbx" name="cname" id="cname"></td>
                </tr>
                <tr>
                    <td>Course Content</td>
                    <td><input type="text" class="txtbx" name="ccontent" id="ccontent" placeholder="Separated By Coma (,)"></td>
                    <td>Course Duration</td>
                    <td><input type="text" class="txtbx" name="cduration" id="cduration" onblur="javascript:calfee()"></td>
                </tr>
                <tr>
                    <td>Duration Unit</td>
                    <td><select class="txtbx" name="cdurationunit" id="cdurationunit" onchange="javascript:calfee()">
                            <option value="hour">Hours</option>
                            <option value="month">Months</option>
                        </select>
                    </td>
                    <td>Admission Fee</td>
                    <td><input type="text" class="txtbx" name="afee" id="afee" onblur="javascript:calfee()" ></td>
                </tr>
                <tr>
                    <td>Tuition Fee</td>
                    <td><input type="text" class="txtbx" name="tfee" id="tfee" onblur="javascript:calfee()"></td>
                    <td>Total Fee</td>
                    <td><input type="text" class="txtbx" name="totalfee" id="totalfee"></td>
                </tr>
                <tr>
                    <td colspan="4" align="center">
                        <input type="hidden" name='idd' id='idd' value='<?php echo $_GET['editcid'] ?>'>
                        <input type="hidden" name="submittyp" id="submittyp" value="new">
                        <input type="submit" class="btn" value="Submit" id="submitbtn">
                        
                    </td>
                    
                </tr>
            </table></form>
            
            
            
             <?php
        
        if(isset($_GET['editcid']) && $_GET['editcid']!="")
        {
            $cinfoq=  mysql_query("select course_code, course_name,"
                    . "course_code,course_duration,duration_unit,admission_fee,tuition_fee,"
                    . "total_fee,course_content from d_courses where id='".$_GET['editcid']."'",$conn);
            $cinfor=  mysql_fetch_array($cinfoq);
         ?>
        <script type="text/javascript">
            document.getElementById('submitbtn').value="Modify";
            document.getElementById('submittyp').value="modify";
            document.getElementById('ccd').value='<?php echo $cinfor['course_code'] ?>';
            document.getElementById('ccd').disabled=false;
            document.getElementById('cname').value='<?php echo $cinfor['course_name'] ?>';
            document.getElementById('ccontent').value='<?php echo $cinfor['course_content'] ?>';
            document.getElementById('cduration').value='<?php echo $cinfor['course_duration'] ?>';
            document.getElementById('cdurationunit').value='<?php echo $cinfor['duration_unit'] ?>';
            document.getElementById('afee').value='<?php echo $cinfor['admission_fee'] ?>';
            document.getElementById('tfee').value='<?php echo $cinfor['tuition_fee'] ?>';
            document.getElementById('totalfee').value='<?php echo $cinfor['total_fee'] ?>';
         </script>
        <?php
        }
       
        if(isset($_GET['statuscid']))
        {
            if($_GET['cstatus']=='B')
            {
                
                $cstatusq=  mysql_query("update d_courses set record_status='B' where id='".$_GET['statuscid']."'",$conn);
                if($cstatusq)
                {
                    echo "<script>alert('Course Blocked Successfully')</script>";
                }
            }
            
            
            else if($_GET['cstatus']=='A')
            {
                $cstatusq=  mysql_query("update d_courses set record_status='A' where id='".$_GET['statuscid']."'",$conn);
                if($cstatusq)
                {
                    echo "<script>alert('Course Activated Successfully')</script>";
                }
            }
        }
        
        ?>
            
            
            
        </div>
        <br>
        <div class="bodytext">
        <table border="0" cellspacing="1" cellpadding="3">
            <tr style="color: white; background-color: #1b7b95; border-radius: 2px; text-align: center">
                <th>Course Code</th>
                <th>Course Name</th>
                <th>Duration</th>
                <th>Total Fee</th>
                <th>View / Edit</th>
                <th>Block</th>
            </tr>
            <?php 
            $clistq=  mysql_query("select course_code,course_name,course_duration,duration_unit,total_fee,record_status,id from d_courses",$conn);
            while ($clistr=mysql_fetch_array($clistq))
            {
            ?>
            <tr style="color: black; background-color: #bababa; border-radius: 2px; text-align: center">
                <td><?php echo $clistr['course_code']?></td>
                <td><?php echo $clistr['course_name']?></td>
                <td><?php echo $clistr['course_duration']." ".$clistr['duration_unit']?></td>
                <td><?php echo $clistr['total_fee']?></td>
                <td><a href="courses.php?editcid=<?php echo $clistr['id']?>">View/Edit</a></td>
                <td><?php 
                if($clistr['record_status']=='A')
                {echo "<a href='courses.php?cstatus=B&statuscid=".$clistr['id']."'>Block</a>";}
                else if($clistr['record_status']=='B')
                {echo "<a href='courses.php?cstatus=A&statuscid=".$clistr['id']."'>Activate</a>";}
                        
                        ?></td>
            </tr>
            <?php } ?>
        </table>
            </div>
    </center>
    </body>
    
    
    
   
</html>
