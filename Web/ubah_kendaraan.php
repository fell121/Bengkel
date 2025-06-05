<?php 
require 'koneksi.php';
$koneksi;

$id = $_GET['id'];


$query_detail = "SELECT * FROM detail_kendaraan WHERE id_kendaraan = $id";
$result_detail = mysqli_query($koneksi, $query_detail);
$detail_kendaraan = mysqli_fetch_assoc($result_detail);

$warna = explode(", ", $detail_kendaraan['warna']);


$query_merek = "SELECT * FROM merek_kendaraan ORDER BY id_kendaraan DESC";
$result_merek = mysqli_query($koneksi, $query_merek);
$merek_kendaraan = [];
while ($data = mysqli_fetch_assoc($result_merek)){
    $merek_kendaraan[] = $data;
}

if(isset($_POST['submit'])){
    $nama = $_POST['nama_kendaraan'];
    $no_mesin = $_POST['no_mesin'];
    $no_polisi = $_POST['no_polisi']; 
    $pembuat = $_POST['pembuat'];
    $tanggal_masuk = $_POST['tanggal_masuk'];
    $tanggal_keluar = $_POST['tanggal_keluar'];
    $status_kendaraan = $_POST['status_kendaraan'];
    $warna = isset($_POST['warna']) ? $_POST['warna'] : []; 
    $warna_str = implode(", ", $warna);
    $keluhan = $_POST['keluhan']; 

    $query = "UPDATE detail_kendaraan SET 
            nama_kendaraan = '$nama',
            no_mesin = '$no_mesin',
            no_polisi = '$no_polisi', 
            tanggal_masuk = '$tanggal_masuk',
            tanggal_keluar = '$tanggal_keluar',
            status_kendaraan = '$status_kendaraan', 
            warna = '$warna_str', 
            keluhan = '$keluhan', 
            pembuat = '$pembuat'
            WHERE id_kendaraan = $id";

    mysqli_query($koneksi, $query);

    if (mysqli_affected_rows($koneksi) > 0) {
        echo "
            <script>
                alert('Data Berhasil Diubah');
                window.location.href = 'kendaraan.php';
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
<h1>Halaman Ubah Kendaraan</h1>
<form action="" method="post">
    <p>Nama kendaraan</p>
    <input type="text" name="nama_kendaraan" placeholder="masukan nama kendaraan" required value="<?= $detail_kendaraan['nama_kendaraan']; ?>"><br>
    <p>No mesin</p>
    <input type="number" name="no_mesin" required value="<?= $detail_kendaraan['no_mesin']; ?>"><br><br>
    <p>No polisi</p>
    <input type="number" name="no_polisi" required value="<?= $detail_kendaraan['no_polisi']; ?>"><br><br>

    <p>Merek kendaraan</p>
    <select name="pembuat" id="">
        <?php foreach($merek_kendaraan as $row) : ?>
            <option value="<?= $row['id_kendaraan']; ?>" <?= $row['id_kendaraan'] == $detail_kendaraan['pembuat'] ? 'selected' : ''; ?>><?= $row['pembuat']; ?></option>
        <?php endforeach ?>
    </select><br>

    <p>Pilih Tanggal:</p>
    <label>Pilih Tanggal Kendaraan Masuk:</label><br>
    <input type="date" name="tanggal_masuk" value="<?= $detail_kendaraan['tanggal_masuk']; ?>"><br>

    <label>Pilih Tanggal Kendaraan keluar:</label><br>
    <input type="date" name="tanggal_keluar" value="<?= $detail_kendaraan['tanggal_keluar']; ?>">

    <p>Status Kendaraan</p>
    <input type="radio" name="status_kendaraan" value="1" <?= $detail_kendaraan['status_kendaraan'] == 1 ? 'checked' : '' ?>>
    <label for="">Lunas</label><br>
    <input type="radio" name="status_kendaraan" value="0" <?= $detail_kendaraan['status_kendaraan'] == 0 ? 'checked' : '' ?>>
    <label for="">Kredit</label><br>

    <p>Warna Kendaraan</p>
    <input type="checkbox" name="warna[]" value="Merah" <?= in_array('Merah', $warna) ? 'checked' : ''; ?>> Merah <br>
    <input type="checkbox" name="warna[]" value="Hijau" <?= in_array('Hijau', $warna) ? 'checked' : ''; ?>> Hijau <br>
    <input type="checkbox" name="warna[]" value="Biru" <?= in_array('Biru', $warna) ? 'checked' : ''; ?>> Biru <br>
    <input type="checkbox" name="warna[]" value="Kuning" <?= in_array('Kuning', $warna) ? 'checked' : ''; ?>> Kuning <br>
    <input type="checkbox" name="warna[]" value="Hitam" <?= in_array('Hitam', $warna) ? 'checked' : ''; ?>> Hitam <br>
    <input type="checkbox" name="warna[]" value="Putih" <?= in_array('Putih', $warna) ? 'checked' : ''; ?>> Putih <br>
    <input type="checkbox" name="warna[]" value="Abu-abu" <?= in_array('Abu-abu', $warna) ? 'checked' : ''; ?>> Abu-abu <br>
    <br><br>
    <textarea name="keluhan" id="" cols="30" rows="2" placeholder="Deskripsi Kendaraan"><?= $detail_kendaraan['keluhan']; ?></textarea><br><br>

    <button name="submit" type="submit">Submit</button>
</form>

<?php include 'foother.php' ?>