<?php


   require 'commun_services.php';


   if (!isset($_REQUEST['id']) || !is_numeric($_REQUEST['id'])) {
       produceErrorRequest();
       return;
   }


   $emprunt = new Emprunt();
   $emprunt->setId($_REQUEST['id']);


   try {
       $result = $db->deleteEmprunt($emprunt);
      
       if ($result) {
           produceResult("Suppression reussie !");
       }else{
           produceError("Echec de la suppression. Merci de réessayer ! Verifie l'existence de l'id");
       }
      
   } catch (\Exception $ex) {
       produceError($ex->getMessage());
       return null;
   }
