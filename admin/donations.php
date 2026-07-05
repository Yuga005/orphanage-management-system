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
        $records = mysqli_query($con, "select * from donations WHERE delete_status='0'");
        while ($data = mysqli_fetch_array($records)) {

            if ($data['donation_id'] == $id) {
                $donorId=$data['donor_id'];
                $amount = $data['amount'];
               $type=$data['type'];
               $description=$data['description'];
               $donationDate=$data['donation_date'];
              
                    
            }
        }
    } else {
        $id = "";
        $donorId = "";
        $amount="";
$type="";
$description="";
$donationDate="";
    }
    ?>

    <title>Add Donations</title>
       <!--<link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">-->


    <style>


        .bg-gradient-primary {
            background: #a6b71b linear-gradient(180deg, #268fff, #1065b9) repeat-x !important;

        }
              @media print
         {
             .no-print{
                 display: none !important;
             }
             .printC{
                 display: block !important;
                 background-color: #fff0 !important;
             }
           
         }
         @media (min-width: 576px){
             .modal-dialog {
                 max-width: 100%;
             }
         }
         @media (min-width: 992px){
             .modal-lg, .modal-xl {
    max-width: 100%;
}
         }
     

    </style>
    
                            <div class="modal fade printC" id="myModal">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header no-print">
                            
                                                                                                <a href="javaScript:void()" onclick="window.print()"  class="no-print btn btn-print"><i class="fa fa-print"></i> PRINT</a>

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
                                    ?> Update <?php }else{ ?> Add  <?php } ?> Donations</h3>
                                    <a class="btn bg-primary btn-sm" href="view_donations.php" style="background:#000 !important;"><i class="nav-icon fas fa-eye"></i> View Donations</a>
                                </div>

                            </div>


                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="add_donations.php" method="post">
                                <div class="card-body">



                                    <div class="row">
                                        <input type="hidden" name="donationId" value="<?php echo $id; ?>" id="donationId">

 <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Select Donor *</label>
                                                 <select class="form-control" name="donorId" id="donorId" required>
                                                 
                                                  <?php  $qry= mysqli_query($con, "select * from donors WHERE delete_status='0'"); 
                                              if($id==""){
                                                  ?>
                                              <option value="" selected>Select </option>
<?php
                                                  while($getData=mysqli_fetch_array($qry)){
                                                  ?>
                                                  <option value="<?php echo $getData['donor_id']; ?>"><?php echo $getData['name']; ?></option>
                                                  <?php }
                                              }else{
                                                       while($getData=mysqli_fetch_array($qry)){
                                               if($getData['donor_id']==$donorId){ ?>
                                                  <option value="<?php echo $donorId; ?>" selected><?php echo $getData['name']; ?></option>
                                                  <?php  continue;  } ?>
                                                      <option value="<?php echo $getData['donor_id']; ?>"><?php echo $getData['name']; ?></option>
                                             <?php }
                                              }?>
                                            
                                              </select>

                                                <p class="text-danger"></p>

                                            </div>

                                        </div>
  
                                    
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label> Amount </label>
                                                <input type="number" name="amount" id="amount"  value="<?php echo $amount; ?>" class="form-control">
                                                <p class="text-danger"></p>

                                            </div>
                                        </div>
                                                 <div class="col-sm-3">
                                                                                    <div class="form-group">
                                                <label> Donation Type *</label>

 <select class="form-control" name="type" id="type" required>
                                                 
                                                  <?php   
                                              if($id==""){
                                                  ?>
                                              <option value="" selected>Select</option>
                                                 <?php  $qry= mysqli_query($con, "SHOW COLUMNS FROM donations LIKE 'type'"); 
$row = mysqli_fetch_assoc($qry);
$type=$row['Type'];
preg_match("/^enum\('(.*)'\)$/", $type, $matches);
$enumValues = explode("','", $matches[1]); 
// print($enumValues);
            foreach ($enumValues as $value) {
    echo "<option value='{$value}'>{$value}</option>";
}
 }else{ 
                                          $qry= mysqli_query($con, "SHOW COLUMNS FROM donations LIKE 'type'"); 
$row = mysqli_fetch_assoc($qry);
$type=$row['Type'];
preg_match("/^enum\('(.*)'\)$/", $type, $matches);
$enumValues = explode("','", $matches[1]);   
                                             $res = mysqli_query($con, "SELECT type FROM donations WHERE donation_id='$id' LIMIT 1");
    if ($res && mysqli_num_rows($res) > 0) {
        $data = mysqli_fetch_assoc($res);
        $currentType = $data['type']; // the currently selected type
    }
     foreach ($enumValues as $value): ?>
        <option value="<?php echo $value; ?>" <?php echo ($value == $currentType) ? 'selected' : ''; ?>>
            <?php echo $value; ?>
        </option>
    <?php endforeach; } ?>
                                            
                                              </select>

                                                <p class="text-danger"></p>


                                            </div>
                                         

                                        </div>
                                      
                                     
                                          <div class="col-sm-3">
                                                                                    <div class="form-group">
                                                <label>Description </label>
                                                <input type="text" class="form-control" name="description"  id="description" value="<?php echo $description; ?>" >

                                                <p class="text-danger"></p>

                                            </div>

                                        </div>
                                            
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Donation Date *</label>
                                                <input type="date" class="form-control" name="donationDate" id="donationDate" value="<?php echo $donationDate; ?>" required>

                                                <p class="text-danger"></p>

                                            </div>

                                        </div>

 </div>
                                    <div class="row text-center">
                                    <div class="col-sm-12">
                                        <div class="submitBtn">
    <?php if (isset($_GET['id'])) {
        ?>
                                                <button type="submit" name="addDonation" class="btn btn-primary" style="margin-top: 31px;">Update</button>

                                            <?php  } else {
                                                ?>
                                                <button type="submit" name="addDonation" class="btn btn-primary" style="margin: 31px 0px;">Add</button>

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
       
$(document).ready(function () {
        let today = new Date().toISOString().split('T')[0];

      $('#donationDate').attr('max', today);

 
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

        $('.nav-link').each(function () {
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
} else {

    echo "<script>window.open('../index.php','_self');</script>";
}
?>