<?php
/**
 * Created by PhpStorm.
 * User: Emre
 * Date: 20.07.2015
 * Time: 14:16
 */
	session_start();
	session_destroy();
	header("Location:index.php");