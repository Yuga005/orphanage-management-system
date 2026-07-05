<?php session_start(); 
if(isset($_SESSION['aid'])){
include('../connection.php');
if(isset($_POST['addDonor'])){
  
$oId=$_POST['donorId'];
 $name = $_POST['dname'];
    $email = $_POST['email'];
    $phone = $_POST['mobile'];
    $address = $_POST['address'];
    

    $datetime=  date("Y-m-d h:i:sa");
    
$edit=0;
  if ($oId!="") {
                $edit = mysqli_query($con, "UPDATE donors SET name='$name',email='$email',phone='$phone',address='$address',joined_on='$datetime' WHERE donor_id='$oId'");
if($edit==1){
    

    $_SESSION['updated'] = "Donor Updated Successfully";
        header("location:view_donors.php");

    } else {
      $_SESSION['error']= "Error: " . $edit . "<br>" . mysqli_error($con);
       header("location:donors.php");
    }
                 
  } else {
        $insert = mysqli_query($con,"INSERT INTO donors (name,email,phone,address,joined_on)
        VALUES ('$name','$email','$phone','$address','$datetime')");
     if($insert==1){
$_SESSION['inserted'] = "Donor added Successfully";
        header("location:view_donors.php");
     }else{
           $_SESSION['error'] = 'Error: ' . $insert . '<br>'. mysqli_error($con);
        header("location:donors.php");
     }
    
   
        
        
  
}
}else{
    header('location:../index.php');
}
}