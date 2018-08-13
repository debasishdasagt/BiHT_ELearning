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
                if(isset($_POST['lcname']) && $_POST['lcname']!="")
                {
                    $chklcnameq=  mysql_query("select count(*) as lcc from d_learning_center where lc_name='".$_POST['lcname']."' and record_status='A'",$conn);
                    $chklcnamer=  mysql_fetch_array($chklcnameq);
                    if($chklcnamer['lcc']>=1)
                    {
                        echo "<script>alert('Learning Center Already Exists')</script>";
                    }
                    else
                    {
                        $newlcq=  mysql_query("insert into d_learning_center(lc_id,lc_name,lc_address,lc_pin_code,lc_mobile_number,lc_email,lc_start_date,record_status,record_created_on) values(get_lc_id(),'".$_POST['lcname']."','".$_POST['lcaddress']."','".$_POST['lcpincode']."','".$_POST['lcphone']."','".$_POST['lcemail']."','".$_POST['lcstart']."','A',now())",$conn);
                        if($newlcq)
                        {
                            echo "<script>alert('Learning Center Created Successfully')</script>";
                        }
                        else
                        {
                            echo "<script>alert('Something Went Wrong while Craeting Learning Center')</script>";
                        }
                    }
                }
                else
                {
                    echo "<script>alert('Please Enter Learning Center Name')</script>";
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
        
        
        <span style="font-family: 'calibri'; color:#bdbdbd; font-size: 50px">Learning Center</span><br>
    <center>
        <div class="bodytext" style="border:1px solid #dddddd;border-radius:5px">
            <form name="lc" action="learningcenter.php" method="post">
            <table cellspacin="0" cellpadding="5" border="0">
                <tr>
                    <td>LC Code</td>
                    <td><input type="text" class="txtbx" name="lccd" id="lccd" readonly="true" disabled="true"></td>
                    <td>LC Name</td>
                    <td><input type="text" class="txtbx" name="lcname" id="lcname"></td>
                </tr>
                <tr>
                    <td>LC Address</td>
                    <td><input type="text" class="txtbx" name="lcaddress" id="lcaddress"></td>
                    <td>LC PIN Code</td>
                    <td><input type="text" class="txtbx" name="lcpincode" id="lcpincode"></td>
                </tr>
                <tr>
                    <td>LC Phone Number</td>
                    <td><input type="text" class="txtbx" name="lcphone" id="lcphone"></td>
                    <td>LC Email Address</td>
                    <td><input type="text" class="txtbx" name="lcemail" id="lcmail"></td>
                </tr>
                <tr>
                    <td>LC Started On</td>
                    <td><input type="text" class="txtbx" name="lcstart" id="lcstart" id="lcstart"></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="4" align="center">
                        <input type="hidden" name="submittyp" id="submittyp" value="new">
                        <input type="submit" class="btn" value="Submit" id="submitbtn">
                        
                    </td>
                    
                </tr>
            </table></form>
            
            
            
             <?php
        
        if(isset($_GET['editlcid']) && $_GET['editlcid']!="")
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
                <th>LC Code</th>
                <th>LC Name</th>
                <th>Contact Number</th>
                <th>Email Address</th>
                <th>Edit</th>
                <th>Block</th>
            </tr>
            <?php 
            $lclistq=  mysql_query("select lc_id,lc_name,lc_mobile_number,lc_email,record_status from d_learning_center",$conn);
            while ($lclistr=mysql_fetch_array($lclistq))
            {
            ?>
            <tr style="color: black; background-color: #bababa; border-radius: 2px; text-align: center">
                <td><?php echo $lclistr['lc_id']?></td>
                <td><?php echo $lclistr['lc_name']?></td>
                <td><?php echo $lclistr['lc_mobile_number']?></td>
                <td><?php echo $lclistr['lc_email']?></td>
                <td><a href="learningcenter.php?editlcid=<?php echo $lclistr['lc_id']?>">Edit</a></td>
                <td><?php 
                if($lclistr['record_status']=='A')
                {echo "<a href='learningcenter.php?lcstatus=B&statuslcid=".$lclistr['lc_id']."'>Block</a>";}
                else if($lclistr['record_status']=='B')
                {echo "<a href='learningcenter.php?lcstatus=A&statuslcid=".$lclistr['lc_id']."'>Activate</a>";}
                        
                        ?></td>
            </tr>
            <?php } ?>
        </table>
            </div>
    </center>
    </body>
    
    
    
    <script type="text/javascript">
    $('#lcstart').datetimepicker({
    dayOfWeekStart : 1,
    lang:'en',
    step:5,
    format: 'Y-m-d',
    timepicker: false,
    closeOnDateSelect: true,
    });</script>
</html>
