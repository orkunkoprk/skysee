<?php 

include 'header.php'; 

$urunsor=$db->prepare("SELECT * FROM urun order by ucak_id DESC");
$urunsor->execute();

?>

<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Ürün Listeleme<small>

              <?php 

              if (@$_GET['durum']=="ok") {?>

              <b style="color:green;">İşlem Başarılı...</b>

              <?php } elseif (@$_GET['durum']=="no") {?>

              <b style="color:red;">İşlem Başarısız...</b>

              <?php }

              ?>

            </small></h2>

            <div class="clearfix"></div>

            <div align="right">
              <a href="urun-ekle.php"><button class="btn btn-success btn-xs">Yeni Uçak Ekle</button></a>

            </div>
          </div>
          <div class="x_content">

            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Uçak Markası</th>
                  <th>Bilet Stok</th>
                  <th>Bilet Fiyat</th>
                  <th>Resim İşlemleri</th>
                  <th>Öne Çıkar</th>
                  <th>Durum</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>

              <tbody>

                <?php 

                $say=0;

                while($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) { $say++?>

                <tr>
                 <td width="20"><?php echo $say ?></td>
                 <td><?php echo $uruncek['ucak_marka'] ?></td>
                 <td><?php echo $uruncek['bilet_stok'] ?></td>
                 <td><?php echo $uruncek['bilet_fiyat'] ?></td>
                 <td><center><a href="urun-galeri.php?ucak_id=<?php echo $uruncek['ucak_id'] ?>"><button class="btn btn-success btn-xs">Resim İşlemleri</button></a></center></td>
                 <td><center><?php 

                 if ($uruncek['ucak_onecikar']==0) {?>

                 <a href="../baglanti/islem.php?ucak_id=<?php echo $uruncek['ucak_id'] ?>&urun_one=1&ucak_onecikar=ok"><button class="btn btn-success btn-xs">Ön Çıkar</button></a>
                   

                 <?php } elseif ($uruncek['ucak_onecikar']==1) {?>

                 <a href="../baglanti/islem.php?ucak_id=<?php echo $uruncek['ucak_id'] ?>&urun_one=0&ucak_onecikar=ok"><button class="btn btn-warning btn-xs">Kaldır</button></a>

                   <?php } ?>                

                   </center></td>
               
                 <td><center><?php 

                  if ($uruncek['ucak_durum']==1) {?>

                  <button class="btn btn-success btn-xs">Aktif</button>

                  <!--

                  success -> yeşil
                  warning -> turuncu
                  danger -> kırmızı
                  default -> beyaz
                  primary -> mavi buton

                  btn-xs -> ufak buton 

                -->

                <?php } else {?>

                <button class="btn btn-danger btn-xs">Pasif</button>

                <?php } ?>
              </center>

            </td>

            <td><center><a href="urun-duzenle.php?ucak_id=<?php echo $uruncek['ucak_id']; ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a></center></td>
            <td><center><a href="../baglanti/islem.php?ucak_id=<?php echo $uruncek['ucak_id']; ?>&urunsil=ok"><button class="btn btn-danger btn-xs">Sil</button></a></center></td>
          </tr>

          <?php  }

          ?>

        </tbody>
      </table>

    </div>
  </div>
</div>
</div>
</div>
</div>
<?php include 'footer.php'; ?>