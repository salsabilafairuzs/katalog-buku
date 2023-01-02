<?php 

if(isset($_SESSION['id_penerbit'])){
  $id_penerbit = $_SESSION['id_penerbit'];
  $penerbit = $_POST['penerbit'];
 
   if(empty($penerbit)){
	header("Location:index.php?include=edit-penerbit&data=".$id_penerbit."&notif=editkosong");
  }else{
	$sql = "update `penerbit` set `penerbit`='$penerbit' 
	where `id_penerbit`='$id_penerbit'";
	mysqli_query($koneksi,$sql);
	unset($_SESSION['id_penerbit']);
	header("Location:index.php?include=penerbit&notif=editberhasil");
  }
}
?>