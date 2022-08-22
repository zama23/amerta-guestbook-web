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

    <title>Amerta Guestbook - Master Data</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" />
    <!-- <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bulma.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet" />
  </head>

  <body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
      <!-- Sidebar -->
      <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
          <div class="sidebar-brand-icon">
            <img src="img/logo.png" alt="logo" width="25" />
          </div>
          <div class="sidebar-brand-text mx-3">GUESTBOOK</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider mb-3" />

        <!-- Nav Item - Dashboard -->
        <li class="nav-item" style="margin-left: 10px">
          <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a
          >
        </li>

        <!-- Nav Item - List Tamu -->
        <li class="nav-item" style="margin-left: 10px">
          <a class="nav-link" href="tamu.php">
            <i class="fas fa-user-friends"></i>
            <span>List Tamu</span></a
          >
        </li>

        <!-- Nav Item - Maste Data -->
        <li class="nav-item" style="margin-left: 10px; border-radius: 20px 0px 0px 20px" >
          <a class="nav-link" href="master-data.php">
            <i class="fas fa-database"></i>
            <span>Master Data</span></a
          >
        </li>

        <!-- Nav Item - Chek In Manual -->
        <li class="nav-item active border-left-light" style="background: #2fa1b1; margin-left: 10px; border-radius: 20px 0px 0px 20px">
          <a class="nav-link" href="manual.php">
          <i class="fas fa-check-circle"></i>
            <span>Check In Manual</span></a
          >
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
                <a class="nav-link dropdown-toggle" href="layar-awal.php" target="_blank">
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
            <h1 class="h3 mb-4 text-gray-800">Check In Manual</h1>
            <div class="container bg-white rounded pt-3 pb-2" style="box-shadow: rgba(0, 0, 0, 0.05) 0px 1px 2px 0px;">
              <h5 class="text-center text-info"><b><?php echo $_SESSION['namacp']; ?></b></h5>
            </div>
            <!-- Tabel -->
            <div class="card shadow mt-4 mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">Data Tamu</h6>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th class="text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      while($tamuu = mysqli_fetch_assoc($sql)){
                    ?>
                      <tr>
                        <td class="text-center"><?php echo ++$nomor; ?>.</td>
                        <td>
                          <span id="namatamu">
                            <?php echo $tamuu['nama']; 
                            ?>
                          </span>
                        </td>
                        <td>
                          <span id="alamattamu">
                            <?php echo $tamuu['alamat'] ?>
                          </span>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-info rounded-4" data-bs-toggle="modal" data-bs-target="#hadir" data-idtamu="<?php echo $tamuu['id']; ?>" data-nama="<?php echo $tamuu['nama']; ?>"><i class="fas fa-check-circle me-2"></i>Check In</button>
                        </td>
                      </tr>
                    <?php
                      }
                    ?> 
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- Tabel End -->
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

<!-- Modal Hapus -->
  <div class="modal fade" id="hadir" tabindex="-1" aria-labelledby="HadirLabel" aria-hidden="true">
  <form action="proses.php" method="POST">  
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="HadirLabel">Chek In</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <input type="hidden" name="idtamu" id="idtamu">
        <p>Chek In Manual <span style="font-weight: 700;" id="nama"></span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" name="checkin" class="btn btn-info">Chek In</button>
      </div>
    </div>
  </form>
  </div>
</div>
<!-- Modal Hapus End -->


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <!-- <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bulma.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bulma.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>

    <script>
      $(document).ready(function() {
    var table = $('#dataTable').DataTable( {
        lengthChange: false,
        buttons: [ 'colvis' ]
    } );

    // Insert at the top left of the table
    table.buttons().container()
        .appendTo( $('div.column.is-half', table.table().container()).eq(0) );
} );
    </script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <script>
        $(document).ready(function() {
          $('#hadir').on('show.bs.modal', function(event){
            var btn = $(event.relatedTarget),
                nama = btn.data('nama'),
                idtamu = btn.data('idtamu');
            
                $('#hadir').find('#nama').text(nama);
                $('#hadir').find('#idtamu').val(idtamu);
          })

        })
      </script>

    <script>
      const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
      const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
  </body>
</html>
