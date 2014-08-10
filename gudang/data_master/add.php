<?php 
$active = "Customer";
require_once("../../include/db.php");
require_once("../templates/header.php"); 
$dat_server = mktime(date("G"),date("i"),date("s"),date("n"),date("j"),date("Y"));
$tgl = date("Y-n-j",$dat_server);
$thn = date("Y",$dat_server);

$kd_brg = "SELECT * FROM data_barang ORDER BY kode_barang DESC";
$kd_brg = mysql_query($kd_brg);
$vd_brg = mysql_fetch_row($kd_brg);
$nd_brg = mysql_num_rows($kd_brg);

if($nd_brg == 0 ){
  $no_id = "PB".$thn."-0001";
} else {
  $arr_id = explode("-", $vd_brg[0]);
  $new_id = $arr_id[1];
  $new_id = $new_id + 1;
  $count_id = strlen($new_id);

  while ($count_id < 4){
    $new_id = "0".$new_id;
    $count_id++;
  }
  $no_id = "PB".$thn."-".$new_id;
}

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
      <input required type="text" class="form-control" id="inputkode_barang" readonly="readonly" placeholder="Kode Barang" name="kode_barang" value="<?php echo $no_id;?>">
    </div>
  </div>
  <div class="form-group">
    <label for="inputkode_barang" class="col-lg-2 control-label">No Parts</label>
    <div class="col-lg-10">
      <input required type="text" class="form-control" id="inputkode_barang" placeholder="No Parts" name="no_parts">
    </div>
  </div>
  <div class="form-group">
    <label for="inputnama_barang" class="col-lg-2 control-label">Nama Barang</label>
    <div class="col-lg-10">
      <input required type="text" class="form-control" id="inputnama_barang" placeholder="Nama Barang" name="nama_barang">
    </div>
  </div>
  <div class="form-group">
    <label for="input" class="col-sm-2 control-label">Kategori</label>
      <div class="col-sm-2">
        <select class="form-control" name="kategori">
          <option value=""> </option>
          <option value="oli">oli </option>
          <option value="bearing">bearing </option>
          <option value="sparkplugs">sparkplugs </option>
          <option value="tire">tire </option>
          <option value="cover body">cover body </option>
        </select>
      </div>
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