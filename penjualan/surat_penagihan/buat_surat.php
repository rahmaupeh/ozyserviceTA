<?php 
$active = "Customer";
require_once("../../include/db.php");
$dat_server = mktime(date("G"),date("i"),date("s"),date("n"),date("j"),date("Y"));
$tgl = date("Y-n-j",$dat_server);
$thn = date("Y",$dat_server);

$kd_brg = "SELECT * FROM surat_penagihan ORDER BY no_surat_penagihan DESC";
$kd_brg = mysql_query($kd_brg);
$vd_brg = mysql_fetch_row($kd_brg);
$nd_brg = mysql_num_rows($kd_brg);



if(isset($_GET["no_penagihan"])){
  $no_penagihan = $_GET["no_penagihan"];
  // echo $no_penagihan;

  if($nd_brg == 0 ){
    $no_id = "SPO".$thn."-0001";
  } else {
    $arr_id = explode("-", $vd_brg[0]);
    $new_id = $arr_id[1];
    $new_id = $new_id + 1;
    $count_id = strlen($new_id);

    while ($count_id < 4){
      $new_id = "0".$new_id;
      $count_id++;
    }
    $no_id = "SPO".$thn."-".$new_id;
  }


  if($no_penagihan != ""){
    // echo $no_penagihan;
    $qfk = "SELECT * FROM penjualan JOIN transaksi ON (penjualan.kode_transaksi = transaksi.kode_transaksi) WHERE penjualan.kode_faktur='$no_penagihan' limit 1";
    $fk = mysql_fetch_row(mysql_query($qfk));

    // echo "INSERT INTO  `ozyservice`.`surat_penagihan` (`no_surat_penagihan` ,`tanggal`) VALUES ('$no_id',  '$tgl')";
    if(mysql_query("INSERT INTO  `ozyservice`.`surat_penagihan` (`no_surat_penagihan` ,`tanggal`) VALUES ('$no_id',  '$tgl')")){
      $qnw = "SELECT * FROM penjualan
              JOIN transaksi ON ( penjualan.kode_transaksi = transaksi.kode_transaksi ) JOIN pelanggan ON ( transaksi.id_pelanggan = pelanggan.id_pelanggan )  
              WHERE penjualan.tanggal_jatuh_tempo <  '$tgl'
              AND transaksi.id_pelanggan =  '$fk[4]'";
      // echo $qnw;
      $qnw = mysql_query($qnw);


      while($nw=mysql_fetch_array($qnw)){
        //input tabel jurnal
        //debit
       
        if(mysql_query("INSERT INTO `ozyservice`.`surat_penagihan_detail` (`no_surat_penagihan`, `kode_faktur`) VALUES ('$no_id', '$nw[0]')")){
          mysql_query("INSERT INTO `ozyservice`.`jurnal` (`tanggal`, `keterangan`, `ref`, `debit`, `kredit`, `pelanggan`) 
            VALUES ('$tgl', 'beban kerugian piutang dagang', '501', '$nw[8]', '0', '$nw[9]')");
          //kredit
          mysql_query("INSERT INTO `ozyservice`.`jurnal` (`tanggal`, `keterangan`, `ref`, `debit`, `kredit`, `pelanggan`) 
            VALUES ('$tgl', 'piutang dagang', '104', '0', '$nw[8]', '$nw[9]')");

        }
      }
    }
    
  }
  header( 'Location: http://localhost/ozyservice/penjualan/surat_penagihan' );
}

require_once("../templates/header.php");

?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main"> 

<?php
  if(!isset($_GET["no_penagihan"])){
     //echo "SELECT * FROM transaksi";
     //echo "SELECT * FROM faktur WHERE kode_transaksi=''";
    //echo "SELECT * FROM faktur JOIN transaksi ON (faktur.kode_transaksi = transaksi.kode_transaksi)";
?>

<center><h4 class="page-header"></i>Membuat Surat Penagihan</h4></center>
<div class="form-group">
    <form action="buat_surat.php">
    <label for="inputkode_barang" class="col-lg-2 control-label">No Faktur</label>
    <div class="col-lg-10">
      <select class="form-control" name="no_penagihan">
          <option value=""> </option>
            <?php 
              $qtransaksi = "SELECT * FROM penjualan JOIN transaksi ON (penjualan.kode_transaksi = transaksi.kode_transaksi)";;

              $qtransaksi = mysql_query($qtransaksi);
              while($row = mysql_fetch_array($qtransaksi)){
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
                  if($selisih >= 30){
               
            ?>
                  <option value="<?php echo $row[0];?>"> <?php echo $row[0];?></option>
            <?php
                  }
              }
            ?>
        </select>

    </div>
    <div class="col-lg-offset-2 col-lg-10">
          <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>
  </div>

<?php
  } 
?>
<?php require_once("../templates/footer.php"); ?>