<?php
	session_start();
	require "_inc/db.php";
	require "_inc/functions.php";

	if(!isset($_SESSION['UyeID'])){
		header("Location:index.php");
		exit();
	}else{
		//üye girişi var ve form gönderilmişse

		if(isset($_POST['iletisimEkleSubmit'])){
			echo "İletişim bilgileri gönderildi" ;
		}
	}

?>


<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>İletişim Ekle</title>
	<!--[if lt IE 9]>
	<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/r29/html5.min.js"></script>
	<![endif]-->

	<!--Styles-->
	<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
	<link rel="stylesheet" href="assets/css/profil-iletisim-ekle.css"/>

	<!--Fonts-->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,300&subset=latin,latin-ext' rel='stylesheet' type='text/css'>




</head>
<body>

	<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" class="pure-form pure-form-aligned">
		<h3>İletişim Bilgileri Ekle</h3>
		<!--yer bilgisi-->
		<fieldset>
			<legend>Yer Bilgisi</legend>
			<!--TODO://Ülkelere göre şehirler ajax ile veritabanından çekilecek -->
			<div class="pure-control-group">
				<label for="ulke" name="ulke">Ülke :</label>
				<select name="ulke" id="ulke">
					<?php
						$sorguUlkeGetir = $db->query("SELECT * FROM ulke");
						$sorguUlkeGetir->execute();

						foreach($sorguUlkeGetir as $rowUlke){
							echo "<option id=".$rowUlke['ulkeID'].">".$rowUlke['ulkeAd']."</option>";
						}
					?>
				</select>
			</div>

			<!--TODO:Şehir tablosu veritabanına dahil edilecek -->
			<div class="pure-control-group">
				<label for="sehir" name="sehir">Şehir :</label>
				<select name="sehir" id="sehir">
					<option value="sehir1">Şehir1</option>
					<option value="sehir2">Şehir2</option>
					<option value="sehir3">Şehir3</option>
				</select>
			</div>
		</fieldset><!--yer bilgisi son-->


		<!--iletişim bilgisi-->
		<fieldset>
			<legend>İletişim Bilgileri</legend>

			<div class="pure-control-group">
				<label for="ceptel">Cep Telefonu</label>
				<input id="ceptel" type="text" placeholder="Cep Telefonu">
			</div>

			<div class="pure-control-group">
				<label for="evtel">Ev Telefonu</label>
				<input id="evtel" type="text" placeholder="Ev Telefonu">
			</div>
		</fieldset><!--iletişim bilgisi son-->


		<!--sosyal medya bilgisi-->
		<fieldset>
			<legend>Sosyal Medya Hesapları</legend>
			<div class="pure-control-group">
				<label for="website">Web Site:</label>
				<input id="website" type="text" placeholder="Web Siteniz" value="http://">
			</div>

			<div class="pure-control-group">
				<label for="facebook">Facebook</label>
				<input id="facebook" type="text" placeholder="Facebook Hesabı" value="facebook.com/"/>
			</div>

			<div class="pure-control-group">
				<label for="twitter">Twitter</label>
				<input id="twitter" type="text" placeholder="Twitter Hesabı" value="twitter.com/"/>
			</div>

		</fieldset><!--sosyal medya bilgisi son-->
		<button type="submit" name="iletisimEkleSubmit" class="pure-button pure-button-primary">Kaydet</button>
	</form>

</body>
</html>



