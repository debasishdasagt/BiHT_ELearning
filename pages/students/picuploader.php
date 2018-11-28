<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include("../../config.php");
$errors= array();
$extensions= array("jpeg","jpg","png","bmp");
if($_FILES['picc']['tmp_name'])
{
    
    $tmpname=$_FILES['picc']['tmp_name'];
    $name=$_FILES['picc']['name'];
    $ext=  strtolower(end(explode(".", $name)));
    $newname=$_POST['regnum'].".".$ext;
    if(! in_array($ext, $extensions))
    {
        $errors[]="Unsupported File Type";
    }
    
    if(empty($errors))
    {
        
        $upload=move_uploaded_file($tmpname, "pics/".$newname);
        if(!$upload)
        {
            
            header("location:newstudent.php?info=Something went wrong while uploading picture for Registration Number:".$_POST['regnum']);
            echo $_FILES['picc']['error'];
        }
        else
        {
            $m_query="update d_students set student_pic='".$newname."' where reg_num='".$_POST['regnum']."' and record_status='A'";
            $r=  mysql_query($m_query,$conn);
            if($r)
            {
               header("location:../payments/admissionfee.php?info=Saved Successfully with Registration Number:".$_POST['regnum']."&regnum=".$_POST['regnum']);
            }
            else
            {
                header("location:../payments/admissionfee.php?info=Something went wrong while doing Database entry of picture for Registration Number:".$_POST['regnum']);
            }
        }
        
        
    }
    else
    {
        print_r($errors);
    }
}
 else {
    header("location:../payments/admissionfee.php?info=No Picture was selected for Registration Number:".$_POST['regnum']."&regnum=".$_POST['regnum']);
}

?>