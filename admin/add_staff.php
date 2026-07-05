<?php session_start(); 
if(isset($_SESSION['aid'])){
include('../connection.php');
if(isset($_POST['addStaff'])){
  
$oId=$_POST['staffId'];
$name=$_POST['sname'];

 $email = $_POST['email'];
    $phone = $_POST['mobile'];
    $staffRole = $_POST['staffRole'];
    
$address = $_POST['address'];
$salary = $_POST['salary'];
$joinDate=$_POST['joinDate'];
$status=$_POST['status'];

    // $datetime=  date("Y-m-d h:i:sa");
    
$edit=0;
  if ($oId!="") {
                $edit = mysqli_query($con, "UPDATE staff SET name='$name',email='$email',phone='$phone',role_id='$staffRole',address='$address',salary='$salary',join_date='$joinDate',status='$status' WHERE staff_id='$oId'");
if($edit==1){
    
    $_SESSION['updated'] = "Staff Details Updated Successfully";
        header("location:view_staff.php");

    } else {
      $_SESSION['error']= "Error: " . $edit . "<br>" . mysqli_error($con);
       header("location:staff.php");
    }
                 
  } else {
        $insert = mysqli_query($con,"INSERT INTO staff (name,email,phone,role_id,address,salary,join_date,status)
        VALUES ('$name','$email','$phone','$staffRole','$address','$salary','$joinDate','$status')");
     if($insert==1){
$_SESSION['inserted'] = "Staff details added Successfully";
        header("location:view_staff.php");
     }else{
           $_SESSION['error'] = 'Error: ' . $insert . '<br>'. mysqli_error($con);
        header("location:staff.php");
     }
    
   
        
        
  
}
}else{
    header('location:../index.php');
}
}