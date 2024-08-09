<?php


   require 'commun_services.php';


   //tester si le nom n'est pas defini
   if (!isset($_REQUEST['titre']) || !isset($_REQUEST['autheur']) || !isset($_REQUEST['isbn']) || !isset($_REQUEST['datePub']) || !isset($_REQUEST['disponibilite']) ) {
        // var_dump("od");
        produceErrorRequest();
        return;
    }


   //tester si un champ est vide
   /* if (empty($_REQUEST['titre']) || empty($_REQUEST['autheur']) || empty($_REQUEST['isbn']) || empty($_REQUEST['datePub']) || empty($_REQUEST['disponibilite']) ) {
        // var_dump("od");
        produceErrorRequest();
    return;
    } */

   try {
    $livre = new Livre();
    //precise l'utilisateur à modifier
    $livre->setId($_REQUEST['id']);

    //on modifie le name et lui donner la valeur reçu par le name
    $livre->setTitre($_REQUEST['titre']);
    $livre->setAutheur($_REQUEST['autheur']);
    $livre->setIsbn($_REQUEST['isbn']);
    $livre->setDatePub(new DateTime($_REQUEST['datePub']));
    $livre->setDisponibilite($_REQUEST['disponibilite']);

    $result = $db->updateLivre($livre);
   
    if ($result) {
        produceResult("Modification reussie !");
    }else{
        produceError("Echec de la mise à jour. Merci de réessayer !");
    }
   
    } catch (Exception $ex) {
        //echo "Erreur : ".$ex->getMessage();
        produceError($ex->getMessage());
    }
