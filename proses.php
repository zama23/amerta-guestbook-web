<?php 
include 'konek.php';
require 'vendor/autoload.php';
session_start();

date_default_timezone_set('Asia/Jakarta');

// $sql = mysqli_query(
//     $conn, 
//     "SELECT nama, updated_at FROM data_tamu ORDER BY updated_at DESC LIMIT 1"
// );

// $row = mysqli_fetch_assoc($sql);

// // Adding Time
// // $adding_time = date(date($row['updated_at']), strtotime("+8 sec"));
// // Current Time
// $date_now = date('Y-m-d H:i:s');
// // Data Time
// $user_time = strtotime($row['updated_at']);
// $to_date = date('Y-m-d H:i:s', $user_time);

// $adding_time = date($to_date, strtotime("+3 sec"));

// $user = $row['updated_at'];
// $output = [
//     "current_time" => $date_now,
//     "adding_time" => $adding_time,
//     "user_time" => $user,
//     "is_nodata" => false,
//     "data" => $row,
// ];

// echo json_encode($output);

//Login
if(isset($_POST['login'])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM data_user WHERE  username = '$username'");

    if( mysqli_num_rows($result) === 1 ) {

        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"]) ) {
            $_SESSION['login'] = true;
            $_SESSION['username'] = $row["username"];
            $_SESSION['imageuser'] = $row["img"];
            $_SESSION['namacp'] = $row["namamempelai"];
            $_SESSION['usernameid'] = $row["id"];
            $_SESSION['linkundangan'] = $row["link"];
            header("location: dashboard");
            exit;
        }
    }
    $_SESSION['gagallogin'] = 'Username/Password Salah';
    header("location: auth");
}

//Create
if(isset($_POST['tambah'])){

    $nama = $_POST['namatamu'];
    $alamat = $_POST['alamat'];
    $status = "Tidak hadir";
    $user = $_SESSION['usernameid'];

    $query = "INSERT INTO data_tamu VALUE(null, '$nama', '$alamat', '$status', '$user', null)";
    $sql = mysqli_query($conn, $query);

    if($sql){
        header("location: master");
    } else {
        echo $query;
    }
}

//Delete
    if(isset($_POST['hapus'])){
        $id = $_POST['idtamu'];
        $_SESSION['hapustamu'] = 'Hapus Berhasil';
        $query = "DELETE FROM data_tamu where id = '$id;'";
        $sql = mysqli_query($conn, $query);
        if($sql){
            header("location: master");
        } else {
            echo $query;
        }
    }

//Edit
if(isset($_POST['edit'])){
    date_default_timezone_set("Asia/Jakarta");

    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];

    // echo $id." | ".$nama." | ".$alamat;
    // die();
    $_SESSION['edittamu'] = 'Edit Berhasil';

    $query = "UPDATE data_tamu SET nama='$nama', alamat='$alamat' WHERE id='$id';";
    $sql = mysqli_query($conn, $query);

    if($sql){
        header("location: master");
        // echo "Data Berhasil di Tambahkan";
    } else {
        echo $query;
    }
}

//Imput
if(isset($_POST['imput'])){
    include 'vendor/autoload.php';
    $connect = new PDO("mysql:host=localhost;dbname=db_amerta", "root", "");

    if($_FILES["filetamu"]["name"] != '')
    {
    $allowed_extension = array('xls', 'csv', 'xlsx');
    $file_array = explode(".", $_FILES["filetamu"]["name"]);
    $file_extension = end($file_array);
    
    if(in_array($file_extension, $allowed_extension))
    {
    $file_name = time() . '.' . $file_extension;
    move_uploaded_file($_FILES['filetamu']['tmp_name'], $file_name);
    $file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file_name);
    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);
    
    $spreadsheet = $reader->load($file_name);
    
    unlink($file_name);
    
    $data = $spreadsheet->getActiveSheet()->toArray();
    
    for($i=1;$i<count($data);$i++){
        $namatamu = $data[$i]['0'];
        $alamat = $data[$i]['1'];
        $status = "Tidak hadir";
        $user = $_SESSION['usernameid'];

        $query = "INSERT INTO data_tamu VALUES (null,' $namatamu', '$alamat', '$status', '$user', null)";
        $sql = mysqli_query($conn, $query);
    
    }


    $_SESSION['importmessage'] = "Import data berhasil";
    // $message = '<div class="alert alert-success">Data Imported Successfully</div>';
    }
    else
    {
    $_SESSION['importmessage'] = "Format file tidak sesuai";
    // $message = '<div class="alert alert-danger">Only .xls .csv or .xlsx file allowed</div>';
    }
    }
    else
    {
    $_SESSION['importmessage'] = "Silahkan pilih file untuk diupload";
    // $message = '<div class="alert alert-danger">Please Select File</div>';
    }
    
    header("location: import");
}

// User Edit --- Edit Nama User
if(isset($_POST['update'])){
    $id = $_SESSION['usernameid'];
    $namacp =   $_POST["namacp"];

    $query = "UPDATE data_user SET namamempelai='$namacp' WHERE id='$id';";
    $sql = mysqli_query($conn, $query);

    if($sql){
        $_SESSION['namacp'] = $namacp;
        $_SESSION['edituser'] = 'Update Berhasil';
        header("location: akun");
    } else {
        echo "Terjadi Kesalahan";
    }
}

// User Edit --- Edit Password
if(isset($_POST['changepassword'])){
    $id = $_SESSION['usernameid'];
    $passwordlama = $_POST["password"];
    $passwordbaru = $_POST["newpassword"];
    $repasswordbaru = $_POST["newpasswordre"];

    if( $passwordbaru !== $repasswordbaru ) {
        $_SESSION['gantipassword'] = 'Password Tidak Sama';
        header("location: akun");
        return false;
    }

    $result = mysqli_query($conn, "SELECT * FROM data_user WHERE  id = '$id'");

    if( mysqli_num_rows($result) === 1 ) {

        $row = mysqli_fetch_assoc($result);
        if (password_verify($passwordlama, $row["password"]) ) {
            $passwordbaru = password_hash($passwordbaru, PASSWORD_DEFAULT);
            $query = "UPDATE data_user SET password='$passwordbaru' WHERE id='$id';";
            $sql = mysqli_query($conn, $query);
            $_SESSION['gantipasswordoke'] = "Password berhasil diubah";
            header("location: akun");
            exit;
        }
    }
    $_SESSION['gantipassword'] = 'Password Salah';
    header("location: akun");
}


//---------------------------------------------------ADMIN-------------------------------------------------
//Login
if(isset($_POST['loginadmin'])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    $adminpanel = mysqli_query($conn, "SELECT * FROM dummy WHERE  user = '$username'");

    if( mysqli_num_rows($adminpanel) === 1 ) {

        $row = mysqli_fetch_assoc($adminpanel);
        if (password_verify($password, $row["password"]) ) {
            $_SESSION['loginadmin'] = true;
            $_SESSION['adminusername'] = $row["user"];
            $_SESSION['adminnama'] = $row["nama"];
            $_SESSION['adminusernameid'] = $row["id"];
            header("location: server");
            exit;
        }
    }
    $_SESSION['tamong'] = 'Username/Password Salah';
    header("location: auth");
}

//Buat Akun Admin - Daftar
// if(isset($_POST['daftaradmin'])){
//     $username = strtolower( stripslashes($_POST["username"]));
//     $nama = $_POST["nama"];
//     $password = mysqli_real_escape_string($conn, $_POST["password"]);
//     $password2 = mysqli_real_escape_string($conn, $_POST["password2"]);

//     $checkuser = mysqli_query($conn, "SELECT user FROM dummy WHERE user = '$username'");

//     if(mysqli_fetch_assoc($checkuser)) {
//         $_SESSION['daftarnotif'] = 'Username Sudah Ada';
//         header("location: tamong2.php");
//         return false;
//     }

//     if( $password !== $password2 ) {
//         $_SESSION['daftarnotif'] = 'Password Tidak Sama';

//         header("location: tamong2.php");
//         return false;
//     }

//     $password = password_hash($password, PASSWORD_DEFAULT);

//     $query = "INSERT INTO dummy VALUE(null, '$username', '$nama', '$password')";
//     $sql = mysqli_query($conn, $query);

//     if($sql){
//         $_SESSION['daftarnotif'] = 'Akun Berhasi Dibuat';
//         header("location: tamong2.php");
//     } else {
//         echo $query;
//     }
// }

//Mimin - Add
if(isset($_POST['daftar'])){

    $username = strtolower( stripslashes($_POST["username"]));
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $password2 = mysqli_real_escape_string($conn, $_POST["password2"]);
    $img = $_FILES['image']['name'];
    $mempelai = $_POST['namamempelai'];
    $linkundangan = $_POST['link'];

    $checkuser = mysqli_query($conn, "SELECT username FROM data_user WHERE username = '$username'");

    if(mysqli_fetch_assoc($checkuser)) {
        $_SESSION['daftarnotif'] = 'Username Sudah Ada';
        header("location: newuser");
        return false;
    }

    if( $password !== $password2 ) {
        $_SESSION['daftarnotif'] = 'Password Tidak Sama';

        header("location: newuser");
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    $dir = "layar-awal/";
    $tmpFiles = $_FILES['image']['tmp_name'];

    move_uploaded_file($tmpFiles, $dir.$img);

    $query = "INSERT INTO data_user VALUE(null, '$username', '$password', '$img', '$mempelai', '$linkundangan')";
    $sql = mysqli_query($conn, $query);

    if($sql){
        $_SESSION['daftarnotif'] = 'Akun Berhasi Dibuat';
        header("location: newuser");
    } else {
        echo $query;
    }
}

//Mimin - Hapus
if(isset($_POST["off"])) {
    $id = $_POST["iduser"];
    $querydel = "SELECT * FROM data_user where id = '$id;'";
    $sqldel = mysqli_query($conn, $querydel);
    $result = mysqli_fetch_assoc($sqldel);

    unlink("layar-awal/".$result['img']);

    $query = "DELETE FROM data_user where id = '$id;'";
    $sql = mysqli_query($conn, $query);

    $deldata = "DELETE FROM data_tamu where user_id = '$id;'";
    $sqldeldata = mysqli_query($conn, $deldata);

    if($sqldeldata){
        header("location: users");
    } else {
        echo "Terjadi Kesalahan";
    }
}

// Edit Password
if(isset($_POST['edituser'])){
    $id = $_POST["id"];
    $username = $_POST["username"];
    $passwordbaru = $_POST["password"];
    $repasswordbaru = $_POST["repassword"];

    if( $passwordbaru !== $repasswordbaru ) {
        $_SESSION['editusers'] = 'Password Tidak Sama';
        header("location: users");
        return false;
    }

    $result = mysqli_query($conn, "SELECT * FROM data_user WHERE  id = '$id'");

    if( mysqli_num_rows($result) === 1 ) {

        $row = mysqli_fetch_assoc($result);
        $passwordbaru = password_hash($passwordbaru, PASSWORD_DEFAULT);
        $query = "UPDATE data_user SET password='$passwordbaru', username='$username' WHERE id='$id';";
        $sql = mysqli_query($conn, $query);
        $_SESSION['editusers'] = "Password berhasil diubah";
        header("location: users");
        exit;
        
    }
    $_SESSION['editusers'] = 'Terjadi Kesalahan';
    header("location: users");
}



//CheckIN
if(isset($_POST['checkin'])){
    date_default_timezone_set("Asia/Jakarta");

    $id = $_POST['idtamu'];
    $date = date('Y-m-d H:i:s', strtotime("+3 sec"));

    // echo $id." | ".$nama." | ".$alamat;
    // die();
    // $_SESSION['layarawal'] = $nama;

    $query = "UPDATE data_tamu SET updated_at='$date', status='Hadir' WHERE id='$id';";
    $sql = mysqli_query($conn, $query);

    if($sql){
        header("location: manual.php");
        // echo "Data Berhasil di Tambahkan";
    } else {
        echo $query;
    }
}


?>