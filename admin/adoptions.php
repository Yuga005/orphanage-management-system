<?php
session_start();

if (isset($_SESSION['aid'])) {

    include('header.php');
    include('sidebar.php');
    include('../connection.php');
?>

    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $records = mysqli_query($con, "select * from adoptions WHERE delete_status='0'");
        while ($data = mysqli_fetch_array($records)) {

            if ($data['adoption_id'] == $id) {
                $orphanId = $data['orphan_id'];

                $name = $data['adopter_name'];
                $email = $data['adopter_email'];
                $phone = $data['adopter_phone'];
                $address = $data['adopter_address'];
                $adoptionDate = $data['adoption_date'];
                $status = $data['status'];
            }
        }
    } else {
        $id = "";
        $orphanId = "";
        $name = "";
        $email = "";
        $phone = "";
        $address = "";
        $adoptionDate = "";
        $status = "";
    }
    ?>

    <title>Add Adoption Details</title>
    <!--<link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">-->


    <style>
        .bg-gradient-primary {
            background: #a6b71b linear-gradient(180deg, #268fff, #1065b9) repeat-x !important;

        }

        @media print {
            .no-print {
                display: none !important;
            }

            .printC {
                display: block !important;
                background-color: #fff0 !important;
            }

        }

        @media (min-width: 576px) {
            .modal-dialog {
                max-width: 100%;
            }
        }

        @media (min-width: 992px) {

            .modal-lg,
            .modal-xl {
                max-width: 100%;
            }
        }
    </style>

    <div class="modal fade printC" id="myModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header no-print">

                    <a href="javaScript:void()" onclick="window.print()" class="no-print btn btn-print"><i class="fa fa-print"></i> PRINT</a>

                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body" align="center">
                    <!--<div class="row">-->
                    <!--<div class="col-md-9">-->
                    <img id="myimg" class="img-responsive " src="" alt="" width="">
                    <!--</div>-->
                    <!--                                    <div class="col-md-3 no-print">
                                                                <a href="javaScript:void()" onclick="window.print()"  class="no-print btn btn-print"><i class="fa fa-print"></i> PRINT</a>

                                    </div>-->
                    <!--</div>-->

                </div>



            </div>
        </div>
    </div>

    <div class="content-wrapper no-print">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <!-- /.container-fluid -->
        </section>
        <!-- /.container-fluid -->
        <section class="content">
            <div class="container-fluid">

                <!-- left column -->

                <!-- general form elements -->
                <div class="row">
                    <div class="col-lg-12 col-12">

                        <div class="card card-primary">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title"> <?php if (isset($_GET['id'])) {
                                                            ?> Update <?php } else { ?> Add <?php } ?> Adoption Details </h3>
                                    <a class="btn bg-primary btn-sm" href="view_adoptions.php" style="background:#000 !important;"><i class="nav-icon fas fa-eye"></i> View Adoptions</a>
                                </div>

                            </div>


                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="add_adoption.php" method="post">
                                <div class="card-body">



                                    <div class="row">
                                        <input type="hidden" name="adoptionId" value="<?php echo $id; ?>" id="adoptionId">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Select Orphan *</label>
                                                <select class="form-control" name="orphanId" id="orphanId" required>

                                                    <?php $qry = mysqli_query($con, "select * from orphans WHERE delete_status='0' AND status='Available'");
                                                    if ($id == "") {
                                                    ?>
                                                        <option value="" selected>Select </option>
                                                        <?php
                                                        while ($getData = mysqli_fetch_array($qry)) {
                                                        ?>
                                                            <option value="<?php echo $getData['orphan_id']; ?>"><?php echo $getData['name']; ?></option>
                                                            <?php }
                                                    } else {
                                                        while ($getData = mysqli_fetch_array($qry)) {
                                                            if ($getData['orphan_id'] == $orphanId) { ?>
                                                                <option value="<?php echo $orphanId; ?>" selected><?php echo $getData['name']; ?></option>
                                                            <?php continue;
                                                            } ?>
                                                            <option value="<?php echo $getData['orphan_id']; ?>"><?php echo $getData['name']; ?></option>
                                                    <?php }
                                                    } ?>

                                                </select>

                                                <p class="text-danger"></p>

                                            </div>

                                        </div>


                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label> Adopter Name *</label>
                                                <input type="text" name="aname" id="aname" value="<?php echo $name; ?>" class="form-control" required>
                                                <p class="text-danger"></p>

                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label> Adopter Email </label>
                                                <input type="email" class="form-control" name="email" id="email" value="<?php echo $email; ?>">

                                                <p class="text-danger"></p>


                                            </div>


                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Adopter Mobile No *</label>
                                                <input type="text" class="form-control" name="mobile" id="mobile" value="<?php echo $phone; ?>" required>

                                                <p class="text-danger"></p>

                                            </div>

                                        </div>



                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Adopter Address *</label>
                                                <input type="text" class="form-control" name="address" id="address" value="<?php echo $address; ?>" required>

                                                <p class="text-danger"></p>

                                            </div>

                                        </div>



                                    </div>
                                    <div class="row text-center">
                                        <div class="col-sm-12">
                                            <div class="submitBtn">
                                                <?php if (isset($_GET['id'])) {
                                                ?>
                                                    <button type="submit" name="addAdoption" class="btn btn-primary" style="margin-top: 31px;">Update</button>

                                                <?php  } else {
                                                ?>
                                                    <button type="submit" name="addAdoption" class="btn btn-primary" style="margin: 31px 0px;">Add</button>

                                                <?php }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                            </form>



                        </div>





                    </div>


                </div>
                <!-- /.card -->

                <!--/.col (right) -->

                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->

    </div>

    <?php
    include("footer.php");
    ?>

    <script src="../dist/js/sweetalert.min.js"></script>



    <script src="../plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <script>
        function showImg(img_url) {
            document.getElementById("myimg").src = img_url;
            $('#myModal').modal('toggle');
        }


        <?php

        if (isset($_SESSION['error'])) {
        ?>
            Swal.fire({
                text: 'Something went wrong',
                icon: 'error',
                confirmButtonText: 'OK'
            });

        <?php
            unset($_SESSION['error']);
        }

        ?>


        var path = window.location.href.substr(window.location.href.lastIndexOf("/") + 1);

        $('.nav-link').each(function() {
            var hrefVal = $(this).attr('href');
            // alert(hrefVal == path)
            if (hrefVal == path) {

                // $(this).addClass('active');
                $(this).parents(".forActive").find(".subActive").addClass('active');
                $(this).parents(".forActive").siblings('li').find('a').removeClass('active');
                $(this).parents(".forActive").addClass('menu-is-opening');
                $(this).parents(".forActive").addClass('menu-open');
                $(this).parents(".forActive").siblings('li').removeClass('menu-open');
                $(this).parents(".forActive").siblings('li').removeClass('menu-is-opening');
                $(this).addClass('treeActive');
                $(this).siblings().removeClass('treeActive');
                $(this).parents(".forActive").siblings('li').find('a').removeClass('treeActive');

            }
        });
    </script>
<?php
} else {

    echo "<script>window.open('../index.php','_self');</script>";
}
?>