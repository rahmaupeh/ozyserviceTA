<?php 
$active = "Customer";
require_once("../../include/db.php");
require_once("../templates/header.php"); 
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<h3 class="page-header"></i> Input Barang</h3>
  <div class="row">
  <div class="col-md-1">
  </div>
  <div class="col-md-9">
    <form class="form-horizontal" role="form" action="add_proses.php" method="POST">
      <div class="form-group">
    <label for="inputkode_barang" class="col-lg-2 control-label">Kode Barang</label>
    <div class="col-lg-10">
      <input type="text" class="form-control" id="inputkode_barang" placeholder="Kode Barang" name="kode_barang">
    </div>
  </div>
  <div class="form-group">
    <label for="inputnama_barang" class="col-lg-2 control-label">Nama Barang</label>
    <div class="col-lg-10">
      <input type="text" class="form-control" id="inputnama_barang" placeholder="Nama Barang" name="nama_barang">
    </div>
  </div>
   <div class="form-group">
    <label for="inputharga_satuan" class="col-lg-2 control-label">Harga Satuan</label>
    <div class="col-lg-10">
      <input type="text" class="form-control" id="inputharga_satuan" placeholder="Harga Satuan" name="harga_satuan">
    </div>
  </div>
  <div class="form-group">
    <label for="inputquantity" class="col-lg-2 control-label">Quantity</label>
    <div class="col-lg-10">
      <input type="text" class="form-control" id="inputquantity" placeholder="Quantity" name="quantity">
    </div>
  </div>
            <?
$total_harga=$quantity*$harga_satuan;

?>
<div class="form-group">
    <label for="inputdate" class="col-lg-2 control-label">Date</label>
    <div class="col-lg-10">

      <input type="date" class="form-control" id="inputdate" placeholder="Date" name="date">
    </div>
  </div>
      <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10">
          <button type="submit" class="btn btn-primary">Submit</button>
          <a href="index.php" class="btn btn-default">Cancel</a>
        </div>
      </div>
    </form>
  </div>
  <div class="col-md-2">
  </div>
  </div>
</div><!-- end main -->
<?php require_once("../templates/footer.php"); ?>