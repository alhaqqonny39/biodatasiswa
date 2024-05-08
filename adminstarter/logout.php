<?php
session_start();

if(!isset($_SESSION['login']))
{
	echo "<script>
            alert ('Silakan login terlebih dahulu');
            document.location.href = 'login.php';
            </script>";
            exit;
}

//kosongkan session
$_SESSION = [];
session_unset();
session_destroy();
//header("Location:login.php");
echo "<script>
            alert ('Anda telah logout');
            document.location.href = 'login.php';
            </script>";
?>