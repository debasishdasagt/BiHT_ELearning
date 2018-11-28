<?php
require_once '../../config.php';
$html="Something Went Wrong";
$filename='receipt';
if(isset($_GET['rcptnum']))
{
    $rq=  mysql_query("SELECT `id`,`rcpt_id`,`student_reg_num`,`course_code`,`course_name`,
    `admission_fee`,`fee_paid`,`student_name`,`student_father_name`,`payment_date`,`next_installment`,
    `class_start_on`,`course_duration`,`duration_unit`,`record_status`
FROM `d_fee_payments` where rcpt_id='".$_GET['rcptnum']."'and fee_type='admission' and record_status='A'",$conn);
    $rr=  mysql_fetch_array($rq);
    
    $sq=mysql_query("select reg_date,tuition_fee from d_students where reg_num='".$rr['student_reg_num']."' and record_status='A'",$conn);
    $sr=  mysql_fetch_array($sq);
    
    
    $html="<html>
    <head>
    <meta http-equiv='Content-Type' content='text/html; charset=iso-8859-15'>
        <style type='text/css'>
        .bodytext
            {
                font-family: sans-serif;
                color: #585858;
                font-size: 14px;
            }
            .chkbox{
            width:12px;
            height:12px;
            border: 1px solid #000000;
            display:inline-block;
            border-radius: 3px;
            }
        </style>
    </head>
    <body style='text-align:center'>
        <div class='bodytext' style='font-size: 36px'><b>BIH Technologies Pvt. Ltd.</b></div>
        <div>A Govt. Of India Registered Institute</div>
        <div class='bodytext'>An ISO 9001:2008 Certified Institute</div>
        <div class='bodytext' style='font-size: 16px'>Authorized Training Partner of NIELIT, PMKVY, NDLM</div>
       

<table cellpadding='5' cellspacing='0' border='0' width=100%  > 
            <tr>
                <td align='right' width=25%><img src='../../images/biht_logo.png'></td>
                <td align='center' width=50%><div class='bodytext' style='font-size: 20px; border:solid #002a80 2px; border-radius: 5px; margin: 2px 4px 6px 4px; padding: 3px'>Admission Acknowledgement </div></td>
                <td align='left' width=25%><img src='../../images/biht_logo.png'></td>
            </tr>
        </table>
    
        <br>
        
            <table cellpadding='5' cellspacing='0' border='0' style='margin-left:100px' >
                <tr>
                    <td>Registration Number :</td><td style='border-bottom: dotted #444444 1px'>
                        <b>".$rr['student_reg_num']."</b>
                    </td><td>Receipt Number:</td><td style='border-bottom: dotted #444444 1px'>
                    <b>".$rr['rcpt_id']."</b>
                    </td>
                </tr>
<tr>
                    <td>Paid Amount :</td><td style='border-bottom: dotted #444444 1px'>
                        <b>".$rr['fee_paid']."</b>
                    </td><td>Payment Date:</td><td style='border-bottom: dotted #444444 1px'>
                    <b>".$rr['payment_date']."</b>
                    </td>
                </tr>                

                <tr>
                    <td>Name of Student :</td><td colspan='3' style='border-bottom: dotted #444444 1px'>
                        <b>".$rr['student_name']."</b>
                    </td>
                </tr>
                <tr>
                    <td>Father's Name :</td><td colspan='3' style='border-bottom: dotted #444444 1px'>
                        <b>".$rr['student_father_name']."</b>
                    </td>
                </tr>
            </table>
            <br>
            <div class='bodytext'>
<table cellspacing=0 cellpadding=3 border=1 style='margin:10px;border:1px solid #eeeeee' width=100%>
<tr><td align=center colspan=4><b>Course Details</b></td></tr>
<tr align=center><td>Course Code</td><td>Name of Course</td><td>Duration</td><td>Class Start From</td></tr>
<tr align=center><td>".$rr['course_code']."</td><td>".$rr['course_name']."</td><td>".$rr['course_duration']." ".$rr['duration_unit']."</td><td>".$rr['class_start_on']."</td></tr>
</table><br>
<table cellspacing=0 cellpadding=3 border=1 style='margin:10px;border:1px solid #eeeeee' width=100%>
<tr><td align=center colspan=5><b>Payment Details</b></td></tr>
<tr align=center><td>Payment Option</td><td>Admission Fee</td><td>Admission Date</td><td>Tuition Fee</td><td>Next Installment Date</td></tr>
<tr align=center><td>Cash</td><td>".$rr['fee_paid']."</td><td>".$sr['reg_date']."</td><td>".$sr['tuition_fee']."</td><td>".$rr['next_installment']."</td></tr>
</table><br>
<table cellspacing=0 cellpadding=3 border=1 style='margin:10px;border:1px solid #eeeeee' width=100%>
<tr><td align=center colspan=3><b>Class Time Table</b></td></tr>
<tr align=left><td width=200>Monday - Wednesday - Friday <div class='chkbox' style='margin-left: 30px;'></div></td><td></td><td width=70>AM<div class='chkbox'></div> /  PM<div class='chkbox'></div></td></tr>
<tr align=left><td width=200>Tuesday - Thursday - Saturday <div class='chkbox' style='margin-left: 30px;'></div></td><td></td><td width=70>AM<div class='chkbox'></div> /  PM<div class='chkbox'></div></td></tr>
</table><br>
<u><b>Rules & Regulations</b></u>
<div style='text-align:left'>
<ul>
<li>Be punctual for classes.</li>
<li>Respect and co-operate with teachers, staffs and other students.</li>
<li>Complete the assigned class work.</li>
<li>Have all materals required for each class.</li>
<li>Remain in class untill dismissed by the teacher.</li>
<li>Keep the class room & institution premise clean and tidy at all times. </li>
<li>Respect Institution's property and property of others.</li>
<li>Institution remains closed on Sundays, Govt. Holidays, Strikes etc.</li>
<li>Examinaton is compulsory for each and every student.</li>
<li>Keep Mobile phones in silent or shitched off mode while in class.</li>
<li>Pay Tuition fee on or before 10th of every month. If fails, student has to pay additional 10% of Tution fee as Late Fine.</li>
<li>Abide by all Rules & Regulations.</li>
</ul></div><br><br><br><br><br>
<div style='text-align:center; border-top: 1px solid #aaaaaa; padding-top: 3px'>
Contact No - 9862804507, 09485070993, 9774227937, 9089417349
</div>

</div>

    </body>
</html>";
    
    
    
    
    $filename="Admission_Fee_Receipt_".$rr['rcpt_id'];
}
require_once '../../dompdf/autoload.inc.php';


// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream($filename.".pdf");
?>
