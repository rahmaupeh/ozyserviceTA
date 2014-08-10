<?php 
$active = "Customer";
$id_customer = $_GET['id'];
require_once("../../include/db.php");
require_once("../templates/header.php"); 
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<h3 class="page-header"><i class="fa fa-users"></i> View Customer</h3>
  <div class="row">
    <div class="col-md-12">
      <a href="index.php" class="btn btn-primary">Back</a>
      <hr/>
    </div>
  </div>
  <div class="row">
  <div class="col-md-10">
    <?php
    $result = mysql_query("SELECT * FROM Customer where id_customer = $id_customer");

    $row = mysql_fetch_array($result);
    ?>
    <table class="table">
      <tr>
        <th class="col-md-2">ID Customer</th>
        <td class="col-md-10"><?php echo $row['id_customer']; ?></td>
      </tr>
      <tr>
        <th class="col-md-2">Nama</th>
        <td class="col-md-10"><?php echo $row['nama']; ?></td>
      </tr>
      <tr>
        <th class="col-md-2">Alamat</th>
        <td class="col-md-10"><?php echo $row['alamat']; ?></td>
      </tr>
      <tr>
        <th class="col-md-2">No KTP</th>
        <td class="col-md-10"><?php echo $row['no_ktp']; ?></td>
      </tr>
      <tr>
        <th class="col-md-2">No Telp</th>
        <td class="col-md-10"><?php echo $row['no_telp']; ?></td>
      </tr>
    </table>
  </div>
  <div class="col-md-2">
  </div>
  </div>
  <div class="row">
  <div class="col-md-10">
    <h3>History Penyewaan</h3>
    <hr/>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>No.</th>
          <th>Plat No</th>
          <th>Merk</th>
          <th>Warna</th>
          <th>Tgl Sewa</th>
          <th>Tgl Kembali</th>
          <th>Total Bayar</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $result = mysql_query("SELECT * FROM sewa join mobil using(id_mobil) where id_customer = $id_customer");

        while($row = mysql_fetch_array($result))
        {
        ?>
        <tr>
          <td><?php echo $no; ?>.</td>
          <td><?php echo $row['no_plat']; ?></td>
          <td><?php echo $row['merk']; ?></td>
          <td><?php echo $row['warna']; ?></td>
          <td><?php echo $row['tgl_sewa']; ?></td>
          <td><?php echo $row['tgl_kembali']; ?></td>
          <td><?php echo $row['total_bayar']; ?></td>
          <td><?php 
          if ($row['status'] == "Belum Kembali") 
          {
            echo '<span class="label label-warning">'.$row['status'].'</span>';
          } 
          else
          {
            echo '<span class="label label-success">'.$row['status'].'</span>';
          }
          ?></td>
        </tr>
        <?php
          $no++;
          }
        ?>
      </tbody>
    </table>
  </div>
  <div class="col-md-2">
  </div>
  </div>
</div><!-- end main -->
<?php require_once("../templates/footer.php"); ?>