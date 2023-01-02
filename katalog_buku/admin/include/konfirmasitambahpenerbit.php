<?php 

$penerbit = $_POST['penerbit'];
if(empty($penerbit)){
	header("Location:index.php?include=tambah-penerbit&notif=tambahkosong");
}else{
	$sql = "insert into `penerbit` (`penerbit`) 
	values ('$penerbit')";
	mysqli_query($koneksi,$sql);
	header("Location:index.php?include=penerbit&notif=tambahberhasil");	
}
?>
