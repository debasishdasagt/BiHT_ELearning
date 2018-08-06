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
    </center>
    <br><br>
        <span style="font-family: 'calibri'; color:#bdbdbd; font-size: 80px">Congratulations !</span>
        <br>
        <div id="regpass" class="regpass">
            You have successfully registered for ITI Admission 2018 online application. Your registration number and login password is mentioned bellow. Please take a note of the same, as these are required to login and Final submission of the application form.
            <br> <br> <br>
            <table border="0" cellpadding="3"><tr><td>Registration Number:</td><td><font color="black"><b><?php echo $_GET['reg'];?></font></b></td></tr>
                <tr><td>Login Password:</td><td><font color="black"><b><?php echo $_GET['pass'];?></font></b></td></tr>
            </table>
            <br><br>
            <table border="0" cellpadding="3"><tr><td><div class="btn" onclick="document.location='candidate_login.php'">Click Here</div> </td><td>to login and fill-up rest of your details.</td></tr></table>
        </div>
        
        
        

    </body>
</html>
