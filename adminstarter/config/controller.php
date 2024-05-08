<?php 

  include 'database.php';
  
//Fungsi untuk menampilkan (hanya read)
function select($query)
  {
    global $db;

    $result = mysqli_query($db, $query);
    $rows =[];

    while ($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
    
  }

 //Fungsi untuk menambahkan data kelas (create)
 function create_kelas($post){
    global $db;

    $namakelas = $post['namakelas'];

    //query tambah data
    $query = "INSERT INTO kelas VALUES (null,'$namakelas')";

    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
  }
 
  //Fungsi tambah siswa
  function create_siswa($post){
    global $db;
    
    $nama = strip_tags($post['namasiswa']);
    $jk = strip_tags($post['jk']);
    $alamat = strip_tags($post['alamat']);
    $ttl = strip_tags($post['tanggallahir']);
    $idkelas = strip_tags($post['idkelas']);

    //query tambah data
    $query = "INSERT INTO siswa VALUES (null,'$nama','$jk','$alamat','$ttl','$idkelas')";
    mysqli_query($db, $query);
    
    return mysqli_affected_rows($db);
    }

    //Fungsi tambah akun
    function create_akun($post){

    global $db;
    
    $nama = strip_tags($post['nama']);
    $username = strip_tags($post['username']);
    $email = strip_tags($post['email']);
    $password1 = strip_tags($post['password']);
    $level = strip_tags($post['level']);
    
    //enkripsi password
    $password = password_hash($password1, PASSWORD_DEFAULT);

    //query tambah data
    $query = "INSERT INTO akun VALUES (null,'$nama','$username','$email','$password','$level')";
    mysqli_query($db, $query);
    
    return mysqli_affected_rows($db);
    }

 //fungsi hapus kelas
 function delete_kelas($id){
    global $db;

    //query hapus data
    $query = "DELETE FROM kelas WHERE idkelas=$id";
    
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
  }    

 //fungsi hapus akun
 function delete_akun($idakun){
    global $db;

    //query hapus data
    $query = "DELETE FROM akun WHERE idakun=$idakun";
    
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
  }
  
 //fungsi hapus siswa
 function delete_siswa($nis){
    global $db;

    //query hapus data
    $query = "DELETE FROM siswa WHERE nis=$nis";
    
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
  }

//Fungsi ubah data kelas
function update_kelas($post){
    global $db;
    
    $id = $post['idkelas'];
    $namakelas = $post['namakelas'];
    
  //query ubah data
  $query = "UPDATE kelas SET namakelas = '$namakelas' WHERE idkelas = $id";
  mysqli_query($db, $query);

  return mysqli_affected_rows($db);
  }  
  ?>