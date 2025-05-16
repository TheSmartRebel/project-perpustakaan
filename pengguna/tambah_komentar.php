<?php
session_start();
include '../koneksi.php';

// Pastikan pengguna sudah login
if (!isset($_SESSION['id_pengguna'])) {
    header('Location: login.php');
    exit();
}

// Tambah komentar (utama atau balasan)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_buku = mysqli_real_escape_string($koneksi, $_POST['id_buku']);
    $id_pengguna = $_SESSION['id_pengguna'];
    $isi_komentar = mysqli_real_escape_string($koneksi, $_POST['isi_komentar']);
    $tanggal_komentar = date('Y-m-d H:i:s');
    $parent_id = isset($_POST['parent_id']) && $_POST['parent_id'] !== '' ? intval($_POST['parent_id']) : "NULL";

    $query = "INSERT INTO komentar (id_buku, id_pengguna, isi_komentar, tanggal_komentar, parent_id)
              VALUES ('$id_buku', '$id_pengguna', '$isi_komentar', '$tanggal_komentar', $parent_id)";

    if (mysqli_query($koneksi, $query)) {
        header("Location: detail_buku.php?id_buku=$id_buku");
        exit();
    } else {
        echo "Terjadi kesalahan: " . mysqli_error($koneksi);
    }
}
?>
