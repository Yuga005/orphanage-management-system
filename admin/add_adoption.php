<?php session_start();
if (isset($_SESSION['aid'])) {
    include('../connection.php');
    if (isset($_POST['addAdoption'])) {

        $oId = $_POST['adoptionId'];
        $name = $_POST['aname'];
        $orphanId = $_POST['orphanId'];
        $email = $_POST['email'];
        $phone = $_POST['mobile'];

        $address = $_POST['address'];

        // $datetime=  date("Y-m-d h:i:sa");

        $edit = 0;
        if ($oId != "") {
            $edit = mysqli_query($con, "UPDATE adoptions SET orphan_id='$orphanId', adopter_name='$name',adopter_email='$email',adopter_phone='$phone',adopter_address='$address' WHERE adoption_id='$oId'");
            if ($edit == 1) {

                $_SESSION['updated'] = "Adoption Details Updated Successfully";
                header("location:view_adoptions.php");
            } else {
                $_SESSION['error'] = "Error: " . $edit . "<br>" . mysqli_error($con);
                header("location:adoptions.php");
            }
        } else {
            $insert = mysqli_query($con, "INSERT INTO adoptions (orphan_id,adopter_name,adopter_email,adopter_phone,adopter_address,status)
        VALUES ('$orphanId','$name','$email','$phone','$address','Pending')");
            if ($insert == 1) {
                $_SESSION['inserted'] = "Adoption details added Successfully";
                header("location:view_adoptions.php");
            } else {
                $_SESSION['error'] = 'Error: ' . $insert . '<br>' . mysqli_error($con);
                header("location:adoptions.php");
            }
        }
    } else {
        header('location:../index.php');
    }
}
