<?php


   require 'commun_services.php';


   try {
       $users = $db->getAllUsers();
       
       //tester si tout se passe très bien
       if ($users) {
           produceResult(clearDataArray($users)); //transforme des obets metiers
       }else{
           produceError("Problemes de Recuperation des utilisateurs !");
       }
   } catch (\Exception $ex) {
       produceError("Echec de Recuperation des Utilisateurs !");
   }
