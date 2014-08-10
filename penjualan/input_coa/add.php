<?php 
$active = "customer";
require_once("../../include/db.php");
require_once("../templates/header.php"); 
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<h3 class="page-header"></i> Input Akun Coa</h3>
  <div class="row">
  <div class="col-md-1">
  </div>
  <div class="col-md-9">
    <form class="form-horizontal" role="form" action="add_proses.php" method="POST">
      <div class="form-group">
        <label for="kode_akun" class="col-lg-2 control-label">Ref</label>
        <div class="col-lg-10">
          <input type="varchar" class="form-control" id="kode_akun" placeholder="Kode Akun" name="kode_akun" required>
        </div>
      </div>
      <div class="form-group">
        <label for="kode_akun" class="col-lg-2 control-label">Jenis</label>
        <div class="col-lg-10">
          <select class="form-control" name="jenis">
          <option value="asset">asset</option>
          <option value="modal">modal</option>
          <option value="pendapatan">pendapatan</option>
          <option value="beban">beban</option>
          <option value="pendapatan lain lain">pendapatan lain lain</option>
        </select>
        </div>
      </div>
      <div class="form-group">
        <label for="nama_akun" class="col-lg-2 control-label">Nama Akun</label>
        <div class="col-lg-10">
          <input type="text" class="form-control" id="nama_akun" placeholder="Nama Akun" name="nama_akun" required>
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