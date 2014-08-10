<?php 
$active = "Pengembalian";
require_once("../../include/db.php");
require_once("../templates/header.php"); 
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<h3 class="page-header"><i class="fa fa-map-marker"></i> Pengembalian</h3>
  <div class="row">
  <div class="col-md-12">
    <a href="add.php" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
  </div>
  </div>
  <div class="row">
  <div class="col-md-12">
    <hr/>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>No.</th>
          <th>No Sewa</th>
          <th>No Plat</th>
          <th>Mobil</th>
          <th>Customer</th>
          <th>Tgl Sewa</th>
          <th>Status</th>
          <th colspan="3">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $result = mysql_query("SELECT * FROM sewa join mobil on mobil.id_mobil = sewa.id_mobil join customer on customer.id_customer = sewa.id_customer join admin on admin.id_admin = sewa.id_admin order by id_sewa DESC");
        while($row = mysql_fetch_array($result))
          {
        ?>
        <tr>
          <td><?php echo $no; ?>.</td>
          <td><?php echo $row['id_sewa']; ?></td>
          <td><?php echo $row['no_plat']; ?></td>
          <td><?php echo $row['merk']; ?></td>
          <td><?php echo $row['nama']; ?></td>
          <td><?php echo $row['tgl_sewa']; ?></td>
          <td>
          <?php 
          if ($row['status'] == "Belum Kembali") 
          {
            echo '<span class="label label-warning">'.$row['status'].'</span>';
          } 
          else
          {
            echo '<span class="label label-success">'.$row['status'].'</span>';
          }
          ?>
          </td>
          <td><a href="view.php?id=<?php echo $row['id_sewa']; ?>" class="btn btn-primary">View</a></td>
          <td><a onclick="return confirm('Hapus Data Ini ?')" href="delete.php?id=<?php echo $row['id_sewa']; ?>" class="btn btn-warning">Delete</a></td>
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