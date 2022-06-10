<?php 

include 'header.php'; 

$urunsor=$db->prepare("SELECT * FROM urun where ucak_id=:id");
$urunsor->execute(array(
  'id' => $_GET['ucak_id']
  ));

$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);

?>

<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Ürün Düzenleme<small>

              <?php 

              if (@$_GET['durum']=="ok") {?>

              <b style="color:green;">İşlem Başarılı...</b>

              <?php } elseif (@$_GET['durum']=="no") {?>

              <b style="color:red;">İşlem Başarısız...</b>

              <?php }

              ?>

            </small></h2>
           
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />

            <form action="../baglanti/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

              <!-- Kategori seçme başlangıç -->
              <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kategori Seç
                </label>
                <div class="col-md-6 col-sm-6 col-xs-6">

                  <?php  

                  $ucak_id=$uruncek['kategori_id']; 

                  $kategorisor=$db->prepare("select * from kategori where kategori_ust=:kategori_ust order by kategori_sira");
                  $kategorisor->execute(array(
                    'kategori_ust' => 0
                    ));

                    ?>
                    <select class="select2_multiple form-control" required="" name="kategori_id" >

                     <?php 

                     while($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)) {

                       $kategori_id=$kategoricek['kategori_id'];

                       ?>

                       <option <?php if ($kategori_id==$ucak_id) { echo "selected='select'"; } ?> value="<?php echo $kategoricek['kategori_id']; ?>"><?php echo $kategoricek['kategori_ad']; ?></option>

                       <?php } ?>

                     </select>
                   </div>
                 </div>

                 <!-- kategori seçme bitiş -->

                 <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Uçak Adı
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="first-name" name="ucak_marka" value="<?php echo $uruncek['ucak_marka'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>

                <!-- Ck Editör Başlangıç -->

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Uçak Detay
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">

                    <textarea  class="ckeditor" id="editor1" name="ucak_detay"><?php echo $uruncek['ucak_detay']; ?></textarea>
                  </div>
                </div>

                <script type="text/javascript">

                 CKEDITOR.replace( 'editor1',

                 {

                  filebrowserBrowseUrl : 'ckfinder/ckfinder.html',

                  filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?type=Images',

                  filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?type=Flash',

                  filebrowserUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',

                  filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',

                  filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',

                  forcePasteAsPlainText: true

                } 

                );

              </script>

              <!-- Ck Editör Bitiş -->

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Bilet Fiyat 
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="bilet_fiyat" value="<?php echo $uruncek['bilet_fiyat'] ?>"  class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Uçak Video
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="ucak_video" value="<?php echo $uruncek['ucak_video'] ?>" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Uçak Keyword 
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="ucak_keyword" value="<?php echo $uruncek['ucak_keyword'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Bilet Stok 
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="bilet_stok" value="<?php echo $uruncek['bilet_stok'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Öne Çıkan Uçaklar
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                 <select id="heard" class="form-control" name="ucak_onecikar" required>

                  <option value="1" <?php echo $uruncek['ucak_onecikar'] == '1' ? 'selected=""' : ''; ?>>Evet</option>

                  <option value="0" <?php if ($uruncek['ucak_onecikar']==0) { echo 'selected=""'; } ?>>Hayır</option>
                 
                 </select>
               </div>
             </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Uçak Durum
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                 <select id="heard" class="form-control" name="ucak_durum" required>

                   <!-- Kısa İf Kulllanımı 

                    <?php echo $uruncek['ucak_durum'] == '1' ? 'selected=""' : ''; ?>

                  -->

                  <option value="1" <?php echo $uruncek['ucak_durum'] == '1' ? 'selected=""' : ''; ?>>Aktif</option>

                  <option value="0" <?php if ($uruncek['ucak_durum']==0) { echo 'selected=""'; } ?>>Pasif</option>
                  <!-- <?php 

                   if ($uruncek['ucak_durum']==0) {?>

                   <option value="0">Pasif</option>
                   <option value="1">Aktif</option>

                   <?php } else {?>

                   <option value="1">Aktif</option>
                   <option value="0">Pasif</option>

                   <?php  }

                   ?> -->

                 </select>
               </div>
             </div>

             <input type="hidden" name="ucak_id" value="<?php echo $uruncek['ucak_id'] ?>"> 

             <div class="form-group">
              <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" name="urunduzenle" class="btn btn-success">Güncelle</button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<?php include 'footer.php'; ?>