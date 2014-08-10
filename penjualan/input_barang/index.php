<?php 
$active = "Customer";
require_once("../../include/db.php");
require_once("../templates/header.php");

if(!isset($_GET['cari'])){
  $_GET['cari'] = "";
} 
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<h3 class="page-header"></i> Data Barang Toko</h3>
    <div class="row">
      <div class="col-md-2">
        <a href="add.php" class="btn btn-primary"></i> Tambah Data</a>
      </div>
      <div class="col-md-2">
        <a href="surat.php" class="btn btn-primary"></i> Proses Surat</a>
      </div>
      <div class="col-lg-7">
      </div>
        <div class="col-lg-3">
        <form class="form-inline" method="GET" action="index.php">
        <div class="input-group">
          <input type="text" class="form-control" name="cari" value="<?php echo $_GET['cari']; ?>">
          <span class="input-group-btn">
            <button class="btn btn-default" type="submit">Search</button>
          </span>
        </div><!-- /input-group -->
        </form>
      </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->
  <div class="row">
  <div class="col-md-12">
    <hr/>
    <?php
      $cari = "";
      $cari = $_GET['cari'];
      $result = mysql_query("SELECT * FROM data_barang WHERE nama_barang LIKE '%$cari%' or kode_barang LIKE '%$cari%' or kategori LIKE '$cari' or no_parts LIKE '%$cari%'");
      $found = mysql_num_rows($result);
      if($found != 0 ){
    ?>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>No</th>
          <th>Kode Barang </th>
          <th>No Parts </th>
          <th>Nama Barang</th>
          <th>Kategori</th>
          <th>Harga Beli</th>
          <th>Harga Jual</th>
          <th>Diskon</th>
          <th>Stock</th>
          <th colspan="3">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;

        while($row = mysql_fetch_array($result))
          {
            if($row['stock toko']< 10){
                $warna = "ff0000";
              } else {
                $warna = "ffffff";
              }


        ?>
        <tr bgcolor="<?php echo $warna;?>">
          <td><?php echo $no; ?>.</td>
          <td><?php echo $row['kode_barang']; ?></td>
          <td><?php echo $row['no_parts']; ?></td>
          <td><?php echo $row['nama_barang']; ?></td>
          <td><?php echo $row['kategori']; ?></td>
          <td><?php echo $row['harga_beli']; ?></td> 
          <td><?php echo $row['harga_jual']; ?></td>
          <td><?php echo $row['diskon']; ?>%</td> 
          <td><?php echo $row['stock toko']; ?></td> 
         
          <td><a href="edit.php?kode_barang=<?php echo $row['kode_barang']; ?>" class="btn btn-success">Edit</a>
      <a onclick="return confirm('Hapus Data Ini ?')" href="delete.php?kode_barang=<?php echo $row['kode_barang']; ?>"class="btn btn-danger">Delete</a></td>
        </tr>
        <?php
          $no++;
          }
        ?>
      </tbody>
    </table>
    <?php } else {?>
      <h1 align="center">Not Found...!!!</h1>
    <?php } ?>
  </div>
  </div>
</div><!-- end main -->
<?php require_once("../templates/footer.php"); ?>