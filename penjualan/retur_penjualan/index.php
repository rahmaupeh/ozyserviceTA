<?php 
$active = "Customer";
require_once("../../include/db.php");
require_once("../templates/header.php"); 
?>



<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

<?php
if(isset($_GET["kode_retur"])){
  $kode_retur = $_GET["kode_retur"];
  
} else {
  $kode_retur = "";
}

if($kode_retur == ""){
?>
  <div class="form-group">
    <form action="index.php">
    <label for="inputkode_barang" class="col-lg-2 control-label">No Retur</label>
    <div class="col-lg-10">
      <select class="form-control" name="kode_retur">
          <option value=""> </option>
            <?php 
              $qtransaksi = "SELECT * FROM retur";
              $qtransaksi = mysql_query($qtransaksi);
              while($transaksi = mysql_fetch_array($qtransaksi)){
            ?>
          <option value="<?php echo $transaksi[0];?>"> <?php echo $transaksi[0];?></option>
      <?php
        }
      ?>
        </select>

    </div>
    <div class="col-lg-offset-2 col-lg-10">
          <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>
  </div>
  <div class="row">
      <div class="col-md-2">
        <a href="add.php" class="btn btn-primary"></i> Buat Retur</a>
      </div>
      
    </div><!-- /.row -->

<?php
}


$view = mysql_fetch_row(mysql_query("SELECT * FROM retur JOIN penjualan ON (retur.kode_faktur = penjualan.kode_faktur) JOIN transaksi ON (penjualan.kode_transaksi= transaksi.kode_transaksi) JOIN pelanggan ON (transaksi.id_pelanggan = pelanggan.id_pelanggan) WHERE retur.kode_retur = '$kode_retur'"));
//echo "SELECT * FROM retur JOIN faktur ON (retur.kode_faktur = faktur.kode_faktur) JOIN transaksi ON (faktur.kode_transaksi= transaksi.kode_transaksi) JOIN pelanggan ON (transaksi.id_pelanggan = pelanggan.id_pelanggan) WHERE retur.kode_retur = '$kode_retur'";
?>





<center><h3 class="page-header">Retur Penjualan </h3></center>
  <h4><tr>Ozy Service</tr></h4>
  <h4><tr>Jalan Pematang Pasir no 121 Tanjung Mulia Hilir</tr></h4>
  <h4><tr>Telp 061-6614627</tr></h4>
  <div class="row">
  <div class="col-md-12">
    <form class="form-horizontal" role="form">
  <div class="form-group">
    <label for="input" class="col-sm-1 control-label">No Retur:</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" id="input" value="<?php echo $view[0];?>" readonly="readonly">
    </div>
    <div class="col-sm-5">
    </div>
    </div>
   <form class="form-horizontal" role="form">
  <div class="form-group">
    <label for="input" class="col-sm-1 control-label">Customer:</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" id="input" value="<?php echo $view[13];?>" readonly="readonly">
    </div>
  <div class="col-sm-5">
    </div>
    </div>
   <form class="form-horizontal" role="form">
  <div class="form-group">
    <label for="input" class="col-sm-1 control-label">Alamat :</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" id="input" value="<?php echo $view[15];?>" readonly="readonly">
    </div>
  </div>
  <form class="form-horizontal" role="form">
  <div class="form-group">
  <label for="input" class="col-sm-1 control-label">Tanggal Retur:</label>
    <div class="col-sm-3">
      <input type="date" class="form-control" id="input" value="<?php echo $view[2];?>" readonly="readonly">
    </div>
  </div>
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
          <th>Quantity beli</th>
          <th>Quantity rusak</th>
          <th>Keterangan</th>
    

        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $result = mysql_query("SELECT * FROM retur_detail JOIN data_barang ON (retur_detail.kode_barang = data_barang.kode_barang) WHERE retur_detail.kode_retur = '$kode_retur'");
        //echo "SELECT * FROM retur_detail JOIN input_barang_masuk ON (retur_detail.kode_barang = input_barang_masuk.kode_barang) WHERE retur_detail.kode_retur = '$kode_retur'";
        while($row = mysql_fetch_array($result))
          {
        ?>
        <tr>
          <td><?php echo $no; ?>.</td>
          <td><?php echo $row['kode_barang']; ?></td>
          <td><?php echo $row['nama_barang']; ?></td>
          <td><?php echo $row['jumlah']; ?></td> 
          <td><?php echo $row['jumlah_retur']; ?></td>
          <td><?php echo $row['keterangan']; ?></td>
        </tr>
        <?php
          $no++;
          }
        ?>
      </tbody>
    </table>
    <div class="row">
    <div class="col-md-12">
    <div class="col-md-8">
    </div>
    <form class="form-horizontal" role="form">
 
  </div>
  </div>
 <div class="form-group"> </div>
  <div class="form-group"> </div>

   <div class="row">
        <div class="col-md-3">Diterima Oleh  <textarea class="form-control" rows="3"></textarea> </div>
        <div class="col-md-6"></div>
        <div class="col-md-3">Bagian Penjualan <textarea class="form-control" rows="3"></textarea> </div>
      </div>
      <center><button onClick="return window.print();" class="btn btn-default">Print</button></center>
      
  </div>
</div><!-- end main -->
<?php require_once("../templates/footer.php"); ?>