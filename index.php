<?php
// session_start();
include('connection.php');
if (isset($_SESSION['aid']) == null) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Login</title>
            <!-- Google Font: Source Sans Pro -->
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
            <!-- Font Awesome -->
            <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
            <!-- icheck bootstrap -->
            <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
            <!-- Theme style -->
            <link rel="stylesheet" href="dist/css/adminlte.min.css">
             <!-- favicon -->
	<!--<link rel="shortcut icon" href="dist/img/logo.png" />-->
            <script src="dist/js/sweetalert.min.js"></script>
        </head>
        <body class="hold-transition login-page">
             <style>
                            .btn-primary{
   
    background-color: #e51a4b !important;
    border-color: #e51a4b !important;
   
}
.card-outline{
     border-top: 3px solid #e51a4b !important;
}
.icheck-primary>input:first-child:checked+label::before {
    background-color: #e51a4b;
    border-color: #e51a4b;
}
.icheck-primary>input:first-child:not(:checked):not(:disabled):focus+label::before {
    border-color: #e51a4b !important;
}
            </style>
            <?php
            if (isset($_POST['username']) && isset($_POST['password'])) {
                $email = $_POST['username'];
                $pwd = $_POST['password'];


                if ($email && $pwd) {
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $email = mysqli_escape_string($con, $email);
                        
                        $query = mysqli_query($con, "Select * from admins where email='$email' LIMIT 1");
                        $num_rows = mysqli_num_rows($query);
                        if ($num_rows == 1) {
                            while ($row = mysqli_fetch_assoc($query)) {
//                                 echo $pwd;                                 echo "<br>";
//  echo $row['password'];
//                                 echo "<br>";

// $newHash = password_hash('admin123', PASSWORD_DEFAULT);
// echo $newHash;
                                // echo password_verify($pwd, $row['password']);
                                if(password_verify($pwd, $row['password'])){

                                $_SESSION['aid'] = $row['admin_id'];
                                $_SESSION['apass'] = $row['password'];
// echo "correct";
                                echo "<script>window.open('admin/dashboard.php','_self');</script>";
                          }else{
                        echo '<script>swal("Message!", "Enter Correct Email & Password!", "warning");</script>';
   
                        }
                      }
                        } else {
                            echo '<script>swal("Message!", "Enter Correct Email & Password!", "warning");</script>';
                        }
                    
                    } else {

                        echo '<script>swal("Message!", "Enter Valid Email Id!", "warning");</script>';
                    }
                } else {

                    echo '<script>swal("Message!", "Enter Email & Password!", "warning");</script>';
                }
            }
            ?>
            <div class="login-box">
                <!-- /.login-logo -->
                <div class="card card-outline card-primary">
                    <div class="card-header text-center">
                        <!--<img style="max-width:150px" src="dist/img/logo.png" alt="Satbara Logo" />-->
                        <h3>Helping Hands</h3>
                    </div>
                    <div class="card-body">
                        <p class="login-box-msg">Sign in to start your session</p>
                        <form action="<?php echo basename($_SERVER['PHP_SELF']); ?>" method="post">
                            <div class="input-group mb-3">
                                <input type="email" id="username" name="username" class="form-control" placeholder="Email">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <div class="icheck-primary">
                                        <input type="checkbox" id="remember">
                                        <label for="remember">
                                            Remember Me
                                        </label>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-4">
                                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.login-box -->
            <!-- jQuery -->
            <script src="plugins/jquery/jquery.min.js"></script>
            <!-- Bootstrap 4 -->
            <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
            <!-- AdminLTE App -->
            <script src="dist/js/adminlte.min.js"></script>
        </body>
    </html>
    <?php
} else {
    echo "<script>window.open('admin/dashboard.php','_self');</script>";
}
?>