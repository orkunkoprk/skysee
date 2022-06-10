<?php 

include 'header.php'; 

$urunsor=$db->prepare("SELECT * FROM urun where ucak_id=:ucak_id");
$urunsor->execute(array(
	'ucak_id' => $_GET['ucak_id']
));

$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);

echo $say=$urunsor->rowCount();

if ($say==0) {
	
	header("Location:index.php?durum=oynasma");
	exit;
}
?>

<head>

	<title><?php echo $uruncek['ucak_marka'] ?> SKYSEE</title>
	
	<!-- fancy Style -->
	<link rel="stylesheet" type="text/css" href="js\product\jquery.fancybox.css?v=2.1.5" media="screen">
</head>

<?php 

if (@$_GET['durum']=="ok") {?>

<script type="text/javascript">
	alert("Yorum Başarıyla Eklendi");
</script>

<?php }
?>

<div class="container">
	
	<div class="clearfix"></div>
	<div class="lines"></div>
</div>

<div class="container">
	<div class="row">

	</div>
	<div class="row">
		<div class="col-md-9"><!--Main content-->
			<div class="title-bg">
				<div class="title"><?php echo $uruncek['ucak_marka'] ?></div>
			</div>
			<div class="row">
				<div class="col-md-6">

					<?php
					$ucak_id=$uruncek['ucak_id'];
					$urunfotosor=$db->prepare("SELECT * FROM urunfoto where ucak_id=:ucak_id order by ucakfoto_sira ASC limit 1 ");
					$urunfotosor->execute(array(
						'ucak_id' => $ucak_id
					));

					$urunfotocek=$urunfotosor->fetch(PDO::FETCH_ASSOC);

					?>
					
					<div class="dt-img">
						<div class="detpricetag"><div class="inner"><?php echo $uruncek['bilet_fiyat'] ?> TL</div></div>
						<a class="fancybox" href="<?php echo $urunfotocek['ucakfoto_resimyol'] ?>" data-fancybox-group="gallery" title="Cras neque mi, semper leon"><img src="<?php echo $urunfotocek['ucakfoto_resimyol'] ?>" alt="" class="img-responsive"></a>
					</div>

					<?php
					$ucak_id=$uruncek['ucak_id'];
					$urunfotosor=$db->prepare("SELECT * FROM urunfoto where ucak_id=:ucak_id order by ucakfoto_sira ASC limit 1,3 ");
					$urunfotosor->execute(array(
						'ucak_id' => $ucak_id
					));

					while($urunfotocek=$urunfotosor->fetch(PDO::FETCH_ASSOC)) {

						?>

						<div class="thumb-img">
							<a class="fancybox" href="<?php echo $urunfotocek['ucakfoto_resimyol'] ?>" data-fancybox-group="gallery" title="Cras neque mi, semper leon"><img src="<?php echo $urunfotocek['ucakfoto_resimyol'] ?>" alt="" class="img-responsive"></a>
						</div>

						<?php } ?>

					</div>
					<div class="col-md-6 det-desc">
						<div class="productdata">
							<div class="infospan">Uçağın Kodu <span><?php echo $uruncek['ucak_id']; ?></span></div>
							<div class="infospan">Bilet Fiyatı <span><?php echo $uruncek['bilet_fiyat']; ?></span></div>

							<div class="clearfix"></div>
							<hr>

							<form action="admin/baglanti/islem.php" method="POST">

								<div class="form-group">
									<label for="qty" class="col-sm-2 control-label">Adet</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" value="1" name="bilet_adet">
									</div>
									<input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id'] ?>">

									<input type="hidden" name="ucak_id" value="<?php echo $uruncek['ucak_id'] ?>">
									<div class="col-sm-4">

										<?php if (isset($_SESSION['userkullanici_mail'])) {?>

										<button type="submit" name="sepetekle" class="btn btn-default btn-red btn-sm"><span class="addchart">Bileti Sepete Ekle</span></button>

										<?php  } else { ?>

										<button type="submit" name="sepetekle" disabled class="btn btn-default btn-red btn-sm"><span class="addchart">Giriş Yapın</span></button>

										<?php } ?>

									</div>
									<div class="clearfix"></div>
								</div>

							</form>

							<div class="sharing">
								<div class="share-bt">
									<div class="addthis_toolbox addthis_default_style ">
										<a class="addthis_counter addthis_pill_style"></a>
									</div>
									<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4f0d0827271d1c3b"></script>
									<div class="clearfix"></div>
								</div>

								<div  class="avatock"><span>

									<?php if ($uruncek['bilet_stok']>=1) {

										echo "Stok Adeti : ".$uruncek['bilet_stok'];
									} else {

										echo "Ürün Kalmadı";
									} ?>

								</span></div>
							</div>

						</div>
					</div>
				</div>

				<div class="tab-review">
					<ul id="myTab" class="nav nav-tabs shop-tab">

						<li <?php if (@$_GET['durum']!="ok") {?>
							class="active"
							<?php } ?>><a href="#desc" data-toggle="tab">Açıklama</a></li>
							<li 

							<?php if (@$_GET['durum']=="ok") {?>
							class="active"
							<?php } ?>

							<?php 
							$kullanici_id=@$kullanicicek['kullanici_id'];
							$ucak_id=$uruncek['ucak_id'];

							$yorumsor=$db->prepare("SELECT * FROM yorumlar where ucak_id=:ucak_id and yorum_onay=:yorum_onay");
							$yorumsor->execute(array(
								'ucak_id' => $ucak_id,
								'yorum_onay' => 1
							));

							?>
							><a href="#rev" data-toggle="tab">Yorumlar (<?php echo $yorumsor->rowCount(); ?>)</a></li>
							<li class=""><a href="#video" data-toggle="tab">Uçak Video</a></li>
						</ul>

						<div id="myTabContent" class="tab-content shop-tab-ct">
							<div class="tab-pane fade <?php if ($_GET['durum']!="ok") {?>
								active in
								<?php } ?>" id="desc">
								<p>
									<?php echo $uruncek['ucak_detay'] ?>
								</p>
							</div>

							<div class="tab-pane fade <?php if ($_GET['durum']=="ok") {?>
								active in
								<?php } ?>" id="rev">

								<?php 

								while($yorumcek=$yorumsor->fetch(PDO::FETCH_ASSOC)) {

									$ykullanici_id=$yorumcek['kullanici_id'];

									$ykullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_id=:id");
									$ykullanicisor->execute(array(
										'id' => $ykullanici_id
									));

									$ykullanicicek=$ykullanicisor->fetch(PDO::FETCH_ASSOC);
									?>

									<!-- Yorumları Dökeceğiz -->
									<p class="dash">
										<span><?php echo $ykullanicicek['kullanici_adsoyad'] ?></span> (<?php echo $yorumcek['yorum_zaman'] ?>)<br><br>
										<?php echo $yorumcek['yorum_detay'] ?>
									</p>

									<!-- Yorumları Dökeceğiz -->

									<?php } ?>

									<h4>Yorum Yazın</h4>

									<?php if (isset($_SESSION['userkullanici_mail'])) {?>

									<form action="admin/baglanti/islem.php" method="POST" role="form">

										<div class="form-group">
											<textarea name="yorum_detay" class="form-control" placeholder="Lütfen yorumunuzu buraya yazınız..." id="text"></textarea>
										</div>

										<input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id'] ?>">

										<input type="hidden" name="ucak_id" value="<?php echo $uruncek['ucak_id'] ?>">

										<input type="hidden" name="gelen_url" value="<?php 
										echo "http://".$_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI'].""; 

										?>">										

										<button type="submit" name="yorumkaydet" class="btn btn-default btn-red btn-sm">Yorumu Gönder</button>
									</form>

									<?php } else {?>

									Yorum yazabilmek için <a style="color:red" href="register">kayıt</a> olmalı yada üyemizseniz giriş yapmalısınız...

									<?php } ?>

								</div>

								<div class="tab-pane fade " id="video">
									<p>

										<?php 

										$say=strlen($uruncek['ucak_video']);

										if ($say>0) {?>

										<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $uruncek['ucak_video'] ?>" frameborder="0" allowfullscreen></iframe>

										<?php } else {

											echo "Bu ürüne video eklenmemiştir";

										}

										?>
									</p>
								</div>

							</div>
						</div>
						
						
						
							<div class="spacer"></div>
						</div><!--Main content-->

						<?php include 'sidebar.php' ?>
					</div>
				</div>

				<?php include 'footer.php' ?>