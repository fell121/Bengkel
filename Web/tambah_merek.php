<?php 
require 'koneksi.php';
global $koneksi;

if (isset($_POST['submit'])){
$kendaraan = mysqli_real_escape_string($koneksi, $_POST['pembuat']);

$query = "INSERT INTO merek_kendaraan (pembuat) VALUES ('$kendaraan')";
mysqli_query($koneksi, $query);

if (mysqli_affected_rows($koneksi) > 0) {
    echo "    
    <script>
        alert('Data Berhasil Ditambahkan');
        window.location.href = 'merek.php'; 
    </script>";
} else {
    echo "
    <script>
        alert('Data Gagal Ditambahkan');
    </script>";
}
}

?>

<?php include 'headher.php' ?>

<h1>Halaman Tambah Merek Kendaraan</h1>
<form action="" method="post">
    <input type="text" name="pembuat" required placeholder="Input Merek Baru">
    <button type="submit" name="submit">Submit</button>
</form>
<?php include 'foother.php' ?>