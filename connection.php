<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();  // Only starts if not already active
}
date_default_timezone_set('Asia/Kolkata');
$DB_HOST='localhost'; $DB_USER='root'; $DB_PASS=''; $DB_NAME='orphanage_db'; $PORT='3307';
$con=new mysqli($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME,port:$PORT); if($con->connect_errno) die('DB error:'.$con->connect_error);
$root_url='';
?>