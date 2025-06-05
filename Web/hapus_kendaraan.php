<?php 
require 'koneksi.php';
global $koneksi;

$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM detail_kendaraan WHERE id_kendaraan = '$id'");

if (mysqli_affected_rows($koneksi) > 0){
    echo "
    <script>
        alert('Data Berhasil Dihapus');
        window.location.href = 'kendaraan.php';
    </script>
    ";
    } else {
    echo "
    <script>
        alert('Data Gagal Dihapus');
    </script>
    ";
}


?>