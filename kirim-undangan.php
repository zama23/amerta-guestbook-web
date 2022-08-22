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
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">


  </head>
  <body>
    <div class="container-fluid ps-0 pe-0 pt-3 pb-3 mb-5 text-center" style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
      <img src="img/Logo-Shop-768x244.png" height="50" width="auto" />
    </div>

    <div class="container bg-white rounded pt-4 pb-3" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
      <h5 class="text-center"><b><?php echo $_SESSION['namacp']; ?></b></h5>
    </div>

    <div class="container bg-white rounded pt-4 pb-3 mt-5" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
      <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Text Pengantar</label>
        <textarea class="form-control" id="ucapan" rows="6">Tanpa mengurangi rasa hormat, perkenankan kami mengundang Bapak/Ibu/Saudara/i %nama-tamu% untuk menghadiri acara kami.
break
*Berikut link undangan kami*, untuk info lengkap dari acara bisa kunjungi :
break
%link-undangan%
break
Merupakan suatu kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan untuk hadir dan memberikan doa restu.
break
*Mohon maaf perihal undangan hanya di bagikan melalui pesan ini.*
break
Dan karena suasana masih pandemi, diharapkan untuk *tetap menggunakan masker dan datang pada jam yang telah ditentukan.*
break
Terima kasih banyak atas perhatiannya.</textarea>
      </div>
      <div class="text-end">
        <button type="button" class="btn btn-primary" id="save-ucapan">Simpan</button>
      </div>
    </div>

    <div class="container bg-white rounded pt-4 pb-3 mt-5 d-none" id="tabel-tamu" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
      <p><strong>Daftar Nama Tamu</strong></p>
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
          <?php
            while($tamuu = mysqli_fetch_assoc($sql)){
          ?>
            <tr>
              <td class="text-center">
                <?php echo ++$nomor; ?>. <span class="d-none"> <?php echo $tamuu['id'] ?> </span>
              </td>
              <td>
                  <?php echo $tamuu['nama']; ?>
              </td>
              <td class="text-center">
              <div class="d-grid gap-2">
                <a id="buka-undangan" class="btn btn-primary" type="button" data-idtamu="<?php echo $tamuu['id'] ?>">Buka Undangan</a>
                <a id="share-wa" class="btn btn-primary" type="button" target="_blank">Share Ke Whatsapp</a>
                <button class="btn btn-primary" type="button">Share Ke Facebook</button>
                <button class="btn btn-primary" type="button">Hapus</button>
              </div>
              </td>
            </tr>
          <?php
            }
          ?> 
          </tbody>
        </table>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>

    <script>
        var table = $('#dataTable').DataTable( {
          lengthChange: false,
          buttons: [ 'colvis' ]
      });

      let ids = ''
      let nama = ''

      $('#save-ucapan').on('click', function(){
        $( "#tabel-tamu" ).removeClass("d-none")  

        document.getElementById('tabel-tamu').scrollIntoView();
      })

      $('#dataTable tbody').on('click', 'tr', function () {

        var data = table.row( this ).data();
        let id = data[0].split(".")
        ids = id[1].match( /\d+/g ).join()
        nama = data[1].replaceAll(" ", "-")
        let ucapans = $('#ucapan').val()

        let res = ucapans
        .replace(/break/g, "%0A%0A")
        .replace(/%nama-tamu%/g, data[1])
        .replace("&", '%26')
        .replace(/%link-undangan%/g, `<?php echo "https://amertainvitation.my.id/".$_SESSION['linkundangan'] ?>/?to=${nama}%26qr=${ids}`)

        let btnWA = $('#share-wa').attr('href', `https://api.whatsapp.com/send?phone=&text=${res}`)
        let btnOpen = $('#buka-undangan').attr('href', `<?php echo "https://amertainvitation.my.id/".$_SESSION['linkundangan'] ?>/?to=${nama}&qr=${ids}`)

        console.log(res)
      });

    </script>
    
    
  </body>
</html>
