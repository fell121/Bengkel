<?php 
require 'koneksi.php';
global $koneksi;

$result = mysqli_query($koneksi, "SELECT * FROM merek_kendaraan ORDER BY id_kendaraan DESC");

// var_dump(mysqli_fetch_assoc($result));

$kendaraan = [];

while ($data = mysqli_fetch_assoc($result)){
    $kendaraan[] = $data;
    // var_dump($result);
}

if(isset($_POST['submit'])){
    $nama = $_POST['nama_kendaraan'];
    $no_mesin = $_POST['no_mesin'];
    $no_polisi = $_POST['no_polisi'];
    $pembuat = $_POST['pembuat'];
    $tanggal_masuk = $_POST['tanggal_masuk'];
    $tanggal_keluar = $_POST['tanggal_keluar'];
    $status_kendaraan = $_POST['status_kendaraan'];
    $warna = $_POST['warna'];
    $warna = implode(", ", $warna);
    $keluhan = $_POST['keluhan'];

    $query = "INSERT INTO detail_kendaraan VALUES 
            (null,'$nama', '$no_mesin', '$no_polisi', '$tanggal_masuk',
            '$tanggal_keluar', '$status_kendaraan', '$warna', '$keluhan', '$pembuat')";

    mysqli_query($koneksi, $query);

    if(mysqli_affected_rows($koneksi) > 0){
        echo "    
        <script>
            alert('Data Berhasil Ditambahkan');
            window.location.href = 'kendaraan.php'; 
        </script>";
    } else {
        echo "
        <script>
            alert('Data Gagal Ditambahkan');
        </script>";
        }
    }
?>

<?php require 'headher.php' ?>
<h1>Halaman Tambah Kendaraan</h1>
<form action="" method="post">
    <input type="text" name="nama_kendaraan" require placeholder="Masukkan Nama Kendaraan" required><br><br>
    <input type="number" name="no_mesin" require placeholder="Masukkan Nomor Mesin" required><br><br>
    <input type="number" name="no_polisi" require placeholder="Masukkan Nomor Polisi" required><br><br>

    <select name="pembuat">
        <?php foreach($kendaraan as $row) : ?>
            <option value="<?= $row['id_kendaraan']; ?>"><?= $row['pembuat']; ?></option>
        <?php endforeach ?>
    </select><br>

    <p>Pilih Tanggal:</p>
    <label>Pilih Tanggal Kendaraan Masuk:</label><br><input type="date" name="tanggal_masuk"><br><br>
    <label>Pilih Tanggal Kendaraan keluar:</label><br><input type="date" name="tanggal_keluar">


    <p>Status Kendaraan</p>
    <input type="radio" name="status_kendaraan" value="1"><label for="">Lunas</label><br>
    <input type="radio" name="status_kendaraan" value="0"><label for="">Kredit</label><br>

    <p>Warna Kendaraan</p>
    <input type="checkbox" name="warna[]" value="Merah"> Merah <br>
    <input type="checkbox" name="warna[]" value="Hijau"> Hijau <br>
    <input type="checkbox" name="warna[]" value="Biru"> Biru <br>
    <input type="checkbox" name="warna[]" value="Kuning"> Kuning <br>
    <input type="checkbox" name="warna[]" value="Hitam"> Hitam <br>
    <input type="checkbox" name="warna[]" value="Putih"> Putih <br>
    <input type="checkbox" name="warna[]" value="Abu-abu"> Abu-abu <br>
    <br><br>
    <textarea name="keluhan" id="" cols="30" row="2" placeholder="Deskripsi Kendaraan"></textarea><br><br>
    <button name="submit" type="submit" >Submit</button>

</form>

<?php require 'foother.php';?>