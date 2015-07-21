<?php

	//TODO: Aynı eposta ile kayıt engellencek.
	session_start();
	require "_inc/db.php";
	require "_inc/functions.php";

	if(!isset($_SESSION['UyeID'])){
		header("Location:giris.php?Hata=GirisYap");
	}else{
		$uyeID = $_SESSION['UyeID'];
		$sorguUyeProfil = $db->prepare("SELECT * FROM uye_profil WHERE uyeID=?");
		$sorguUyeProfil->execute(array($uyeID));


		//her üyenin 1 tane profil oluşturması kontrolü için
		$row_uyeProfil = $sorguUyeProfil->fetch(PDO::FETCH_OBJ);
		$num_row_uyeProfil = $sorguUyeProfil->rowCount();

		//echo "profil sayısı : ".$num_row_uyeProfil;

		//profil oluşturma formu gönderildiğinde
		if(isset($_POST['uyeProfilOlusturSubmit'])){
			echo "profl oluşturma formu gönderildi";

			//formdan gelen verilern alınması
			$ad          = formDegerAl($_POST['ad']);
			$soyad       = formDegerAl($_POST['soyad']);
			$dogumTarih  = formDegerAl($_POST['dogumTarih']);
			$dogumYeri   = formDegerAl($_POST['dogumYeri']);
			$yasadigiYer = formDegerAl($_POST['yasadigiYer']);

			//resmin adının alınması
			if(!empty($_FILES['resim']['name'])){
				$resim = $_FILES['resim']['name'];
			}else{
				$resim = "profil-resim-yok.png";
			}

			//tablolara verilerin girilmesi
			$sorguUyeProfilOlustur = "INSERT INTO uye_profil
			(uyeID,ad,soyad,dogumTarih,dogumYeri,yasadigiYer,profilTarih)
			VALUES
			('$uyeID','$ad','$soyad','$dogumTarih','$dogumYeri','$yasadigiYer',NOW())
			";

			$sonucUyeProfilOlustur = $db->query($sorguUyeProfilOlustur);
			//$sonucUyeProfilOlustur->execute();


			if($sonucUyeProfilOlustur){
				//profil bilgileri girildi,resim yüklenecek

				$sorguProfilResim = "INSERT INTO uye_resim
				(uyeID,resim)
				VALUES
				('$uyeID','$resim')
				";

				$sonucResim = $db->query($sorguProfilResim);
				//$sonucResim->execute();

				if($sonucResim){
					//resim yüklenecek ve yönlendirme yapılacak
					if($resim != "profil-resim-yok.png"){

						//resmin yüklendiği isim değeri
						$filename = $_FILES['resim']['tmp_name'];
						//resmin yolu
						$destination = "uploads/resim/uye/".$resim;

						move_uploaded_file($filename,$destination);
					}
					header("Location:profil.php");
				}
			}
		}

	}//sessionda üye olup olmadığı kontrolü --son--
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>
		<?php
		//header kısmında üye ad soyadını veritabanından çekmek için
		$sorguUyeAdSoyad = $db->prepare("SELECT ad,soyad,kullaniciAdi FROM uye WHERE uyeID=?");
		$sorguUyeAdSoyad->execute(array($uyeID));
		foreach($sorguUyeAdSoyad as $rowAdSoyad){
			echo $rowAdSoyad['ad']." ".$rowAdSoyad['soyad']." Profili";
		}
		?>
	</title>
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
		<!--Profil oluşturulmuşsa-->
	<?php include "_inc/profil/profil-header.inc" ?>

	<ul id="profil-menu">
		<li><a href="profil.php">Profilim</a></li>
		<li><a href="arkadas.php">Arkadaşlarım</a></li>
		<li><a href="mesaj.php">Mesajlarım</a></li>
		<li><a href="fotograf.php">Fotoğraflarım</a></li>
		<li><a href="video.php">Videolarım</a></li>
		<li><a href="muzik.php">Müziklerim</a></li>
	</ul>
	<?php }else{
			//profil oluşturma sayfası
			include "_inc/profil/profil-header.inc";
			include "_inc/profil/profil-create.inc";
		}
	?>



</body>
</html>