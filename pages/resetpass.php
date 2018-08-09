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
        
        <script src="../js/jquery.min.js" type="text/javascript"></script>
        <script type="text/javascript">
        function checkuser()
        {
            document.getElementById('msg').innerHTML="Please Wait.....";
            var userinfo=document.getElementById('userid').value;
            $.get("../handlers/resetpaswdvalidation.php?userid="+userinfo,function(data,status)
            {
                if(data=="1")
                {
                    alert("An email containing uour new password is sent to your registered email address. \n Please check your spam folder too");
                    document.getElementById('msg').innerHTML="An email containing uour new password is sent to your registered email address. <br> Please check your spam folder too";
                }
                else if(data=="0")
                {
                    alert("Something Went wrong");
                    document.getElementById('msg').innerHTML="Something Went wrong";
                }
            });
        }
        </script>
    </head>
    <body>
        <span style="font-family: 'calibri'; color:#bdbdbd; font-size: 50px">Password Reset</span>
        <br>
        <br>
        <div class="bodytext" style="padding-left: 20px">
            Hi, Please enter your User ID or registered email address and click on the submit button. You will receive your new password in your registered email. It is recommended to set a new password during the first login after password reset. 
        </div>
    <center>
        <table cellspacing="0" cellpadding="5" border="0">
            <tr>
                <td><input type="text" class="txtbx" id="userid" placeholder="User ID or Registered Email"></td>
                <td><div class="btn" onclick="javascript:checkuser()">Reset</div></td>
            </tr>
        </table>
        <br>
        <div class="bodytext" style="width:60%;text-align: center" id="msg"></div>
    </center>
        <?php
        // put your code here
        ?>
    </body>
</html>
