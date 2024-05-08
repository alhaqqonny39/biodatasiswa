<?php 

  include 'layout/header.php';
  include 'config/app.php';

  if(isset($_POST['tambah'])){
    if(create_kelas($_POST)>0){
      echo "<script>
            alert ('Data Kelas Berhasil Ditambahkan');
            document.location.href = 'datakelas.php';
            </script>";

            }
            else{
      echo "<script>
            alert ('Data Kelas Gagal Ditambahkan');
            document.location.href = 'datakelas.php';
            </script>";
    }
  }
  ?>
    <div class="container mt-5">
      <h1>Tambah Data Kelas</h1>
    <hr>
    <form action="" method="post" id="tambahkelas">
      <div class="mb -3">
        <label for="nama" class="form-label">Nama Kelas</label>
        <input type="text" class="form-control" id="namakelas" name="namakelas" placeholder="Nama Kelas" required>
      </div>
        <input type="submit" class="btn btn-primary" style="float: right;" name="tambah">
        <button type="button" class="btn btn-danger" style="float: right;" onclick="clearForm()">Hapus</button>
        </form>
        <script>
           function clearForm() {
            document.getElementById("tambahbkelas").reset();
             }
        </script>
    </div>   

<?php include 'layout/footer.php'; ?>