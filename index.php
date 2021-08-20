<?php
session_start();

?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous"><script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
</head>
<body>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>

            <!-- Navbar Dark -->
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
                <div class="container-fluid">
                    <a class="navbar-brand" href="index.php">
                        <span class="">University Management</span>
                    </a>
                    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="navbar-collapse collapse" id="navbarTogglerDemo02" style="">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Home</a>
                            </li>
                            
                        <?php if(isset($_SESSION['id']))
                            echo '<li class="nav-item ml-lg-4">
                                <a href="logout.php">
                                    <div class="btn btn-primary px-0 px-lg-2">
                                    Logout
                                    </div>
                                </a>
                            </li>';
                            else {
                               echo '<li class="nav-item ml-lg-4">
                                <a class="nav-link" aria-current="page" href="student_register.php">Student Register</a>
                            </li>'; 
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </nav>
   <?php
if(isset($_SESSION['success'])){
  echo '<div class="alert alert-success" role="alert">'.$_SESSION['success'].'</div>';
  unset($_SESSION['success']);
}
if(isset($_SESSION['error'])){
  echo '<div class="alert alert-danger" role="alert">'.$_SESSION['error'].'</div>';
  unset($_SESSION['error']);
}
?>
<section class="h-100">
            <div class="position-absolute h-100 w-100" ></div>
            <div class="container h-100 py-5">
                <div class="row h-100 justify-content-between align-items-center">
                    <div class="col-lg-5 h-50">
                        <div class="d-flex flex-column h-100 justify-content-between text-center text-lg-left">
                            <h1 class="font-weight-bold">
                                University Management System
                            </h1>
                            <h5 class="text-muted font-weight-normal">
                                Made By:<br>Prakhar Saxena<br>2019021103<br>B.TECH. CSE Sec-'B'
                            </h5>
                            <?php if(isset($_SESSION['id']))
                            echo '<div style="z-index: 5;">
                                <a href="attendance.php"><button class="btn btn btn-primary">
                                  View Attendance
                                 </button></a>
                                <a href="marks.php"><button class="btn btn btn-primary">
                                   View Marks
                                </button></a>
                            </div>';
                            else echo'
                            <div style="z-index: 5;">
                                <a href="teacher_login.php"><button class="btn btn btn-primary">
                                  Teacher Login 
                                 </button></a>
                                <a href="student_login.php"><button class="btn btn btn-primary">
                                   Student Login 
                                </button></a>
                            </div>';
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-5 mt-3 mt-lg-0">
                        <img src="./assets/bg-img-placeholder.png" class="h-100 w-100" alt="">
                    </div>
                </div>
            </div>
        </section>
</body>
</html>