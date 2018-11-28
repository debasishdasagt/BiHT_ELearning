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
        <link rel="stylesheet" href="../../css/style.css">
        <link rel="stylesheet" href="../../css/jquery.datetimepicker.css">
        
        <script type="text/javascript" src="../../js/jquery-latest.js"></script>
        <script type="text/javascript" src="../../js/jquery.datetimepicker.full.js"></script>
        <script type="text/javascript">
            function searchstudent()
            {
                var ssdata=document.getElementById('searchbox').value;
                var type,result;
                if(document.getElementById('regnum').checked)
                {
                    type='regnum';
                }
                else if(document.getElementById('sname').checked)
                {
                    type='sname';
                }
                else if(document.getElementById('uid').checked)
                {
                    type='uid';
                }
                else if(document.getElementById('mob').checked)
                {
                    type='mob';
                }
                
                if(ssdata=="")
                {
                    alert("Please Enter Something");
                }
                else
                {
                    $.get('studentsearchhandler1.php',
                    {
                        sdata: ssdata,
                        stype: type
                    },
                    function(data,status)
                    {
                        document.getElementById('result').innerHTML=data;
                    });
                }
            }
            </script>
    </head>
    <body>
        
       <span style="font-family: 'calibri'; color:#bdbdbd; font-size: 50px">Search Students </span> 
    <center>
        <div class="bodytext">
        <br><br>
        <form action="javascript:searchstudent()">
            <table border="0" celspacind="0" cellpadding="0" width="70%">
                <tr>
                    <td align="right"><input type="text" style="border: 1px #6666ff solid; border-radius: 13px 0px 0px 13px; width:500px; padding-left: 10px; height:25px" name="searchbox" id="searchbox"></td>
                    <td align="left"><input type="submit" value="Search" style="border: 1px #6666ff solid; border-radius: 0px 13px 13px 0px; width:100px; height:29px; background-color: #6666ff; margin: 0px;color: #ffffff; cursor: pointer"></td>
                </tr>
                <tr><td align="center" colspan="0"><input type="radio" name="susing" value="regnum" checked="true" id="regnum">By Registration Number &nbsp; 
                        <input type="radio" name="susing" value="sname" id="sname">By Name &nbsp; 
                        <input type="radio" name="susing" value="uid" id="uid">By UID &nbsp; 
                        <input type="radio" name="susing" value="mob" id="mob">By Mobile Number</td></tr>
            </table>
        </form>
        </div>
        <br><br>
        
        <div id="result"></div>
        
        
    </center>
        <?php
        
        ?>
    </body>
</html>
