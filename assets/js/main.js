$(function(){
	//profil bilgileri detaylı bilgiler göster-gizle kısmı
	var sayac = 0;
	$('#profil-detay-bilgiler').hide();
	$(".profil-bilgiler-link a").click(function(){
		$("#profil-detay-bilgiler").slideToggle(100);
	if(sayac == 0){
		$(this).text("Detaylı Bilgileri Gizle");
		sayac++;
	}else{
		$(this).text("Detaylı Bilgileri Göster");
		sayac = 0;
	}
	});
});
