<?php include 'header.php'; ?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="page-title-wrap">
				<div class="page-title-inner">
					<div class="row">
						<div class="col-md-12">
							<div class="bigtitle">Bilet Sipariş Bilgilerim</div>
							<p >Vermiş olduğunuz bilet siparişlerinizi listeliyorsunuz</p>
						</div>					
					</div>
				</div>
			</div>
		</div>
	</div>

	<form action="admin/baglanti/islem.php" method="POST" class="form-horizontal checkout" role="form">
		<div class="row">
			<div class="col-md-12">
				
					<div class="title">Sipariş Bilgileri</div>

				<div class="table-responsive">
					<table class="table table-bordered chart">
						<thead>
							<tr>

								<th>PNR</th>
								<th>Tarih</th>
								<th>Tutar</th>
								<th>Ödeme Tip</th>
								<th>Uçak Gidiş Tarihi</th>
								<th>Uçak Dönüş Tarihi</th>
								
							</tr>
						</thead>
						<tbody>

							<?php 
							 $kullanici_id=$kullanicicek['kullanici_id'];
							$siparissor=$db->prepare("SELECT * FROM siparis where kullanici_id=:id");
							 
							$siparissor->execute(array(
								'id' => $kullanici_id
								));
							
								while($sipariscek=$siparissor->fetch(PDO::FETCH_ASSOC)) {?>
								
								<tr>

									<td><?php echo $sipariscek['bilet_id']; ?></td>
									<td><?php echo $sipariscek['bilet_zaman']; ?></td>
									<td><?php echo $sipariscek['bilet_toplam']; ?></td>
									<td><?php echo $sipariscek['bilet_tip']; ?></td>
									<td><?php echo $sipariscek['ucak_gidis']; ?></td>
									<td><?php echo $sipariscek['ucak_donus']; ?></td>
									
									
									<!-- <td><a href="http://localhost/skysee" target="_blank"><button class="btn btn-primary btn-xs">Detay</button></a></td> -->
									
									
								</tr>

								<?php } ?>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</form>
	<div class="spacer"></div>
</div>

<?php include 'footer.php'; ?>