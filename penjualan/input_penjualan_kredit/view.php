<?php
$active = "Customer";
require_once("../../include/db.php");
require_once("../templates/header.php"); 

$kode_transaksi = $_GET["kode_transaksi"];
$tagih = $_GET["tagih"];
//hellow world
?>


<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<h3 class="page-header"></i> View Detail Penjualan Kredit Kode Transaksi <?php echo $kode_transaksi;?></h3>
  <div class="row">
  <div class="col-md-12">
    <a href="index.php" class="btn btn-primary"></i> Back</a>
    <!-- <a href="http://localhost/ozyservice/penjualan/penjualan_kredit/index.php?kode_transaksi=<?php echo $kode_transaksi;?>" class="btn btn-primary"></i> Cetak Faktur Faktur</a> -->
  <?php if($tagih == 1){?>
    <a href="http://localhost/ozyservice/penjualan/surat_penagihan/buat_surat.php" class="btn btn-danger"></i> Cetak Penagihan</a>  
  <?php } ?>
  </div>
  </div>
  <div class="col-md-2">
  </div>
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
          <th>Quantity</th>
          <th>Harga Satuan</th>
          <th>diskon</th>
          <th>Total Harga</th>
          <th colspan="3">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $result = mysql_query("SELECT * FROM detail_penjualan JOIN data_barang ON (detail_penjualan.kode_barang = data_barang.kode_barang) WHERE detail_penjualan.kode_transaksi = '$kode_transaksi'");

        while($row = mysql_fetch_array($result))
          {
        ?>
        <tr>
          <td><?php echo $no; ?>.</td>
          <td><?php echo $row['kode_barang']; ?></td>
          <td><?php echo $row['nama_barang']; ?></td>
          <td><?php echo $row['jumlah']; ?></td> 
          <td><?php echo $row['harga']; ?></td>
          <td><?php echo $row['diskon']; ?></td>
          <td><?php echo ($row['jumlah']*$row['harga'])-($row['jumlah']*$row['harga']*$row['diskon']/100); ?></td> 
        
		  
          <td>
			<a onclick="return confirm('Hapus Data Ini ?')" href="add_proses.php?hapus=<?php echo $row['kode_barang']; ?>&kode_transaksi=<?php echo $row['kode_transaksi']; ?>" class="btn btn-danger">Delete</a></td>
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