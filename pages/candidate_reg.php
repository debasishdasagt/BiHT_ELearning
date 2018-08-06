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
        <script type="text/javascript" src="../js/validation.js"></script>
        <script type="text/javascript" src="../js/dataProcessor.js"></script>
        <script type='text/javascript'>
        
        function refreshCaptcha(){
                var img = document.images['captchaimg'];
                img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
        }
        
        
        $(document).ready(function () {
  //called when key is pressed in textbox
  $("#can_mob").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        
               return false;
    }
   });
});
        </script>
        
    </head>
    <body>
    <center>
        <div id="progress" >
            
            <table border="0">
                <tr>
                    <td><div class="cur_status"><b>1 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Registration</b></div></td>
                    <td><div class="pending_status"><b>2 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Candidate Details</b></div></td>
                    <td><div class="pending_status"><b>3 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Upload</b></div></td>
                    <td><div class="pending_status"><b>4 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Review & Submit</b></div></td>
                </tr>
            </table>
        </div>
        
        
        
        <div id="form_bg">
            <form name="reg_form" id="reg_form">
                <table border="0" cellspacing="0" cellpadding="3">
                    <tr>
                        <td>Candidate Name*</td>
                        <td><input type="text" id="can_name" name="can_name" class="txtbx" placeholder="Full Name"></td>
                        <td width="30"><img id="cnam_s" style="display: none" class="ajax_s"></td>
                        <td rowspan="3" width="50"></td>
                        <td>Date of Birth*</td> 
                        <td><input type="text" id="can_dob" name="can_dob" class="txtbx" placeholder="YYYY-MM-DD"></td>
                         <td width="30"><img id="dob_s" style="display: none" class="ajax_s"></td>
                    </tr>
                    <tr>
                        <td>Father's Name*</td>
                        <td><input type="text" id="can_fname" name="can_fname" class="txtbx" placeholder="Candidate's Father Name" ></td>
                         <td width="30"><img id="cfnam_s" style="display: none" class="ajax_s"></td>
                        <td>UID Number*</td> 
                        <td><input type="text" id="can_uid" name="can_uid" class="txtbx" placeholder="Aadhar Number" onchange="chk_uid()" maxlength="12"><div id="uid_msg" class="ajax_msg"></div></td>
                    
                        <td width="30"><img id="uid_s" style="display: none" class="ajax_s"></td>
                    </tr>
                    
                    <tr>
                        <td>Mobile Number*</td>
                        <td><input id="can_mob" name="can_mob" class="txtbx" placeholder="Primary Mobile number" maxlength="10"></td>
                         <td width="30"><img id="mob_s" style="display: none" class="ajax_s"></td>
                        <td>E-Mail Address</td> 
                        <td><input type="text" id="can_email" name="can_email" class="txtbx" placeholder="Candidate's E-Mail "></td>
                         <td width="30"><img id="email_s" style="display: none" class="ajax_s"></td>
                    </tr>
                    
                </table>
                <br>
                
            </form>
        </div>
        <div style="width:90%;color:red;font-family: 'calibri'" align="left"><i><b>Note:</b> * (Star) Marked fields are Mandatory</i></div>
        <div id="btn_bar">
            
            <div style="float:right;margin-right: 70px">
                <table border='0' cellpadding="5"><tr>
                        <td valign="middle" style="background-color: #f2f0f0; border-radius: 5px"><table border="0"><tr>
                                    <td><img src="../phpcaptcha/captcha.php?rand=<?php echo rand();?>" id='captchaimg' style="height: 30px; margin-right: 10px; margin-left: 30px"></td>
                                    <td><a href='javascript: refreshCaptcha();'><img src="../images/refreshicon.png" border="0" height="20" width="20" style="margin-right: 20px"></a> </td>
                                <td><input type="text" id="captcha_txtbx" class="txtbx" placeholder="Captcha Here" style="width: 100px" onchange="chk_captcha()"></td>
                                <td width="30"><img class="ajax_s" src="../images/loading.gif" style="display: none" id="captcha_s"></td></tr></table></td>
                                <td><div class='btn' style="margin-left: 50px" onclick="submitreg()" id="submit_btn">Submit</div></td></tr></table>
            </div>
        
    </center>
    </body>
    
    <script type="text/javascript">
    $('#can_dob').datetimepicker({
    dayOfWeekStart : 1,
    lang:'en',
    step:5,
    format: 'Y-m-d',
    timepicker: false,
    closeOnDateSelect: true,
    startDate:'1990/1/1'
    });
    
   
        </script>
</html>
