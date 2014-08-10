<?php 
$active = "customer";
$id_pelanggan = $_GET['id_pelanggan'];
require_once("../../include/db.php");
require_once("../templates/header.php"); 
$query = "select * from pelanggan where id_pelanggan='".mysql_real_escape_string($_GET['id_pelanggan'])."'";
    $result = mysql_query($query);  
    $coba = mysql_fetch_array($result);
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<h3 class="page-header"> Edit Customer</h3>
  <div class="row">
  <div class="col-md-1">
  </div>
  <div class="col-md-9">
    <form class="form-horizontal" role="form" action="edit_proses.php" method="POST">
     <div class="form-group">
        <label for="id_pelanggan" class="col-lg-2 control-label">Id Pelanggan</label>
        <div class="col-lg-10">
          <input disabled type="int" class="form-control" id="id_pelanggan" placeholder="Kode Customer" name="id_pelanggan" value="<?php echo $coba['id_pelanggan']; ?>" ></td>
          <input  type="hidden" name="id_pelanggan"  value="<?php echo $coba['id_pelanggan']; ?>"  /></td>
        </div>
      </div>
      <div class="form-group">
        <label for="nama_pelanggan" class="col-lg-2 control-label">Nama Pelanggan</label>
        <div class="col-lg-10">
          <input type="text" class="form-control" id="nama_pelanggan" placeholder="Nama Pelanggan" name="nama_pelanggan" value="<?php echo $coba['nama_pelanggan']; ?>"  ></td>
        </div>
        </div>
      <div class="form-group">
        <label for="nama_pelanggan" class="col-lg-2 control-label">Nama Toko</label>
        <div class="col-lg-10">
          <input type="text" class="form-control" id="nama_pelanggan" placeholder="Nama Pelanggan" name="nama_toko" value="<?php echo $coba['toko']; ?>"  ></td>
        </div>
        </div>
      <div class="form-group">
        <label for="alamat" class="col-lg-2 control-label">Alamat </label>
        <div class="col-lg-10">
          <input type="text" class="form-control" id="alamat" placeholder="Alamat" name="alamat" value="<?php echo $coba['alamat']; ?>"  /></td>
        </div>
      </div>
       <div class="form-group">
        <label for="no_telepon" class="col-lg-2 control-label">No Telepon</label>
        <div class="col-lg-10">
          <input type="text" class="form-control" id="no_telepon" placeholder="No Telepon" name="no_telepon" value="<?php echo $coba['no_telepon']; ?>"  /></td>
      </div>
      </div>
      <div class="form-group">
      <label for="email" class="col-lg-2 control-label">Email</label>
        <div class="col-lg-10">
          <input type="text" class="form-control" id="email" placeholder="Email" name="email" value="<?php echo $coba['email']; ?>"  /></td>
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