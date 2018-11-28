<?php
require_once '../../config.php';
$html="Something Went Wrong";
$filename='receipt';
if(isset($_GET['rcptnum']))
{
    $rq=  mysql_query("SELECT `id`,`rcpt_id`,`student_reg_num`,`course_code`,`course_name`,
    `admission_fee`,`fee_paid`,`student_name`,`student_father_name`,`payment_date`,`next_installment`,
    `class_start_on`,`course_duration`,`duration_unit`,`record_status`
FROM `d_fee_payments` where rcpt_id='".$_GET['rcptnum']."'and fee_type='tuition' and record_status='A'",$conn);
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
                <td align='center' width=50%><div class='bodytext' style='font-size: 20px; border:solid #002a80 2px; border-radius: 5px; margin: 2px 4px 6px 4px; padding: 3px'>Tuition Fee Receipt </div></td>
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
                    <td>Next Installment date :</td><td colspan='3' style='border-bottom: dotted #444444 1px'>
                        <b>".$rr['next_installment']."</b>
                    </td>
                </tr>
            </table>
            <br>
            <div class='bodytext'>
</div><br>
<div style='text-align:center; border-top: 1px solid #aaaaaa; padding-top: 3px'>
Contact No - 9862804507, 09485070993, 9774227937, 9089417349
</div>

</div>

    </body>
</html>";
    
    
    
    
    $filename="Tution _Fee_Receipt_".$rr['rcpt_id'];
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
