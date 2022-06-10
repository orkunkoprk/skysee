<?php include 'header.php'; ?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="page-title-wrap">
				<div class="page-title-inner">
					<div class="row">
						<div class="col-md-12">
							<div class="bigtitle">Hesap Bilgilerim</div>
							<p >Bilgilerinizi aşağıdan düzenleyebilirsiniz...</p>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>

	<form action="admin/baglanti/islem.php" method="POST" class="form-horizontal checkout" role="form">
		<div class="row">
			<div class="col-md-6">
				
					<div class="title">Kayıt Bilgileri</div>
				

				<?php 

				if (@$_GET['durum']=="farklisifre") {?>

				<div class="alert alert-danger">
					<strong>Hata!</strong> Girdiğiniz şifreler eşleşmiyor.
				</div>

				<?php } elseif (@$_GET['durum']=="eksiksifre") {?>

				<div class="alert alert-danger">
					<strong>Hata!</strong> Şifreniz minimum 6 karakter uzunluğunda olmalıdır.
				</div>

				<?php } elseif (@$_GET['durum']=="mukerrerkayit") {?>

				<div class="alert alert-danger">
					<strong>Hata!</strong> Bu kullanıcı daha önce kayıt edilmiş.
				</div>

				<?php } elseif (@$_GET['durum']=="basarisiz") {?>

				<div class="alert alert-danger">
					<strong>Hata!</strong> Kayıt Yapılamadı Sistem Yöneticisine Danışınız.
				</div>

				<?php }
				?>

				<div class="form-group dob">
					<div class="col-sm-12">
						
						<input type="text" class="form-control"  required="" name="kullanici_adsoyad" value="<?php echo $kullanicicek['kullanici_adsoyad'] ?>">
					</div>
					
				</div>
			
				<div class="form-group dob">
					<div class="col-sm-12">
					<div class="default"><?php echo "Telefon numarası"?></div>
						<input type="text" class="form-control" name="kullanici_gsm" placeholder="GSM"   value="<?php echo $kullanicicek['kullanici_gsm'] ?>">
					</div>
				<hr><hr>
					<div class="col-sm-12">
					<div class="default"><?php echo "İl"?></div>
						<input type="text" class="form-control" name="kullanici_il" placeholder="İl"   value="<?php echo $kullanicicek['kullanici_il'] ?>">
					</div>
				
					<hr><hr><hr>
					<div class="col-sm-12">
					<div class="default"><?php echo "İlçe"?></div>
						<input type="text" class="form-control" name="kullanici_ilce" placeholder="İlçe"   value="<?php echo $kullanicicek['kullanici_ilce'] ?>">
					</div>
				<hr><hr><hr>
					<div class="col-sm-12">
					<div class="default"><?php echo "Adres"?></div>
						<input type="text" class="form-control" name="kullanici_adres" placeholder="Adres"   value="<?php echo $kullanicicek['kullanici_adres'] ?>">
					</div>
				</div>
				

				<input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id'] ?>">
                <hr>
				<button  type="submit" name="kullanicibilgiguncelle" class="btn btn-default btn-red">Bilgilerimi Güncelle</button>
				
			</div>
			<div class="col-md-6">						
			</div>
		</div>
	</div>
</form>
<div class="spacer"></div>
</div>

<?php include 'footer.php'; ?>