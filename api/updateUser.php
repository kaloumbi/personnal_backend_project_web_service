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
    //precise l'utilisateur à modifier
    $user->setId($_REQUEST['id']);

    $user->setPrenom($_REQUEST['prenom']);
    $user->setNom($_REQUEST['nom']);
    $user->setLogin($_REQUEST['login']);
    $user->setPassword($_REQUEST['password']);

    $result = $db->updateUser($user);
   
    if ($result) {
        produceResult("Modification reussie !");
    }else{
        produceError("Echec de la mise à jour. Merci de réessayer !");
    }
   
    } catch (Exception $ex) {
        //echo "Erreur : ".$ex->getMessage();
        produceError($ex->getMessage());
    }
