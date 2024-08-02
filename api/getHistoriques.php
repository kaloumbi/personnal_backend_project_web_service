<?php


   require 'commun_services.php';


   try {
       $historiques = $db->getAllHistoriques();
       //tester si tout se passe très bien
       if ($historiques) {
           produceResult(clearDataArray($historiques)); //transforme des obets metiers
       }else{
           produceError("Problemes de Recuperation des données !");
       }
   } catch (\Exception $ex) {
       produceError("Echec de Recuperation des products !");
   }