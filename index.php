<?php
	session_start();
	require_once "_inc/db.php";

	if(isset($_POST['uyeKayitSubmit'])){

		//üye kayıt formundan gelen veriler
		$kullanici_adi = mysql_real_escape_string($_POST['kadi']);
		$eposta        = mysql_real_escape_string($_POST['eposta']);
		$ad            = mysql_real_escape_string($_POST['ad']);
		$soyad         = mysql_real_escape_string($_POST['soyad']);
		$sifre         = mysql_real_escape_string($_POST['sifre']);
		$sifretekrar   = mysql_real_escape_string($_POST['sifretekrar']);


		//ip adresinin alınması
		$kayitIP = $_SERVER['REMOTE_ADDR'];

		if(!empty($kullanici_adi) && !empty($eposta) && !empty($ad) && !empty($soyad) && !empty($sifre) && !empty($sifretekrar) ){
			//parola işlemleri
			if($sifre == $sifretekrar){

				$sifre = md5($sifre);

				//kullanıcı adının veritabanında olup olmadığı kontrolü
				$sorgu_kadi_varmi = $db->prepare("SELECT * FROM uye WHERE kullaniciAdi = ?");
				$sorgu_kadi_varmi->execute(array($kullanici_adi));

				if($sorgu_kadi_varmi->rowCount()>0){
					header("Location:index.php?hata=kadiVar&kadi=$kullanici_adi&eposta=$eposta&ad=$ad&soyad=$soyad");
				}else{
					//veritabanı kayıt işlemleri
					$sorgu = $db->query("INSERT INTO uye (kullaniciAdi,sifre,ad,soyad,eposta,dogumTarihi,kayitIP,seviyeID)
										VALUES ('$kullanici_adi','$sifre','$ad','$soyad','$eposta','$dtarih','$kayitIP',2)");

					if($sorgu->rowCount()>=1){

						//son eklenen üyenin id sine göre session oluşturuldu.
						$uyeID = $db->lastInsertId();
						$_SESSION['UyeID'] = $uyeID;

						header("Location:profil.php");
					}else {
						echo "Kayıt ekleme işlemi sırasında bir hata oluştu";
					}
				}



			}else{
				echo "<script>alert('parolalar uyuşmuyor');</script>";
				header("Location:index.php?hata=parolaFarkli&kadi=$kullanici_adi&eposta=$eposta&ad=$ad&soyad=$soyad");
			}

		}else{
			header("Location:index.php?hata=alanlarbos&kadi=$kullanici_adi&eposta=$eposta&ad=$ad&soyad=$soyad");
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
		include "_inc/header.inc";
		include "_inc/content.inc";
		include "_inc/footer.inc";
	?>
</body>
</html>