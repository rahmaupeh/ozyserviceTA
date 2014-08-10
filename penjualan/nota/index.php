<?php 
$active = "Customer";
require_once("../../include/db.php");
require_once("../templates/header.php");
$dat_server = mktime(date("G"),date("i"),date("s"),date("n"),date("j"),date("Y"));
$tgl = date("Y-n-j",$dat_server);
$thn = date("Y",$dat_server);

?>



  <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <?php

  if(isset($_GET["kode_transaksi"])){
    $kode_transaksi = $_GET["kode_transaksi"];
    $trans = mysql_num_rows(mysql_query("SELECT * FROM penjualan WHERE kode_faktur = '$kode_transaksi'"));
  } else {
    $kode_transaksi = "";
  }

  if(isset($_GET["kode_transaksi"]) and isset($_GET["lunas"])){
    $kode_transaksi = $_GET["kode_transaksi"];
    $trans = mysql_fetch_row(mysql_query("SELECT * FROM penjualan JOIN transaksi ON (penjualan.kode_transaksi = transaksi.kode_transaksi) WHERE penjualan.kode_faktur = '$kode_transaksi'"));
    // echo "SELECT * FROM faktur JOIN transaksi ON (faktur.kode_transaksi = transaksi.kode_transaksi) WHERE faktur.kode_faktur = '$kode_transaksi'";
   
    $tgl_awal = $trans[5];
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
    //echo $nilai;
    $selisih = $jd2 - $jd1;

    $nam = mysql_fetch_row(mysql_query("SELECT * FROM transaksi JOIN pelanggan ON (transaksi.id_pelanggan = pelanggan.id_pelanggan) WHERE kode_transaksi = '$trans[1]'"));
    // echo "SELECT * FROM transaksi JOIN pelanggan ON (transaksi.id_pelanggan = pelanggan.id_pelanggan) WHERE kode_transaksi = '$trans[1]'";
    //echo $nam[8];
    if($selisih <= 10){
//jurnal untuk diskon
      $disc = $trans[8]*2/100;
      $jur1 = $trans[8];
      $jur2 = $jur1+$disc;
      //debit
      mysql_query("INSERT INTO `ozyservice`.`jurnal` (`tanggal`, `keterangan`, `ref`, `debit`, `kredit`, `pelanggan`) 
        VALUES ('$tgl', 'kas', '101', '$jur1', '0', '$nam[6]')");
      //debit
      mysql_query("INSERT INTO `ozyservice`.`jurnal` (`tanggal`, `keterangan`, `ref`, `debit`, `kredit`, `pelanggan`) 
        VALUES ('$tgl', 'diskon penjualan', '102', '$disc', '0', '$nam[6]')");
      //kredit
      mysql_query("INSERT INTO `ozyservice`.`jurnal` (`tanggal`, `keterangan`, `ref`, `debit`, `kredit`, `pelanggan`) 
        VALUES ('$tgl', 'piutang dagang', '104', '0', '$jur2', '$nam[6]')");

    } else if($selisih > 10 and $selisih <= 30){
//jurnal tanpa diskon
      $disc = 0;
      $jur1 = $trans[8];
      //debit
      mysql_query("INSERT INTO `ozyservice`.`jurnal` (`tanggal`, `keterangan`, `ref`, `debit`, `kredit`, `pelanggan`) 
        VALUES ('$tgl', 'kas', '101', '$jur1', '0', '$nam[6]')");
      //kredit
      mysql_query("INSERT INTO `ozyservice`.`jurnal` (`tanggal`, `keterangan`, `ref`, `debit`, `kredit`, `pelanggan`) 
        VALUES ('$tgl', 'piutang dagang', '104', '0', '$jur1', '$nam[6]')");
      
    } else if($selisih > 30){
//jurnal dengan denda
      $disc = -1*($trans[8]*1/100);
      echo $disc;
      $jur1 = (-1*$disc)+$trans[8];
        //debit
        mysql_query("INSERT INTO `ozyservice`.`jurnal` (`tanggal`, `keterangan`, `ref`, `debit`, `kredit`, `pelanggan`) 
          VALUES ('$tgl', 'piutang dagang pelanggan', '102', '$jur1', '0', '$nam[6]')");
        //kredit
        mysql_query("INSERT INTO `ozyservice`.`jurnal` (`tanggal`, `keterangan`, `ref`, `debit`, `kredit`, `pelanggan`) 
          VALUES ('$tgl', 'pendapatan lain-lain', '601', '0', '$jur1', '$nam[6]')");
        //debit
        mysql_query("INSERT INTO `ozyservice`.`jurnal` (`tanggal`, `keterangan`, `ref`, `debit`, `kredit`, `pelanggan`) 
          VALUES ('$tgl', 'kas', '101', '$jur1', '0', '$nam[6]')");
        //kredit
        mysql_query("INSERT INTO `ozyservice`.`jurnal` (`tanggal`, `keterangan`, `ref`, `debit`, `kredit`, `pelanggan`) 
          VALUES ('$tgl', 'piutang dagang', '104', '0', '$jur1', '$nam[6]')");
    
    }

    $lun = mysql_query("UPDATE  `ozyservice`.`transaksi` SET  `diskon` =  '$disc' , `tanggal_lunas` =  '$tgl' WHERE  `transaksi`.`kode_transaksi` =  '$trans[1]'");
  }

  if($kode_transaksi == ""){
  ?>
    <div class="form-group">
      <form action="index.php">
      <label for="inputkode_barang" class="col-lg-2 control-label">No Faktur</label>
      <div class="col-lg-10">
        <select class="form-control" name="kode_transaksi">
            <option value=""> </option>
              <?php 
                $qtransaksi = "SELECT * FROM penjualan";
                $qtransaksi = mysql_query($qtransaksi);
                while($transaksi = mysql_fetch_array($qtransaksi)){
                  $c = mysql_num_rows(mysql_query("SELECT * FROM transaksi WHERE kode_transaksi = '$transaksi[kode_transaksi]' and tanggal_lunas='0000-00-00'"));
                  if($c != 0){
              ?>
            <option value="<?php echo $transaksi["kode_faktur"];?>"> <?php 
            echo $transaksi["kode_faktur"];
            ?></option>
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


  $view = mysql_fetch_row(mysql_query("SELECT * FROM penjualan JOIN transaksi ON (penjualan.kode_transaksi= transaksi.kode_transaksi) JOIN pelanggan ON (transaksi.id_pelanggan = pelanggan.id_pelanggan) WHERE penjualan.kode_faktur = '$kode_transaksi'"));
  //echo "SELECT * FROM faktur JOIN transaksi ON (faktur.kode_transaksi= transaksi.kode_transaksi) JOIN pelanggan ON (transaksi.id_pelanggan = pelanggan.id_pelanggan) WHERE faktur.kode_faktur = '$kode_transaksi'";
  ?>
  <center><h3 class="page-header">Nota Pelunasan</h3></center>
  <?php 
  if($view[0]!=""){
    if($view[6] != "0000-00-00"){
  ?>
  <center><h3 class="page-header">LUNAS</h3></center>
  <?php
    }
  ?>
    <h3><tr>Ozy Service</tr></h3>
    <h4><tr>Jalan Pematang Pasir no 121 Tanjung Mulia Hilir</tr></h4>
    <h4><tr>Telp 061-6614627</tr></h4>
    <div class="row">
    <div class="col-md-12">
      <form class="form-horizontal" role="form">
    <div class="form-group">
      <label for="input" class="col-sm-1 control-label">No Faktur:</label>
      <div class="col-sm-2">
        <input type="text" class="form-control" id="input" value="<?php echo $view[0];?>" readonly="readonly">
      </div>
      <div class="col-sm-5">
      </div>
      <label for="input" class="col-sm-1 control-label">Jatuh Tempo:</label>
      <div class="col-sm-3">
    <?php
      $date=$view[5];
      $new_date = date('Y-m-j',strtotime('+30 day', strtotime($date)));
      mysql_query("UPDATE  `ozyservice`.`penjualan` SET  `tanggal_jatuh_tempo` =  '$new_date' WHERE  `penjualan`.`kode_faktur` =  '$view[0]'");
    ?>
        <input type="date" class="form-control" id="input" placeholder="2/10n/30"  value="<?php echo $new_date;?>" readonly="readonly">
      </div>
    </div>
     <form class="form-horizontal" role="form">
    <div class="form-group">
      <label for="input" class="col-sm-1 control-label">Customer:</label>
      <div class="col-sm-2">
        <input type="text" class="form-control" id="input" value="<?php echo $view[10];?>" readonly="readonly">
      </div>
    <div class="col-sm-5">
      </div>
      <label for="input" class="col-sm-1 control-label">Tanggal Faktur:</label>
      <div class="col-sm-3">
        <input type="date" class="form-control" id="input"  value="<?php echo $view[5];?>" readonly="readonly">
      </div>
  </div>
     <form class="form-horizontal" role="form">
    <div class="form-group">
      <label for="input" class="col-sm-1 control-label">Alamat :</label>
      <div class="col-sm-3">
        <input type="text" class="form-control" id="input"  value="<?php echo $view[12];?>" readonly="readonly">
      </div>
    </div>
    </div>
    </div>
    <div class="row">
    <div class="col-md-12">
      <hr/>
      <table class="table table-hover">
        <thead>
          <tr>
            <th>No</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Quantity</th>
            <th>Harga Satuan</th>
            <th>diskon</th>
            <th>Total Harga</th>

          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $result = mysql_query("SELECT * FROM detail_penjualan JOIN data_barang ON (detail_penjualan.kode_barang=data_barang.kode_barang) WHERE kode_transaksi = '$view[1]'");
          $total = 0;
          while($row = mysql_fetch_array($result))
            {
          ?>
          <tr>
            <td><?php echo $no; ?>.</td>
            <td><?php echo $row['kode_barang']; ?></td>
            <td><?php echo $row['nama_barang']; ?></td>
            <td><?php echo $row['jumlah']; ?></td> 
            <td>Rp <?php echo number_format($row['harga']); ?></td>
            <td><?php echo $row['diskon']; ?>%</td>
            <td>Rp <?php echo number_format(($row['jumlah']*$row['harga'])-($row['jumlah']*$row['harga']*$row['diskon']/100)); ?></td> 
          </tr>
          <?php
            $total = $total + ($row['jumlah']*$row['harga'])-($row['jumlah']*$row['harga']*$row['diskon']/100);
            $no++;
            }
          ?>
        </tbody>
      </table>
      <div class="row">
      <div class="col-md-12">
      <div class="col-md-8">
      </div>
      <form class="form-horizontal" role="form">
    
    </div>
    <div class="col-md-12">
      <div class="col-md-8">
      </div>
      <form class="form-horizontal" role="form">
    
    <div class="form-group">
    <?php
      $tgl_awal = $view[5];
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
      //echo $nilai;
      $selisih = $jd2 - $jd1;
      //echo $selisih;
      if($selisih <= 10){
        $disc = $total*2/100;
      } else if($selisih > 10 and $selisih <= 30){
        $disc = 0;
      } else {
        $disc = -1*($total*1/100);
      }
    ?>
      <label for="input" class="col-sm-2 control-label">
      <?php 
        $disc2 = $disc;
        if($disc >= 0){
          $disc2 = $disc;
          ?>
        Potongan:
      <?php }else{
           $disc2 = -1*$disc;
      ?>
        Denda:
      <?php }?>
    </label>
      <div class="col-sm-2">
        <input type="text" class="form-control" id="input"  value="Rp <?php echo number_format($disc2);?>" readonly="readonly">
      </div>
    </div>
    </div>
    <div class="col-md-12">
      <div class="col-md-8">
      </div>
      <form class="form-horizontal" role="form">

    <div class="form-group">
      <label for="input" class="col-sm-2 control-label">Total :</label>
      <div class="col-sm-2">
        <input type="text" class="form-control" id="input"  value="Rp <?php echo number_format($total-$disc);?>" readonly="readonly">
      </div>
    </div>
    </div>
    </div>
   <div class="form-group"> </div>
    <div class="form-group"> </div>

     <div class="row">
          <div class="col-md-3">Diterima Oleh <textarea class="form-control" rows="3"></textarea> </div>
          <div class="col-md-6"></div>
          <div class="col-md-3">Bagian Penjualan <textarea class="form-control" rows="3"></textarea> </div>
        </div>
        <center><button onClick="return window.print();" class="btn btn-default">Print</button></center>
  <?php 
    if($view[6] == "0000-00-00"){
  ?>
       <a href="index.php?kode_transaksi=<?php echo $kode_transaksi;?>&lunas=1"><h1>Lunas</h1></a>
  <?php 
    }
  }
  ?>
    </div>
  </div><!-- end main -->
  <?php require_once("../templates/footer.php"); ?>