<?php session_start(); 
if(isset($_SESSION['aid'])){
include('../connection.php');
if(isset($_POST['addItem'])){
  
$oId=$_POST['itemId'];
$donationId=$_POST['donationId'];

 $itemName = $_POST['itemName'];
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];
    $unit=$_POST['unit'];
$receivedDate = $_POST['receivedDate'];
    $datetime=  date("Y-m-d h:i:sa");
    
$edit=0;
  if ($oId!="") {
                $edit = mysqli_query($con, "UPDATE inventory SET donation_id='$donationId',item_name='$itemName',category='$category',quantity='$quantity',unit='$unit',received_date='$receivedDate' WHERE item_id='$oId'");
if($edit==1){
    
    $_SESSION['updated'] = "Item Details Updated Successfully";
        header("location:view_items.php");

    } else {
      $_SESSION['error']= "Error: " . $edit . "<br>" . mysqli_error($con);
       header("location:inventory.php");
    }
                 
  } else {
        $insert = mysqli_query($con,"INSERT INTO inventory (donation_id,item_name,category,quantity,unit,received_date)
        VALUES ('$donationId','$itemName','$category','$quantity','$unit','$receivedDate')");
     if($insert==1){
$_SESSION['inserted'] = "Items details added Successfully";
        header("location:view_items.php");
     }else{
           $_SESSION['error'] = 'Error: ' . $insert . '<br>'. mysqli_error($con);
        header("location:inventory.php");
     }
    
   
        
        
  
}
}else{
    header('location:../index.php');
}
}