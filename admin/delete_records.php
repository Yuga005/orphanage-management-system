<?php 
include('../connection.php');
$check=$_GET['check'];
if($check=="orphan"){
    $id=$_GET['id'];
    $del=1;
  
$delete = mysqli_query($con,"UPDATE orphans SET delete_status='$del' WHERE orphan_id = '$id'"); 

if($delete)
{
  echo "Deleted";
    mysqli_close($con); 
}else
{
    echo "Error deleting record"; 
}
}else if($check=="donor"){
   
    $status=1;
    $id=$_GET['id'];
    $delete = mysqli_query($con,"UPDATE donors SET delete_status='$status' WHERE donor_id = '$id'"); 
   

if($delete)
{
  echo "Deleted";
    mysqli_close($con); 
}else
{
    echo "Error deleting record"; 
}
}else if($check=="staff"){
   $del=1;
   
    $id=$_GET['id'];
    $delete = mysqli_query($con,"UPDATE staff SET delete_status ='$del' WHERE staff_id = '$id'"); 

if($delete)
{
  echo "Deleted";
    mysqli_close($con); 
}else
{
    echo "Error deleting record"; 
}
}else if($check=="staffRoles"){
   $del=1;
   
    $id=$_GET['id'];
    $delete = mysqli_query($con,"UPDATE staff_roles SET delete_status ='$del' WHERE role_id = '$id'"); 

if($delete)
{
  echo "Deleted";
    mysqli_close($con); 
}else
{
    echo "Error deleting record"; 
}
}else if($check=="donation"){
   $del=1;
   
    $id=$_GET['id'];
    $delete = mysqli_query($con,"UPDATE donations SET delete_status ='$del' WHERE donation_id = '$id'"); 

if($delete)
{
  echo "Deleted";
    mysqli_close($con); 
}else
{
    echo "Error deleting record"; 
}
}else if($check=="adoption"){
   $del=1;
   
    $id=$_GET['id'];
    $delete = mysqli_query($con,"UPDATE adoptions SET delete_status ='$del' WHERE adoption_id = '$id'"); 

if($delete)
{
  echo "Deleted";
    mysqli_close($con); 
}else
{
    echo "Error deleting record"; 
}
}else if($check=="items"){
   $del=1;
   
    $id=$_GET['id'];
    $delete = mysqli_query($con,"UPDATE inventory SET delete_status ='$del' WHERE item_id = '$id'"); 

if($delete)
{
  echo "Deleted";
    mysqli_close($con); 
}else
{
    echo "Error deleting record"; 
}
}
?>