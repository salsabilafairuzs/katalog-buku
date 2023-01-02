<?php
if(isset($_POST["katakunci"])){
  $katakunci_konten = $_POST["katakunci"];
  $_SESSION['katakunci_konten'] = $katakunci_konten;
}
if(isset($_SESSION['katakunci_konten'])){
  $katakunci_konten = $_SESSION['katakunci_konten'];
}

?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3><i class="fas fa-file-alt"></i> Konten</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"> Konten</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Daftar  Konten</h3>
                <div class="card-tools">
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="col-md-12">
                  <form method="post" action="index.php?include=konten">
                    <div class="row">
                        <div class="col-md-4 bottom-10">
                          <input type="text" class="form-control" id="kata_kunci" name="katakunci">
                        </div>
                        <div class="col-md-5 bottom-10">
                          <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i>&nbsp; Search</button>
                        </div>
                    </div><!-- .row -->
                  </form>
                </div><br>
              <div class="col-sm-12">
                <?php if(!empty($_GET['notif'])){ ?>
                  <?php if($_GET['notif']=="editberhasil"){ ?>
                    <div class="alert alert-success" role="alert">Data Berhasil Diubah</div>
                  <?php } ?>
                <?php } ?>
              </div>
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th width="5%">No</th>
                      <th width="20%">Judul</th>
                      <th width="30%">Isi</th>
                      <th width="20%">Tanggal</th>
                      <th width="20%"><center>Aksi</center></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php  
                    $batas = 1; 
                    if(!isset($_GET['halaman'])){ 
                         $posisi = 0; 
                         $halaman = 1; 
                    }else{ 
                         $halaman = $_GET['halaman']; 
                         $posisi = ($halaman-1) * $batas; 
                    }
                    //query sql
                    $sql_kon = "SELECT `id_konten`,`judul`,`tanggal`,`isi` FROM `konten` ";  
                    if (!empty($katakunci_konten)){ 
                      $sql_kon .= " where `judul` LIKE '%$katakunci_konten%'";
                    }
                    $sql_kon .= " ORDER BY `judul` limit $posisi, $batas";
                    $query_kon = mysqli_query($koneksi,$sql_kon); 
                    $posisi += 1; 
                    while($data_kon = mysqli_fetch_row($query_kon)){ 
                       $id_konten = $data_kon[0]; 
                       $judul = $data_kon[1]; 
                       $isi = $data_kon[3];
                       $tanggal = $data_kon[2]; 
                    ?>
                    <?php 
                      $sql_jum = "select `id_konten`, `judul`,`isi`, `tanggal`from `konten` ";  
                      if (!empty($katakunci_konten)){ 
                        $sql_jum .= " where `judul` LIKE '%$katakunci_konten%'"; 
                      }  
                      $sql_jum .= " order by `judul`"; 
                      $query_jum = mysqli_query($koneksi,$sql_jum); 
                      $jum_data = mysqli_num_rows($query_jum); 
                      $jum_halaman = ceil($jum_data/$batas); 
                    ?>
                    <tr>
                    <td><?php echo $posisi;?></td>
                    <td><?php echo $judul;?></td>
                    <td><?php echo $isi;?></td>
                    <td><?php echo $tanggal;?></td>
                    <td align="center">
                      <a href="index.php?include=edit-konten&data=<?php echo $id_konten;?>" class="btn btn-xs btn-info"><i class="fas fa-edit"></i></a>
                      <a href="index.php?include=detail-konten&data=<?php echo $id_konten;?>" class="btn btn-xs btn-info" title="Detail"><i class="fas fa-eye"></i></a>
                      <!--a href="javascript:if(confirm('Anda yakin ingin menghapus konten <?php echo $judul; ?>?'))window.location.href = 'konten.php?aksi=hapus&data=<?php echo $id_konten;?>&notif=hapusberhasil'" class="btn btn-xs btn-warning"><i class="fas fa-trash" title="Hapus"></i></a-->                         
                    </td>
                  </tr>
                  <?php $posisi++;}?> 
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
              <ul class="pagination pagination-sm m-0 float-right">
                <?php if($jum_halaman==0){
                      //tidak ada halaman
                    }else if($jum_halaman==1){
                      echo "<li class='page-item'><a class='page-link'>1</a></li>";
                    }else{
                      $sebelum = $halaman-1;
                      $setelah = $halaman+1;
                      if($halaman!=1){
                        echo "<li class='page-item'>
                        <a class='page-link' 
                        href='index.php?include=konten&halaman=1'>First</a></li>";
                        echo "<li class='page-item'><a class='page-link' 
                        href='index.php?include=konten&
                        halaman=$sebelum'>
                        «</a></li>";
                    }
                    for($i=1; $i<=$jum_halaman; $i++){
                      if ($i > $halaman - 5 and $i < $halaman + 5 ) {
                        if($i!=$halaman){
                          echo "<li class='page-item'><a class='page-link' 
                          href='index.php?include=konten&halaman=$i'>
                          $i</a></li>";
                        }else{
                          echo "<li class='page-item'>
                          <a class='page-link'>$i</a></li>";
                        }
                      }
                    }
                      if($halaman!=$jum_halaman){
                        echo "<li class='page-item'>
                        <a class='page-link'  
                        href='index.php?include=konten
                        &halaman=$setelah'>»</a></li>";
                        echo "<li class='page-item'><a class='page-link' 
                        href='index.php?include=konten&halaman=$jum_halaman'>
                        Last</a></li>";
                      }
                    }?>
              </ul>
              </div>
            </div>
            <!-- /.card -->

    </section>

