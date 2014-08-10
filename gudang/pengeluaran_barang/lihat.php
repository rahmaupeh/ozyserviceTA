<?php 
$active = "Customer";
require_once("../../include/db.php");
require_once("../templates/header.php"); 
$no_surat = $_GET["no_surat"];
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<h3 class="page-header"></i> Detail Pengeluaran Barang Kode Surat <?php echo $no_surat?></h3>
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
          <th>Nama Barang</th>
          <th>Jumlah</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $result = mysql_query("SELECT * FROM Pengeluaran_barang_detail JOIN data_barang ON (Pengeluaran_barang_detail.kode_barang = data_barang.kode_barang) WHERE Pengeluaran_barang_detail.kode_surat='$no_surat'");
        //echo "SELECT * FROM Pengeluaran_barang_detail JOIN data_barang (Pengeluaran_barang_detail.kode_barang = data_barang.kode_barang) WHERE Pengeluaran_barang_detail.kode_surat='$no_surat'";
        while($row = mysql_fetch_array($result))
          {
        ?>
        <tr>
          <td><?php echo $no; ?>.</td>
          <td><?php echo $row[1]; ?></td>
          <td><?php echo $row[6]; ?></td>
          <td><?php echo $row[2]; ?></td> 		  
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