<?php
// Connexion à la base de données
 try
 {
   //Serveur Mysql : 91.216.107.161 (à la place de 91.216.107.161 quand vous installez un CMS)
  $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION; $bdd = new PDO('mysql:host=91.216.107.161;dbname=sport1022510;charset=utf8', 'sport1022510','k6rqzpgpps',$pdo_options);
 }
 
 catch (Exception $e)
 {
  die('Erreur : ' . $e->getMessage());
 } 