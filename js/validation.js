/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var namemsg="",dobmsg="",fnamemsg="",uidmsg="",captchamsg="",mobmsg="",emailmsg="",ma="";
function setmsg(id,msg,c )
{
   if(msg=="")
   {
       document.getElementById(id).style="display:none";
   }
   else
   {
        document.getElementById(id).style="display:block";
   }
    
    if(c=="r")
    {
        document.getElementById(id).innerHTML=msg;
        document.getElementById(id).style="background-color: #cc1421"
    }
    
    else if(c=="g")
    {
        document.getElementById(id).innerHTML=msg;
        document.getElementById(id).style="background-color: #387f10"
    }
}


function SHinfo(status_tag,status_img,show_hide)
{
    var img;
    if(status_img=='cross')
    {
        img="../images/cross_ajax.png";
    }
    else if(status_img=='tick')
    {
        img="../images/tick_ajax.png";
    }
    else if(status_img=='loading')
    {
        img="../images/loading.gif";
    }
    
    if(show_hide=="S")
    {
        document.getElementById(status_tag).src=img;
        document.getElementById(status_tag).style="display: inline";
    }
    else if(show_hide=="H")
    {
        document.getElementById(status_tag).src=img;
        document.getElementById(status_tag).style="display: none";
    }
    
    
}

function chk_uid()
{
    var u=document.getElementById('can_uid').value
    if(u!=="")
    {
    if(u.length!==12)
    {
        uidmsg="Invalid Aadhar Number";
        setmsg('uid_msg',"Invalid Aadhar Number","r");
        SHinfo('uid_s','cross','S');
    }
    else
    {
        setmsg('uid_msg',"","g");
        SHinfo('uid_s','loading','S');
        $.get("../handlers/checkuid.php?can_uid="+u,function(data,status)
        {
            if(data=="1")
            {
            uidmsg="";
            setmsg('uid_msg',"","g");
            SHinfo('uid_s','tick','S');
            }
            else if(data == "0")
            {
                uidmsg="Aadhar Number Already Taken";
                setmsg('uid_msg',"Aadhar Number Alredy Taken","r");
                SHinfo('uid_s','cross','S');
            }});}}
    else
    {   uidmsg="Enter Aadhar Number";
        setmsg('uid_msg',"Please Enter Aadhar Number","r");
        SHinfo('uid_s','cross','S');}
}



function chk_captcha()
{
    var c=document.getElementById('captcha_txtbx').value
    
        if(c!="")
        {
        SHinfo('captcha_s','loading','S');
        $.get("../handlers/captchacheck.php?captcha_code="+c,function(data,status)
        {
            if(data=="1")
            {
                captchamsg="";
            document.getElementById('captcha_s').src="../images/tick_ajax.png"
            }
            else if(data == "0")
            {
                captchamsg="Invalid Captcha";
                
                SHinfo('captcha_s','cross','S');
            }
        
        }
                
                
                );
    }
    else
    {
        captchamsg="Enter Captcha text as displayed in the Image";
        document.getElementById('captcha_s').src="../images/cross_ajax.png";
        document.getElementById('captcha_s').style="display: inline";
    }
        
    }


function chk_all()
{
    chk_uid();
    chk_captcha();
    
    if(document.getElementById('can_name').value=="")
    {namemsg="Enter Candidate Name";SHinfo('cnam_s','cross','S'); }
    else{namemsg="";SHinfo('cnam_s','tick','S');}
    
    if(document.getElementById('can_dob').value=="")
    {dobmsg="Enter Candidate's Date of Birth";SHinfo('dob_s','cross','S');}
    else{dobmsg="";SHinfo('dob_s','tick','S');}
    
    if(document.getElementById('can_fname').value=="")
    {fnamemsg="Enter Candidate's Father Name";SHinfo('cfnam_s','cross','S');}
    else{fnamemsg="";SHinfo('cfnam_s','tick','S');}
    
    if(document.getElementById('can_mob').value=="")
    {mobmsg="Enter Candidate's Mobile Number";SHinfo('mob_s','cross','S');}
    else{mobmsg="";SHinfo('mob_s','tick','S');}
}

function msg_a(m)
{
    if(m!=="")
    return "\t\u2022 "+m+"\n";
    else
    return "";
}

function submitreg()
{
    document.getElementById('submit_btn').innerHTML="<img src='../images/loading2.gif' width='15' height='15'>";
    $.ajaxSetup({async: false});
    chk_all();
    var c=msg_a(namemsg)+msg_a(dobmsg)+msg_a(fnamemsg)+msg_a(uidmsg)+msg_a(mobmsg)+msg_a(emailmsg)+msg_a(captchamsg);
    if(c!=="")
    {
        alert("Plese Resolve following Issues\n\n"+c);
        $.ajaxSetup({async: true});
        document.getElementById('submit_btn').innerHTML="Submit"
    }
    else
    {
        submitregdata();
    }
}

