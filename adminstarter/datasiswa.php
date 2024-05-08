<?php 
   session_start();
   //membatasi halaman sebelum login
   if(!isset($_SESSION['login'])){
     echo"<script>
         alert('silakan login terlebih dahulu');
         document.location.href = 'login.php';
         </script>";
     exit;
   }

  //membatasi halaman sesuai user login
  if($_SESSION['level']!= 1){
    echo"<script>
        alert('Anda harus masuk sebagai operator siswa');
        document.location.href = 'login.php';
        </script>";
    exit;
  }

  include 'layout/header.php';
  include 'config/app.php';

  if(isset($_POST['tambah'])){
    if(create_siswa($_POST)>0){
      echo "<script>
            alert ('Data Siswa Berhasil Ditambahkan');
            document.location.href = 'datasiswa.php';
            </script>";

            }
            else{
      echo "<script>
            alert ('Data Siswa Gagal Ditambahkan');
            document.location.href = 'datasiswa.php';
            </script>";
    }
  }



//pagination
$stokDataPerhalaman = 5;
$stokData     = count(select("SELECT * FROM siswa"));
$stokHalaman  = ceil($stokData / $stokDataPerhalaman);
$halamanAktif = (isset($_GET['halaman']) ? $_GET['halaman']:1);
$awalData = ($stokDataPerhalaman * $halamanAktif) - $stokDataPerhalaman;

$data_siswa = select("SELECT * FROM siswa ORDER BY nis DESC LIMIT $awalData, $stokDataPerhalaman");

?>

    <div class="container mt-5">
      <h1>Data Siswa</h1>
        <hr>
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modaltambah">
          Modal Tambah
          </button>
          <table class="table table-bordered table-striped table-hover">
          <thead>
        <tr>
            <th>No.</th>
            <th>NIS</th>
            <th>Nama Siswa</th>
            <th>Jenis Kelamin</th>
            <th>Alamat</th>
            <th>Tanggal Lahir</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
          <?php $no=1; ?>
          <?php foreach ($data_siswa as $siswa) : ?>
        <tr>
            <td><?=$no++; ?></td>
            <td><?=$siswa['nis'];?></td>
            <td><?=$siswa['namasiswa'];?></td>
            <td><?=$siswa['jk'];?></td>
            <td><?=$siswa['alamat'];?></td>
            <td><?=date("d/m/Y", strtotime($siswa['tanggallahir']));?></td>
            <td width="20%" class="text-center">
            <a href="ubahsiswa.php?nis=<?=$siswa['nis'];?>" class="btn btn-warning">Edit</a>
            <button type="button" class="btn btn-danger mb-2" data-bs-toggle="modal" data-bs-target="#modalhapus<?=$siswa['nis'];?>">Hapus</button>
            </td>

        </tr>

        <?php endforeach; ?>
        </tbody>
      </table>
      <div class="mt-2 justify-content-end d-flex">
      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <?php if ($halamanAktif > 1) : ?>
            <li class="page-item">
              <a class="page-link" href="?halaman=<?= $halamanAktif - 1 ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
              </a>
            </li>
          <?php endif; ?>

          <?php for ($i = 1; $i <= $stokHalaman; $i++) : ?>
            <?php if ($i == $halamanAktif) : ?>
              <li class="page-item active"><a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a></li>
            <?php else : ?>
              <li class="page-item "><a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a></li>
            <?php endif; ?>
          <?php endfor; ?>

          <?php if ($halamanAktif < $stokHalaman) : ?>
            <li class="page-item">
              <a class="page-link" href="?halaman=<?= $halamanAktif + 1 ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
              </a>
            </li>
          <?php endif; ?>
        </ul>
      </nav>
      </div>
    </div>  

<!-- Modal Tambah -->
<div class="modal fade" id="modaltambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah siswa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post" id="tambahsiswa" enctype="multipart/form-data">
        <div class="mb -3">
        <label for="nama" class="form-label">Nama Siswa</label>
        <input type="text" class="form-control" id="namasiswa" name="namasiswa" placeholder="Nama Siswa" required>
      </div>
      <div class="mb -3">
      <label for="jeniskelamin" class="form-label">Jenis Kelamin</label>  
      <select class="form-select" id="jeniskelamin" name="jeniskelamin">
            <option selected>Pilih salah satu</option>
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
        </select>
      </div>
      <div class="mb -3">
        <label for="alamat">Alamat</label> 
        <textarea class="form-control" placeholder="Alamat lengkap" id="alamat" name="alamat" required></textarea>               
      </div>
      <div class="form-group mb-3">
        <label for="tanggal">Tanggal Lahir :</label>
        <input type="date" class="form-control" id="tanggallahir" name="tanggallahir" required>
        </div>
          <div class="mb -3">
            <label for="level" class="form-label">Kelas</label>  
                <select class="form-select" id="level" name="level">
                <option selected>Pilih salah satu</option>
                <option value="1">Admin</option>
                <option value="2">Operator Siswa</option>
                <option value="3">Operator Barang</option>
                </select>
            </div>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- looping untuk menghapus siswa -->
<?php foreach($data_siswa as $siswa) : ?>

<!-- Modal hapus-->
<div class="modal fade" id="modalhapus<?=$siswa['nis'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus siswa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin ingin menghapus siswa : <?=$siswa['nama'];?> ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <a href="hapussiswa.php?nis=<?=$siswa['nis'];?>" class="btn btn-danger" name="hapus">Hapus</a>
      </div>
    </div>
  </div>
</div>
<?php endforeach; ?>

<?php include 'layout/footer.php'; ?>  