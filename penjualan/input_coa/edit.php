<?php 
$active = "customer";
$kode_customer = $_GET['kode_customer'];
require_once("../../include/db.php");
require_once("../templates/header.php"); 
$query = "select * from input_coa where kode_akun='".mysql_real_escape_string($_GET['kode_akun'])."'";
    $result = mysql_query($query);  
    $coba = mysql_fetch_array($result);
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<h3 class="page-header"> Edit Coa</h3>
  <div class="row">
  <div class="col-md-1">
  </div>
  <div class="col-md-9">
    <form class="form-horizontal" role="form" action="edit_proses.php" method="POST">
     <div class="form-group">
        <label for="kode_akun" class="col-lg-2 control-label">Kode Akun</label> 
        <div class="col-lg-10">
          <input disabled type="varchar" class="form-control" id="kode_akun" placeholder="Kode Akun" name="kode_akun" value="<?php echo $coba['kode_akun']; ?>" ></td>
          <input  type="hidden" name="kode_akun"  value="<?php echo $coba['kode_akun']; ?>"  /></td>
        </div>
      </div>
      <div class="form-group">
        <label for="nama_akun" class="col-lg-2 control-label">Nama Akun</label>
        <div class="col-lg-10">
          <input type="text" class="form-control" id="nama_akun" placeholder="Nama Akun" name="nama_akun" value="<?php echo $coba['nama_akun']; ?>"  ></td>
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