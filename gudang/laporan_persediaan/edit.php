<?php 
$active = "data_master";
$kode_customer = $_GET['kode_barang'];
require_once("../../include/db.php");
require_once("../templates/header.php"); 
$query = "select * from data_barang where kode_barang='".mysql_real_escape_string($_GET['kode_barang'])."'";
    $result = mysql_query($query);  
    $coba = mysql_fetch_array($result);
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<h3 class="page-header"></i> Edit Customer</h3>
  <div class="row">
  <div class="col-md-1">
  </div>
  <div class="col-md-9">
    <form class="form-horizontal" role="form" action="edit_proses.php" method="POST">
       <div class="form-group">
    <label for="inputkode_barang" class="col-lg-2 control-label">Kode Barang</label>
    <div class="col-lg-10">
      <input disabled type="varchar" class="form-control" id="inputkode_barang" placeholder="Kode Barang" name="kode_barang" value="<?php echo $coba['kode_barang']; ?>" >
       <input  type="hidden" name="kode_barang"  value="<?php echo $coba['kode_barang']; ?>"  /></td>
     </div>
  </div>
  <div class="form-group">
    <label for="inputnama_barang" class="col-lg-2 control-label">Nama Barang</label>
    <div class="col-lg-10">
      <input type="varchar" class="form-control" id="inputnama_barang" placeholder="Nama Barang" name="nama_barang" value="<?php echo $coba['nama_barang']; ?>">
    </div>
  </div>
   <div class="form-group">
    <label for="inputharga_satuan" class="col-lg-2 control-label">Harga Satuan</label>
    <div class="col-lg-10">
      <input type="varchar" class="form-control" id="inputharga_satuan" placeholder="Harga Satuan" name="harga_satuan" value="<?php echo $coba['harga_satuan']; ?>" >
    </div>
  </div>
  <div class="form-group">
    <label for="inputquantity" class="col-lg-2 control-label">Quantity</label>
    <div class="col-lg-10">
      <input type="text" class="form-control" id="inputquantity" placeholder="Quantity" name="quantity" value="<?php echo $coba['quantity']; ?>" >
    </div>
  </div>
<div class="form-group">
    <label for="inputdate" class="col-lg-2 control-label">Date</label>
    <div class="col-lg-10">

      <input type="date" class="form-control" id="inputdate" placeholder="Date" name="date" value="<?php echo $coba['date']; ?>"  >
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