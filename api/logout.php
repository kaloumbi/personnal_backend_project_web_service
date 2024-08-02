<?php

   //puisqu'on va utiliser les sessions, on active la session
   session_start();


   require 'commun_services.php';


   //verifier si le user est connecté pour penser à detruire sa session
   if (isset($_SESSION['ident'])) {
       unset($_SESSION['ident']);
       session_destroy();
       produceResult("Utilisateur déconnecté avec succès !");
       return;
   }else{
       produceError("Utilisateur non connecté !");
   }


