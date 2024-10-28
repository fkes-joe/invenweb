<?php
session_start();
include ('../config/conn.php');
include ('../config/function.php');

if(isset($_POST['tambah'])){
    $nama_barang = $_POST['nama_barang'];
    $id_merek = $_POST['id_merek'];
    $id_kategori =  $_POST['id_kategori'];
    $id_ruangan =  $_POST['id_ruangan'];
    $id_kondisi =  $_POST['id_kondisi'];
    $jumlah_awal =  $_POST['jumlah_awal'];
    $keterangan_barang =  $_POST['keterangan_barang'];
    $tanggal_barang =  $_POST['tanggal'];

    // Cek apakah nama barang sudah ada
    $check_query = mysqli_query($con, "SELECT * FROM tb_barang WHERE nama_barang = '$nama_barang'");
    
    if (mysqli_num_rows($check_query) > 0) {
        // Jika ada, set pesan error
        $_SESSION['error'] = 'Nama barang sudah ada. Silakan gunakan nama yang berbeda.';
        header('Location:../?barang');
        exit();
    }

    // Jika nama barang belum ada, lakukan insert
    $insert = mysqli_query($con,"INSERT INTO tb_barang (id_merek, id_kategori, id_ruangan, id_kondisi, jumlah_awal, nama_barang, keterangan_barang, tanggal_barang) VALUES ('$id_merek','$id_kategori','$id_ruangan','$id_kondisi','$jumlah_awal', '$nama_barang','$keterangan_barang', '$tanggal_barang')") or die (mysqli_error($con));
    
    if($insert){
        $_SESSION['success'] = 'Berhasil menambahkan data barang';
    }else{
        $_SESSION['error'] = 'Gagal menambahkan data barang';
    }
    header('Location:../?barang');
}

// Proses ubah
if(isset($_POST['ubah'])){
    $id = $_POST['id'];
    $nama_barang = $_POST['nama_barang'];
    $id_merek = $_POST['id_merek'];
    $id_kategori =  $_POST['id_kategori'];
    $id_ruangan =  $_POST['id_ruangan'];
    $id_kondisi =  $_POST['id_kondisi'];
    $jumlah_awal =  $_POST['jumlah_awal'];
    $keterangan_barang =  $_POST['keterangan_barang'];
    $tanggal_barang =  $_POST['tanggal'];

    $update = mysqli_query($con,"UPDATE tb_barang SET nama_barang='$nama_barang', id_merek='$id_merek', id_kategori='$id_kategori', id_ruangan='$id_ruangan', id_kondisi='$id_kondisi', jumlah_awal='$jumlah_awal', keterangan_barang='$keterangan_barang', tanggal_barang='$tanggal_barang' WHERE id_barang='$id'") or die (mysqli_error($con));
    
    if($update){
        $_SESSION['success'] = 'Berhasil mengubah data barang';
    }else{
        $_SESSION['error'] = 'Gagal mengubah data barang';
    }
    header('Location:../?barang');
}

// Proses hapus
if(decrypt($_GET['act'])=='delete' && isset($_GET['id'])!=""){
    $id = decrypt($_GET['id']);
    $query = mysqli_query($con, "DELETE FROM tb_barang WHERE id_barang='$id'")or die(mysqli_error($con));
    if($query){
        $_SESSION['success'] = 'Berhasil menghapus data barang';
    }else{
        $_SESSION['error'] = 'Gagal menghapus data barang';
    }
    header('Location:../?barang');
}
?>