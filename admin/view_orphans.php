<?php
session_start();
if (isset($_SESSION['aid'])) {
    include('header.php');
    include('../connection.php');
?>
    <link href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css" rel="stylesheet">


    <title>View Orphan Details</title>
    <script type="text/javascript">
        function delRecord(id) {

            //   let text = "Do you want to delete??";
            //   if (confirm(text) == true) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    var check = "orphan";
                    var dataobj = {}
                    dataobj.app_no = id;
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            if (this.responseText == "Deleted") {

                                Swal.fire(
                                    'Deleted!',
                                    'Orphan details deleted successfully...',
                                    'success',
                                    'OK'
                                ).then((result) => {
                                    location.reload();
                                });


                            } else {
                                Swal.fire({
                                    text: 'Something went wrong. Please try again',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                                //alert("Something went wrong. Please try again");

                            }
                        }
                    };
                    xhttp.open("GET", "delete_records.php?id=" + id + "&check=" + check, true);
                    xhttp.send();
                } else {

                }
            });
        }
        // Delete Data Function Close
    </script>
    <?php
    include("sidebar.php");
    ?>
    <style>
        .bg-gradient-primary {
            background: #a6b71b linear-gradient(180deg, #268fff, #1065b9) repeat-x !important;

        }

        img {
            cursor: pointer;
        }

        @media print {
            .no-print {
                display: none !important;
            }

            .printC {
                display: block !important;
                background-color: #fff0 !important;
            }

            .modal-dialog {
                border: none;
            }

            .modal-body {
                border: none;
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
    </style>
    <?php

    ?>
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

    <!-- Content Wrapper. Contains page content -->
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
                <div class="card card-primary no-print">

                    <div class="card-header no-print">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">View Orphan Details</h3>
                            <a class="btn bg-primary btn-sm" href="orphans.php" style="background:#000 !important;"><i class="nav-icon fas fa-plus"></i> Add Orphan</a>


                        </div>
                    </div>

                    <div class="card-body no-print">

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>

                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Photo</th>
                                    <th>Gender</th>
                                    <th>Date Of Birth</th>

                                    <!-- <th>Age</th> -->

                                    <th>Health status</th>
                                    <th>Admission Date</th>
                                    <th>Guardian Name & Contact</th>
                                    <!-- <th>Guardian Contact</th> -->
                                    <th>Status</th>

                                    <th>Datetime</th>

                                    <th>Action</th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php
                                $records = mysqli_query($con, "SELECT * from orphans WHERE delete_status=0");

                                $x = 1;

                                while ($data = mysqli_fetch_array($records)) {

                                ?>
                                    <tr>
                                        <td><?php echo $x; ?></td>
                                        <td><?php echo $data['name']; ?></td>
                                        <td><img src="../dist/img/OrphanPhotos/<?php echo $data['photo']; ?>" onclick="showImg('../dist/img/OrphanPhotos/<?php echo $data['photo']; ?>')" width="100px" /></td>
                                        <td><?php echo $data['gender']; ?></td>
                                        <td><?php echo date("d M Y", strtotime(datetime: $data['dob']));  ?></td>

                                        <!-- <td><?php //echo $data['age']; 
                                                    ?></td> -->
                                        <td><?php echo $data['health_status']; ?></td>
                                        <td><?php echo date("d M Y", strtotime(datetime: $data['admission_date'])); ?></td>
                                        <td><?php echo $data['guardian_name']; ?><br><?php echo $data['guardian_contact']; ?></td>


                                        <td><?php echo $data['status']; ?></td>

                                        <td> <?php echo date("d M Y", strtotime(datetime: $data['created_at'])); ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <a name="edit" href="orphans.php?id=<?php echo $data['orphan_id']; ?>" class="btn btn-sm btn-success" style="padding: 8px;"><i class="fa fa-edit"></i></a>


                                                <a href="javascript:void(0);" onclick="delRecord(<?php echo $data['orphan_id'];  ?>)" class="btn btn-sm btn-danger" style="padding: 8px;"><i class="fa fa-trash" aria-hidden="true"></i></a>



                                            </div>
                                        </td>

                                    </tr>

                                <?php
                                    $x++;
                                }
                                ?>
                            </tbody>

                        </table>

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
    <?php include("footer.php"); ?>

    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <!--<script src="plugins/datatables-rowreorder/js/dataTables.rowReorder.js"></script>-->
    <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../plugins/jszip/jszip.min.js"></script>
    <script src="../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="..//plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>





    <script>
        function showImg(img_url) {
            document.getElementById("myimg").src = img_url;
            $('#myModal').modal('toggle');
        }
        <?php if (isset($_SESSION['edit'])) { ?>
            Swal.fire({
                text: '<?php echo $_SESSION['edit']; ?>',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        <?php
            unset($_SESSION['edit']);
        }

        if (isset($_SESSION['inserted'])) {
        ?>
            Swal.fire({
                text: '<?php echo $_SESSION['inserted']; ?>',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        <?php
            unset($_SESSION['inserted']);
        }
        if (isset($_SESSION['updated'])) {
        ?>
            Swal.fire({
                text: '<?php echo $_SESSION['updated']; ?>',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        <?php
            unset($_SESSION['updated']);
        }
        if (isset($_SESSION['exists'])) { ?>
            Swal.fire({
                text: '<?php echo $_SESSION['exists']; ?>',
                icon: 'info',
                confirmButtonText: 'OK'
            });
        <?php
            unset($_SESSION['exists']);
        }

        ?>

        $(function() {

            $("#example1").DataTable({
                "searching": true,
                //  serverSide: true,
                responsive: true,
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copy',
                        title: 'Orphan Details' // Title inside the file (for PDF/Excel)
                    },
                    {
                        extend: 'csv',
                        filename: 'Orphan_Details_CSV' // Name of CSV file
                    },
                    {
                        extend: 'excel',
                        filename: 'Orphan_Details_Excel', // Name of Excel file
                        title: 'Orphan Details'
                    },
                    {
                        extend: 'pdf',
                        filename: 'Orphan_Details_PDF', // Name of PDF file
                        title: 'Orphan Details'
                    },
                    {
                        extend: 'print',
                        title: 'Orphan Details'
                    }
                ]



            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');



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
        });
    </script>
<?php
    mysqli_close($con);
} else {
    header("location:../index.php");
}
?>