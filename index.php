<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>BiHT e-Learning</title>
        <link rel='stylesheet' href='css/style.css'>
        <script type="text/javascript" src="js/jquery-latest.js"></script>
        <script type="text/javascript">
            function checklogin()
            {
                $.post("handlers/lclogin.php",{'reg':document.getElementById('reg').value,'pass':document.getElementById('pass').value},
                function(data,status)
                {
                   if(data=='1')
                   {
                       document.location="frame.php";
                   }
                   else if(data=='0')
                   {
                       alert('Wrong Registration Number or Login Password \n\n Please Retry');
                   }
                   else
                   {
                       alert(data);
                   }
                }
        
                )
            }
            </script>
        
        
    </head>
    <body>
    <center>
        
        <br><br><br><br><br>
        <div class='login_box'>
            <img src="images/biht_elearning_logo.png">
            <br><br>
            
            <table border='0' cellspacing='0' cellpadding='5' width='300'>
                <tr>
                    <td align='left'>
                        <span style="opacity: 0.5; font-size: 12px" >Learning Center or Operator Login</span><br>
                        <input type="text" class='login_txtbx' placeholder="User ID" style="background-image: url('images/user.png')" id="reg">
                    </td>
                </tr><tr>
                    <td align='left'>
                        <span style="opacity: 0.5 ; font-size: 12px">User Password</span><br>
                        <input type="password" class='login_txtbx' placeholder="Password" style="background-image: url('images/password.png')" id="pass">
                    </td>
                    
                </tr>
                <tr>
                    <td align='center'>
                        
                        <div class='login_btn' onclick="checklogin()">Login</div>
                    </td>
                    
                </tr>
                <tr>
                    <td align='left'>
                        
                       
                        <a href="pages/resetpass.php" target="_self">Reset Password</a>
                    </td>
                    
                </tr>
            </table>
        </div>
        
    </center>
    </body>
</html>
