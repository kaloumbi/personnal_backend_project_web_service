<?php

   //activer la session
   session_start();


   require 'commun_services.php';
  
   //Verifie le Cas où l'utilisateur est dejà connectée: les CESSIONS tout en definissant une clé "ident"
   if (isset($_SESSION['ident'])) {
       produceError("utilisateur déjà connecté !");
       return;
   }


   //verifier le Cas où la requette est mal formulée: si le mail ou le password ne sont definis
   if (!isset($_REQUEST['login']) || !isset($_REQUEST['password']) ) {
       produceErrorRequest();
       return;
   }


   //TENTER L'authentification
   try {
       $user = new User();
       $user->setLogin($_REQUEST['login']);
       $user->setPassword($_REQUEST['password']);


       $dataAuth = $db->authentifier($user);
       if ($dataAuth) {
           //Authentification réussie ! => stockage d'info dans la cession
           $_SESSION['ident'] = $dataAuth;
           produceResult($dataAuth);
       }else{
           //Echec d'authentification
           produceError("Email ou password incorect. Merci de reessayer !");
       }


   } catch (\Exception $ex) { //non lié à la BD: pas PDOException
       produceError($ex->getMessage());
   }
