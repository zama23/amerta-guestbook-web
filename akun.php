<?php
  include 'konek.php';
  session_start();

  if(!isset($_SESSION["login"]) ) {
    header("Location: masuk.php");
    exit;
  }
  $idusername = $_SESSION['usernameid'];
  $query = "SELECT * FROM data_tamu where user_id = '$idusername;'";
  $sql = mysqli_query($conn, $query);
  $nomor = 0;
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Amerta Guestbook</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bulma.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bulma.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet" />
  </head>

  <body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
      <!-- Sidebar -->
      <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard">
          <div class="sidebar-brand-icon">
            <img src="img/logo.png" alt="logo" width="25" />
          </div>
          <div class="sidebar-brand-text mx-3">GUESTBOOK</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider mb-3" />

        <!-- Nav Item - Dashboard -->
        <li class="nav-item" style="margin-left: 10px">
          <a class="nav-link" href="dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a
          >
        </li>

        <!-- Nav Item - List Tamu -->
        <li class="nav-item" style="margin-left: 10px">
          <a class="nav-link" href="tamu">
            <i class="fas fa-user-friends"></i>
            <span>List Tamu</span></a
          >
        </li>

        <!-- Nav Item - Maste Data -->
        <li class="nav-item" style="margin-left: 10px">
          <a class="nav-link" href="master">
            <i class="fas fa-database"></i>
            <span>Master Data</span></a
          >
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block mt-4" />

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline" style="margin-top: 150px">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
      </ul>
      <!-- End of Sidebar -->

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
          <!-- Topbar -->
          <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-info d-md-none rounded-circle mr-3">
              <i class="fa fa-bars"></i>
            </button>

            <!-- Layar Awal -->
            <ul class="navbar-nav ml-auto">
              <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="welcome" target="_blank">
                  <i class="fas fa-desktop"></i>
                </a>
              </li>
              <!-- Layar Awal End -->

              <div class="topbar-divider d-none d-sm-block"></div>

              <!-- Nav Item - User Information -->
              <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['username']; ?></span>
                  <img class="img-profile rounded-circle" src="img/undraw_profile_1.svg" />
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                  <a class="dropdown-item" href="akun.php">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Pengaturan Akun
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Keluar
                  </a>
                </div>
              </li>
            </ul>
          </nav>
          <!-- End of Topbar -->

          <!-- Begin Page Content -->
          <div class="container-fluid">
            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Pengaturan Akun</h1>
            <div class="container-fluid bg-white rounded pt-4 pb-4" style="box-shadow: rgba(0, 0, 0, 0.05) 0px 1px 2px 0px;">
            <?php 
            if(isset($_SESSION["edituser"])):
            ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?php echo $_SESSION["edituser"]; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>  
              <?php 
                unset ($_SESSION["edituser"]);
                endif;
              ?>
            <h5 class="text-info mb-3">User Detail</h5>
            <hr class="sidebar-divider mb-4 mt-4" />
            <form method="POST" action="proses.php">
              <div class="mb-3 row">
                <label for="username" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="username" id="username" placeholder="<?php echo $_SESSION['username']; ?>" aria-label="Disabled input example" disabled>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="namacp" class="col-sm-2 col-form-label">Nama Mempelai</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="namacp" id="namacp"  value="<?php echo $_SESSION['namacp']; ?>">
                </div>
              </div>
              <div class="text-end">
                <button type="submit" name="update" id="updateuser" class="btn btn-info">Update</button>
              </div>
              </form>
            </div>
            <!--Ganti Password-->
            <div class="container-fluid bg-white rounded pt-4 pb-4 mt-4 mb-4" style="box-shadow: rgba(0, 0, 0, 0.05) 0px 1px 2px 0px;">
            <?php 
            if(isset($_SESSION["gantipasswordoke"])):
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Password Berhasil diubah
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
              unset ($_SESSION["gantipasswordoke"]);
              endif; 
            ?>
            <?php 
            if(isset($_SESSION["gantipassword"])):
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $_SESSION["gantipassword"] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
              unset($_SESSION["gantipassword"]);
              endif; 
            ?>
            <h5 class="text-info mb-3">Ganti Password</h5>
            <hr class="sidebar-divider mb-4 mt-4" />
            <form method="POST" action="proses.php">
              <div class="mb-3 row">
                <label for="Password" class="col-sm-2 col-form-label">Password Lama</label>
                <div class="col-sm-10">
                  <input type="password" required class="form-control" name="password" id="Password" placeholder="Masukan Password Lama">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="NewPassword" class="col-sm-2 col-form-label">Password Baru</label>
                <div class="col-sm-10">
                  <input type="password" required class="form-control" name="newpassword" id="NewPassword" placeholder="Masukan Password Baru">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="NewPasswordre" class="col-sm-2 col-form-label">Ulangi Password</label>
                <div class="col-sm-10">
                  <input type="password" required class="form-control" name="newpasswordre" id="NewPasswordre" placeholder="Konfirmasi Password Baru">
                </div>
              </div>
              <div class="text-end">
                <button type="submit" name="changepassword" id="changepassword" class="btn btn-success">Ubah Password</button>
              </div>
              </form>
            </div>
          </div>
          <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright &copy; Amerta Invitation 2022</span>
            </div>
          </div>
        </footer>
        <!-- End of Footer -->
      </div>
      <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Keluar?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Yakin ingin keluar dari akun ?</div>
          <div class="modal-footer">
            <button class="btn btn-danger" type="button" data-dismiss="modal">Batal</button>
            <a class="btn btn-info" href="logout.php">Keluar</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
