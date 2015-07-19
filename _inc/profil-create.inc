
		<!--üye profil oluşturma formu-->
		<?php
			$sorguAd = $db->prepare("SELECT ad FROM uye WHERE uyeID = ?");
			$sorguAd->execute(array($_SESSION['UyeID']));

			$sorguSoyad = $db->prepare("SELECT soyad FROM uye WHERE uyeID = ? ");
			$sorguSoyad->execute(array($_SESSION['UyeID']));
		?>

		<!-- resim dosyası seçmek için enctype="multipart/form-data" yapıldı-->
		<form action="" method="post" enctype="multipart/form-data" class="pure-form pure-form-aligned">
			<fieldset>
				<legend>Kişisel Bilgiler</legend>
				<div class="pure-control-group">
		            <label for="ad">Ad</label>
		            <input id="ad" name="ad" type="text" placeholder="Ad" value=<?php
		                foreach($sorguAd as $row){
			                echo $row['ad'];
		                }
		            ?> >
                </div>

				<div class="pure-control-group">
					<label for="ad">Soyad</label>
					<input id="soyad" name="soyad" type="text" placeholder="Soyad" value=<?php
						foreach($sorguSoyad as $row){
							echo $row['soyad'];
						}
					?> >
				</div>
			</fieldset><!--kişisel bilgiler-->


			<fieldset>
				<legend>Yer ve Tarih Bilgileri</legend>
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


			<fielset>
				<legend>Profil Resmi</legend>
				<div class="pure-control-group">
					<label for="resim">Profil Resmi</label>
					<input id="resim" name="resim" type="file" >
				</div>

				<button type="submit" name="uyeProfilOlusturSubmit" class="pure-button pure-button-primary">Profil Oluştur</button>
			</fielset>
		</form>
