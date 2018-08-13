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
    </head>
    <body>
        <?php
        include_once 'loginChecker.php';
        
        
        if($_SERVER['REQUEST_METHOD']=="POST")
        {resetpasswd();}
        
        
        
        function resetpasswd()
        {
            include_once '../config.php';
        if(!isset($_POST['oldp']) && $_POST['oldp']=="")
        {
            echo "<script> alert('Old Password not provided. Please Try again') </script>";
        }
        else
        {
            if(!isset($_POST['newp1']))
            {
                echo "<script>alert('New Password not provided. Please Try again')</script>";
            }
            else
            {
                if($_POST['newp1']!=$_POST['newp2'])
                {
                   echo "<script>alert('New Password not confirmed. Please Try again')</script>"; 
                }
                else{
                    $stfid=mysql_query("select staff_id from d_user_password where user_id='".$_SESSION['userid']."' and passwd=md5('".$_POST['oldp']."') and record_status='A'",$conn);
                    $Rstfid=  mysql_fetch_array($stfid);
                    
                    
                        
                        
                        if($Rstfid['staff_id']!="")
                        {
                            $rstpwq=mysql_query("update d_user_password set record_status='B',updated_on=now() where passwd=md5('".$_POST['oldp']."') and user_id='".$_SESSION['userid']."' and record_status='A'",$conn);
                            if($rstpwq){
                            $npwq=  mysql_query("insert into d_user_password(staff_id,user_id,passwd,record_status,created_on) values('".$Rstfid['staff_id']."','".$_SESSION['userid']."',md5('".$_POST['newp1']."'),'A',now())",$conn);
                            if(!$npwq)
                            {
                                echo "<script>alert('Something Went wrong. Please Contact to Administrator')</script>"; 
                            }
                            else
                            {
                                 echo "<script>alert('Password Updated Successfully')</script>";
                            }
                        }
                        else
                        {
                            echo "<script>alert('Old Password Incorrect')</script>";
                        }
                    }
                    else
                    {
                        echo "<script>alert('Something went Wrong. Please Try again')</script>"; 
                    }
                    
                }
            }
        }
        }
        
        
        
        ?>
        
        <span style="font-family: 'calibri'; color:#bdbdbd; font-size: 50px">Change Password</span><br>
    <center>
        <div class="bodytext" style="display: inline-block" >
            <form method="post" action="changepass.php">
        <table cellpadding="5" cellspacing="0" border="0">
            <tr>
                <td>Old Password</td><td><input type="password" class="txtbx" name="oldp"></td></tr>
                <tr><td>New Password</td><td><input type="password" class="txtbx" name="newp1"></td></tr>
                <tr><td>Confirm New Password</td><td><input type="password" class="txtbx" name="newp2"></td></tr>
                <tr><td colspan="2" align="center"><input type="submit" class="btn" value="Reset Password"></td>
            </tr>
        </table> 
            </form>
        </div>
    </center>
    </body>
</html>
