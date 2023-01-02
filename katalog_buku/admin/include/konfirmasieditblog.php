<?php 
session_start();
include('../koneksi/koneksi.php');
// $id_user = $_SESSION['id_user'];
// // kurang user
if(isset($_SESSION['id_blog'])){
$id_blog = $_SESSION['id_blog'];
$id_kategori_blog = $_POST['kategori'];
$judul = $_POST['juduls'];
$isi = $_POST['isi'];

if(empty($id_kategori_blog)){
	header("Location:index.php?include=edit-blog&notif=tambahkategorikosong");
}else if(empty($judul)){
	header("Location:index.php?include=edit-blog&notif=tambahjudulkosong");
}else if(empty($isi)){
	header("Location:index.php?include=edit-blog&notif=tambahisikosong");
}else{
	$sql = "UPDATE `blog` SET `id_kategori_blog`='$id_kategori_blog', `judul`='$judul', `isi`='$isi' WHERE `id_blog`='$id_blog'";

	mysqli_query($koneksi,$sql);
    unset($_SESSION['id_blog']);
header("Location:index.php?include=blog&notif=editblogberhasil");	
}}
?>