<?php 
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Amerta Guestbook - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/sb-admin-2.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Berkshire+Swash&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../css/login.css" />
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <div class="wrapper d-flex justify-content-center align-items-center vh-100">
      <div class="col-xl-4 col-md-6 rounded-4 p-5 bg-white">
        <h1 class="text-center text-info">AMERTA</h1>
        <p class="text-center mb-5 text-dark">Admin Page</p>
        <?php 
          if(isset($_SESSION['tamong'])):
        ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <?php echo $_SESSION['tamong']; ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php 
      unset($_SESSION["tamong"]);
        endif;
      ?>
        <form action="../proses.php" method="POST">
          <div class="input-group flex-nowrap mb-4">
            <span class="input-group-text bg-info border border-0" id="addon-wrapping"><i class="fas fa-envelope text-white"></i></span>
            <input type="text" class="form-control border border-info" name="username" placeholder="Username" aria-label="Username" aria-describedby="addon-wrapping" />
          </div>
          <div class="input-group flex-nowrap mb-4">
            <span class="input-group-text bg-info border border-0"" id="addon-wrapping"><i class="fas fa-lock text-white"></i></span>
            <input type="password" class="form-control border border-info" name="password" placeholder="Password" aria-label="Username" aria-describedby="addon-wrapping" />
          </div>
          <div class="text-center">
            <button type="submit" name="loginadmin" class="btn btn-info">Masuk</button>
          </div>
        </form>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
