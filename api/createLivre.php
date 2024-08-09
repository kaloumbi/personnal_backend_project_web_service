<?php


   require 'commun_services.php';


   //tester si le nom n'est pas defini
   if (!isset($_REQUEST['titre']) || empty($_REQUEST['autheur']) || empty($_REQUEST['isbn']) || empty($_REQUEST['datePub']) || empty($_REQUEST['disponibilite']) ) {
       // var_dump("od");
       produceErrorRequest();
       return;
   }


   try {
       $livre = new Livre();
       //on modifie le name et lui donner la valeur reçu par le name
       $livre->setTitre($_REQUEST['titre']);
       $livre->setAutheur($_REQUEST['autheur']);
       $livre->setIsbn($_REQUEST['isbn']);
       $livre->setDatePub(new DateTime($_REQUEST['datePub']));
       $livre->setDisponibilite($_REQUEST['disponibilite']);

       $result = $db->creatLivre($livre);
      
       if ($result) {
           produceResult("Cetegory cree avec succès!");
       }else{
           produceError("Echec de creation de la category");
       }
    } catch (Exception $ex) {
        produceError($ex->getMessage());
    }
 