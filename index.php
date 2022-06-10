<?php 
include 'header.php'; 
?>

<div class="container">

	<div class="clearfix"></div>
	<div class="lines"></div>

	

</div>
<div class="f-widget featpro">
	<div class="container">
		<div class="title-widget-bg">
			<div class="title-widget">Öne Çıkan Uçuş Fırsatları</div>
			<div class="carousel-nav">
				<a class="prev"></a>
				<a class="next"></a>
			</div>
		</div>
		<div id="product-carousel" class="owl-carousel owl-theme">

			<?php 
			$urunsor=$db->prepare("SELECT * FROM urun where ucak_durum=:ucak_durum and ucak_onecikar=:ucak_onecikar");
			$urunsor->execute(array(
				'ucak_durum' => 1,
				'ucak_onecikar' => 1
				));

			
			while($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) {


					$ucak_id=$uruncek['ucak_id'];
					$urunfotosor=$db->prepare("SELECT * FROM urunfoto where ucak_id=:ucak_id order by ucakfoto_sira ASC limit 1 ");
					$urunfotosor->execute(array(
						'ucak_id' => $ucak_id
						));

					$urunfotocek=$urunfotosor->fetch(PDO::FETCH_ASSOC);
				
				?>

				<div class="item animated bounce">
					<div class="productwrap">
						<div class="pr-img">
							<div class="hot"></div>
							<a href="urun-<?=seo($uruncek["ucak_marka"]).'-'.$uruncek["ucak_id"]?>"><img  src="<?php echo $urunfotocek['ucakfoto_resimyol'] ?>" alt="" class="img-responsive"></a>
							<div class="blue"><div class="inner"><span><?php echo $uruncek['bilet_fiyat'] ?> TL</span></div></div>
						</div>
						<span class="smalltitle"><a href="urun-<?=seo($uruncek["ucak_marka"]).'-'.$uruncek["ucak_id"]?>"><?php echo $uruncek['ucak_marka'] ?></a></span>
						<span class="smalldesc">Uçak Kodu.: <?php echo $uruncek['ucak_id'] ?></span>
					</div>
				</div>

				<?php } ?>

			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-9"><!--Main content-->
				
					<div class="title">Hakkımızda Bilgi</div>
				
				<p class="ct">
					<?php 
					$hakkimizdasor=$db->prepare("SELECT * FROM hakkimizda where hakkimizda_id=:id");
					$hakkimizdasor->execute(array(
						'id' => 0
						));
					$hakkimizdacek=$hakkimizdasor->fetch(PDO::FETCH_ASSOC);

					echo substr($hakkimizdacek['hakkimizda_icerik'],0,1000) ?>
				</p>

				<a href="hakkimizda" class="btn btn-default btn-red btn-sm">Devamını Oku</a>
								
				<div class="spacer"></div>
			</div><!--Ana kısım-->

			<!-- Siderbar buraya gelecek -->
			<?php include 'sidebar.php' ?>
		</div>
	</div>

	<?php include 'footer.php'; ?>