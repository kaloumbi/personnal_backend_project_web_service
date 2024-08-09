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
       //recupere moi l'identifiant de l'objet nouvellement ajouté(dernier objet)
       $empruntLastId = $db->getLastEmpruntId();

       $emprunt = new Emprunt();
       //ERROR: Emprunt::$id must not be accessed before initialization
       $emprunt->setId($empruntLastId);
       //on modifie le name et lui donner la valeur reçu par le name
       $emprunt->setDateEmprunt(new DateTime($_REQUEST['date_emprunt']));
       $emprunt->setDateRetour(new DateTime($_REQUEST['date_retour']));
       $emprunt->setUserId($_REQUEST['user_id']);
       $emprunt->setLivreId($_REQUEST['livre_id']);
       

       $result = $db->createEmprunt($emprunt);

       $historique = new Historique();
       //on modifie le name et lui donner la valeur reçu par le name
       $historique->setDateEmprunt(new DateTime($_REQUEST['date_emprunt']));
       $historique->setDateRetour(new DateTime($_REQUEST['date_retour']));
       $historique->setUserId($_REQUEST['user_id']);
       $historique->setLivreId($_REQUEST['livre_id']);
       $historique->setEmpruntId($emprunt->getId()); //recupere l'id de l'emprunt courant

       $resultHistorique = $db->createHistorique($historique);
      
       if ($result) {
           produceResult("Cetegory cree avec succès!");
       }else{
           produceError("Echec de creation de la category");
       }
    } catch (Exception $ex) {
        produceError($ex->getMessage());
    }
 