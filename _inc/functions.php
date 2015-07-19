<?php
/**
 * Created by PhpStorm.
 * User: Emre
 * Date: 19.07.2015
 * Time: 15:00
 */
	//fonksiyondan alınan verilerin güvenli biçimde alınması ve sağ sol boşluklarının temizlenmesini sağlayan fonksiyon
	function formDegerAl($deger){
		$deger = mysql_real_escape_string($deger);
		$deger = trim($deger);
		return $deger;
	}