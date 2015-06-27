<?php
/**
 * Created by PhpStorm.
 * Author: Emre Köse
 * Date: 27.06.2015
 * Time: 16:07
 */

	try{
		$db = new PDO("mysql:host=localhost; dbname=palmsocial","root","12345",array(
			PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8",
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		));
	}catch (PDOException $ex){
		echo $ex->getMessage();
	}