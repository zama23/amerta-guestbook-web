<?php
  include 'konek.php';
session_start();

  if(!isset($_SESSION["login"]) ) {
    header("Location: auth");
    exit;
  }

  $idusername = $_SESSION['usernameid'];
  $query = "SELECT * FROM data_tamu where user_id = '$idusername;'";
  $queryhadir = "SELECT * FROM data_tamu where user_id = '$idusername;' AND status = 'Hadir'";
  $querytidakhadir = "SELECT * FROM data_tamu where user_id = '$idusername;' AND status = 'tidak hadir'";
  $sql = mysqli_query($conn, $query);
  $totaltamu = mysqli_num_rows($sql);
  $tamuhadir = mysqli_num_rows(mysqli_query($conn,$queryhadir));
  $tamutidakhadir = mysqli_num_rows(mysqli_query($conn,$querytidakhadir));
  
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

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
            <img src="img/logo.png" alt="logo" width="25">
          </div>
          <div class="sidebar-brand-text mx-3">GUESTBOOK</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider mb-3" />

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active border-left-light" style="background: #2FA1B1; margin-left:10px; border-radius:20px 0px 0px 20px">
          <a class="nav-link" href="dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a
          >
        </li>

        <!-- Nav Item - List Tamu -->
        <li class="nav-item" style="margin-left:10px;">
            <a class="nav-link" href="tamu">
            <i class="fas fa-user-friends"></i>
            <span>List Tamu</span></a>
        </li>

        <!-- Nav Item - Maste Data -->
        <li class="nav-item" style="margin-left:10px;">
        <a class="nav-link" href="master">
        <i class="fas fa-database"></i>
        <span>Master Data</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block mt-4" />

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline" style="margin-top: 150px;">
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

            <!-- Topbar Search -->
            <!-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
              <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                <div class="input-group-append">
                  <button class="btn btn-info" type="button">
                    <i class="fas fa-search fa-sm"></i>
                  </button>
                </div>
              </div>
            </form> -->

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
                  <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                    <?php echo $_SESSION['username']; ?>
                  </span>
                  <img class="img-profile rounded-circle" src="img/undraw_profile_1.svg" />
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                  <a class="dropdown-item" href="akun">
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
            <h1 class="h3 mb-4 text-gray-800">Dahsboard</h1>
            <!-- <div class="container bg-white rounded pt-4 pb-3 mb-4">
              <h2 class="text-center text-gray-800"><b>Teuku Muhammad Agam & Cut Intan Dara</b></h2>
            </div> -->

            <!-- Content Row -->
            <div class="row">
              <!-- Total Tamu -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Tamu</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totaltamu; ?></div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

                            <!-- Tamu Hadir -->
                            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Tamu Hadir</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $tamuhadir; ?></div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-user-check fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Tamu Tidak Hadir</div>
                        <div class="row no-gutters align-items-center">
                          <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $tamutidakhadir; ?></div>
                          </div>
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-user-times fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Pending Requests Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2 bg-info">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col">
                        <a class="text-center text-white mt-3" href="https://google.com" target="_blank"><strong>DOWNLOAD APK</strong></a>
                      </div>
                      <div class="col-auto">
                        <a class="text-white" href="https://google.com" target="_blank"><i class="fab fa-android fa-2x"></i></a>
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
                        <!-- Content Row -->

                        <div class="row">
              <!-- Area Chart -->
              <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                  <!-- Card Header - Dropdown -->
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-info">Layar Awal</h6>
                    <div class="dropdown no-arrow">
                      <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="welcome" target="_blank">Buka Layar Awal</a>
                      </div>
                    </div>
                  </div>
                  <!-- Card Body -->
                  <div class="card-body">
                    <div>
                      <img src="layar-awal/<?php echo $_SESSION['imageuser']; ?>" class="img-fluid" alt="Responsive image" style="border: 5px solid #36b9cc">
                    </div>
                  </div>
                </div>
              </div>

              <!-- Pie Chart -->
              <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                  <!-- Card Header - Dropdown -->
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-info">Tutorial</h6>
                    <div class="dropdown no-arrow">
                      <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="tutorial.html" target="_blank">Lihat Tutorial</a>
                      </div>
                    </div>
                  </div>
                  <!-- Card Body -->
                  <div class="card-body text-center rounded-bottom text-info">
                  <i class="fas fa-question mb-4 fs-1"></i>
                      <p style="font-size: 12px;">Masih Bingung Menggunakan Buku Tamu ?</br>
                      Klik Tutorial Dibawah Untuk Melihat Cara Penggunaan <strong>Amerta Guestbook</strong></p>
                      <a href="tutorial.html" target="_blank" type="button" class="btn btn-info">Tutorial</a>
                  </div>
                </div>
              </div>
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

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
  </body>
</html>
