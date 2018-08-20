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
        <link rel="stylesheet" href="../css/jquery.datetimepicker.css">
        
        
        <script type="text/javascript" src="../js/jquery-latest.js"></script>
        <script type="text/javascript" src="../js/jquery.datetimepicker.full.js"></script>
        
    
            
           
            
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
                if(isset($_POST['staffuserid']) && $_POST['staffuserid']!="")
                {
                    $chksuidq=  mysql_query("select count(*) as suc from d_user_password where user_id='".$_POST['staffuserid']."' and record_status='A'",$conn);
                    $chksuidr=  mysql_fetch_array($chksuidq);
                    if($chksuidr['suc']>=1)
                    {
                        echo "<script>alert('User ID Already Exists')</script>";
                    }
                    else
                    {
                        if($_POST['staffpassword']==$_POST['staffpassword1'])
                        {
                            $getscdq=  mysql_query("select get_staff_id() as sid",$conn);
                            $getscdr=  mysql_fetch_array($getscdq);
                            $newstaffq=  mysql_query("insert into d_staffs(staff_id, staff_name,"
                                    . "staff_address,staff_dob,"
                                    . "staff_mobile,staff_email,"
                                    . "staff_under_lc,created_on,record_status) values('"
                                    . $getscdr['sid']."','".$_POST['staffname']."','"
                                    . $_POST['staffaddress']."','".$_POST['staffdob']."','"
                                    . $_POST['staffphone']."','".$_POST['staffemail']."','"
                                    . $_POST['underlc']."',now(),'A')",$conn);
                            
                            $staffuidq= mysql_query("insert into d_user_password(staff_id,user_id,passwd,created_on,record_status) values('"
                                    . $getscdr['sid']."','".$_POST['staffuserid']."',md5('".$_POST['staffpassword']."'),now(),'A')",$conn);
                            
                            
                            
                            $staffroleq=  mysql_query("insert into d_user_roles(staff_id,role_code,record_status,created_on) value('"
                                    . $getscdr['sid']."','".$_POST['staffrole']."','A',now())",$conn);
                        if($newstaffq && $staffuidq && $staffroleq)
                        {
                            echo "<script>alert('Staff Registered Successfully with Staff ID: ". $getscdr['sid']."')</script>";
                        }
                        else
                        {
                            echo "<script>alert('Something Went Wrong while Registering Staff')</script>";
                        }
                        }
                    
                        else
                        {
                            echo "<script>alert('Password Not Confiremed')</script>";
                        }}
                }
                else
                {
                    echo "<script>alert('Please Enter Staff Details')</script>";
                }
            }
        
            function mdfy()
            {
                include '../config.php';
                
               
                
                $staffupdateq=  mysql_query("update d_staffs"
                        . " set staff_name='".$_POST['staffname']."',"
                        . "staff_address='".$_POST['staffaddress']."',"
                        . "staff_dob='".$_POST['staffdob']."',"
                        . "staff_mobile='".$_POST['staffphone']."',"
                        . "staff_email='".$_POST['staffemail']."',"
                        . "staff_under_lc='".$_POST['underlc']."',updated_on=now() where staff_id='".$_POST['staffid']."'", $conn);
                
                
                
                
                
                $staffroleupdateq=mysql_query("update d_user_roles set role_code='".$_POST['staffrole']."',updated_on=now()"
                        . " where staff_id='".$_POST['staffid']."' and record_status='A'",$conn);
               
                if($staffupdateq && $staffroleupdateq)
                {
                if($_POST['staffpassword']==$_POST['staffpassword1'] && $_POST['staffpassword1']!="")
                {
                    $staffpasswdupdateq=  mysql_query("update d_user_password set passwd=md5('".$_POST['staffpassword']."') "
                            . "where record_status='A' and staff_id='".$_POST['staffid']."'",$conn);
                    if($staffpasswdupdateq)
                    {echo "<script>alert('Staff Record and login password Updated Successfully')</script>";}
                     else {
                         echo "<script>alert('Something Went wrong while updating login password')</script>";
                     }
                }
                
                else {
                         echo "<script>alert('Staff record updated without but without Password')</script>";
                     }
                }
                else 
                {
                    echo "<script>alert('Something Went Wrong')</script>";
                }
               
            }
        
        ?>
        
        
        <span style="font-family: 'calibri'; color:#bdbdbd; font-size: 50px">Staffs</span><br>
    <center>
        <div class="bodytext" style="border:1px solid #dddddd;border-radius:5px">
            <form name="lc" action="staffs.php" method="post">
            <table cellspacin="0" cellpadding="5" border="0">
                <tr>
                    <td>Staff ID</td>
                    <td><input type="text" class="txtbx" name="staffid" id="staffid" readonly="true" disabled="true"></td>
                    <td>Staff Name</td>
                    <td><input type="text" class="txtbx" name="staffname" id="staffname"></td>
                </tr>
                <tr>
                    <td>Staff Address</td>
                    <td><input type="text" class="txtbx" name="staffaddress" id="staffaddress"></td>
                    <td>Staff DOB</td>
                    <td><input type="text" class="txtbx" name="staffdob" id="staffdob"></td>
                </tr>
                <tr>
                    <td>Staff Phone Number</td>
                    <td><input type="text" class="txtbx" name="staffphone" id="staffphone"></td>
                    <td>Staff Email Address</td>
                    <td><input type="text" class="txtbx" name="staffemail" id="staffemail"></td>
                </tr>
                <tr>
                    <td>Staff Under LC</td>
                    <td>
                        <select name='underlc' id='underlc' class='txtbx'>
                            <?php
                            $lcq=mysql_query("select lc_id,lc_name from d_learning_center where record_status='A'",$conn);
                            while($lcr=  mysql_fetch_array($lcq))
                            {
                                echo "<option value='".$lcr['lc_id']."'>".$lcr['lc_name']."</option>";
                            }
                            
                            ?>
                            
                            
                        </select> 
                        
                        
                        
                    </td>
                    <td>Login User ID</td>
                    <td><input type="text" class="txtbx" name="staffuserid" id="staffuserid"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" class="txtbx" name="staffpassword" id="staffpassword"></td>
                    <td>Confirm Password</td>
                    <td><input type="password" class="txtbx" name="staffpassword1" id="staffpassword1"></td>
                </tr>
                <tr>
                    <td>Staff Role</td>
                    <td>
                    
                    <select name='staffrole' id='staffrole' class='txtbx'>
                            <?php
                            $roleq=mysql_query("select role_code,role from m_roles where record_status='A'",$conn);
                            while($roler=  mysql_fetch_array($roleq))
                            {
                                echo "<option value='".$roler['role_code']."'>".$roler['role']."</option>";
                            }
                            
                            ?>
                            
                            
                        </select> 
                    
                    
                    </td>
                    <td colspan="2" align="center">
                        <input type="hidden" name="submittyp" id="submittyp" value="new">
                        <input type="submit" class="btn" value="Submit" id="submitbtn">
                        
                    </td>
                </tr>
                
            </table></form>
            
            
            
             <?php
        
        if(isset($_GET['editstaffid']) && $_GET['editstaffid']!="")
        {
            $staffinfoq=  mysql_query("select d_staffs.staff_id,"
                    . "d_staffs.staff_name,d_staffs.staff_mobile,"
                    . "d_staffs.staff_email,d_staffs.staff_dob,"
                    . "d_staffs.staff_under_lc,d_staffs.staff_address,"
                    . "(select role_code from d_user_roles where d_user_roles.staff_id=d_staffs.staff_id and record_status='A') as role_cd,"
                    . "(select d_user_password.user_id from d_user_password where d_user_password.staff_id=d_staffs.staff_id and record_status='A') as uid,"
                    . "d_staffs.record_status from d_staffs where d_staffs.staff_id='".$_GET['editstaffid']."'",$conn);
            $staffinfor=  mysql_fetch_array($staffinfoq);
         ?>
        <script type="text/javascript">
            document.getElementById('submitbtn').value="Modify";
            document.getElementById('submittyp').value="modify";
            document.getElementById('staffid').value='<?php echo $staffinfor['staff_id'] ?>';
            document.getElementById('staffid').disabled=false;
            document.getElementById('staffname').value='<?php echo $staffinfor['staff_name'] ?>';
            document.getElementById('staffaddress').value='<?php echo $staffinfor['staff_address'] ?>';
            document.getElementById('staffdob').value='<?php echo $staffinfor['staff_dob'] ?>';
            document.getElementById('staffphone').value='<?php echo $staffinfor['staff_mobile'] ?>';
            document.getElementById('staffemail').value='<?php echo $staffinfor['staff_email'] ?>';
            document.getElementById('underlc').value='<?php echo $staffinfor['staff_under_lc'] ?>';
            document.getElementById('staffuserid').value='<?php echo $staffinfor['uid'] ?>';
            document.getElementById('staffuserid').readonly=true;
            document.getElementById('staffpassword').placeholder='Unchanged';
            document.getElementById('staffpassword1').placeholder='Unchanged';
            document.getElementById('staffrole').value='<?php echo $staffinfor['role_cd'] ?>';
        </script>
        <?php
        }
       
        if(isset($_GET['staffid']))
        {
            if($_GET['staffstatus']=='B')
            {
                
                $lcstatusq=  mysql_query("update d_staffs set record_status='B' where staff_id='".$_GET['staffid']."'",$conn);
                $staffpasswdstatus=mysql_query("update d_user_password set record_status='D' where staff_id='".$_GET['staffid']."' and record_status='A'",$conn);
                if($lcstatusq && $staffpasswdstatus)
                {
                    echo "<script>alert('Staff Blocked Successfully')</script>";
                }
            }
            
            
            else if($_GET['staffstatus']=='A')
            {
                $lcstatusq=  mysql_query("update d_staffs set record_status='A' where staff_id='".$_GET['staffid']."'",$conn);
                $staffpasswdstatus=mysql_query("update d_user_password set record_status='A' where staff_id='".$_GET['staffid']."' and record_status='D'",$conn);
                if($lcstatusq && $staffpasswdstatus)
                {
                    echo "<script>alert('Staff Activated Successfully')</script>";
                }
            }
        }
        
        ?>
            
            
            
        </div>
        <br>
        <div class="bodytext">
                <table border="0" cellspacing="1" cellpadding="3">
            <tr style="color: white; background-color: #1b7b95; border-radius: 2px; text-align: center">
                <th>Staff Code</th>
                <th>Staff Name</th>
                <th>Contact Number</th>
                <th>Email Address</th>
                <th>Login ID</th>
                <th>Under LC</th>
                <th>Edit</th>
                <th>Block</th>
            </tr>
            <?php 
            $lclistq=  mysql_query("select d_staffs.staff_id,"
                    . "d_staffs.staff_name,d_staffs.staff_mobile,"
                    . "d_staffs.staff_email,"
                    . "(select d_user_password.user_id from d_user_password where d_user_password.staff_id=d_staffs.staff_id and record_status='A') as uid,"
                    . "(select d_learning_center.lc_name from d_learning_center where d_learning_center.lc_id=d_staffs.staff_under_lc) as lc,"
                    . "d_staffs.record_status from d_staffs",$conn);
            while ($lclistr=mysql_fetch_array($lclistq))
            {
            ?>
            <tr style="color: black; background-color: #bababa; border-radius: 2px; text-align: center">
                <td><?php echo $lclistr['staff_id']?></td>
                <td><?php echo $lclistr['staff_name']?></td>
                <td><?php echo $lclistr['staff_mobile']?></td>
                <td><?php echo $lclistr['staff_email']?></td>
                <td><?php echo $lclistr['uid']?></td>
                <td><?php echo $lclistr['lc']?></td>
                <td><a href="staffs.php?editstaffid=<?php echo $lclistr['staff_id']?>">Edit</a></td>
                <td><?php 
                if($lclistr['record_status']=='A')
                {echo "<a href='staffs.php?staffstatus=B&staffid=".$lclistr['staff_id']."'>Block</a>";}
                else if($lclistr['record_status']=='B')
                {echo "<a href='staffs.php?staffstatus=A&staffid=".$lclistr['staff_id']."'>Activate</a>";}
                        
                        ?></td>
            </tr>
            <?php } ?>
        </table>
            </div>
    </center>
    </body>
    
    
    
    <script type="text/javascript">
    $('#staffdob').datetimepicker({
    dayOfWeekStart : 1,
    lang:'en',
    step:5,
    format: 'Y-m-d',
    timepicker: false,
    closeOnDateSelect: true,
    });</script>
</html>
