<?php

		try
		{
			$db = new PDO('mysql:host=localhost;dbname=projet3j;charset=utf8', 'root', 'glyx') ;
		}

		catch(Exception $e)
		{
			die('Erreur : '.$e->getMessage()) ;
		}

		return $db ;

