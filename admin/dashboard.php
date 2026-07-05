<?php
// if (session_status() == PHP_SESSION_NONE) {
    // echo "doneeeee";
    session_start();
// }
include('header.php');
include('sidebar.php');
include('../connection.php');
if (isset($_SESSION['aid'])) {
    // echo "hiiiii";
    ?>
    <style>
        .control {
            display: block;
            position: relative;
            padding-left: 30px;
            margin-bottom: 15px;
            cursor: pointer;
            font-size: 14px;
            padding: 8px 40px;
            height: 40px;
            font-weight: 600 !important;
            background: #fff;
            transition: all 500ms ease;
        }
        .control input {
            position: absolute !important;
            z-index: -1;
            opacity: 0 !important;
            left: 0 !important;
        }
        input[type="checkbox"], input[type="radio"] {
            box-sizing: border-box;
            padding: 0;
        }

        .control__indicator {
            position: absolute;
            top: 12px;
            left: 10px;
            height: 16px;
            width: 16px;
            background: #fff;
            border: 1px solid #ccc;
        }
        .control--radio .control__indicator {
            border-radius: 50%;
        }
        .control__indicator:after {
            content: '';
            position: absolute;
            display: none;
        }

        .control__indicator:before {
            content: '';
            position: absolute;
            top: -5px;
            bottom: -5px;
            left: -5px;
            right: -5px;
            border: solid 1px #ccc;
            border-radius: 50%;
        }
        .control input:checked~.control__indicator {
            background: #fff;
            border: none;
        }
        .control [type=radio]:checked~.control__indicator:before {
            border-color: #df1802;
            top: -4px;
            bottom: -4px;
            left: -4px;
            right: -4px;
        }

        .control input:checked~.control__indicator:after {
            display: block;
        }
        .control--radio .control__indicator:after {
            left: 0px;
            top: 0px;
            height: 16px;
            width: 16px;
            transition: all 3s;
            border-radius: 50%;
            background: #df1802;
        }

        .control--radio input:disabled~.control__indicator:after {
            background: #7b7b7b;
        }
        .card-body .appStatus{
            border-top: solid;
            margin-top: 20px;

        }
        .card-body{
            display: none;
        }
        .col-form-label{
            font-weight: 600;
            font-size: 18px;
            padding: 10px 0 20px 0;
        }
        /*        .inner{
                    text-align: center;
                }*/
        .small-box h3 {
            font-size: 34px;
        }
        .small-box p {
            font-size: 20px;
        }
    </style>
    <title>Dashboard</title>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Dashboard</h1>
                    </div>
                </div>   
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-sm-3">
                        <!-- small box -->
                        <div class="small-box bg-primary" style="background-color: #dd4c39 !important;">
                            <div class="inner">
                                <h3>
                                    <?php
                                    $qry = "select orphan_id from orphans WHERE status='Available' AND delete_status='0'";
                                 
                                    $qryRun = mysqli_query($con, $qry);
                                    $result = mysqli_num_rows($qryRun);
                                    echo $result;
                                    ?>
                                </h3> 

                                <p>Total Orphans</p>
                         
                            </div>
                            <div class="icon">
                                <i class="fa fa-solid fa-child"></i>
                            </div>
                           

                        </div>

                    </div>
                      <div class="col-sm-3">
                        <!-- small box -->
                        <div class="small-box bg-primary" style="background-color: #dd4c39 !important;">
                            <div class="inner">
                                <h3>
                                    <?php
                                    $qry = "select donor_id from donors WHERE delete_status='0'";
                                 
                                    $qryRun = mysqli_query($con, $qry);
                                    $result = mysqli_num_rows($qryRun);
                                    echo $result;
                                    ?>
                                </h3> 

                                <p>Total Donors</p>
                         
                            </div>
                            <div class="icon">
                                <i class="fa fa-solid fa-hand-holding-heart"></i>
                            </div>
                           

                        </div>

                    </div>
                      <div class="col-sm-3">
                        <!-- small box -->
                        <div class="small-box bg-primary" style="background-color: #dd4c39 !important;">
                            <div class="inner">
                                <h3>
                                    <?php
                                    $qry = "select staff_id from staff WHERE status='Active' AND delete_status='0'";
                                 
                                    $qryRun = mysqli_query($con, $qry);
                                    $result = mysqli_num_rows($qryRun);
                                    echo $result;
                                    ?>
                                </h3> 

                                <p>Total Staff</p>
                         
                            </div>
                            <div class="icon">
                                <i class="fa fa-solid fa-user-shield"></i>
                            </div>
                           

                        </div>

                    </div>
                    <div class="col-sm-3">
                        <!-- small box -->
                        <div class="small-box bg-primary" style="background-color: #dd4c39 !important;">
                            <div class="inner">
                                <h3>
                                    <?php
                                    $qry = "select adoption_id from adoptions WHERE status='Approved' AND delete_status='0'";
                                 
                                    $qryRun = mysqli_query($con, $qry);
                                    $result = mysqli_num_rows($qryRun);
                                    echo $result;
                                    ?>
                                </h3> 

                                <p>Total Adoptions</p>
                         
                            </div>
                            <div class="icon">
                                <i class="fa fa-solid fa-star"></i>
                            </div>
                           

                        </div>

                    </div>
                    <div class="col-sm-3">
                        <!-- small box -->
                        <div class="small-box bg-primary" style="background-color: #dd4c39 !important;">
                            <div class="inner">
                                <h3>
                                    <?php
                                    $qry = "select adoption_id from adoptions WHERE status='Pending' AND delete_status='0'";
                                 
                                    $qryRun = mysqli_query($con, $qry);
                                    $result = mysqli_num_rows($qryRun);
                                    echo $result;
                                    ?>
                                </h3> 

                                <p>Pending Adoptions</p>
                         
                            </div>
                            <div class="icon">
                                <i class="fa fa-solid fa-hourglass-half"></i>
                            </div>
                           

                        </div>

                    </div>
                    <div class="col-sm-3">
                        <!-- small box -->
                        <div class="small-box bg-primary" style="background-color: #dd4c39 !important;">
                            <div class="inner">
                                <h3>
                                    <?php
$month = date('m');
$year  = date('Y');

$sql = "SELECT SUM(CAST(amount AS DECIMAL(10,2))) AS totalDonation 
        FROM donations 
        WHERE MONTH(donation_date) = '$month' AND YEAR(donation_date) = '$year'";

$result = mysqli_query($con, $sql);
if (!$result) {
    die('Query Error: ' . mysqli_error($con));
}
$row = mysqli_fetch_assoc($result);

$currentMonthDonation = $row['totalDonation'] ?? 0;                                 
                                    
                                    echo $currentMonthDonation;
                                    ?>
                                </h3> 

                                <p>Current Month Donation</p>
                         
                            </div>
                            <div class="icon">
                                <i class="fa fa-solid fa-gift"></i>
                            </div>
                           

                        </div>

                    </div>
                </div>

                <!-- /.row -->
                 
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>


    <?php
    include('footer.php');
    ?>

    <?php
} else {

    echo "<script>window.open('../index.php','_self');</script>";
}
?>