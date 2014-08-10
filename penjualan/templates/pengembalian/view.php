<?php 
$active = "Pengembalian";
$id_sewa = $_GET['id'];
require_once("../../include/db.php");
require_once("../templates/header.php"); 
$result = mysql_query("SELECT * FROM sewa join mobil using(id_mobil) join customer using(id_customer) where id_sewa = $id_sewa");

$row = mysql_fetch_array($result);
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<h3 class="page-header"><i class="fa fa-users"></i> View Pengembalian</h3>
  <div class="row">
    <div class="col-md-12">
      <a href="index.php" class="btn btn-primary">Back</a>
      <hr/>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <table class="table">
        <tr>
          <th colspan="2" class="text-center">Informasi Penyewaan</th>
        </tr>
        <tr>
          <th class="col-md-2">Tgl Sewa</th>
          <td class="col-md-10"><?php echo $row['tgl_sewa']; ?></td>
        </tr>
        <tr>
          <th class="col-md-2">Tgl Kembali</th>
          <td class="col-md-10"><?php echo $row['tgl_kembali']; ?></td>
        </tr>
        <tr>
          <th class="col-md-2">Total Bayar</th>
          <td class="col-md-10"><?php echo $row['total_bayar']; ?></td>
        </tr>
        <tr>
          <th class="col-md-2">Status</th>
          <td class="col-md-10">
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
        </tr>
      </table>
      <hr/>
    </div>
  </div>
  <div class="row">
  <div class="col-md-6">
    <table class="table">
      <tr>
        <th colspan="2" class="text-center">Informasi Mobil</th>
      </tr>
      <tr>
        <th class="col-md-3">ID Mobil</th>
        <td class="col-md-9"><?php echo $row['id_mobil']; ?></td>
      </tr>
      <tr>
        <th class="col-md-3">Merk</th>
        <td class="col-md-9"><?php echo $row['merk']; ?></td>
      </tr>
      <tr>
        <th class="col-md-3">Tahun Buat</th>
        <td class="col-md-9"><?php echo $row['tahun_buat']; ?></td>
      </tr>
      <tr>
        <th class="col-md-3">Warna</th>
        <td class="col-md-9"><?php echo $row['warna']; ?></td>
      </tr>
      <tr>
        <th class="col-md-3">Harga Sewa</th>
        <td class="col-md-9"><?php echo $row['harga_sewa']; ?></td>
      </tr>
    </table>
  </div>
  <div class="col-md-6">
    <table class="table">
      <tr>
        <th colspan="2" class="text-center">Informasi Customer</th>
      </tr>
      <tr>
        <th class="col-md-3">ID Customer</th>
        <td class="col-md-9"><?php echo $row['id_customer']; ?></td>
      </tr>
      <tr>
        <th class="col-md-3">Nama</th>
        <td class="col-md-9"><?php echo $row['nama']; ?></td>
      </tr>
      <tr>
        <th class="col-md-3">Alamat</th>
        <td class="col-md-9"><?php echo $row['alamat']; ?></td>
      </tr>
      <tr>
        <th class="col-md-3">No KTP</th>
        <td class="col-md-9"><?php echo $row['no_ktp']; ?></td>
      </tr>
      <tr>
        <th class="col-md-3">No Telp</th>
        <td class="col-md-9"><?php echo $row['no_telp']; ?></td>
      </tr>
    </table>
  </div>
  </div>
</div><!-- end main -->
<?php require_once("../templates/footer.php"); ?>