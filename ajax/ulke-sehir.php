<?php
/**
 * Created by PhpStorm.
 * User: Emre
 * Date: 25.07.2015
 * Time: 13:02
 */
	include "../_inc/db.php";
	if($_POST){
		$ulkeID = $_POST['ulkeID'];
		$sorguSehirGetir = $db->prepare("SELECT * FROM sehir WHERE ulkeID = ? ");
		$sorguSehirGetir->execute(array($ulkeID));

		foreach($sorguSehirGetir as $row_sehir){
			echo "<option value=".$row_sehir['sehirID'].">".$row_sehir['sehirAd']."</option>";
		}
	}else{
		return false;
	}

