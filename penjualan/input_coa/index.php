<?php 
$active = "Customer";
require_once("../../include/db.php");
require_once("../templates/header.php"); 
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<h3 class="page-header"></i> Data Akun</h3>
  <div class="row">
  <div class="col-md-12">
    <a href="add.php" class="btn btn-primary"></i> Tambah Data</a>
  </div>
  </div>
  <div class="row">
  <div class="col-md-12">
    <hr/>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>No.</th>
          <th>Ref</th>
          <th>Jenis</th>
          <th>Nama Akun</th>
          <th colspan="3">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $result = mysql_query("SELECT * FROM input_coa ORDER BY reff ASC");

        while($row = mysql_fetch_array($result))
          {
        ?>
        <tr>
          <td><?php echo $no; ?>.</td>
          <td><?php echo $row['reff']; ?></td>
          <td><?php echo $row['type']; ?></td>
          <td><?php echo $row['nama_akun']; ?></td>
          <td><a href="edit.php?kode_akun=<?php echo $row['kode_akun']; ?>" class="btn btn-info">Edit</a>
         <a onclick="return confirm('Hapus Data Ini ?')" href="delete.php?id=<?php echo $row['kode_akun']; ?>" class="btn btn-warning">Delete</a></td>
        </tr>
        <?php
          $no++;
          }
        ?>
      </tbody>
    </table>
  </div>
  </div>
</div><!-- end main -->
<?php require_once("../templates/footer.php"); ?>