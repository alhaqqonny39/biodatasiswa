<?php

include 'config/app.php';

$id = (int)$_GET['idkelas'];

if(delete_kelas($id)>0){
    echo "<script>
          alert ('Data kelas Berhasil Dihapus');
          document.location.href = 'datakelas.php';
          </script>";

          }
          else{
    echo "<script>
          alert ('Data kelas Gagal Dihapus');
          document.location.href = 'datakelas.php';
          </script>";
  }
?>
