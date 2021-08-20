<?php // Do not put any HTML above this line
session_start();
if(isset($_SESSION['id']))die("Logout first");
require_once "pdo.php";
$salt = 'Praks*_';

$failure = false;  // If we have no POST data

// Check to see if we have some POST data, if we do process it
if ( isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['name'])  ) {
    if ( strlen($_POST['email']) < 1 || strlen($_POST['pass']) < 1 || strlen($_POST['name']) < 1) {
        $_SESSION['error'] = "All fields are required";
        header("Location: index.php");
        return;
    }  else if (strpos($_POST['email'], "@") === false) {
        $_SESSION['error'] = "Email must have an at-sign (@)";
        header("Location: index.php");
        return;
    }else { 
        $em=$_POST['email'];
        $stmt = $pdo->prepare('SELECT * FROM student where email = :prof ');
        $stmt->execute(array(":prof" => $_POST['email']));
        $rows2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
         if (sizeof($rows2) > 0) {        
            $_SESSION['error'] = "Email already exists";
            header("Location: index.php");
            return;
        }

    
        $check = hash('md5', $salt . $_POST['pass']);
        $stmt = $pdo->prepare('INSERT INTO student (name, password, email) VALUES (  :fn, :ln, :em)');

        $stmt->execute(array(
                ':fn' => $_POST['name'],
                ':ln' => $check,
                ':em' => $_POST['email'])
        );
                
      
        $_SESSION['success'] = "Successfully Registered. Please Login";
        header("Location: index.php");
        return;
      

    }  


}
?>
    <!DOCTYPE html>
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
                                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
           
   <section class="bg-white h-100">
            <div class="container py-5">
                <div class="row">
                    <div class="order-lg-2 mb-3 mb-lg-0 col-lg-6 w-50 mx-auto">
                        <img src="./assets/bg-img-placeholder.png" class="h-100 w-100" alt="">
                    </div>
                    <div class="order-lg-1 col-lg-6">
                        <div class="card rounded shadow p-3 p-md-4">
                            <h3 class="text-center font-weight-bold text-primary">
                                Student's Register
                            </h3>
                            <form method="post">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="John Doe">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="johndoe@example.com">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="pass" id="password" >
                                </div>
                                <button type="submit" class="btn btn-block btn-primary mx-auto d-block">
                                    Submit
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

</body>
</html>