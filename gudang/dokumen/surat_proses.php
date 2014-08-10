<?php 
$active = "Customer";
require_once("../../include/db.php");
require_once("../templates/header.php"); 
$no_surat = $_GET["no_surat"];

if(isset($_GET["kode_barang"])){
  $kode_barang = $_GET["kode_barang"];
  $qambil = "SELECT * FROM permintaan_barang_detail WHERE kode_surat = '$no_surat' AND kode_barang = '$kode_barang'";
  $qambil = mysql_query($qambil);
  while($ambil  = mysql_fetch_array($qambil)){
    $qstok_toko = mysql_query("SELECT * FROM data_barang WHERE kode_barang = '$ambil[1]'");
    $stok_toko = mysql_fetch_row($qstok_toko);
    $new = $stok_toko[7];
    //echo $new." ";
    
    $new = $new + $ambil[2];
    //echo $ambil[2]." ";
    //echo $new;

    mysql_query("UPDATE  `ozyservice`.`data_barang` SET  `stock toko` =  '$new' WHERE  `data_barang`.`kode_barang` =  '$ambil[1]'");

  }
  mysql_query("UPDATE  `ozyservice`.`permintaan_barang_detail` SET  `status` =  'sudah proses' WHERE  `permintaan_barang_detail`.`kode_surat` =  '$no_surat' AND  `permintaan_barang_detail`.`kode_barang` =  '$kode_barang'");
  mysql_query("UPDATE  `ozyservice`.`permintaan_barang` SET  `status` =  'sudah proses' WHERE  `permintaan_barang`.`kode_surat` =  '$no_surat'");
}
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<h3 class="page-header"></i> Detail Permintaan Barang Kode Surat <?php echo $no_surat?></h3>
  <div class="row">
  </div>

  <div class="row">
  <div class="col-md-12">
    <hr/>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>No</th>
          <th>Kode Barang</th>
          <th>Jumlah</th>
          <th>Status</th>
          <th colspan="3">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $result = mysql_query("SELECT * FROM permintaan_barang_detail WHERE kode_surat='$no_surat'");

        while($row = mysql_fetch_array($result))
          {
        ?>
        <tr>
          <td><?php echo $no; ?>.</td>
          <td><?php echo $row[1]; ?></td>
          <td><?php echo $row[2]; ?></td>
          <td><?php echo $row[3]; ?></td>  	
          <td>
          <?php if ($row[3]!="sudah proses"){?>
            <a href="surat_proses.php?no_surat=<?php echo $row[0]; ?>&kode_barang=<?php echo $row[1]; ?>" class="btn btn-success">Update</a>
          <?php } ?></td>	  
        </tr>
        <?php
          $no++;
          }
        ?>
      </tbody>
    </table>
  </div>
  </div>
</div><!-- end main -->
<?php require_once("../templates/footer.php"); ?>