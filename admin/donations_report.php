<?php
session_start();
if (isset($_SESSION['aid'])) {
    include('header.php');
    include('../connection.php');
    ?>
    <link href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet">
        <link href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css" rel="stylesheet">

     
    <title>Donations Report</title>
    
    <?php
    include("sidebar.php");
    ?>
    <style>
        .bg-gradient-primary {
            background: #a6b71b linear-gradient(180deg,#268fff,#1065b9) repeat-x!important;

        }
        img{
            cursor: pointer;
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
           .modal-dialog{
                 border: none;
             }
             .modal-body{
                 border: none;
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
    <?php 
 
    ?>
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
                            <h3 class="card-title">Donations Report</h3>
                            <!-- <a class="btn bg-primary btn-sm" href="donations.php" style="background:#000 !important;"><i class="nav-icon fas fa-plus"></i> Add Donations</a> -->


                        </div>
                    </div>
             
                    <div class="card-body no-print">
 <form method="get">
                                <div class="card-body">



                                    <div class="row">

 
                                    
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label> Donation Type </label>
                                                 <select class="form-control" name="type" id="type">
                                                    <option value="" selected disabled>Select</option>
                                                <?php  $qry= mysqli_query($con, "SHOW COLUMNS FROM donations LIKE 'type'"); 
$row = mysqli_fetch_assoc($qry);
$type=$row['Type'];
preg_match("/^enum\('(.*)'\)$/", $type, $matches);
$enumValues = explode("','", $matches[1]); 
// print($enumValues);
            foreach ($enumValues as $value) {
    echo "<option value='{$value}'>{$value}</option>";
}   
?>
  
                                                </select>

                                            </div>
                                        </div>
                                              
                                        
              
                                        
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                 <label>From Date</label>
        <input type="date" id="from" class="form-control">

                                            </div>

                                        </div>
                                             <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>To Date</label>
        <input type="date" id="to" class="form-control">

                                            </div>

                                        </div>
                                          
                                         

 </div>
                                   
                                    
                                    
                            </form>

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>

                                <tr>
                                     <th>Id</th>
                                      <th>Donor Name</th>
                                                                            <th>Donor Contact</th>

                                       <th>Amount</th>
                                        <th>Donation Type </th>
                                                                                <th>Description</th>
       
                                      <th>Donation Date</th>
                                   
   <th>Action</th>
                                </tr>

                            </thead>
                            <tbody>
                                 <?php
                                $records = mysqli_query($con, "SELECT donations.*, donors.name, donors.phone 
    FROM donations 
    JOIN donors ON donors.donor_id = donations.donor_id 
    WHERE donors.delete_status='0' AND donations.delete_status='0'");
                               
                                $x = 1;

                                while ($data = mysqli_fetch_array($records)) {
       
                                    ?>
                                    <tr>
                                        <td><?php echo $x; ?></td>
                                         <td><?php echo $data['name']; ?></td>
                                         <td><?php echo $data['phone']; ?></td>
                                             
                                         <td><?php echo $data['amount']; ?></td>
                                         <td><?php echo $data['type']; ?></td>
                                                                                  <td><?php echo $data['description']; ?></td>

                                            
                                         <td> <?php echo date("d M Y",strtotime(datetime: $data['donation_date'])); ?></td>
                                        <td><div class="btn-group">
                                                <a name="edit" href="donations.php?id=<?php echo $data['donor_id']; ?>" class="btn btn-sm btn-success" style="padding: 8px;"><i class="fa fa-edit"></i></a>
                          

                                                <a href="javascript:void(0);" onclick="delRecord(<?php echo $data['donation_id'];  ?>)" class="btn btn-sm btn-danger" style="padding: 8px;"><i class="fa fa-trash" aria-hidden="true"></i></a> 



                                            </div></td>

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
      

                                                $(function () {

                                                    $("#example1").DataTable({
                                                        "searching": true,
                                                            //  serverSide: true,
                                                             responsive:true,
                      
                                                                             dom: 'Bfrtip',
                                                                             columnDefs: [{
                                                                                 orderable: false,
                                                    }],
                                                                              "order": [[1, "asc"]],
         buttons: [
            {
                extend: 'copy',
                title: 'Donation List'   // Title inside the file (for PDF/Excel)
            },
            {
                extend: 'csv',
                filename: 'Donation_List_CSV' // Name of CSV file
            },
            {
                extend: 'excel',
                filename: 'Donation_List_Excel', // Name of Excel file
                title: 'Donation_List'
            },
            {
                extend: 'pdf',
                filename: 'Donation_List_PDF',   // Name of PDF file
                title: 'Donation_List'
            },
            {
                extend: 'print',
                title: 'Donation_List'
            }
        ]


         

                                                       
                                                    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                                                

                                                
     var path = window.location.href.substr(window.location.href.lastIndexOf("/")+1);
    var table = $('#example1').DataTable();
   
function applyFilters() {
    let name = $('#type').val().trim().toLowerCase();
    let from = $('#from').val();
    let to = $('#to').val();

    table.draw();
}

// Custom filtering
$.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {

    let nameFilter = $('#type').val().trim().toLowerCase();
    // let genderFilter = $('#gender').val().trim().toLowerCase();
    let from = $('#from').val();
    let to = $('#to').val();

    let rowName = data[4].trim().toLowerCase();      // column 1 = name
    // let rowGe = data[3].trim().toLowerCase();    // column 2 = gender
     let rowDate = (data[6] || "").replace(
    /(\d{2}) (\w{3}) (\d{4})/,
    function(_, d, m, y) {
        const months = {Jan:"01",Feb:"02",Mar:"03",Apr:"04",May:"05",Jun:"06",Jul:"07",Aug:"08",Sep:"09",Oct:"10",Nov:"11",Dec:"12"};
        return `${y}-${months[m]}-${d}`;
    }
);                         // column 3 = date YYYY-MM-DD

    // 🔹 Name filter
    if (nameFilter && !rowName.includes(nameFilter)) {
        return false;
    }

    // 🔹 Gender filter ("" means ALL)
    // if (genderFilter && rowGender !== genderFilter) {
    //     return false;
    // }

    // 🔹 Date range
    if (from && rowDate < from) return false;
    if (to && rowDate > to) return false;

    return true;
});

// Trigger on change
$('#type, #from, #to').on('change keyup', applyFilters);
table.on('order.dt search.dt draw.dt', function () {
    table.column(0, { search: 'applied', order: 'applied' })
        .nodes()
        .each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
}).draw();
    $('.nav-link').each(function() {
        var hrefVal=$(this).attr('href');
       // alert(hrefVal == path)
        if(hrefVal == path){
         
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