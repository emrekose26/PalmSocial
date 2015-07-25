	<header>
		<div id="logo">
			<a href="profil.php"><img src="assets/images/palms-iconbeyaz.png" alt=""/></a>
		</div><!---logo-->

		<form action="" class="pure-form">
			<input type="text" placeholder="Arama...">
			<button type="submit" class="pure-button pure-button-primary">Ara</button>
		</form>


		<ul id="menu">
			<li><a href="#">Profil</a></li>
			<li><a href="#">Arkadaşlar</a></li>
			<li><a href="#">Mesajlar</a></li>
			<li><a href="#">Multimedya</a></li>
			<li><a href="#">Müzikler</a></li>
		</ul>

		<ul id="sag-menu">
			<li><a href="profil.php">
					<?php
						//header kısmında üye ad soyadını veritabanından çekmek için
						$sorguUyeAdSoyad = $db->prepare("SELECT ad,soyad,kullaniciAdi FROM uye WHERE uyeID=?");
						$sorguUyeAdSoyad->execute(array($uyeID));
						foreach($sorguUyeAdSoyad as $rowAdSoyad){
							echo $rowAdSoyad['ad']." ".$rowAdSoyad['soyad']."<strong> (@".$rowAdSoyad['kullaniciAdi'].")</strong> ";
						}
					?>
			</a></li>
			<li><a href="cikisYap.php">Çıkış Yap</a></li>
		</ul>
	</header>


