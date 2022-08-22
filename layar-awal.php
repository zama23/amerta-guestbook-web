<?php
  include 'konek.php';
  session_start();
  date_default_timezone_set("Asia/Jakarta");

  if(!isset($_SESSION["login"]) ) {
    header("Location: masuk.php");
    exit;
  }

  $idusername = $_SESSION['usernameid'];
  $query = "SELECT * FROM data_tamu where user_id = '$idusername;'";
  $sql = mysqli_query($conn, $query);


  $date = date('Y-m-d H:i:s');

  $sqel = mysqli_query($conn, "SELECT * FROM data_tamu ORDER BY updated_at DESC LIMIT 1");
  $row = mysqli_fetch_assoc($sqel);

  $is_nodata = false;

  if( 
      strtotime(date($row['updated_at'])) >= strtotime(date("Y-m-d H:i:s")) 
  ){
    $is_nodata = false;
  } else {
    $is_nodata = true;
  }
  


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Layar Awal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/sb-admin-2.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Berkshire+Swash&display=swap" rel="stylesheet" />
    <style>
      .wrapper {
        background: url("layar-awal/<?php echo $_SESSION['imageuser']; ?>") no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
      }

      .tamu {
        display: <?php echo $is_nodata ? 'none' : 'show' ?>;
        height: 100vh;
        width: 100vw;
      }
      h1 {
        font-family: "Berkshire Swash", cursive;
      }
    </style>
    <!-- <link rel="stylesheet" href="css/login.css" /> -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <div class="wrapper d-flex justify-content-center align-items-center vh-100">
      <div class="container-fluid  bg-white tamu" style="padding-top: 190px; padding-bottom: 180px;"> 
        <h5 class="text-center text-info mt-5 mb-3">Selamat Datang</h5>
        <h1 class="text-center text-info">
        <?php
          echo $row['nama'];
        ?>
        </h1>
        <h6 class="text-center text-info">
          <?php
            echo $row['alamat'];
          ?>
        </h6>
      </div>
    </div>
    <script>
      setInterval(function() {
        window.location.reload();
      }, 2000);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  </body>
</html>
