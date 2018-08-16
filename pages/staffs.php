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
                $lcupdateq=  mysql_query("update d_learning_center set lc_name='".$_POST['lcname']."',lc_address='".$_POST['lcaddress']."',lc_pin_code='".$_POST['lcpincode']."',lc_mobile_number='".$_POST['lcphone']."',lc_email='".$_POST['lcemail']."',lc_start_date='".$_POST['lcstart']."' where lc_id='".$_POST['lccd']."'", $conn);
                
                if($lcupdateq)
                {
                    echo "<script>alert('Learning Center Updated Successfully')</script>";
                }
                else
                {
                    echo "<script>alert('Something Went wrong while updating the Learning Center')</script>";
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
            $lcinfoq=  mysql_query("select lc_id,lc_name,lc_address,lc_pin_code,lc_mobile_number,lc_email,lc_start_date from d_learning_center where lc_id='".$_GET['editlcid']."'",$conn);
            $lcinfor=  mysql_fetch_array($lcinfoq);
         ?>
        <script type="text/javascript">
            document.getElementById('submitbtn').value="Modify";
            document.getElementById('submittyp').value="modify";
            document.getElementById('lccd').value='<?php echo $lcinfor['lc_id'] ?>';
            document.getElementById('lccd').disabled=false;
            document.getElementById('lcname').value='<?php echo $lcinfor['lc_name'] ?>';
            document.getElementById('lcaddress').value='<?php echo $lcinfor['lc_address'] ?>';
            document.getElementById('lcpincode').value='<?php echo $lcinfor['lc_pin_code'] ?>';
            document.getElementById('lcphone').value='<?php echo $lcinfor['lc_mobile_number'] ?>';
            document.getElementById('lcstart').value='<?php echo $lcinfor['lc_start_date'] ?>';
            document.getElementById('lcmail').value='<?php echo $lcinfor['lc_email'] ?>';
            
         </script>
        <?php
        }
       
        if(isset($_GET['statuslcid']))
        {
            if($_GET['lcstatus']=='B')
            {
                
                $lcstatusq=  mysql_query("update d_learning_center set record_status='B' where lc_id='".$_GET['statuslcid']."'",$conn);
                if($lcstatusq)
                {
                    echo "<script>alert('Learning Center Blocked Successfully')</script>";
                }
            }
            
            
            else if($_GET['lcstatus']=='A')
            {
                $lcstatusq=  mysql_query("update d_learning_center set record_status='A' where lc_id='".$_GET['statuslcid']."'",$conn);
                if($lcstatusq)
                {
                    echo "<script>alert('Learning Center Activated Successfully')</script>";
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
                <td><a href="staffs.php?editlcid=<?php echo $lclistr['staff_id']?>">Edit</a></td>
                <td><?php 
                if($lclistr['record_status']=='A')
                {echo "<a href='staffs.php?lcstatus=B&statuslcid=".$lclistr['staff_id']."'>Block</a>";}
                else if($lclistr['record_status']=='B')
                {echo "<a href='staffs.php?lcstatus=A&statuslcid=".$lclistr['staff_id']."'>Activate</a>";}
                        
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
