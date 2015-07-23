<header>
	<a href="index.php"><img src="assets/images/palmsociallogobaslik.png" alt="" title="Palm Social"/></a>
	<div id="login">
		<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="pure-form">
			<fieldset>
				<ul id="giris-ust-alan">
					<li>
						<label for="kadiGiris">Kullanıcı Adı</label>
						<input type="text" id="kadiGiris" name="kadiGiris"/>
					</li>
					<li>
						<label for="sifreGiris">Şifre</label>
						<input type="password" id="sifreGiris" name="sifreGiris"/>
					</li>
					<li>
						<button type="submit" name="GirisYapSubmit" class="pure-button pure-button-primary">Oturum Aç</button>
					</li>
				</ul>
				<ul id="giris-alt-alan">
					<li>

						<input type="checkbox" name="benihatirla" id="benihatirla"/>
						<label for="benihatirla">Beni Hatırla</label>
					</li>
					<li>
						<a href="#" style="margin-left: 40px;">Şifremi Unuttum</a>
					</li>
				</ul>
			</fieldset>
		</form>
	</div>
</header>
