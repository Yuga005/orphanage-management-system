<?php session_start();
if (isset($_SESSION['aid'])) {
  include('../connection.php');
  if (isset($_POST['addOrphan'])) {

    $oId = $_POST['orphanId'];
    $name = $_POST['oname'];
    $dob = $_POST['dob'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $admission = $_POST['admissionDate'];
    $health = $_POST['healthStatus'];
    $education = $_POST['education'];
    $guardianName = $_POST['guardianName'];
    $guardian_contact = $_POST['guardianContact'];

    $target_cust = "../dist/img/OrphanPhotos/";
    $target_photo = "";
    $imagePhoto = "";
    if ($_FILES['photo']['name'] != "") {
      $extCust = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
      $imagePhoto = time() . '1.' . $extCust;
      $target_photo = $target_cust . $imagePhoto;
    }

    $datetime =  date("Y-m-d h:i:sa");

    $edit = 0;
    if ($oId != "") {
      if ($_FILES['photo']['name'] != "") {
        move_uploaded_file($_FILES["photo"]["tmp_name"], $target_photo);

        $edit = mysqli_query($con, "UPDATE orphans SET photo='$imagePhoto' WHERE orphan_id='$oId'");
      }
      $edit = mysqli_query($con, "UPDATE orphans SET name='$name',dob='$dob',age='$age',gender='$gender',admission_date='$admission',health_status='$health',education='$education',guardian_name='$guardianName',guardian_contact='$guardian_contact',created_at='$datetime' WHERE orphan_id='$oId'");
      if ($edit == 1) {


        $_SESSION['updated'] = "Orphan details Updated Successfully";
        header("location:view_orphans.php");
      } else {
        $_SESSION['error'] = "Error: " . $edit . "<br>" . mysqli_error($con);
        header("location:orphans.php");
      }
    } else {
      if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_photo)) {
        $insertOrphan = mysqli_query($con, "INSERT INTO orphans (name,gender,dob,age,health_status,education,admission_date,photo,guardian_name,guardian_contact,created_at)
        VALUES ('$name','$gender','$dob','$age','$health','$education','$admission','$imagePhoto','$guardianName','$guardian_contact','$datetime')");
        if ($insertOrphan == 1) {
          $_SESSION['inserted'] = "Orphan details added Successfully";
          header("location:view_orphans.php");
        } else {
          $_SESSION['error'] = 'Error: ' . $insertOrphan . '<br>' . mysqli_error($con);
          header("location:orphans.php");
        }
      } else {

        $_SESSION['error'] = 'Could not add Orphan';
        header("location:orphans.php");
      }
    }
  } else {
    header('location:../index.php');
  }
}
?>