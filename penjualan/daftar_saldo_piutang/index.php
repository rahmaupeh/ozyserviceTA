<?php 
$active = "Customer";
require_once("../../include/db.php");
require_once("../templates/header.php"); 
if(!isset($_GET["cari"])){
 $_GET["cari"]="-";
}
// if(!isset($_GET["d1"])){
//   $_GET["d1"]="";
// }
// if(!isset($_GET["d2"])){
//   $_GET["d2"]="";
// }

$tg = $_GET["dari_tgl"];
$tg2 = $_GET["sampai_tgl"];


?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

<h3 class="page-header"></i>Daftar Saldo Piutang</h3>

<div class="col-lg-3">
        <form class="form-inline" method="GET" action="index.php">
        <div class="input-group">
          Dari Tanggal :
          <input type="date" class="form-control" name="dari_tgl" value="<?php echo $_GET['dari_tgl']; ?>">
        </div>
        <div class="input-group">
          Sampai Tanggal :
          <input type="date" class="form-control" name="sampai_tgl" value="<?php echo $_GET['sampai_tgl']; ?>">
        </div>
          <span class="input-group-btn">
            <button class="btn btn-default" type="submit">View</button>
          </span>
</form>
        </div>
       
  
  <div class="row">
  <div class="col-md-12">
    <hr/>
        <table class="table table-hover" border="0">
          <thead>
            <tr>
              <th>No.</th>
              <th>Debitur</th>
              <th>Jumlah</th>
            </tr>
          </thead>
          <tbody>
    <?php 
       $no = 1;
      $qid_p = mysql_query("SELECT DISTINCT pelanggan FROM jurnal WHERE tanggal >= '$tg' AND tanggal <= '$tg2'");
      // echo "SELECT DISTINCT pelanggan FROM jurnal WHERE tanggal <= '$cari'";
      while($id_p = mysql_fetch_array($qid_p)){
    ?>
    <!-- start tabel -->

    <?php 
      $pel = mysql_fetch_row(mysql_query("SELECT * FROM pelanggan WHERE id_pelanggan = '$id_p[0]'"));
    ?>
      <!-- <hr/>
      <table class="table table-hover" border="0">
        <thead>
          <tr>
            <th>No.</th>
            <th>Debitur</th>
            <th>Jumlah</th>
          </tr>
        </thead>
        <tbody> -->
          <?php
          
          $q = 1;
         
          $result = mysql_query("SELECT * FROM jurnal WHERE ((keterangan = 'piutang dagang') OR (keterangan = 'retur penjualan') OR (keterangan = 'diskon penjualan') OR (keterangan = 'pendapatan lain-lain')) AND pelanggan = '$id_p[0]' ORDER BY no");
          $jum1 = mysql_num_rows(mysql_query("SELECT * FROM jurnal WHERE ((keterangan = '$cari') OR (keterangan = 'retur penjualan') OR (keterangan = 'diskon penjualan') OR (keterangan = 'pendapatan lain-lain')) AND tanggal <= '$d2' ORDER BY no"));
          $jum = mysql_num_rows(mysql_query("SELECT * FROM jurnal  WHERE ((keterangan = '$cari') OR (keterangan = 'retur penjualan') OR (keterangan = 'diskon penjualan') OR (keterangan = 'pendapatan lain-lain')) AND tanggal <= '$d1' ORDER BY no"));
          $saldo = 0;
          $x = 0;
          // echo $jum1." ".$jum." ".$d1." ".$d2;

          while($row = mysql_fetch_array($result)){
            // echo "</br>".$x." ".$row[1]." ".$row[3]." ".$row[4];
            if($row[1] != "piutang dagang"){
              $x = $row[3] + $row[4];
              // echo "masuk";
            } else if($q <$jum){
              $q++;
              // echo $jum." ".$j." cek </br>";
              //$view[5];
              //$code = explode("-",$view[5]);

                $saldo = $row[3] + $saldo - $x;
                $saldo = - $row[4] + $saldo + $x;
                // echo $x." ".$saldo;
  // hitungan buku besar
              // if($row[2] != 101   and 1 != 1){
              //   $saldo = $row[4] + $saldo - $row[3]-$x;
              // } else {
              //   $saldo = $row[3] + $saldo - $row[4]-$x;
              // }
              $x = 0;
            }  else if($q==$jum){
              $q++;
         ?>
            
                <?php

                $row[5];
                $code = explode("-",$row[5]);
  // hitungan buku besar
                $saldo = $row[3] + $saldo - $x;
                // echo $x." ".$saldo." ";
                $saldo = - $row[4] + $saldo + $x + $x;
                // echo $x." ".$saldo;
                ?>
              <?php if($saldo>0){
                  //echo "Rp ".number_format($saldo);
                  }
                  if($saldo<=0){
                  //echo "Rp ".number_format($saldo*-1);
                  }
                  ?>
               



          <?php
              $x = 0;
            } else if($q >= $jum and $row[1] == "piutang dagang" AND ($row[4] + $row[3] - $x > 0)){
  // hitungan buku besar
                // if($row[2] != 101  and 1 != 1){
                //   $saldo = $row[4] + $saldo - $row[3];
                // } else {
                //   $saldo = $row[3] + $saldo - $row[4];
                // }
          ?>
         
          
            <?php if($row[4]==0){
                  //echo "left";
                }else {
                  // echo "left";
                }
                ?>
              
          <?php 
              if($row[3]==0){
                $row[3]="-";
              } else {
                // echo "Rp. ".number_format($row[3] - $x); 
                $saldo = $row[3] + $saldo - $x;
              }?></td>
            <?php 
              if($row[4]==0){
                $row[4]="-";
              } else {
                // echo "Rp. ".number_format($row[4] - $x); 
                $saldo = - $row[4] + $saldo + $x;
              }?></td>
           <?php 
              if($saldo>0){
                // echo "Rp. ".number_format($saldo);
              } 
              if($saldo<0){
                // echo "Rp. ".number_format(-1*$saldo);
              }
              ?>
          <?php
            $x = 0;
            
              } else {
                $x = 0;
              }
            }

//red
          // echo $saldo;
          ?>
           <tr>
              <td><?php echo $no;?></td>
              <td><?php echo $pel[1];?> - <?php echo $pel[2];?></td>
              <td><?php echo "Rp. ".number_format($saldo);?></td>
            </tr>

      <!-- end tabel -->
      <?php
            $no++; 
          } ?>
        </tbody>
      </table>
  </div>
  </div>
</div><!-- end main -->
<?php require_once("../templates/footer.php"); ?>