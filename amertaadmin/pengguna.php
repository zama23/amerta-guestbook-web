<?php
  include '../konek.php';
  session_start();
  
  if(!isset($_SESSION["loginadmin"]) ) {
    header("Location: auth");
    exit;
  }

  $query = "SELECT * FROM data_user;";
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
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="server">
          <div class="sidebar-brand-icon">
            <img src="img/logo.png" alt="logo" width="25" />
          </div>
          <div class="sidebar-brand-text mx-3">GUESTBOOK</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider mb-3" />

        <!-- Nav Item - Dashboard -->
        <li class="nav-item" style="margin-left: 10px">
          <a class="nav-link" href="server">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a
          >
        </li>

        <!-- Nav Item - List Tamu -->
        <li class="nav-item active border-left-light" style="background: #2FA1B1; margin-left:10px; border-radius:20px 0px 0px 20px">
          <a class="nav-link" href="users">
            <i class="fas fa-user-friends"></i>
            <span>User</span></a
          >
        </li>

        <!-- Nav Item - Maste Data -->
        <li class="nav-item" style="margin-left: 10px">
          <a class="nav-link" href="newuser">
            <i class="fas fa-database"></i>
            <span>Tambah User</span></a
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
                  <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['adminnama']; ?></span>
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
            <h1 class="h3 mb-4 text-gray-800">Master Data</h1>
            
            <!-- Session Edit -->
            <?php
            if(isset($_SESSION['editusers'])):
            ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['editusers']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php 
                unset ($_SESSION["editusers"]);
                endif;
              ?>
            <!-- Session Edit End -->

            <!-- Session Hapus -->
            <?php
            if(isset($_SESSION['hapustamu'])):
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              Berhasil Menghapus Tamu
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                unset ($_SESSION["hapustamu"]);
                endif;
              ?>
            <!-- Session Hapus End -->

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
                        <th>Username</th>
                        <th>Nama Mempelai</th>
                        <th class="text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      while($tamuu = mysqli_fetch_assoc($sql)){
                    ?>
                      <tr>
                        <td class="text-center"><?php echo ++$nomor; ?>.</td>
                        <td><?php echo $tamuu['username']; ?></td>
                        <td><?php echo $tamuu['namamempelai'] ?></td>
                        <td class="text-center">
                          <a href="https://amertainvitation.my.id/<?php echo $tamuu['link'];?>" target="_blank" type="button" class="btn btn-dark btn-sm rounded-5"><i class="fas fa-link" data-bs-toggle="tooltip" data-bs-title="Buka Undangan"></i></a>
                          <button type="button" class="btn btn-primary btn-sm rounded-5" data-bs-toggle="modal" data-bs-target="#EditData" data-idtamu="<?php echo $tamuu['id'] ?>" data-nama="<?php echo $tamuu['username']; ?>"><i class="fas fa-pencil-alt" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Data"></i></button>
                          <!-- <a href="proses.php?hapus=<?php echo $tamuu['id']; ?>" type="button" class="btn btn-danger btn-sm rounded-5"><i class="fas fa-times" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data"></i></a> -->
                          <a type="button" class="btn btn-danger btn-sm rounded-5" data-bs-toggle="modal" data-nama="<?php echo $tamuu['username']; ?>" data-idtamu="<?php echo $tamuu['id'] ?>" data-bs-target="#HapusData">
                            <i class="fas fa-times" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data"></i>
                          </a>
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

    <!-- Modal Edit Data -->
    <div class="modal fade text-start" id="EditData" tabindex="-1" aria-labelledby="EditDataLabel" aria-hidden="true">
      <form action="proses.php" method="POST">  
      <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="EditDataLabel">Edit User</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <input type="hidden" value="ID Tamu" name="id" id="edit-id">
              <div class="mb-3">
                <label for="NamaTamu" class="form-label"><b>Username</b></label>
                <input type="text" class="form-control" name="username" id="edit-nama" />
              </div>
              <div class="mb-3">
                <label for="password" class="form-label"><b>Password Baru</b></label>
                <input type="password" class="form-control" name="password" />
              </div>
              <div class="mb-3">
                <label for="password" class="form-label"><b>Ulangi Password</b></label>
                <input type="password" class="form-control" name="repassword" />
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
              <button type="submit" name="edituser" id="edit-tombol" class="btn btn-info btn-sm">Simpan</button>
            </div>
          </div>
          </form>
        </div>
      </div>
    <!-- Modal Edit Data END -->

<!-- Modal Hapus -->
  <div class="modal fade" id="HapusData" tabindex="-1" aria-labelledby="HapusDataLabel" aria-hidden="true">
  <form action="proses.php" method="POST">  
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="HapusDataLabel">Hapus Tamu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <input type="hidden" name="iduser" id="idtamu">
        <p>Yakin ingin menghapus <span id="nama">nama</span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" name="off" class="btn btn-danger">Hapus</button>
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
          $('#EditData').on('show.bs.modal', function(event){
            var btn = $(event.relatedTarget),
                nama = btn.data('nama'),
                id = btn.data('idtamu');
            
                $('#EditData').find('#edit-id').val(id);
                $('#EditData').find('#edit-nama').val(nama);
          })

          $('#HapusData').on('show.bs.modal', function(event){
            var btn = $(event.relatedTarget),
                nama = btn.data('nama'),
                idtamu = btn.data('idtamu');
            
                $('#HapusData').find('#nama').text(nama);
                $('#HapusData').find('#idtamu').val(idtamu);
          })

        })
      </script>

    <script>
      const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
      const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
  </body>
</html>