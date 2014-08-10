<?php 
$active = "Pengembalian";
require_once("../../include/db.php");
require_once("../templates/header.php"); 
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<h3 class="page-header"><i class="fa fa-map-marker"></i> Input Pengembalian</h3>
  <div class="row">
  <div class="col-md-1">
  </div>
  <div class="col-md-9">
    <form class="form-horizontal" role="form" action="add_proses.php" method="POST">
      <div class="form-group">
        <label for="penyewaan" class="col-lg-2 control-label">Penyewaan</label>
        <div class="col-lg-10">
          <select name="id_sewa" id="penyewaan" class="form-control" required>
            <option value="">Pilih Penyewaan</option>
            <?php
            $result = mysql_query("SELECT * FROM sewa join mobil using(id_mobil) join customer using(id_customer) where status = 'Belum Kembali'");
            while($row = mysql_fetch_array($result))
            {
            ?>
            <option data-merk="<?php echo $row['merk']; ?>" data-warna="<?php echo $row['warna']; ?>" data-noplat="<?php echo $row['no_plat']; ?>" data-customer="<?php echo $row['nama']; ?>" data-tglsewa="<?php echo $row['tgl_sewa']; ?>" data-tglkembali="<?php echo $row['tgl_kembali']; ?>" data-hargatotal="<?php echo $row['total_bayar']; ?>" value="<?php echo $row['id_sewa']; ?>"><?php echo $row['id_sewa'].' | '.$row['no_plat'].' | '.$row['nama']; ?></option>
            <?php
            }
            ?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="merk" class="col-lg-2 control-label">Merk</label>
        <div class="col-lg-10">
          <input type="text" class="form-control" id="merk" name="merk" disabled>
        </div>
      </div>
      <div class="form-group">
        <label for="warna" class="col-lg-2 control-label">Warna</label>
        <div class="col-lg-10">
          <input type="text" class="form-control" id="warna" name="warna" disabled>
        </div>
      </div>
      <div class="form-group">
        <label for="no_plat" class="col-lg-2 control-label">No Plat</label>
        <div class="col-lg-10">
          <input type="text" class="form-control" id="no_plat" name="no_plat" disabled>
        </div>
      </div>
      <div class="form-group">
        <label for="customer" class="col-lg-2 control-label">Customer</label>
        <div class="col-lg-10">
          <input type="text" class="form-control" id="customer" name="customer" disabled>
        </div>
      </div>
      <div class="form-group">
        <label for="tgl_sewa" class="col-lg-2 control-label">Tgl Sewa</label>
        <div class="col-lg-10">
          <input type="date" class="form-control" id="tgl_sewa" name="tgl_sewa" disabled>
        </div>
      </div>
      <div class="form-group">
        <label for="tgl_kembali" class="col-lg-2 control-label">Tgl Kembali</label>
        <div class="col-lg-10">
          <input type="date" class="form-control" id="tgl_kembali" name="tgl_kembali" disabled>
        </div>
      </div>
      <div class="form-group">
        <label for="harga_total" class="col-lg-2 control-label">Harga Total</label>
        <div class="col-lg-10">
          <input type="text" class="form-control" id="harga_total" name="harga_total" disabled>
        </div>
      </div>
      <div class="form-group">
        <label for="harga_total" class="col-lg-2 control-label">Status</label>
        <div class="col-lg-10">
          <select name="status" class="form-control" required>
            <option value="">Pilih Status</option>
            <option value="Belum Kembali">Belum Kembali</option>
            <option value="Sudah Kembali">Sudah Kembali</option>
          </select>
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