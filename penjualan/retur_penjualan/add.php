<?php 
$active = "Customer";
require_once("../../include/db.php");
require_once("../templates/header.php"); 

$dat_server = mktime(date("G"),date("i"),date("s"),date("n"),date("j"),date("Y"));
$tgl = date("Y-n-j",$dat_server);
$thn = date("Y",$dat_server);

$kd_brg = "SELECT * FROM retur ORDER BY kode_retur DESC";
$kd_brg = mysql_query($kd_brg);
$vd_brg = mysql_fetch_row($kd_brg);
$nd_brg = mysql_num_rows($kd_brg);

if($nd_brg == 0 ){
  $no_id = "ROZ".$thn."-0001";
} else {
  $arr_id = explode("-", $vd_brg[0]);
  $new_id = $arr_id[1];
  $new_id = $new_id + 1;
  $count_id = strlen($new_id);

  while ($count_id < 4){
    $new_id = "0".$new_id;
    $count_id++;
  }
  $no_id = "ROZ".$thn."-".$new_id;
}
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<h3 class="page-header"></i> Input Penjualan Kredit</h3>
  <div class="row">
  <div class="col-md-1">
  </div>
  <div class="col-md-9">
    <form class="form-horizontal" role="form" action="add_proses.php" method="POST">
      <div class="form-group">
    <label for="no_parts" class="col-lg-2 control-label">Kode Retur</label>
    <div class="col-lg-10">
      <input type="varchar" class="form-control" id="no_parts" placeholder="No Transaksi" readonly="readonly" value="<?php echo $no_id; ?>" name="kode_retur">
    </div>
  </div>
  <div class="form-group">
    <label for="inputnama_barang" class="col-lg-2 control-label">Kode Faktur</label>
     <div class="col-lg-10">
      <input type="varchar" class="form-control" id="no_parts" placeholder="No Faktur" value="" name="no_faktur">
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