<?php 

  include 'layout/header.php';
  include 'config/app.php';
    
  $id = (int)$_GET['idkelas'];
  //query data kelas berdasarkan id
  $kelas = select("SELECT * FROM kelas WHERE idkelas = $id")[0];

  //check apakah tombol ubah ditekan
  if(isset($_POST['ubah'])){
    if(update_kelas($_POST)>0){
      echo "<script>
            alert ('Data kelas Berhasil Diubah');
            document.location.href = 'datakelas.php';
            </script>";

            }
            else{
      echo "<script>
            alert ('Data kelas Gagal Diubah');
            document.location.href = 'datakelas.php';
            </script>";
    }
  }
  ?>
    <div class="container mt-5">
      <h1>Ubah Data kelas</h1>
    <hr>
    <form action="" method="post">
        <input type="hidden" name="idkelas" value="<?=$kelas['idkelas'];?>">
      <div class="mb -3">
        <label for="nama" class="form-label">Nama kelas</label>
        <input type="text" class="form-control" id="namakelas" name="namakelas" value="<?=$kelas['namakelas'];?>" placeholder="Nama kelas" required>
      </div>
        <button type="submit" class="btn btn-primary" style="float: right;" name="ubah">Ubah Data</button>
        </form>
    </div>   

<?php include 'layout/footer.php'; ?>