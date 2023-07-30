<!DOCTYPE html>
<html>
<head>
    <title>Aplikasi Barang</title>
</head>
<body>
    <?php
    // Import class BarangClass
    require_once 'BarangClass.php';

    // Inisialisasi objek BarangClass
    $barangClass = new BarangClass();

    // Proses penambahan data barang (gunakan $_POST atau $_GET sesuai kebutuhan)
    if (isset($_POST['submit'])) {
        $nama = $_POST['nama'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];
        $barangClass->tambahBarang($nama, $harga, $stok);
    }

    // Tampilkan data barang yang ada
    $dataBarang = $barangClass->getDataBarang();
    ?>

    <!-- Form untuk menambahkan data barang -->
    <h2>Form Tambah Data Barang</h2>
    <form method="post" action="">
        <label for="nama">Nama Barang:</label>
        <input type="text" name="nama" required>
        <label for="harga">Harga:</label>
        <input type="number" name="harga" required>
        <label for="stok">Stok:</label>
        <input type="number" name="stok" required>
        <input type="submit" name="submit" value="Tambahkan">
    </form>

    <!-- Tabel untuk menampilkan data barang -->
    <h2>Data Barang</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
        </tr>
        <?php foreach ($dataBarang as $barang) : ?>
        <tr>
            <td><?= $barang['id']; ?></td>
            <td><?= $barang['nama']; ?></td>
            <td><?= $barang['harga']; ?></td>
            <td><?= $barang['stok']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>