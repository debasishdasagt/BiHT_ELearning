<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php 
include_once 'config.php';
session_start();
if(!isset($_SESSION['userid']))
{
    header("location: ./");
} ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>BIHT E-Learning</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/efluidmenu.css" />
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/efluidmenu.js">

/***********************************************
* eFluid Menu script (c) Dynamic Drive (www.dynamicdrive.com)
* Please keep this notice intact
* Visit http://www.dynamicdrive.com/ for this script and 100s more.
***********************************************/

</script>
        
        <script type="text/javascript">
                var wheight,wwidth;
                $(document).ready(function()
                {    wwidth=$(document).width();

                    wheight=$(document).height();
                });



                $(document).ready(function()
                {
                   $('#maincontainer').css("height",Math.round(wheight*0.90)+"px");
                   $('#maincontainer').css("width",Math.round(wwidth*0.7)+"px");
                   $('#maincontainer').css("margin-left","-"+Math.round((wwidth*0.7)/2)+"px");
                   $('#maincontainer').css("margin-top","-"+Math.round((wheight*0.9)/2)+"px");
                });

</script>
    </head>
    <body style=" margin: 0px; background-color: #a2a2a2">
    <center>
        <div id="head_r">
            
            <table width="70%" border="0">
                <tr>
                    <td valign="bottom" width="30%"><img src="images/biht_elearning_logo.png" class="logo"></td>
                   
                    <td valign="top" width="70%">
                      <div id="fluidmenu1" class="efluidmenu">  
                          <a class="efluid-animateddrawer" href="#">
<span></span>
</a>
                        <ul>
<?php
$getusernamequery=  mysql_query("select staff_name from d_staffs where staff_id=(select staff_id from d_user_password where user_id='".$_SESSION['userid']."' and record_status='A' ) and record_status='A' limit 1",$conn);
$Ruserid=  mysql_fetch_array($getusernamequery);
if($_SESSION['rolecode']==1)
{
?>
<li><a>Administration</a>
<ul>
  <li><a href="pages/learningcenter.php" target="form_frame">Learning Center</a></li>
  <li><a href="pages/staffs.php" target="form_frame">Staffs</a></li>
  <li><a href="pages/courses.php" target="form_frame">Courses</a></li>
 </ul></li>
<?php } ?>
<li><a>Students</a>
<ul>
    <li><a href="pages/students/newstudent.php" target="form_frame">New Student</a></li>
    <li><a href="pages/students/searchstudent.php" target="form_frame">Search Student</a></li>
    <?php if($_SESSION['rolecode']==1)
{
?>
    <li><a href="pages/export_student.php" target="form_frame">Export Student Data</a></li>
<?php } ?>
 </ul></li>
 
 <li><a>Payment</a>
<ul>
    <li><a href="pages/payments/admissionfee.php" target="form_frame">Admission Fee</a></li>
    <li><a href="pages/payments/tuitionfee.php" target="form_frame">Tuition Fee</a></li>
    <li><a href="pages/payments/paymenthistory.php" target="form_frame">Payment History</a></li>
    <?php if($_SESSION['rolecode']==1)
{
?>
    <li><a href="pages/export_payments.php" target="form_frame">Export Payment Data</a></li>
<?php } ?>
 </ul></li>
 
 
<li><a>
    <?php echo $Ruserid['staff_name'];?>
    
    </a>
    <ul>
        <li><a href="pages/changepass.php" target="form_frame">Change Password</a></li>
        <li><a href="pages/logout.php">Log Out</a></li>
    </ul>
</li>

                        </ul></div>
                    </td>
                        
                        
                </tr>
                
                
            </table>
            
            
            
            
        </div>
        <div class="m" id="maincontainer">
            <iframe style="width: 100%; height: 100%; border: 0px" name="form_frame" src="pages/start.php"></iframe>
            
            
            
            
        </div>
    </center>
    </body>
</html>
