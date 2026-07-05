<?php 
include('../connection.php');

  $check=$_POST['check'];

if($check=="staff"){
    $id=$_POST['id'];
      $status=$_POST['status'];
      $stat=$status;
      if($stat==1){
        $stat="Active";
      }else{
                $stat="Inactive";

      }
$edit = mysqli_query($con,"UPDATE staff SET status='$stat' WHERE staff_id='$id'");


    if ($edit==1) {
   echo json_encode(array('status' => $status,'msg'=>'success','stat'=>$stat,'id'=>$id));

    } else {
      echo "Error: " . $edit . "<br>" . mysqli_error($con);
    }
}else if($check=="user"){
    $id=$_POST['id'];
     $select = mysqli_query($con, "SELECT status from users WHERE id='$id'");
     $row = mysqli_fetch_assoc($select);
     $edit="";
     if($row['status']==1){
$edit = mysqli_query($con, "UPDATE users SET status='0',register_status='0' WHERE id='$id'");
$status=1;
     }else{
         $edit = mysqli_query($con, "UPDATE users SET status='1',register_status='1' WHERE id='$id'");
         $status=0;
     }

    if ($edit==1) {
    echo json_encode(array('status' => $status,'msg'=>'success'));
    } else {
      echo "Error: " . $edit . "<br>" . mysqli_error($con);
    }
}
    ?>