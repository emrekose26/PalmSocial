<?php
	require_once "_inc/db.php";

	if(isset($_POST['uyeKayitSubmit'])){

		//üye kayıt formundan gelen veriler
		$kullanici_adi = mysql_real_escape_string($_POST['kadi']);
		$eposta        = mysql_real_escape_string($_POST['eposta']);
		$adsoyad       = mysql_real_escape_string($_POST['adsoyad']);
		$sifre         = mysql_real_escape_string($_POST['sifre']);
		$sifretekrar   = mysql_real_escape_string($_POST['sifretekrar']);
		$dtarih        = mysql_real_escape_string($_POST['dtarih']);

		//ip adresinin alınması
		$kayitIP = $_SERVER['REMOTE_ADDR'];

		if(!empty($kullanici_adi) && !empty($eposta) && !empty($adsoyad) && !empty($sifre) && !empty($sifretekrar) &&!empty($dtarih)){
			//parola işlemleri
			if($sifre == $sifretekrar){

				$sifre = md5($sifre);

				//kullanıcı adının veritabanında olup olmadığı kontrolü
				$sorgu_kadi_varmi = $db->prepare("SELECT * FROM uye WHERE kullaniciAdi = ?");
				$sorgu_kadi_varmi->execute(array($kullanici_adi));

				if($sorgu_kadi_varmi->rowCount()>0){
					header("Location:index.php?hata=kadiVar&kadi=$kullanici_adi&eposta=$eposta&adsoyad=$adsoyad");
				}else{
					//veritabanı kayıt işlemleri
					$sorgu = $db->query("INSERT INTO uye (kullaniciAdi,sifre,adSoyad,eposta,dogumTarihi,kayitIP,seviyeID)
										VALUES ('$kullanici_adi','$sifre','$adsoyad','$eposta','$dtarih','$kayitIP',2)");

					if($sorgu->rowCount()>=1){
						echo "Kayıt Başarılı";

						//TODO : Profil sayfasına yönlendir
					}else {
						echo "Kayıt ekleme işlemi sırasında bir hata oluştu";
					}
				}

				//TODO : tarih ekleme fonksiyonları detaylandırılacak;

			}else{
				echo "<script>alert('parolalar uyuşmuyor');</script>";
				header("Location:index.php?hata=parolaFarkli&kadi=$kullanici_adi&eposta=$eposta&adsoyad=$adsoyad");
			}

		}else{
			header("Location:index.php?hata=alanlarbos&kadi=$kullanici_adi&eposta=$eposta&adsoyad=$adsoyad");
		}
	}
?>
<!doctype html>
<html lang="en">
<head>

	<meta charset="UTF-8">
	<meta name="keywords" content="">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Palm Social</title>
	<link rel="icon" href="assets/images/palms-icon.ico"/>

	<!--[if lt IE 9]>
	<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/r29/html5.min.js"></script>
	<![endif]-->

	<!--Fonts-->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,300&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

	<!--Styles-->
	<link rel="stylesheet" href="assets/css/reset.css"/>
	<link rel="stylesheet" href="assets/css/style.css"/>
	<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css"/>

	<!--Scripts-->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/main.js"></script>



</head>
<body>
	<?php
		include "header.php";
		include "content.php";
		include "footer.php";
	?>
</body>
</html>