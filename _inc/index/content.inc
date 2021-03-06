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
						case "kadiVar":echo "<strong>".$_GET['kadi']."</strong> kullanıcı adı kullanılıyor";break;
					}
				?>

			</div>
			<?php endif; ?>

			<form action="<?= $_SERVER['PHP_SELF']; ?>"  method="post" class="pure-form pure-form-aligned">
				<fieldset>
					<div class="pure-control-group">
						<label for="adsoyad">Ad:</label>
						<input id="ad" type="text" name="ad" placeholder="Ad"
							value="<?php if(isset($_GET['ad'])){echo $_GET['ad'];} ?>"
							/>
					</div>

					<div class="pure-control-group">
						<label for="soyad">Soyad:</label>
						<input id="soyad" type="text" name="soyad" placeholder="Soyad"
						       value="<?php if(isset($_GET['soyad'])){echo $_GET['soyad'];} ?>"
							/>
					</div>

					<div class="pure-control-group">
						<label for="eposta">E-posta:</label>
						<input type="email" name="eposta" placeholder="Eposta adresi"
							value="<?php if(isset($_GET['eposta'])){echo $_GET['eposta'];} ?>"/>
					</div>

					<div class="pure-control-group">
						<label for="kadi">Kullanıcı Adı:</label>
						<input type="text" name="kadi" placeholder="Kullanıcı Adı"
							value="<?php if(isset($_GET['kadi'])){ echo $_GET['kadi'];} ?>"
							/>
					</div>

					<div class="pure-control-group">
						<label for="sifre">Şifre:</label>
						<input type="password" name="sifre" placeholder="Şifre"/><br/>
					</div>

					<div class="pure-control-group">
						<label for="sifretekrar">Şifre(Tekrar):</label>
						<input type="password" name="sifretekrar" placeholder="Şifre(Tekrar)"/>
					</div>

					<div class="pure-controls">
						<button type="submit" name="uyeKayitSubmit" class="pure-button">Kaydol</button>
					</div>
				</fieldset>
			</form>
		</li>
	</ul>
</div>
