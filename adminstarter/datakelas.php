<?php
 //membatasi halaman sebelum login
 if(!isset($_SESSION['login'])){
  echo"<script>
      alert('silakan login terlebih dahulu');
      document.location.href = 'login.php';
      </script>";
  exit;
}

//membatasi halaman sesuai user login
if($_SESSION['level']!= 2){
echo"<script>
  alert('Anda harus masuk sebagai operator kelas');
  document.location.href = 'login.php';
  </script>";
exit;
}


    include 'layout/header.php';
    include 'config/app.php';

$stokDataPerhalaman = 5;
$stokData     = count(select("SELECT * FROM kelas"));
$stokHalaman  = ceil($stokData / $stokDataPerhalaman);
$halamanAktif = (isset($_GET['halaman']) ? $_GET['halaman']:1);
$awalData = ($stokDataPerhalaman * $halamanAktif) - $stokDataPerhalaman;

$data_kelas = select("SELECT * FROM kelas ORDER BY idkelas DESC LIMIT $awalData, $stokDataPerhalaman");

?>

    <div class="container mt-5">
      <h1>Data Kelas SMK Negeri 1 Bangsri</h1>
    <hr>
    <a href="tambahkelas.php" class="btn btn-primary mb-3"><i class="fas fa-plus-circle"></i>Tambah kelas</a>
    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>No.</th>
            <th>ID Kelas</th>
            <th>Nama Kelas</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
          <?php $no=1; ?>
          <?php foreach ($data_kelas as $kelas) : ?>
        <tr>
            <td><?=$no++; ?></td>
            <td><?=$kelas['idkelas'];?></td>
            <td><?=$kelas['namakelas'];?></td>
            <td width="20%" class="text-center">
            <a href="ubahkelas.php?idkelas=<?=$kelas['idkelas'];?>" class="btn btn-warning">Edit</a>
            <a href="hapuskelas.php?idkelas=<?=$kelas['idkelas'];?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus kelas ini?')">Hapus</a>
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


<?php include 'layout/footer.php'; ?>