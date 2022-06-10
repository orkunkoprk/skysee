<?php 

include 'header.php'; 

                     $sayfada = 6; // sayfada gösterilecek içerik miktarını belirtiyoruz.
                     $sorgu=$db->prepare("select * from kategori");
                     $sorgu->execute();
                     $toplam_icerik=$sorgu->rowCount();
                     $toplam_sayfa = ceil($toplam_icerik / $sayfada);
                     // eğer sayfa girilmemişse 1 varsayalım.
                     $sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;
                            // eğer 1'den küçük bir sayfa sayısı girildiyse 1 yapalım.
                     if($sayfa < 1) $sayfa = 1; 
                                   // toplam sayfa sayımızdan fazla yazılırsa en son sayfayı varsayalım.
                     if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa; 
                     $limit = ($sayfa - 1) * $sayfada;

                     //aşağısı bir önceki default kodumuz...
                     if (isset($_GET['sef'])) {

                            $kategorisor=$db->prepare("SELECT * FROM kategori where kategori_seourl=:seourl");
                            $kategorisor->execute(array(
                                   'seourl' => $_GET['sef']
                            ));

                            $kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC);

                            $kategori_id=$kategoricek['kategori_id'];


                            $urunsor=$db->prepare("SELECT * FROM urun where kategori_id=:kategori_id order by ucak_id DESC limit $limit,$sayfada");
                            $urunsor->execute(array(
                                   'kategori_id' => $kategori_id
                            ));

                            $say=$urunsor->rowCount();

                     } else {

                            $urunsor=$db->prepare("SELECT * FROM urun order by ucak_id DESC limit $limit,$sayfada");
                            $urunsor->execute();

                     }

                     if ($toplam_icerik==0) {
                            echo "Bu kategoride ürün bulunamadı";
                     }

                     ?>

                     <head>
                            
                            <title><?php echo @$kategoricek['kategori_ad'] ?>UÇAKLAR</title>

                     </head>

                     <div class="container">

                           <div class="clearfix"></div>
                           <div class="lines"></div>
                    </div>

                    <div class="container">

                           <div class="row">
                                 <div class="col-md-9"><!--Main content-->
                                       
                                             <div class="title">Uçaklar</div>
                                             
                                     <div class="row prdct"><!--Products-->

                                          <?php

                                          while($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) {

                                                 $ucak_id=$uruncek['ucak_id'];
                                                 $urunfotosor=$db->prepare("SELECT * FROM urunfoto where ucak_id=:ucak_id order by ucakfoto_sira ASC limit 1 ");
                                                 $urunfotosor->execute(array(
                                                        'ucak_id' => $ucak_id
                                                 ));

                                                 $urunfotocek=$urunfotosor->fetch(PDO::FETCH_ASSOC);
                                                 ?>

                                                 <div class="col-md-4">
                                                   <div class="productwrap">
                                                    <div class="pr-img">
                                                     <div class="hot"></div>
                                                     <a href="urun-<?=seo($uruncek["ucak_marka"]).'-'.$uruncek["ucak_id"]?>"><img src="<?php echo $urunfotocek['ucakfoto_resimyol'] ?>" alt="" class="img-responsive"></a>
                                                     <div class="pricetag on-sale"><div class="inner on-sale"><span class="onsale"><span class="oldprice"><?php echo $uruncek['bilet_fiyat']*1.50 ?> TL</span><?php echo $uruncek['bilet_fiyat'] ?></span></div></div>
                                              </div>
                                              <span class="smalltitle"><a href="urun-<?=seo($uruncek["ucak_marka"]).'-'.$uruncek["ucak_id"]?>"><?php echo $uruncek['ucak_marka'] ?></a></span>
                                              <div>
                                              <span class="smalldesc">Gidiş: <?php echo $uruncek['ucak_gidis'] ?></span>
                                              </div>
                                              <div>
                                              <span class="smalldesc">Dönüş: <?php echo $uruncek['ucak_donus'] ?></span>
                                              </div>   
                                              <span class="smalldesc">Ürün Kodu.: <?php echo $uruncek['ucak_id'] ?></span>


                                       </div>
                                </div>

                                <?php } ?>

                                <div align="right" class="col-md-12">
                                     <ul class="pagination">

                                      <?php

                                      $s=0;

                                      while ($s < $toplam_sayfa) {

                                       $s++; ?>

                                       <?php 

                                       if ($s==$sayfa) {?>

                                       <li class="active">

                                        <a href="kategoriler?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a>

                                 </li>

                                 <?php } else {?>

                                 <li>

                                        <a href="kategoriler?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a>

                                 </li>

                                 <?php   }

                          }

                          ?>

                   </ul>
            </div>

     </div><!--Ürünler-->

			</div>

			<?php include 'sidebar.php' ?>
		</div>
		<div class="spacer"></div>
	</div>
	
	<?php include 'footer.php'; ?>