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

		//resim bilgisi alma
		$sorguUyeProfilResim = $db->prepare("SELECT resim FROM uye_resim WHERE uyeID = ? AND resimTurID = ?");
		$sorguUyeProfilResim->execute(array($uyeID,1));
		$row_uyeProfilResim = $sorguUyeProfilResim->fetch(PDO::FETCH_OBJ);

		//durum mesajını profilde gösterme
		//son durumu profilin en üstünde yazdırma
		$sorguDurumMesaj = $db->prepare("SELECT * FROM uye_durum WHERE uyeID = ? ORDER BY durumID DESC LIMIT 1");
		$sorguDurumMesaj->execute(array($uyeID));
		$row_DurumMesaj = $sorguDurumMesaj->fetch(PDO::FETCH_OBJ);
		$num_row_DurumMesaj = $sorguDurumMesaj->rowCount();


		//üye bağlantı kaydetme
		$sorguUyeBaglanti = $db->prepare("SELECT * FROM uye_baglanti WHERE uyeID = ? ");
		$sorguUyeBaglanti->execute(array($uyeID));
		$row_UyeBaglanti = $sorguUyeProfilResim->fetch(PDO::FETCH_OBJ);
		$num_row_uyeBaglanti = $sorguUyeBaglanti->rowCount();


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
		//title da üye adını görüntülemek için
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

	<!--Scripts-->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/main.js"></script>


	<!--HighSlide-->
	<script type="text/javascript" src="highslide/highslide-with-html.js"></script>
	<link rel="stylesheet" type="text/css" href="highslide/highslide.css" />
	<script type="text/javascript">
		hs.graphicsDir = 'highslide/graphics/';
		hs.outlineType = 'rounded-white';
		hs.wrapperClassName = 'draggable-header';
		hs.minHeight = 800;
		hs.minWidth = 600;
		hs.showCredits = false;
		hs.allowMultipleInstances = false;
	</script>


</head>
<body>

	<?php if($num_row_uyeProfil !=0 ){ ?>
		<!--Profil oluşturulmuşsa-->
	<?php include "_inc/profil/profil-header.inc" ?>

		<div id="sol">
			<?php
			//üye profil fotoğrafını getirme
			$sorguProfilResimGetir = $db->prepare("SELECT resim FROM uye_resim WHERE uyeID = ? ");
			$sorguProfilResimGetir->execute(array($uyeID));
			?>

			<div id="profil-sol">
				<div id="profil-baslik">Profil</div>
				<img src="<?php

				foreach($sorguProfilResimGetir as $rowProfilResimGetir){
					echo "uploads/resim/uye/".$rowProfilResimGetir['resim'];
				}

				?>" alt=""/>

				<div id="profil-duzenle">
					<h4><a href="#">Profil Resmini Değitir</a></h4>
					<h4><a href="#">Profili Düzenle</a></h4>
				</div><!--profil-duzenle-->
			</div><!--profil-sol-->
		</div><!--sol-->
		<div id="orta">

			<div id="durum"><?php
				if($num_row_DurumMesaj==0){
					echo "Merhaba PalmSocial!";
				}else {
					//son eklenen durum yazdırılır.
					echo $row_DurumMesaj->durumBaslik;
				}
				?></div>
			<div id="profil-bilgiler">
				<?php
					$sorguUyeBilgiler = $db->prepare("SELECT * FROM uye_profil WHERE uyeID = ? ");
					$sorguUyeBilgiler->execute(array($uyeID));
					$row_UyeBilgiler = $sorguUyeBilgiler->fetch(PDO::FETCH_OBJ);
				?>
				<form class="pure-form pure-form-aligned">
					<fieldset>
						<legend style="margin-left: 20px;">Profil Bilgileri</legend>
						<div class="pure-control-group">
							<label>Doğum Günü : </label>
							<label><?php echo $row_UyeBilgiler->dogumTarih ?></label>
						</div>

						<div class="pure-control-group">
							<label>Memleketi : </label>
							<label><?php echo $row_UyeBilgiler->dogumYeri ?></label>
						</div>

						<div class="pure-control-group">
							<label>Yaşadığı Yer</label>
							<label><?php echo $row_UyeBilgiler->yasadigiYer ?></label>
						</div>
					</fieldset>
				</form>
			</div><!--profil bilgiler-->


			<?php if($num_row_uyeBaglanti == 0): ?>
				<div class="iletisim-olustur">
					<a href="profil-iletisim-ekle.php" onclick="return hs.htmlExpand(this, { objectType: 'iframe' } )">
						İletişim Bilgisi oluştur
					</a>
				</div>

			<?php else: ?>
				<!-- İletişim bilgileri girilmişse -->
				<div class="profil-bilgiler-link">
					<a href="#">Detaylı Bilgileri Göster</a>
				</div>


				<?php
					$sorguBaglantiBilgiGetir = $db->prepare("SELECT * FROM uye_baglanti WHERE uyeID = ?");
					$sorguBaglantiBilgiGetir->execute(array($uyeID));
					$row_BaglantiBilgiGetir = $sorguBaglantiBilgiGetir->fetch(PDO::FETCH_OBJ);

					$baglantiUlke = $row_BaglantiBilgiGetir->ulke;
					$baglantiSehir = $row_BaglantiBilgiGetir->sehir;

					$sorguUlkeSehir = $db->prepare("SELECT ulke.ulkeID,sehir.sehirID,ulkeAd,sehirAd FROM ulke INNER JOIN sehir ON ulke.ulkeID = sehir.ulkeID WHERE ulke.ulkeID = ? AND sehir.sehirID = ?
");
					$sorguUlkeSehir->execute(array($baglantiUlke,$baglantiSehir));
					$row_ulkeSehir = $sorguUlkeSehir->fetch(PDO::FETCH_OBJ);



				?>
				<div id="profil-detay-bilgiler">
					<form class="pure-form pure-form-aligned">
						<fieldset>
							<legend style="margin-left:20px;">İletişim Bilgileri <a href="#">Düzenle</a></legend>
							<div class="pure-control-group">
								<label>Ülke : </label>
								<label><?php echo $row_ulkeSehir->ulkeAd ?></label>
							</div>

							<div class="pure-control-group">
								<label>Şehir : </label>
								<label><?php echo $row_ulkeSehir->sehirAd ?></label>
							</div>

							<div class="pure-control-group">
								<label>Cep Telefon : </label>
								<label><?php echo $row_BaglantiBilgiGetir->cepTelefon ?></label>
							</div>

							<div class="pure-control-group">
								<label>Ev Telefon : </label>
								<label><?php echo $row_BaglantiBilgiGetir->evTelefon ?></label>
							</div>

							<div class="pure-control-group">
								<label>Web Site : </label>
								<label><?php echo $row_BaglantiBilgiGetir->website ?></label>
							</div>

							<div class="pure-control-group">
								<label>Facebook : </label>
								<label><?php echo $row_BaglantiBilgiGetir->facebook ?></label>
							</div>

							<div class="pure-control-group">
								<label>Twitter : </label>
								<label><?php echo $row_BaglantiBilgiGetir->twitter ?></label>
							</div>
						</fieldset>
					</form>
				</div>


			<?php endif; ?>
		</div>
		<div id="sag"></div>


	<?php }else{
			//profil oluşturma sayfası
			include "_inc/profil/profil-header.inc";
			include "_inc/profil/profil-create.inc";
		}
	?>



</body>
</html>