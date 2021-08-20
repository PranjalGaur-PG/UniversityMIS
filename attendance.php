<?php
session_start();

require_once "pdo.php";
if(!isset($_SESSION['id']))die("Login first");


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
                            
<?php if(isset($_SESSION['id']))
                            echo '<li class="nav-item ml-lg-4">
                                <a href="logout.php">
                                    <div class="btn btn-primary px-0 px-lg-2">
                                    Logout
                                    </div>
                                </a>
                            </li>';
                            ?>
                        </ul>
                    </div>
                </div>
            </nav>

<?php 
    if($_SESSION['role']==0)
       { 
        $stmt = $pdo->prepare("SELECT * FROM attendance where sid = :xyz");
        $stmt->execute(array(":xyz" => $_SESSION['id']));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $attendance=isset($row['attendance'])?$row['attendance']:'Not Updated';
        echo'<h1 class="display-5 font-weight-bold mt-5 text-center">
                       Attendance: '.$attendance.'
            </h1>';
        }
    else{
        $stmt = $pdo->prepare("SELECT * FROM student s left join attendance a on a.sid=s.id");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(isset($_POST['sub'])){
    $stmt = $pdo->prepare("TRUNCATE TABLE attendance ");
        $stmt->execute();
          foreach ($rows as $key) {
            if(isset($_POST['sm'.$key['id']])){
        $stmt = $pdo->prepare('INSERT INTO attendance (sid, attendance) VALUES ( :uid, :fn)');

        $stmt->execute(array(
                ':uid' => $key['id'],
                ':fn' => $_POST['sm'.$key['id']])
        )
        ;}

        }
    $stmt = $pdo->prepare("SELECT * FROM student s left join attendance a on a.sid=s.id");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);}

       echo'<h1 class="display-5 font-weight-bold mt-5 text-center">
                Attendance
            </h1>
            <Form method="post">
            <table class="table table-striped mx-auto text-center" style="width:90%;">
                <thead>
    <tr><th scope="col">Name</th>
      <th scope="col">Attendance</th>
    </tr>
  </thead>
  <tbody>';$i=1;

  foreach ($rows as $key) {
      echo '
      <tr><td scope="row">'.$key['name'].'</td>
      <td><input type="number" name="sm'.$key['id'].'" value="'.(isset($key['attendance'])?$key['attendance']:0).'"></td>
    </tr>';
  }
    
   echo'
 
  </tbody>
            </table>
<button type="submit" name="sub" class="btn btn-block btn-primary mx-auto d-block">
                                    Submit
                                </button>
            </form>';

    }
?>
</body>
</html>