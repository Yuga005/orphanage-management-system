<?php session_start(); 
if(isset($_SESSION['aid'])){
include('../connection.php');
if(isset($_POST['addStaffRole'])){
  
$oId=$_POST['staffRoleId'];
$name=$_POST['rname'];

 $desc = $_POST['desc'];
    
    // $datetime=  date("Y-m-d h:i:sa");
    
$edit=0;
  if ($oId!="") {
                $edit = mysqli_query($con, "UPDATE staff_roles SET role_name='$name',role_description='$desc' WHERE role_id='$oId'");
if($edit==1){
    
    $_SESSION['updated'] = "Staff roles Updated Successfully";
        header("location:view_staff_roles.php");

    } else {
      $_SESSION['error']= "Error: " . $edit . "<br>" . mysqli_error($con);
       header("location:staff_roles.php");
    }
                 
  } else {
        $insert = mysqli_query($con,"INSERT INTO staff_roles (role_name,role_description)
        VALUES ('$name','$desc')");
     if($insert==1){
$_SESSION['inserted'] = "Staff roles added Successfully";
        header("location:view_staff_roles.php");
     }else{
           $_SESSION['error'] = 'Error: ' . $insert . '<br>'. mysqli_error($con);
        header("location:staff_roles.php");
     }
    
   
        
        
  
}
}else{
    header('location:../index.php');
}
}