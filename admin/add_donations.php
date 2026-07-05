<?php session_start(); 
if(isset($_SESSION['aid'])){
include('../connection.php');
if(isset($_POST['addDonation'])){
  
$oId=$_POST['donationId'];
$donorId=$_POST['donorId'];

 $amount = $_POST['amount'];
    $type = $_POST['type'];
    $desc = $_POST['description'];
    
$donationDate = $_POST['donationDate'];
    $datetime=  date("Y-m-d h:i:sa");
    
$edit=0;
  if ($oId!="") {
                $edit = mysqli_query($con, "UPDATE donations SET donor_id='$donorId',amount='$amount',type='$type',description='$desc',donation_date='$donationDate' WHERE donation_id='$oId'");
if($edit==1){
    
    $_SESSION['updated'] = "Donation Details Updated Successfully";
        header("location:view_donations.php");

    } else {
      $_SESSION['error']= "Error: " . $edit . "<br>" . mysqli_error($con);
       header("location:donations.php");
    }
                 
  } else {
        $insert = mysqli_query($con,"INSERT INTO donations (donor_id,amount,type,description,donation_date,datetime)
        VALUES ('$donorId','$amount','$type','$desc','$donationDate','$datetime')");
     if($insert==1){
$_SESSION['inserted'] = "Donation details added Successfully";
        header("location:view_donations.php");
     }else{
           $_SESSION['error'] = 'Error: ' . $insert . '<br>'. mysqli_error($con);
        header("location:donations.php");
     }
    
   
        
        
  
}
}else{
    header('location:../index.php');
}
}