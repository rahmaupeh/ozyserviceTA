<?php
$active = "Customer";
require_once("../../include/db.php");

$dat_server = mktime(date("G"),date("i"),date("s"),date("n"),date("j"),date("Y"));
$tgl = date("Y-n-j",$dat_server);
$thn = date("Y",$dat_server);

if(isset($_GET['kode_retur'])){
	$kode_retur= $_GET['kode_retur'];
}

require_once("../templates/header.php");

?>


<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<h3 class="page-header"></i> Hasil Input Retur</h3>
  <div class="row">
  <div class="col-md-1">
  </div>
  <div class="col-md-2">
  </div>
  </div>
  <div class="row">
  <div class="col-md-12">
    <table width="50%">
      <tr>
          <th>No</th>
          <th>kode barang</th>
          <th>jumlah retur</th>
          <th>Harga</th>
      </tr>
      <?php
      $no = 0;
      $total = 0;
      $nama="";
      $qview = mysql_query("SELECT * FROM retur_detail WHERE kode_retur = '$kode_retur'");
      while($view = mysql_fetch_array($qview)){
        $no++;
      ?>
      <tr>
          <td><?php echo $no;?></td>
          <td><?php echo $view[1];?></td>
          <td><?php echo $view[3];?></td>
          <td><?php 
              $harga = mysql_fetch_row(mysql_query("SELECT harga,id_pelanggan FROM retur  
                JOIN penjualan ON (retur.kode_faktur = penjualan.kode_faktur)
                JOIN transaksi ON (penjualan.kode_transaksi = transaksi.kode_transaksi)
                JOIN detail_penjualan ON (transaksi.kode_transaksi = detail_penjualan.kode_transaksi) 
                WHERE retur.kode_retur='$kode_retur' AND detail_penjualan.kode_barang = '$view[1]' LIMIT 1"));
              $nama = $harga[1];
              echo $harga[0];

              $total = $total + ($harga[0]*$view[3]);
          ?>
          </td>
      </tr>
      <?php
      }
      //debit
      mysql_query("INSERT INTO `ozyservice`.`jurnal` (`tanggal`, `keterangan`, `ref`, `debit`, `kredit`, `pelanggan`) 
        VALUES ('$tgl', 'retur penjualan', '404', '$total', '0', '$nama')");
      //kredit
      mysql_query("INSERT INTO `ozyservice`.`jurnal` (`tanggal`, `keterangan`, `ref`, `debit`, `kredit`, `pelanggan`) 
        VALUES ('$tgl', 'piutang dagang', '104', '0', '$total', '$nama')");

      ?>
    </table>
    <div class="form-group">
      <div class="col-lg-offset-2 col-lg-10">
        <a href="index.php?kode_retur=<?php echo $kode_retur;?>" class="btn btn-default">Simpan</a>
      </div>
    </div>
  </div>
  </div>
</div><!-- end main -->
<?php require_once("../templates/footer.php"); ?>