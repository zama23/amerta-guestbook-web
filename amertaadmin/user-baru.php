<?php 
  session_start();

  if(!isset($_SESSION["loginadmin"]) ) {
    header("Location: auth");
    exit;
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Buat User Guestbook</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/sb-admin-2.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Berkshire+Swash&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="css/login.css" />
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <div class="wrapper d-flex justify-content-center align-items-center vh-100">
      <div class="col-xl-4 col-md-6 rounded-4 p-5 bg-white">
        <h1 class="text-center mb-5 text-info">DAFTAR</h1>
        
        <?php 
          if(isset($_SESSION['daftarnotif'])):
        ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
          <?php echo $_SESSION['daftarnotif']; ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php 
      session_destroy();
        endif;
      ?>
        <form method="POST" action="proses.php" enctype="multipart/form-data">
          <div class="input-group flex-nowrap mb-4">
            <span class="input-group-text" id="addon-wrapping"><i class="fas fa-at text-info"></i></span>
            <input required type="text" class="form-control" name="username" placeholder="Username" />
          </div>
          <div class="input-group flex-nowrap mb-4">
            <span class="input-group-text" id="addon-wrapping"><i class="fas fa-heart text-info"></i></span>
            <input required type="text" class="form-control" name="namamempelai" placeholder="Nama Kedua Mempelai" />
          </div>
          <div class="input-group flex-nowrap mb-4">
            <span class="input-group-text" id="addon-wrapping"><i class="fas fa-link text-info"></i></span>
            <input required type="text" class="form-control" name="link" placeholder="Link Undangan" />
          </div>
          <div class="input-group flex-nowrap mb-4">
            <span class="input-group-text" id="addon-wrapping"><i class="fas fa-lock text-info"></i></span>
            <input required type="password" class="form-control" name="password" placeholder="Password" />
          </div>
          <div class="input-group flex-nowrap mb-4">
            <span class="input-group-text" id="addon-wrapping"><i class="fas fa-unlock text-info"></i></span>
            <input required type="password" class="form-control" name="password2" placeholder="Konfirmasi Password" />
          </div>
          <div class="input-group mb-4">
            <label class="input-group-text" for="inputGroupFile01"><i class="fas fa-tv text-info"></i></label>
            <input required type="file" class="form-control" name="image" accept="image/*" id="inputGroupFile01">
          </div>
          <div class="text-center">
            <button type="submit" name="daftar" class="btn btn-info">Daftar</button>
          </div>
        </form>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
