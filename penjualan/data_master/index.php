<?php 
$active = "Customer";
require_once("../../include/db.php");
require_once("../templates/header.php"); 
$cari = "";
if(isset($_GET["cari"])){
  $cari = $_GET["cari"];
}
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<h3 class="page-header"></i> Data Pelanggan</h3>
  <div class="row">
  <div class="col-md-12">
    <a href="add.php" class="btn btn-primary"></i> Tambah Data</a></br>
  </div>
  <div class="col-lg-3">
    <form class="form-inline" method="GET" action="index.php">
      <div class="input-group">
        <input type="text" class="form-control" name="cari" value="<?php echo $cari; ?>">
        <span class="input-group-btn">
          <button class="btn btn-default" type="submit">Search</button>
        </span>
      </div><!-- /input-group -->
    </form>
  </div><!-- /.col-lg-6 -->
  </div>
  <div class="row">
  <div class="col-md-12">
    <hr/>
    <?php 
      $result = mysql_query("SELECT * FROM pelanggan WHERE id_pelanggan LIKE '%$cari%' OR nama_pelanggan LIKE '%$cari%'");
      $qres = mysql_num_rows($result);
      if($qres != 0){
    ?>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>No.</th>
          <th>Id Pelanggan</th>
          <th>Nama Pelanggan</th>
          <th>Toko</th>
          <th>Alamat</th>
           <th>No Telepon</th>
           <th>Email </th>

          <th colspan="3">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $result = mysql_query("SELECT * FROM pelanggan WHERE id_pelanggan LIKE '%$cari%' OR nama_pelanggan LIKE '%$cari%'");
        
        while($row = mysql_fetch_array($result))
          {
        ?>
        <tr>
          <td><?php echo $no; ?>.</td>
          <td><?php echo $row['id_pelanggan']; ?></td>
          <td><?php echo $row['nama_pelanggan']; ?></td>
          <td><?php echo $row['toko']; ?></td>
          <td><?php echo $row['alamat']; ?></td>
          <td><?php echo $row['no_telepon']; ?></td>
          <td><?php echo $row['email']; ?></td>
          <td><a href="edit.php?id_pelanggan=<?php echo $row['id_pelanggan']; ?>" class="btn btn-info">Edit</a></td>
          <td><a onclick="return confirm('Hapus Data Ini ?')" href="delete.php?id=<?php echo $row['id_pelanggan']; ?>" class="btn btn-warning">Delete</a></td>
        </tr>
        <?php
          $no++;
          }
        ?>
      </tbody>
    </table>
    <?php 
      } else {
    ?>
      <h2>Data Tidak Ditemukan</h2>
    <?php

      }
    ?>
  </div>
  </div>
</div><!-- end main -->
<?php require_once("../templates/footer.php"); ?>