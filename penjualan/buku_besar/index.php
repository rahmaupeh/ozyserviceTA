<?php 
$active = "Customer";
require_once("../../include/db.php");
require_once("../templates/header.php"); 
if(!isset($_GET["cari"])){
 $_GET["cari"]="";
}
if(!isset($_GET["d1"])){
  $_GET["d1"]="";
}
if(!isset($_GET["d2"])){
  $_GET["d2"]="";
}
$cari = $_GET["cari"];
$d1 = $_GET["d1"];
$d2 = $_GET["d2"];


?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<h3 class="page-header"></i> Buku Besar</h3>
<form class="form-inline" method="GET" action="index.php">
  <div class="row">
    <div class="col-lg-3">
      Dari Tanggal : <input type="date" class="form-control" name="d1" value="<?php echo $_GET['d1']; ?>">
    </div>
  </div>
  <div class="row">
    <div class="col-lg-3">
      Sampai Tanggal : <input type="date" class="form-control" name="d2" value="<?php echo $_GET['d2']; ?>">
    </div>
  </div>
  <div class="row">
    <div class="col-lg-3">
        Cari
        <div class="input-group">
          <input type="text" class="form-control" name="cari" value="<?php echo $_GET['cari']; ?>">
          <span class="input-group-btn">
            <button class="btn btn-default" type="submit">View</button>
          </span>
        </div><!-- /input-group -->
        
      </div><!-- /.col-lg-6 -->
       <div class="col-lg-3">
</form>
       </div>
  </div>
  <div class="row">
  <div class="col-md-12">
    <hr/>
    <table class="table table-hover" border="0">
      <thead>
        <tr>
          <th>No.</th>
          <th>Tanggal</th>
          <th>Keterangan</th>
          <th>Ref</th>
          <th>Debit</th>
          <th>Kredit</th>
          <th colspan="1" align="center"><center>Saldo</center></th>
        </tr>
      </thead>
      <tbody>
        <?php
if($cari != "piutang dagang"){
        $q = 1;
        $no = 1;
        $result = mysql_query("SELECT * FROM jurnal WHERE (keterangan = '$cari') AND tanggal <= '$d2' ORDER BY no");
        $jum1 = mysql_num_rows(mysql_query("SELECT * FROM jurnal WHERE (keterangan = '$cari') AND tanggal <= '$d2' ORDER BY no"));
        $jum = mysql_num_rows(mysql_query("SELECT * FROM jurnal  WHERE (keterangan = '$cari') AND tanggal <= '$d1' ORDER BY no"));
        $saldo = 0;

        // echo $jum1." ".$jum." ".$d1." ".$d2;

        while($row = mysql_fetch_array($result)){
          if($q <$jum){
            $q++;
            // echo $jum." ".$j." cek </br>";
            //$view[5];
            //$code = explode("-",$view[5]);
// hitungan buku besar
            if($row[2] != 101   and 1 != 1){
              $saldo = $row[4] + $saldo - $row[3];
            } else {
              $saldo = $row[3] + $saldo - $row[4];
            }
          }  else if($q==$jum){
            $q++;
       ?>
          <tr  bgcolor="#ffffff">
            <td colspan="6">Saldo Awal 
              <?php
              $row[5];
              $code = explode("-",$row[5]);
// hitungan buku besar
              if($row[2] != 101  and 1 != 1){
                $saldo = $row[4] + $saldo - $row[3];
              } else {
                $saldo = $row[3] + $saldo - $row[4];
              }
              ?></td>
            <td><center><?php if($saldo>=0){
                echo "Rp ".number_format($saldo);
                } else {
                echo "-";
                }?>
              <?php
                if($saldo<=0){
                echo "Rp ".number_format($saldo*-1);
                } else {
                echo "-";
                }?></center>
              </td>
          </tr>



        <?php
          } else if($q >= $jum){
// hitungan buku besar
              if($row[2] != 101  and 1 != 1){
                $saldo = $row[4] + $saldo - $row[3];
              } else {
                $saldo = $row[3] + $saldo - $row[4];
              }
        ?>
        <tr>
          <td><?php echo $no; ?>.</td>
          <td><?php echo $row[0]; ?></td>
          <td align="<?php if($row[4]==0){
                echo "left";
              }else {
                echo "left";
              }
              ?>"
            ><?php echo $row[1]; ?></td>
          <td><?php echo $row[2]; ?></td>
          <td><?php 
            if($row[3]==0){
              $row[3]="-";
            } else {
              echo "Rp. ".number_format($row[3]); 
            }?></td>
          <td><?php 
            if($row[4]==0){
              $row[4]="-";
            } else {
              echo "Rp. ".number_format($row[4]); 
            }?></td>
          <td><?php 
            if($saldo>0){
              echo "Rp. ".number_format($saldo);
            }
            if($saldo<0){
              echo "Rp. ".number_format(-1*$saldo);
            }
            ?></td>
        </tr>
        <?php
          $no++;
            }
          }
// piutang dagang
} else {



        $q = 1;
        $no = 1;
        $result = mysql_query("SELECT * FROM jurnal WHERE ((keterangan = '$cari') OR (keterangan = 'diskon penjualan') OR (keterangan = 'pendapatan lain-lain')) AND tanggal <= '$d2' ORDER BY no");
        $jum1 = mysql_num_rows(mysql_query("SELECT * FROM jurnal WHERE ((keterangan = '$cari') OR (keterangan = 'diskon penjualan') OR (keterangan = 'pendapatan lain-lain')) AND tanggal <= '$d2' ORDER BY no"));
        $jum = mysql_num_rows(mysql_query("SELECT * FROM jurnal  WHERE ((keterangan = '$cari') OR (keterangan = 'diskon penjualan') OR (keterangan = 'pendapatan lain-lain')) AND tanggal <= '$d1' ORDER BY no"));
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
          <tr  bgcolor="#ffffff">
            <td colspan="6">Saldo Awal 
              <?php

              $row[5];
              $code = explode("-",$row[5]);
// hitungan buku besar
              $saldo = $row[3] + $saldo - $x;
              // echo $x." ".$saldo." ";
              $saldo = - $row[4] + $saldo + $x + $x;
              // echo $x." ".$saldo;
              ?></td>
            <td><?php if($saldo>0){
                echo "Rp ".number_format($saldo);
                }
                if($saldo<=0){
                echo "Rp ".number_format($saldo*-1);
                }
                ?>
              </td>
              
          </tr>



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
        <tr>
          <td><?php echo $no; ?>.</td>
          <td><?php echo $row[0]; ?></td>
          <td align="<?php if($row[4]==0){
                echo "left";
              }else {
                echo "left";
              }
              ?>"
            ><?php echo $row[1]; ?></td>
          <td><?php echo $row[2]; ?></td>
          <td><?php 
            if($row[3]==0){
              $row[3]="-";
            } else {
              echo "Rp. ".number_format($row[3] - $x); 
              $saldo = $row[3] + $saldo - $x;
            }?></td>
          <td><?php 
            if($row[4]==0){
              $row[4]="-";
            } else {
              echo "Rp. ".number_format($row[4] - $x); 
              $saldo = - $row[4] + $saldo + $x;
            }?></td>
          <td><?php 
            if($saldo>0){
              echo "Rp. ".number_format($saldo);
            } 
            if($saldo<0){
              echo "Rp. ".number_format(-1*$saldo);
            }
            ?></td>
        </tr>
        <?php
          $x = 0;
          $no++;
            } else {
              $x = 0;
            }
          }



}
        ?>
      </tbody>
    </table>
  </div>
  </div>
</div><!-- end main -->
<?php require_once("../templates/footer.php"); ?>