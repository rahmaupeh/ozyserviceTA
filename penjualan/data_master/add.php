<?php 
$active = "customer";
require_once("../../include/db.php");
require_once("../templates/header.php"); 
$dat_server = mktime(date("G"),date("i"),date("s"),date("n"),date("j"),date("Y"));
$tgl = date("Y-n-j",$dat_server);
$thn = date("Y",$dat_server);

$kd_brg = "SELECT * FROM pelanggan ORDER BY id_pelanggan DESC";
$kd_brg = mysql_query($kd_brg);
$vd_brg = mysql_fetch_row($kd_brg);
$nd_brg = mysql_num_rows($kd_brg);

if($nd_brg == 0 ){
  $no_id = "COZ".$thn."-0001";
} else {
  $arr_id = explode("-", $vd_brg[0]);
  $new_id = $arr_id[1];
  $new_id = $new_id + 1;
  $count_id = strlen($new_id);

  while ($count_id < 4){
    $new_id = "0".$new_id;
    $count_id++;
  }
  $no_id = "COZ".$thn."-".$new_id;
}

?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<h3 class="page-header"></i> Input Pelanggan</h3>
  <div class="row">
  <div class="col-md-1">
  </div>
  <div class="col-md-9">
    <form class="form-horizontal" role="form" action="add_proses.php" method="POST">
      <div class="form-group">
        <label for="kode_customer" class="col-lg-2 control-label">Id Pelanggan</label>
        <div class="col-lg-10">
          <input type="int" class="form-control" id="kode_customer" placeholder="Id Pelanggan" value="<?php echo $no_id; ?>"name="id_pelanggan" required>
        </div>
      </div>
      <div class="form-group">
        <label for="nama_customer" class="col-lg-2 control-label">Nama Pelanggan</label>
        <div class="col-lg-10">
          <input type="text" class="form-control" id="nama_customer" placeholder="Nama Pelanggan" name="nama_pelanggan" required>
        </div>
        </div>
      <div class="form-group">
        <label for="nama_customer" class="col-lg-2 control-label">Nama Toko</label>
        <div class="col-lg-10">
          <input type="text" class="form-control" id="nama_customer" placeholder="Nama Toko" name="nama_toko" required>
        </div>
        </div>
      <div class="form-group">
        <label for="nama_toko" class="col-lg-2 control-label">Alamat</label>
        <div class="col-lg-10">
          <input type="text" class="form-control" id="nama_toko" placeholder="Alamat" name="alamat" required>
        </div>
      </div>
      <div class="form-group">
        <label for="alamat_toko" class="col-lg-2 control-label">No Telepon</label>
        <div class="col-lg-10">
          <input type="text" class="form-control" id="no_telepon" placeholder="No Telepon" name="no_telepon" required>
        </div>
      </div>
       <div class="form-group">
        <label for="alamat_rumah" class="col-lg-2 control-label">Email</label>
        <div class="col-lg-10">
          <input type="text" class="form-control" id="email" placeholder="email" name="email" required>
        </div>
      </div>
      </div>
      <div>
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