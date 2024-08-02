<?php


   require 'commun_services.php';


   try {
       $livres = $db->getAllLivres();
       //tester si tout se passe très bien
       if ($livres) {
           produceResult(clearDataArray($livres)); //transforme des obets metiers
       }else{
           produceError("Problemes de Recuperation des données !");
       }
   } catch (\Exception $ex) {
       produceError("Echec de Recuperation des products !");
   }
