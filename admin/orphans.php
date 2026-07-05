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
        $records = mysqli_query($con, "select * from orphans WHERE status='Available' AND delete_status='0'");
        while ($data = mysqli_fetch_array($records)) {

            if ($data['orphan_id'] == $id) {
                //  $catId=$data['catid'];
                $name = $data['name'];
                $gender = $data['gender'];
                $dob = $data['dob'];
                $age = $data['age'];
                $healthStatus = $data['health_status'];
                $education = $data['education'];
                $admissionDate = $data['admission_date'];
                $photo = $data['photo'];
                $status = $data['status'];
                $guardianName = $data['guardian_name'];
                $guardianContact = $data['guardian_contact'];
            }
        }
    } else {
        $id = "";
        $name = "";
        $gender = "";
        $age = "";
        $education = "";
        $healthStatus = "";
        $dob = "";
        $admissionDate = "";
        $guardianName = "";
        $guardianContact = "";
        $photo = "";
        $status = "";
    }
    ?>

    <title>Add Orphans</title>
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
                max-width: 60%;
            }
        }

        @media (min-width: 992px) {

            .modal-lg,
            .modal-xl {
                max-width: 100%;
            }
        }

        .preview-container {
            margin-top: 15px;
        }

        .preview-container img {
            width: 60px;
            height: auto;
            border-radius: 8px;
            border: 2px solid #ccc;
            padding: 2px;
        }
    </style>

    <div class="modal fade printC" id="myModal">
        <div class="modal-dialog modal-dialog-centered modal-md">
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
                    <img id="myimg" class="img-responsive " src="" alt="" width="50%">
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
                                                            ?> Update <?php } else { ?> Add <?php } ?> Orphan</h3>
                                    <a class="btn bg-primary btn-sm" href="view_orphans.php" style="background:#000 !important;"><i class="nav-icon fas fa-eye"></i> View Orphans</a>
                                </div>

                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="add_orphan.php" enctype="multipart/form-data" method="post">
                                <div class="card-body">

                                    <div class="row">
                                        <input type="hidden" name="orphanId" value="<?php echo $id; ?>" id="OrphanId">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label> Name *</label>
                                                <input type="text" name="oname" id="oname" value="<?php echo $name; ?>" class="form-control" required>
                                                <p class="text-danger"></p>

                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label> Photo *</label>
                                                <input type="file" class="form-control" name="photo" id="orphanPhoto" required>

                                                <p id="photoError" class="text-danger"></p>
                                                <div class="preview-container" id="previewContainer"></div>


                                            </div>
                                            <?php if ($id != "") {
                                            ?>

                                                <img src="../dist/img/OrphanPhotos/<?php echo $photo; ?>" onclick="showImg('../dist/img/OrphanPhotos/<?php echo $photo ?>');" width="100" height="auto" id="changelogo" style="margin-bottom: 15px;" />
                                            <?php } ?>

                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Date Of Birth *</label>
                                                <input type="date" class="form-control" name="dob" id="dob" value="<?php echo $dob; ?>" required>

                                                <p id="dobError" class="text-danger"></p>

                                            </div>

                                        </div>
                                        <input type="hidden" name="age" id="age" value="<?php echo $age; ?>">

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Gender *</label>
                                                <select class="form-control" name="gender" id="gender" required>

                                                    <?php
                                                    if ($id == "") {
                                                    ?>
                                                        <option value="" selected>Select</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                        <?php    } else {

                                                        if ($gender == "Male") { ?>
                                                            <option value="Male" selected>Male</option>
                                                            <option value="Female">Female</option>

                                                        <?php } else { ?>
                                                            <option value="Female" selected>Female</option>
                                                            <option value="Male">Male</option>

                                                    <?php }
                                                    } ?>

                                                </select>

                                                <p class="text-danger"></p>

                                            </div>

                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Admission Date *</label>
                                                <input type="date" class="form-control" name="admissionDate" id="admissionDate" value="<?php echo $admissionDate; ?>" required>

                                                <p class="text-danger"></p>

                                            </div>

                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Health Status </label>
                                                <input type="text" class="form-control" name="healthStatus" id="healthStatus" value="<?php echo $healthStatus; ?>">

                                                <p class="text-danger"></p>

                                            </div>

                                        </div>


                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Education </label>
                                                <input type="text" class="form-control" name="education" id="education" value="<?php echo $education; ?>">

                                                <p class="text-danger"></p>

                                            </div>

                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Guardian Name </label>
                                                <input type="text" class="form-control" name="guardianName" id="guardian_name" value="<?php echo $guardianName; ?>">

                                                <p class="text-danger"></p>

                                            </div>


                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Guardian Contact </label>
                                                <input type="text" class="form-control" name="guardianContact" id="guardianContact" value="<?php echo $guardianContact; ?>">

                                                <p class="text-danger"></p>

                                            </div>


                                        </div>


                                    </div>
                                    <div class="row text-center">
                                        <div class="col-sm-12">
                                            <div class="submitBtn">
                                                <?php if (isset($_GET['id'])) {
                                                ?>
                                                    <button type="submit" name="addOrphan" class="btn btn-primary" style="margin-top: 31px;">Update</button>

                                                <?php  } else {
                                                ?>
                                                    <button type="submit" name="addOrphan" class="btn btn-primary" style="margin: 31px 0px;">Add</button>

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
        if ('<?php echo isset($_GET['id']); ?>' === '1') {



            $('#photo').removeAttr('required');
        }
        let today = new Date().toISOString().split('T')[0];
        $('#dob').attr('max', today);
        $('#admissionDate').attr('max', today);

        $('#dob').on('change', function() {
            const dob = new Date($(this).val());
            const today = new Date();

            // Calculate age
            let age = today.getFullYear() - dob.getFullYear();
            const monthDiff = today.getMonth() - dob.getMonth();

            // Adjust age if birthday hasn’t occurred yet this year
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
                age--;
            }

            if (age > 18) {
                $('#dobError').text('Age should be less than 18 years');
                $(this).val(''); // Clear invalid DOB
            } else {
                $('#age').val(age);
                $('#dobError').text('');
            }
        });

        function showImg(img_url) {
            document.getElementById("myimg").src = img_url;
            $('#myModal').modal('toggle');
        }
        $('#orphanPhoto').on('change', function() {
            
            const file = this.files[0];
            const errorMsg = $('#photoError');
            const previewContainer = $('#previewContainer');

            errorMsg.text(''); // Clear previous errors
            previewContainer.empty(); // Clear previous preview
            var orphanId = "<?php echo isset($id) ? $id : ''; ?>";
            // 🟢 If editing an existing orphan and selecting a new image → remove old preview
            if (orphanId !== '' && file) {
                previewContainer.empty();
            }
            if (!file) return; // If no file selected

            const fileType = file.type;
            const validImageTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];

            if (!validImageTypes.includes(fileType)) {
                errorMsg.text('Please select a valid image file (JPG, PNG, GIF, WEBP).');
                $(this).val(''); // Reset file input
                return;
            }

            const reader = new FileReader();
            // reader.onload = function(e) {
            //   previewContainer.html('<img src="' + e.target.result + '" alt="Selected Image">');
            // };
            // reader.readAsDataURL(file);
            reader.onload = function(e) {
                // 🟢 Clear the container first, then add the new image
                $('#changelogo').remove(); // remove old image

                previewContainer.html('<img src="' + e.target.result + '" alt="Selected Image" width="200">');
            };
            reader.readAsDataURL(file);
        });

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