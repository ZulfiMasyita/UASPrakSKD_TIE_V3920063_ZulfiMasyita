<?php
session_start();
include('../config.php');//masukkan koneksi
if(empty($_SESSION['username'])){//Pengecekan apakah user sudah login atau belum
header("location:../index.php");
}
// Menampilkan username
$last = $_SESSION['username'];
$queryupdate = mysqli_query($koneksi,"UPDATE users SET last_activity=now() WHERE username='$last'");
?>
<!DOCTYPE html>
<html>
<?php
$user = $_SESSION['username'];
$query = mysqli_query($koneksi,"SELECT fullname,job_title,last_activity FROM users WHERE username='$user'");
$data = mysqli_fetch_array($query);
?>
  <head>
    <title><?php echo $data['fullname']; ?> - AES-128</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="../assets/plugins/datatables/css/jquery.dataTables.css">
  </head>
  <body class="sidebar-mini fixed">
    <?php include('navmenu.php'); ?>
      <div class="content-wrapper">
        <div class="page-title">
          <div>
            <h1><i class="fa fa-file"></i> Dekripsi Berkas</h1>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <?php
                //Menampilkan data dari table file pada database, data yang akan ditampilkan bedasarkan id_file
                $id_file = $_GET['id_file'];
                $query = mysqli_query($koneksi,"SELECT * FROM file WHERE id_file='$id_file'");
                $data2 = mysqli_fetch_array($query);
                ?>
                <h3 align="center">Dekripsi Berkas <i style="color:blue"><?php echo $data2['file_name_finish'] ?></i></h3><br>
                <form class="form-horizontal" method="post" action="decrypt-process.php">
                <div class="table-responsive">
                  <table class="table striped">
                       <tr>
                         <td>Nama Berkas</td>
                         <td>:</td>
                         <td><?php echo $data2['file_name_source']; ?></td>
                       </tr>
                       <tr>
                         <td>Nama Berkas Enkripsi</td>
                         <td>:</td>
                         <td><?php echo $data2['file_name_finish']; ?></td>
                       </tr>
                       <tr>
                         <td>Ukuran Berkas</td>
                         <td>:</td>
                         <td><?php echo $data2['file_size']; ?> KB</td>
                       </tr>
                       <tr>
                         <td>Tanggal Enkripsi</td>
                         <td>:</td>
                         <td><?php echo $data2['tgl_upload']; ?></td>
                       </tr>
                       <tr>
                         <td>Keterangan</td>
                         <td>:</td>
                         <td><?php echo $data2['keterangan']; ?></td>
                       </tr>
                       <tr>
                         <td>Masukkan Password Berkas  Untuk Mendekripsi</td>
                         <td></td>
                         <td>
                           <div class="col-md-6">
                            <input type="hidden" name="fileid" value="<?php echo $data2['id_file'];?>">
                           <input class="form-control" id="inputPassword" type="password" placeholder="Password" name="pwdfile" required><br>
                           <input type="submit" name="decrypt_now" value="Dekripsi Berkas" class="form-control btn btn-primary">
                         </div>
                       </td>
                       </tr>
                  </table>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    <script src="../assets/js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
        $('#file').dataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": true,
            "bAutoWidth": true,
          "order": [0, "asc"]
        });
        });
        </script>
    <script src="../assets/js/essential-plugins.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/plugins/datatables/js/jquery.dataTables.js"></script>
    <script src="../assets/js/plugins/pace.min.js"></script>
    <script src="../assets/js/main.js"></script>
  </body>
</html>
