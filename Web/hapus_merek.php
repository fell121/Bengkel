<?php 
require 'koneksi.php';
global $koneksi;

$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM merek_kendaraan WHERE id_kendaraan = $id");
// mysqli_query($koneksi, $query);

if (mysqli_affected_rows($koneksi) > 0) {
    echo "
            <script>
                alert('Data Berhasil Dihapus');
                window.location.href = 'merek.php';
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