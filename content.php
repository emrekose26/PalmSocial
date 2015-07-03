<div id="content">
	<img src="assets/images/worldmap.png" alt=""/>
	<ul>
		<li id="description">
			<h1>Palm Social'a Hoşgeldin</h1>
			<h3>Arkadaşlarınla ve diğer insanlarla iletişim kur.</h3>
			<img src="assets/images/peeopesocial.png" alt=""/>
		</li>
		<li id="signupform">
			<h1>Kayıt Ol</h1>
			<h3>Hemen ücretsiz üye olun!</h3>

			<?php if(isset($_GET['hata'])):?>
			<div id="uyeKayitHata">
				<i class="fa fa-exclamation-circle" style="color:red;"></i>
				<?php
					switch($_GET['hata']){
						case "alanlarbos": echo "Alanları Boş Bırakmayın"; break;
						case "parolaFarkli" :echo "Parolalar uyuşmuyor";break;
					}
				?>

			</div>
			<?php endif; ?>

			<form action="<?= $_SERVER['PHP_SELF']; ?>"  method="post" class="pure-form pure-form-aligned">
				<fieldset>
					<div class="pure-control-group">
						<label for="adsoyad">Ad Soyad:</label>
						<input id="adsoyad" type="text" name="adsoyad" placeholder="Ad Soyad"/>
					</div>

					<div class="pure-control-group">
						<label for="eposta">E-posta:</label>
						<input type="email" name="eposta" placeholder="Eposta adresi"/>
					</div>

					<div class="pure-control-group">
						<label for="kadi">Kullanıcı Adı:</label>
						<input type="text" name="kadi" placeholder="Kullanıcı Adı"/>
					</div>

					<div class="pure-control-group">
						<label for="sifre">Şifre:</label>
						<input type="password" name="sifre" placeholder="Şifre"/><br/>
					</div>

					<div class="pure-control-group">
						<label for="sifretekrar">Şifre(Tekrar):</label>
						<input type="password" name="sifretekrar" placeholder="Şifre(Tekrar)"/>
					</div>

					<div class="pure-control-group">
						<label for="dtarih">Doğum Tarihi:</label>
						<input type="datetime" name="dtarih" placeholder="Doğum Tarihi"/>
					</div>

					<div class="pure-controls">
						<button type="submit" name="uyeKayitSubmit" class="pure-button">Kaydol</button>
					</div>
				</fieldset>
			</form>
		</li>
	</ul>
</div>
