<?php
// Connexion à la base de données
 try
 {
  $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION; 
  $bdd = new PDO('mysql:host=localhost;dbname=parrain;charset=utf8', 'root','',$pdo_options);
  
 }
 
 catch (Exception $e)
 {
  die('Erreur : ' . $e->getMessage());
 } 