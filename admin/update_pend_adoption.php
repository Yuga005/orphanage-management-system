<?php session_start(); 
if(isset($_SESSION['aid'])){
include('../connection.php');
if(isset($_POST['updateAdoption'])){
  
$oId=$_POST['adoptionId'];
$orphanId=$_POST['orphanId'];
 $adoptionDate=$_POST['adoptionDate'];
 $status=$_POST['adopStatus'];
 $orStatus="Pending";
 if($status == "Approved"){
 $orStatus="Adopted";

 }else if($status == "Rejected"){
 $orStatus="Available";
 }
 

    // $datetime=  date("Y-m-d h:i:sa");
    
$edit=0;
  if ($oId!="") {
                $edit = mysqli_query($con, "UPDATE adoptions SET adoption_date='$adoptionDate',status='$status' WHERE adoption_id='$oId'");
if($edit==1){
                    $editOrphan = mysqli_query($con, "UPDATE orphans SET status='$orStatus' WHERE orphan_id='$orphanId'");

    $_SESSION['updated'] = "Adoption Details Updated Successfully";
        header("location:view_adoptions.php");

    } else {
      $_SESSION['error']= "Error: " . $edit . "<br>" . mysqli_error($con);
       header("location:adoptions.php");
    }
                 
  } 
}else{
    header('location:../index.php');
}
}