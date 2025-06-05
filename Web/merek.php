<?php 
require 'koneksi.php';
global $koneksi;

$result = mysqli_query($koneksi, "SELECT * FROM merek_kendaraan ORDER BY id_kendaraan DESC");

$kendaraan = [];

while ($data = mysqli_fetch_assoc($result)){
    $kendaraan[] = $data;
    // var_dump($result);
}
?>
<?php include 'headher.php' ?>
<h1>Data merek</h1>
<table border = "1" cellpadding = "10" cellspacing="0">
<thead>
            <tr>
                <td>No</td>
                <td>Merek</td>
                <td>Aksi</td>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1 ?>
            <?php foreach($kendaraan as $row ) : ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $row['pembuat']; ?></td>
                <td>
                    <a href="ubah.php?id=<?= $row['id_kendaraan']; ?>">Ubah</a> ||
                    <a href="hapus_merek.php?id=<?= $row['id_kendaraan']; ?>" onclick= "return confirm('Anda Yakin Data Akan Dihapus?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
</table><br>
<a href="tambah_merek.php">Tambah</a>

<?php include 'foother.php' ?>

