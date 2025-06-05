<?php 
require 'koneksi.php';
global $koneksi;

$result = mysqli_query($koneksi, "SELECT *, detail_kendaraan.id_kendaraan FROM detail_kendaraan JOIN merek_kendaraan ON merek_kendaraan.id_kendaraan = detail_kendaraan.pembuat ORDER BY detail_kendaraan.id_kendaraan DESC"); 

$kendaraan = [];

while ($data = mysqli_fetch_assoc($result)){
    $kendaraan[] = $data;
    // var_dump($result);
}

?>

<?php include 'headher.php' ?>
    <h1>Halaman Detail Kendaraan</h1>
    <table border="1" cellpadding = "10" cellspacing = "0">
        <thead>
            <tr>
                <td>No</td>
                <td>Nama Kendaraan</td>
                <td>No. Mesin</td>
                <td>No. Polisi</td>
                <td>Pembuat</td>
                <td>Tanggal Masuk</td>
                <td>Tanggal keluar</td>
                <td>Status Kendaraan</td>
                <td>Warna</td>
                <td>Keluhan</td>
                <td>Aksi</td>

            </tr>
        </thead>
        <tbody>
            <?php $i = 1 ?>
            <?php foreach($kendaraan as $row ) : ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $row['nama_kendaraan']; ?></td>
                <td><?= $row['no_mesin']; ?></td>
                <td><?= $row['no_polisi']?></td>
                <td><?= $row['pembuat']; ?></td>
                <td><?= $row['tanggal_masuk']; ?></td>
                <td><?= $row['tanggal_keluar']; ?></td>
                <td><?= $row['status_kendaraan'] == 1 ? 'Lunas' : 'Kredit' ;?></td>
                <td><?= $row['warna']; ?></td>
                <td><?= $row['keluhan']; ?></td>
                <td>
                <a href="ubah_kendaraan.php?id=<?= $row['id_kendaraan']; ?>">Ubah</a> ||
                <a href="hapus_kendaraan.php?id=<?= $row['id_kendaraan']; ?>" onclick="return confirm('Anda Yakin? Data Akan Dihapus!')">Hapus</a>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>  

    <a href="tambah_kendaraan.php">Tambah</a>
<?php include 'foother.php' ?>
