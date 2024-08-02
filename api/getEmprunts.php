<?php


   require 'commun_services.php';


   try {
       $emprunts = $db->getAllEmprunts();
       //tester si tout se passe très bien
       if ($emprunts) {
           produceResult(clearDataArray($emprunts)); //transforme des obets metiers
       }else{
           produceError("Problemes de Recuperation des données !");
       }
   } catch (\Exception $ex) {
       produceError("Echec de Recuperation des products !");
   }