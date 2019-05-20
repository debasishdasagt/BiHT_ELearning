<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$db_server="localhost";
$db_name="biht_elearning";
$db_username="root";
$db_password="devdas";
$conn=  mysql_connect($db_server,$db_username,$db_password);
$db= mysql_select_db($db_name);

?>