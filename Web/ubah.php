<?php 
require 'koneksi.php';
global $koneksi;

$id = $_GET['id'];

$kendaraan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM merek_kendaraan WHERE id_kendaraan = '$id'"));

if(isset($_POST['submit'])){
global $koneksi;
$kendaraan = $_POST['pembuat'];
$id = $_POST['id'];



$query = "UPDATE merek_kendaraan SET pembuat = '$kendaraan' WHERE id_kendaraan = $id";
mysqli_query($koneksi, $query);
    if (mysqli_affected_rows($koneksi) > 0) {
        echo "
                <script>
                    alert('Data Berhasil Diubah');
                    window.location.href = 'merek.php';
                </script>
            ";
    } else {
        echo "
                <script>
                    alert('Data Gagal Diubah');
                </script>
            ";
    }

}
?>

<?php include 'headher.php' ?>
<h1>Halaman Ubah Merek Kendaraan</h1>
<form action="" method="post">
    <input type="text" name="pembuat" required placeholder="ganti merek kendaraan" value="<?= $kendaraan['pembuat']; ?>">

    <input type="hidden" name="id" value="<?= $kendaraan['id_kendaraan']; ?>"><br>
    
    <button type="submit" name="submit">Submit</button>
</form>

<?php include 'foother.php' ?>