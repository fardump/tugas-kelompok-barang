<?php

class BarangClass
{
    private $dataBarang = [];

    // Fungsi untuk menambah barang baru
    public function tambahBarang($nama, $harga, $stok)
    {
        $id = count($this->dataBarang) + 1; // Generate ID baru
        $barang = [
            'id' => $id,
            'nama' => $nama,
            'harga' => $harga,
            'stok' => $stok
        ];
        $this->dataBarang[] = $barang;
        return $id; // Kembalikan ID barang yang baru ditambahkan
    }

    // Fungsi untuk mengedit data barang berdasarkan ID
    public function editBarang($id, $nama, $harga, $stok)
    {
        foreach ($this->dataBarang as &$barang) {
            if ($barang['id'] === $id) {
                $barang['nama'] = $nama;
                $barang['harga'] = $harga;
                $barang['stok'] = $stok;
                return true; // Berhasil mengedit data barang
            }
        }
        return false; // Barang tidak ditemukan
    }

    // Fungsi untuk menghapus barang berdasarkan ID
    public function hapusBarang($id)
    {
        foreach ($this->dataBarang as $key => $barang) {
            if ($barang['id'] === $id) {
                unset($this->dataBarang[$key]);
                return true; // Berhasil menghapus barang
            }
        }
        return false; // Barang tidak ditemukan
    }

    // Fungsi untuk mendapatkan data semua barang
    public function getDataBarang()
    {
        return $this->dataBarang;
    }

    // Fungsi untuk mencari kombinasi barang dengan harga total tertentu menggunakan Linear Programming (PHP Native)
    public function cariKombinasiBarang($hargaTotal)
    {
        // Menginisialisasi variabel untuk menyimpan hasil kombinasi barang
        $hasilKombinasi = [];

        // Mendefinisikan jumlah barang dan variabel kombinasi (x1, x2, ..., xn)
        $jumlahBarang = count($this->dataBarang);
        $kombinasi = [];
        for ($i = 1; $i <= $jumlahBarang; $i++) {
            $kombinasi["x{$i}"] = 0;
        }

        // Menggunakan pendekatan brute-force untuk mencari kombinasi yang memenuhi batasan
        $maxKombinasi = 2 ** $jumlahBarang;
        for ($i = 1; $i < $maxKombinasi; $i++) {
            $totalHarga = 0;
            $totalStok = 0;
            for ($j = 1; $j <= $jumlahBarang; $j++) {
                if (($i & (1 << ($j - 1))) !== 0) {
                    $totalHarga += $this->dataBarang[$j - 1]['harga'];
                    $totalStok += $this->dataBarang[$j - 1]['stok'];
                }
            }

            if ($totalHarga <= $hargaTotal && $totalStok <= 1) {
                $hasilKombinasi[] = [
                    'harga' => $totalHarga,
                    'stok' => $totalStok
                ];
            }
        }

        return $hasilKombinasi;
    }

    // Fungsi untuk menghitung total pendapatan berdasarkan daftar barang
    public function hitungTotalPendapatan()
    {
        $totalPendapatan = 0;
        foreach ($this->dataBarang as $barang) {
            $totalPendapatan += ($barang['harga'] * $barang['stok']);
        }
        return $totalPendapatan;
    }

    // Fungsi untuk menghitung total biaya berdasarkan daftar barang
    public function hitungTotalBiaya()
    {
        $totalBiaya = 0;
        foreach ($this->dataBarang as $barang) {
            // Gantilah sesuai dengan biaya yang relevan untuk setiap barang jika ada
            // Misalnya, biaya produksi, biaya pengadaan, dsb.
            $totalBiaya += ($barang['harga'] * $barang['stok']);
        }
        return $totalBiaya;
    }

    // Fungsi untuk menghitung laba rugi berdasarkan perbedaan total pendapatan dan total biaya
    public function hitungLabaRugi()
    {
        $totalPendapatan = $this->hitungTotalPendapatan();
        $totalBiaya = $this->hitungTotalBiaya();
        return $totalPendapatan - $totalBiaya;
    }
}