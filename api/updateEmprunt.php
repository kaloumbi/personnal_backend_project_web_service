<?php


   require 'commun_services.php';


   //tester si le nom n'est pas defini
   if (!isset($_REQUEST['date_emprunt']) || !isset($_REQUEST['date_retour']) || !isset($_REQUEST['user_id']) || !isset($_REQUEST['livre_id']) ) {
        // var_dump("od");
        produceErrorRequest();
        return;
   }

    //tester si le nom n'est pas defini
    if (empty($_REQUEST['date_emprunt']) || empty($_REQUEST['date_retour']) || empty($_REQUEST['user_id']) || empty($_REQUEST['livre_id']) ) {
        // var_dump("od");
        produceErrorRequest();
        return;
    }

   try {
    $emprunt = new Emprunt();
    //precise l'utilisateur à modifier
    $emprunt->setId($_REQUEST['id']);

    //on modifie le name et lui donner la valeur reçu par le name
    $emprunt->setDateEmprunt(new DateTime($_REQUEST['date_emprunt']));
    $emprunt->setDateRetour(new DateTime($_REQUEST['date_retour']));
    $emprunt->setUserId($_REQUEST['user_id']);
    $emprunt->setLivreId($_REQUEST['livre_id']);

    $result = $db->updateEmprunt($emprunt);

    //trouver l'emprunt mise à jour par son propre id(emprunt actuellement modifié )
    $empruntUpdated = $db->getEmpruntById($emprunt->getId());

    //recuperer l'identifiant de l'historique à travers l'identifiant de l'emprunt
    $historiqueIdByEmprunt = $db->getHistoriqueByEmpruntId($emprunt->getId());

    
    //Mise à jour automatique de l'historique
    $historique = new Historique();
    $historique->setDateEmprunt(new DateTime($_REQUEST['date_emprunt']));
    $historique->setDateRetour(new DateTime($_REQUEST['date_retour']));
    $historique->setUserId($_REQUEST['user_id']);
    $historique->setLivreId($_REQUEST['livre_id']);
    
    //passer l'id de l'emprunt mise à jour
    $historique->setEmpruntId($empruntUpdated->getId());

    //passer l'id de l'historique trouvé par l'id de l'emprunt
    $historique->setId($historiqueIdByEmprunt->getId());

    $resultHisto = $db->updateHistorique($historique);
   
    if ($result) {
        produceResult("Modification reussie !");
    }else{
        produceError("Echec de la mise à jour. Merci de réessayer !");
    }
   
    } catch (Exception $ex) {
        //echo "Erreur : ".$ex->getMessage();
        produceError($ex->getMessage());
    }
