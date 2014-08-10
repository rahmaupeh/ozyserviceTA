<?php 
$active = "Customer";
require_once("../../include/db.php");
require_once("../templates/header.php"); 
$dat_server = mktime(date("G"),date("i"),date("s"),date("n"),date("j"),date("Y"));
$tgl = date("Y-n-j",$dat_server);
$thn = date("Y",$dat_server);

//input tabel jurnal
if(isset($_GET["jur"])){
  $jur = $_GET["jur"];
  $view = mysql_fetch_row(mysql_query("SELECT * FROM transaksi WHERE kode_transaksi = '$jur'"));
  // echo "SELECT * FROM transaksi WHERE kode_transaksi = '$jur'";
  mysql_query("INSERT INTO `ozyservice`.`jurnal` (`tanggal`, `keterangan`, `ref`, `debit`, `kredit`, `pelanggan`) 
    VALUES ('$tgl', 'piutang dagang', '104', '$view[5]', '0', '$view[1]')");
  mysql_query("INSERT INTO `ozyservice`.`jurnal` (`tanggal`, `keterangan`, `ref`, `debit`, `kredit`, `pelanggan`) 
    VALUES ('$tgl', 'penjualan kredit', '402', '0', '$view[5]', '$view[1]')");
}

?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<h3 class="page-header"></i> Penjualan Kredit</h3>
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
          <th>No</th>
          <th>Kode Transaksi</th>
          <th>Id Pelanggan</th>
          <th>Nama Pelanggan</th>
          <th>Tanggal</th>
          <th>Pelunasan</th>
          <th>Total Harga</th>
          <th colspan="3">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $result = mysql_query("SELECT * FROM transaksi JOIN Pelanggan ON (transaksi.id_pelanggan=Pelanggan.id_pelanggan)");

        while($row = mysql_fetch_array($result))
          {
              $tgl_awal = $row['tanggal_pesan'];
              $tgl_akhir = $tgl;
              //echo $tgl_awal;
              //echo $tgl_akhir;

              $pecah1 = explode("-", $tgl_awal);
              $date1 = $pecah1[2];
              $mount1 = $pecah1[1];
              $year1 = $pecah1[0];

              $pecah2 = explode("-", $tgl_akhir);
              $date2 = $pecah2[2];
              $mount2 = $pecah2[1];
              $year2 = $pecah2[0]; 

              $jd1 = GregorianToJD($mount1, $date1, $year1);
              $jd2 = GregorianToJD($mount2, $date2, $year2);
              //echo $jd1." ".$jd2." ";
              $selisih = $jd2 - $jd1;
              //echo $selisih;
              if($selisih >= 30 and $row['tanggal_lunas'] == "0000-00-00"){
                $warna = "ff0000";
                $tagih = 1;
              } else {
                $warna = "ffffff";
                $tagih = 0;
              }

        ?>
        <tr 
          bgcolor="<?php echo $warna;?>">
          <td><?php echo $no; ?>.</td>
          <td><?php echo $row['kode_transaksi']; ?></td>
          <td><?php echo $row['id_pelanggan']; ?></td>
          <td><?php echo $row['nama_pelanggan']; ?>, <?php echo $row['toko']; ?></td> 
          <td><?php echo $row['tanggal_pesan']; ?></td>
          <td><?php 
            if($row['tanggal_lunas'] == "0000-00-00"){
              echo "Belum Lunas";
            } else {
              echo "Sudah Lunas";
            } ?>
          </td>
          <td><?php echo number_format($row['total_harga']); ?></td> 
        
		  
          <td><a href="view.php?kode_transaksi=<?php echo $row['kode_transaksi']; ?>&tagih=<?php echo $tagih?>" class="btn btn-success">Detail</a>
			<a onclick="return confirm('Hapus Data Ini ?')" href="delete.php?kode_transaksi=<?php echo $row['kode_transaksi']; ?>"class="btn btn-danger">Delete</a></td>
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