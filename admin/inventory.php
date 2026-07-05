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
        $records = mysqli_query($con, "select * from inventory WHERE delete_status='0'");
        while ($data = mysqli_fetch_array($records)) {

            if ($data['item_id'] == $id) {
                $donationId = $data['donation_id'];
                $itemName = $data['item_name'];
                $category = $data['category'];
                $quantity = $data['quantity'];
                $unit = $data['unit'];
                $receivedDate = $data['received_date'];
            }
        }
    } else {
        $id = "";
        $donationId = "";
        $itemName = "";
        $category = "";
        $quantity = "";
        $unit = "";
        $receivedDate = "";
    }
    ?>

    <title>Add Items</title>
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
                                                            ?> Update <?php } else { ?> Add <?php } ?> Items</h3>
                                    <a class="btn bg-primary btn-sm" href="view_items.php" style="background:#000 !important;"><i class="nav-icon fas fa-eye"></i> View Items</a>
                                </div>

                            </div>


                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="add_items.php" method="post">
                                <div class="card-body">



                                    <div class="row">
                                        <input type="hidden" name="itemId" value="<?php echo $id; ?>" id="itemId">

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Select Donations *</label>
                                                <select class="form-control" name="donationId" id="donationId" required>

                                                    <?php $qry = mysqli_query($con, "select * from donations WHERE delete_status='0' AND type !='Money'");
                                                    if ($id == "") {
                                                    ?>
                                                        <option value="" selected>Select </option>
                                                        <?php
                                                        while ($getData = mysqli_fetch_array($qry)) {
                                                        ?>
                                                            <option value="<?php echo $getData['donation_id']; ?>"><?php echo $getData['type']; ?></option>
                                                            <?php }
                                                    } else {
                                                        while ($getData = mysqli_fetch_array($qry)) {
                                                            if ($getData['donation_id'] == $donationId) { ?>
                                                                <option value="<?php echo $donationId; ?>" selected><?php echo $getData['type']; ?></option>
                                                            <?php continue;
                                                            } ?>
                                                            <option value="<?php echo $getData['donation_id']; ?>"><?php echo $getData['type']; ?></option>
                                                    <?php }
                                                    } ?>

                                                </select>

                                                <p class="text-danger"></p>

                                            </div>

                                        </div>


                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label> Item Name </label>
                                                <input type="text" name="itemName" id="itemName" value="<?php echo $itemName; ?>" class="form-control">
                                                <p class="text-danger"></p>

                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label> Category *</label>

                                                <select class="form-control" name="category" id="category" required>

                                                    <?php
                                                    if ($id == "") {
                                                    ?>
                                                        <option value="" selected>Select</option>
                                                        <?php $qry = mysqli_query($con, "SHOW COLUMNS FROM inventory LIKE 'category'");
                                                        $row = mysqli_fetch_assoc($qry);
                                                        $type = $row['Type'];
                                                        preg_match("/^enum\('(.*)'\)$/", $type, $matches);
                                                        $enumValues = explode("','", $matches[1]);
                                                        // print($enumValues);
                                                        foreach ($enumValues as $value) {
                                                            echo "<option value='{$value}'>{$value}</option>";
                                                        }
                                                    } else {
                                                        $qry = mysqli_query($con, "SHOW COLUMNS FROM inventory LIKE 'category'");
                                                        $row = mysqli_fetch_assoc($qry);
                                                        $type = $row['Type'];
                                                        preg_match("/^enum\('(.*)'\)$/", $type, $matches);
                                                        $enumValues = explode("','", $matches[1]);
                                                        $res = mysqli_query($con, "SELECT category FROM inventory WHERE item_id='$id' LIMIT 1");
                                                        if ($res && mysqli_num_rows($res) > 0) {
                                                            $data = mysqli_fetch_assoc($res);
                                                            $currentType = $data['category']; // the currently selected type
                                                        }
                                                        foreach ($enumValues as $value): ?>
                                                            <option value="<?php echo $value; ?>" <?php echo ($value == $currentType) ? 'selected' : ''; ?>>
                                                                <?php echo $value; ?>
                                                            </option>
                                                    <?php endforeach;
                                                    } ?>

                                                </select>

                                                <p class="text-danger"></p>


                                            </div>


                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label> Quantity</label>
                                                <input type="text" name="quantity" id="quantity" value="<?php echo $quantity; ?>" class="form-control">
                                                <p class="text-danger"></p>

                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Unit </label>
                                                <input type="text" class="form-control" name="unit" id="unit" value="<?php echo $unit; ?>">

                                                <p class="text-danger"></p>

                                            </div>

                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Received Date *</label>
                                                <input type="date" class="form-control" name="receivedDate" id="receivedDate" value="<?php echo $receivedDate; ?>" required>

                                                <p class="text-danger"></p>

                                            </div>

                                        </div>

                                    </div>
                                    <div class="row text-center">
                                        <div class="col-sm-12">
                                            <div class="submitBtn">
                                                <?php if (isset($_GET['id'])) {
                                                ?>
                                                    <button type="submit" name="addItem" class="btn btn-primary" style="margin-top: 31px;">Update</button>

                                                <?php  } else {
                                                ?>
                                                    <button type="submit" name="addItem" class="btn btn-primary" style="margin: 31px 0px;">Add</button>

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
        let today = new Date().toISOString().split('T')[0];
        $('#receivedDate').attr('max', today);

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