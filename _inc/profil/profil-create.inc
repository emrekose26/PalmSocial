
		<!--üye profil oluşturma formu-->
		<?php
			$sorguAd = $db->prepare("SELECT ad FROM uye WHERE uyeID = ?");
			$sorguAd->execute(array($_SESSION['UyeID']));

			$sorguSoyad = $db->prepare("SELECT soyad FROM uye WHERE uyeID = ? ");
			$sorguSoyad->execute(array($_SESSION['UyeID']));
		?>

		<div id="sol"></div>

		<div id="orta">

			<h3><img src="assets/images/info.png" alt=""/> &nbsp;Henüz profil oluşturmadınız.Profil oluşturmak için aşağıdaki bilgileri eksiksiz &nbsp;doldurunuz</h3>
			<!-- resim dosyası seçmek için enctype="multipart/form-data" yapıldı-->
			<form action="" method="post" enctype="multipart/form-data" class="pure-form pure-form-aligned">
				<fieldset>
					<legend>Kişisel Bilgiler</legend>
					<img src="assets/images/edituser.png" class="fieldset-photo" alt=""/>
					<div class="pure-control-group">
						<label for="ad">Ad</label>
						<input id="ad" name="ad" type="text" placeholder="Ad" value=<?php
						foreach($sorguAd as $row){
							echo $row['ad'];
						}
						?> >
					</div>

					<div class="pure-control-group">
						<label for="soyad">Soyad</label>
						<input id="soyad" name="soyad" type="text" placeholder="Soyad" value=<?php
						foreach($sorguSoyad as $row){
							echo $row['soyad'];
						}
						?> >
					</div>
				</fieldset><!--kişisel bilgiler-->


				<!--TODO:Doğum tarihi,tarih fonksiyonlarıyla detaylandırılacak-->
				<!--TODO:Yaşadığı yer sayısı dropdownda arttılıcak.Ajax ile ülke seçimi ve şehir seçimi yapılacak-->
				<fieldset>
					<legend>Yer ve Tarih Bilgileri</legend>
					<img src="assets/images/map-marker.png" class="fieldset-photo" alt=""/>
					<div class="pure-control-group">
						<label for="dogumTarih">Doğum Tarihi</label>
						<input id="dogumTarih" name="dogumTarih" type="text" placeholder="Doğum Tarihi">
					</div>

					<div class="pure-control-group">
						<label for="dogumYeri">Doğum Yeri</label>
						<select id="dogumYeri" name="dogumYeri">
							<?php
							$sorguIller = $db->query("SELECT * FROM iller");
							$sorguIller->execute();
							foreach($sorguIller as $rowIller){
								echo "<option id='".$rowIller['ilID']."'>".$rowIller['ilAdi']."</option>";
							}
							?>
						</select>
					</div>

					<div class="pure-control-group">
						<label for="yasadigiYer">Yaşadığı Yer</label>
						<input id="yasadigiYer" name="yasadigiYer" type="text" placeholder="Yaşadığınız Yer">
					</div>
				</fieldset><!--yer ve tarih bilgileri-->


				<fieldset>
					<legend>Profil Resmi</legend>
					<img src="assets/images/photo.png" class="fieldset-photo" alt=""/>
					<div class="pure-control-group">
						<label for="resim">Profil Resmi</label>
						<input id="resim" name="resim" type="file" >
					</div>

					<button type="submit" id="uyeProfilOlusturSubmit" name="uyeProfilOlusturSubmit" class="pure-button pure-button-primary">Profil Oluştur</button>
				</fieldset>
			</form>
		</div><!--orta-->

		<div id="sag"></div>

