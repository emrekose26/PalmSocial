<?php
	require_once "_inc/db.php";

	if(isset($_POST['uyeKayitSubmit'])){

		echo "<pre>";
		print_r($_POST);

		echo "</pre>";

		//üye kayıt formundan gelen veriler
		$kullanici_adi = mysql_real_escape_string($_POST['kadi']);
		$eposta        = mysql_real_escape_string($_POST['eposta']);
		$adsoyad       = mysql_real_escape_string($_POST['adsoyad']);
		$sifre         = mysql_real_escape_string($_POST['sifre']);
		$sifretekrar   = mysql_real_escape_string($_POST['sifretekrar']);
		$dtarih        = mysql_real_escape_string($_POST['dtarih']);

		//ip adresinin alınması
		$kayitIP = $_SERVER['REMOTE_ADDR'];

		if(!empty($kullanici_adi) && !empty($eposta)){
			//parola işlemleri
			if($sifre == $sifretekrar){

			}else{
				echo "<script>alert('parolalar uyuşmuyor');</script>";
				header("Location:index.php?hata=parolaFarkli");
			}


		}else{
			header("Location:index.php?hata=alanlarbos");
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