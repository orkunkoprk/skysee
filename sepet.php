<?php include 'header.php' ?>

<div class="container">

	<div class="clearfix"></div>
	<div class="lines"></div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			
		</div>
	</div>
	<div class="title-bg">
		<div class="title">Bilet Sepetim</div>
	</div>

	<div class="table-responsive">
		<table class="table table-bordered chart">
			<thead>
				<tr>
					<th>-</th>
					<th>Nerden-Nereye</th>
					<th>Uçağın Kodu</th>
					<th>Adet</th>
					<th>Toplam Fiyat</th>
				</tr>
			</thead>
			<tbody>


				<?php 
				$kullanici_id=@$kullanicicek['kullanici_id'];
				$sepetsor=$db->prepare("SELECT * FROM sepet where kullanici_id=:id");
				$sepetsor->execute(array(
					'id' => $kullanici_id
					));

				while($sepetcek=$sepetsor->fetch(PDO::FETCH_ASSOC)) {

					$ucak_id=$sepetcek['ucak_id'];
					$urunsor=$db->prepare("SELECT * FROM urun where ucak_id=:ucak_id");
					$urunsor->execute(array(
						'ucak_id' => $ucak_id
						));

					$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);

					//echo $topla=$uruncek['bilet_fiyat']*$sepetcek['bilet_adet'];
					?>

					<tr>
						<td><form><input type="checkbox"></form></td>
						<td><?php echo $uruncek['ucak_marka'] ?></td>
						<td><?php echo $uruncek['ucak_id'] ?></td>
						<td><form><input type="text" class="form-control quantity" value="<?php echo $sepetcek['bilet_adet'] ?>"></form></td>
						<td><?php echo $uruncek['bilet_fiyat'] ?></td>
					</tr>
					<?php } ?>

				</tbody>
			</table>
		</div>
		<div class="row">
			<div class="col-md-6">

			</div>
			<div class="col-md-3 col-md-offset-3">
				<div class="subtotal-wrap">
					<!--<div class="subtotal">
						<<p>Toplam Fiyat : $26.00</p>
						<p>Vat 17% : $54.00</p>
					</div>-->
					<div class="total">Toplam Fiyat : <span class="bigprice"><?php echo @$toplam_fiyat ?> TL</span></div>
					<div class="clearfix"></div>
					<a href="odeme" class="btn btn-default btn-yellow">Ödeme Sayfası</a>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="spacer"></div>
	</div>

	<?php include 'footer.php' ?>