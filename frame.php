<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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

<li><a href="http://www.google.com">Item 1</a></li>
<li><a href="http://www.google.com">Folder 0</a>
  <ul>
  <li><a href="http://www.google.com">Sub Item 1.1</a></li>
  <li><a href="http://www.google.com">Sub Item 1.2</a></li>
  <li><a href="http://www.google.com">Sub Item 1.3</a></li>
  <li><a href="http://www.google.com">Sub Item 1.4</a></li>
  <li><a href="http://www.google.com">Sub Item 1.2</a></li>
  <li><a href="http://www.google.com">Sub Item 1.3</a></li>
  <li><a href="http://www.google.com">Sub Item 1.4</a></li>
  </ul>
</li>
<li><a href="http://www.google.com">Folder 1</a>
  <ul class="multicolumn">
  <li><a href="http://www.google.com">Sub Item 1.1</a></li>
  <li><a href="http://www.google.com">Sub Item 1.2</a></li>
  <li><a href="http://www.google.com">Sub Item 1.3</a></li>
  <li><a href="http://www.google.com">Sub Item 1.4</a></li>
  <li><a href="http://www.google.com">Sub Item 1.5</a></li>
  <li><a href="http://www.google.com">Sub Item 1.6</a></li>
  <li><a href="http://www.google.com">Sub Item 1.7</a></li>
  </ul>
</li>
<li><a href="http://www.google.com">Item 3</a></li>
<li><a href="http://www.google.com">Folder 2</a>
  <ul>
  <li><a href="http://www.google.com">Sub Item 2.1</a></li>
  <li><a href="http://www.google.com">Sub Item 2.1</a></li>
  <li><a href="http://www.google.com">Sub Item 2.1</a></li>
  <li><a href="http://www.google.com">Sub Item 2.1</a></li>
  <li><a href="http://www.google.com">Sub Item 2.1</a></li>
  </ul>
</li>
<li><a href="http://www.google.com/style/">Item 4</a></li>

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
