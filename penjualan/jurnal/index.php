<?php 
$active = "Customer";
require_once("../../include/db.php");
require_once("../templates/header.php"); 
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<h3 class="page-header"></i> Jurnal</h3>
    <div class="row">
      <div class="col-lg-7">
      <?php if($_GET['dari_tgl'] != 0){
          $tg = $_GET["dari_tgl"];
          $tg2 = $_GET["sampai_tgl"];
          //$tg2 = date ( 'Y-m-j' , $tg2 );

          $tg = explode("-",$tg);
          $d = $tg[2];
          $m = $tg[1];
          $y = $tg[0];
          $m = $m +0;
          switch  ($m){
            case  1: $mi = "Januari";break;
            case  2: $mi = "Februari";break;
            case  3: $mi = "Maret";break;
            case  4: $mi = "April";break;
            case  5: $mi =  "Mei";break;
            case  6: $mi =  "Juni";break;
            case  7: $mi =  "Juli";break;
            case  8: $mi =  "Agustus";break;
            case  9: $mi =  "September";break;
            case  10: $mi =  "Oktober";break;
            case  11: $mi =  "November";break;
            case  12: $mi =  "Desember";break;
          }

          $tg2 = explode("-",$tg2);
          $d2 = $tg2[2];
          $m2 = $tg2[1];
          $y2 = $tg2[0];
          $m2 = $m2 +0;
          switch  ($m2){
            case  1: $mi2 = "Januari";break;
            case  2: $mi2 = "Februari";break;
            case  3: $mi2 = "Maret";break;
            case  4: $mi2 = "April";break;
            case  5: $mi2 =  "Mei";break;
            case  6: $mi2 =  "Juni";break;
            case  7: $mi2 =  "Juli";break;
            case  8: $mi2 =  "Agustus";break;
            case  9: $mi2 =  "September";break;
            case  10: $mi2 =  "Oktober";break;
            case  11: $mi2 =  "November";break;
            case  12: $mi2 =  "Desember";break;
          }


      ?>
        Jurnal Dari Tanggal <b><?php echo $d." ".$mi." ".$y;?></b> sampai dengan tanggal <b><?php echo $d2." ".$mi2." ".$y2;?></b>
      <?php } ?>
      </div>

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
        </div><!-- /input-group -->
        </div>
      </div>
            <?php
      $cari = "";
      $tg = $_GET["dari_tgl"];
      $tg2 = $_GET["sampai_tgl"];
      //$tg2 = date ( 'Y-m-j' , $tg2 ); 

      $result = mysql_query("SELECT * FROM jurnal WHERE tanggal >= '$tg' AND tanggal <= '$tg2'");
      //echo "SELECT * FROM faktur JOIN transaksi ON (faktur.kode_transaksi = transaksi.kode_transaksi) WHERE transaksi.tanggal_lunas >= '$tg' AND transaksi.tanggal_lunas >= '$tg2'";
      
      $found = mysql_num_rows($result);
      if($found != 0 ){
    ?>
  
  <div class="row">
  <div class="col-md-12">
    <hr/>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>No.</th>
          <th>Tanggal</th>
          <th>Keterangan</th>
          <th>Ref</th>
          <th>Debit</th>
          <th>Kredit</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $result = mysql_query("SELECT * FROM jurnal");

        while($row = mysql_fetch_array($result))
          {
        ?>
        <tr>
          <td><?php echo $no; ?>.</td>
          <td><?php echo $row[0]; ?></td>
          <td align="<?php if($row[4]==0){
                echo "left";
              }else {
                echo "right";
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
        </tr>
        <?php
          $no++;
          }
        ?>
      </tbody>
    </table>
  </div>
       <?php } else {?>
      <h1 align="center">Not Found...!!!</h1>
    <?php } ?>
  </div>
  </div>
</div>
</div><!-- end main -->
<?php require_once("../templates/footer.php"); ?>