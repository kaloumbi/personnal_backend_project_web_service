<?php


   require 'commun_services.php';


   if (!isset($_REQUEST['prenom']) || !isset($_REQUEST['nom']) || !isset($_REQUEST['login']) || !isset($_REQUEST['password']) ) {
      
       produceErrorRequest();
       return;
   }


   //tester si un champ est vide
   if (empty($_REQUEST['prenom']) || empty($_REQUEST['nom']) || empty($_REQUEST['login']) || empty($_REQUEST['password']) ) {
      
       produceErrorRequest();
       return;
   }


   try {
       $user = new User();
       //on modifie le name et lui donner la valeur reçu par le name
       $user->setPrenom($_REQUEST['prenom']);
       $user->setNom($_REQUEST['nom']);
       $user->setLogin($_REQUEST['login']);
       $user->setPassword($_REQUEST['password']);




       $result = $db->creatUser($user);
      
       if ($result) {
           produceResult("Utilisateur cree avec succès !");
       }else{
           produceError("Echec de creation de l'utilisateur ! Merci de reessayer !");
       }
      
   } catch (Exception $ex) {
       echo "Erreur : ".$ex->getMessage();
       //produceError($ex->getMessage());
   }
