<?php 
$active = "Penyewaan";
require_once("../../include/db.php");
require_once("../templates/header.php"); 
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<h3 class="page-header"><i class="fa fa-map-marker"></i> Input Penyewaan</h3>
  <div class="row">
  <div class="col-md-1">
  </div>
  <div class="col-md-9">
    <form id="formsewa" class="form-horizontal" role="form" action="add_proses.php" method="POST">
      <div class="form-group">
        <label for="customer" class="col-lg-2 control-label">Customer</label>
        <div class="col-lg-10">
          <select name="id_customer" id="customer" class="form-control" required>
            <option value="">Pilih Customer</option>
            <?php
            $result = mysql_query("SELECT * FROM customer");
            while($row = mysql_fetch_array($result))
            {
            ?>
            <option value="<?php echo $row['id_customer']; ?>"><?php echo $row['id_customer'].' | '.$row['nama']; ?></option>
            <?php
            }
            ?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="mobil" class="col-lg-2 control-label">Mobil</label>
        <div class="col-lg-10">
          <select name="id_mobil" id="mobil" class="form-control" required>
            <option value="">Pilih Mobil</option>
            <?php
            $result = mysql_query("select * from mobil left join (select * from (select * from sewa ORDER BY id_sewa DESC) AS x GROUP BY id_mobil) as sewa on sewa.id_mobil = mobil.id_mobil");
            while($row = mysql_fetch_array($result))
            {
              if($row['status'] == 'Belum Kembali') 
              {
                $status = 'Tidak Tersedia';
              }
              else
              {
                $status = 'Tersedia'; 
              }
            ?>
            <option data-status="<?php echo $status ?>" data-harga="<?php echo $row['harga_sewa']; ?>" value="<?php echo $row['id_mobil']; ?>"><?php echo $row['no_plat'].' | '.$row['merk'].' | '.$row['warna'].' | '.$status; ?></option>
            <?php
            }
            ?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="tgl_sewa" class="col-lg-2 control-label">Tgl Sewa</label>
        <div class="col-lg-10">
          <input type="date" class="form-control" id="tgl_sewa" name="tgl_sewa" required>
        </div>
      </div>
      <div class="form-group">
        <label for="tgl_kembali" class="col-lg-2 control-label">Tgl Kembali</label>
        <div class="col-lg-10">
          <input type="date" class="form-control" id="tgl_kembali" name="tgl_kembali" required>
        </div>
      </div>
      <div class="form-group">
        <label for="harga_total" class="col-lg-2 control-label">Harga Total</label>
        <div class="col-lg-10">
          <input type="number" class="form-control" id="harga_total" name="harga_total" required>
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