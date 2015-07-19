<?php

	//TODO: Aynı eposta ile kayıt engellencek.
	session_start();
	require "_inc/db.php";

	if(!isset($_SESSION['UyeID'])){
		header("Location:giris.php?Hata=GirisYap");
	}else{
		$sorguUyeProfil = $db->prepare("SELECT * FROM uye_profil WHERE uyeID=?");
		$sorguUyeProfil->execute(array($_SESSION['UyeID']));


		//her üyenin 1 tane profil oluşturması kontrolü için
		$row_uyeProfil = $sorguUyeProfil->fetch(PDO::FETCH_OBJ);
		$num_row_uyeProfil = $sorguUyeProfil->rowCount();

		echo "profil saysı : ".$num_row_uyeProfil;
	}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Profil</title>
	<link rel="icon" href="assets/images/palms-icon.ico"/>

	<!--[if lt IE 9]>
	<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/r29/html5.min.js"></script>
	<![endif]-->

	<!--Styles-->
	<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
	<link rel="stylesheet" href="assets/css/profil.css"/>


	<!--Fonts-->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,300&subset=latin,latin-ext' rel='stylesheet' type='text/css'>


</head>
<body>

	<?php if($num_row_uyeProfil !=0 ){ ?>
	<ul id="profil-menu">
		<li><a href="profil.php">Profilim</a></li>
		<li><a href="arkadas.php">Arkadaşlarım</a></li>
		<li><a href="mesaj.php">Mesajlarım</a></li>
		<li><a href="fotograf.php">Fotoğraflarım</a></li>
		<li><a href="video.php">Videolarım</a></li>
		<li><a href="muzik.php">Müziklerim</a></li>
	</ul>
	<?php }else{
			include "_inc/profil-create.inc";
		}
	?>



</body>
</html>