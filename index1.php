<?php

require "config/config.php";
require "model/Datalayer.php";
require "entity/User.php";
require "entity/Livre.php";
require "entity/Emprunt.php";
require "entity/Historique.php";


$db = new Datalayer();


/**
 * ======================> CREATE OBJECT <======================
 */

/* $user = new User();
$user->setPrenom("Fama");
$user->setNom("THIAM");
$user->setLogin("fama@gmail.com");
$user->setPassword("passer"); */

/* 
     $livre = new Livre();
     $livre->setTitre("Une vie de boy");
     $livre->setAutheur("Ferdinand Oyono");
     $livre->setIsbn("978-3-06-15-0");
     $livre->setDisponibilite(1); */


/* $emprunt = new Emprunt();
$dateEmprunt = new DateTime();
$dateRetour = new DateTime();

$dateRetour->modify('+7 days');

$emprunt->setDateEmprunt($dateEmprunt);
$emprunt->setDateRetour($dateRetour);
$emprunt->setUserId(3);
$emprunt->setLivreId(1); */


/* 
    ==================
    AVOIR LES TRACES
    ==================
     
    $empruntLastId = $db->getLastEmpruntId();

    //var_dump($empruntLastId);

    //Set données emprunt
    $emprunt = new Emprunt();
    $emprunt->setId($empruntLastId);
    $dateEmprunt = new DateTime();
    $dateRetour = new DateTime();

    $dateRetour->modify('+7 days');

    $emprunt->setDateEmprunt($dateEmprunt);
    $emprunt->setDateRetour($dateRetour);
    $emprunt->setUserId(3);
    $emprunt->setLivreId(1);


    // sauvegarde des emprunts
    $varEmprunt = $db->createEmprunt($emprunt);

    // var_dump($varEmprunt);
    //set données historique emprunts
    $historique = new Historique();
    $historique->setDateEmprunt($emprunt->getDateEmprunt());
    $historique->setDateRetour($emprunt->getDateRetour());
    $historique->setUserId($emprunt->getUserId());
    $historique->setLivreId($emprunt->getLivreId());
    $historique->setEmpruntId($emprunt->getId());
    

    //sauvegarde des Historiques
    $varHistorique = $db->createHistorique($historique);

   */

    // var_dump("Emprunt ==>".$varEmprunt);
    // var_dump("Historique ".$varHistorique);



    /**
     * ===============> READ OBJECT <======================
     */

    //$allUsers = $db->getAllUsers();

    // $allLivres = $db->getAllLivres();
    // $allEmprunts = $db->getAllHistoriques();

    //var_dump($allEmprunts);


    /**
     * ===============> update OBJECT <======================
     */

    /* $user = new User();
    $user->setPrenom("Amy");
    $user->setNom("Fall");
    $user->setLogin("amy@gmail.com");
    $user->setId(3);

    $upUser = $db->updateUser($user); */

    /*  $livre = new Livre();
    $datePub = new DateTime("2022-07-30 00:00:00");
    $livre->setTitre("Vol de Nuit");
    $livre->setAutheur("Jim");
    $livre->setIsbn("00-7786777-78");
    $livre->setDatePub($datePub);
    $livre->setDisponibilite(0);
    $livre->setId(3);

    $livre = $db->updateLivre($livre); */

    /**
     * ============================ MODIFICATION DYNAMIQUES SUR LES TRACES
     * ============================
     * 
     */


    /* $emprunt = new Emprunt();
    $dateEmprunt = new DateTime("2026-12-30");
    $dateRetour = new DateTime("2030-09-27");

    $emprunt->setDateEmprunt($dateEmprunt);
    $emprunt->setDateRetour($dateRetour);
    $emprunt->setUserId(1);
    $emprunt->setLivreId(3);
    $emprunt->setId(28);

    $empruntUpdated = $db->updateEmprunt($emprunt);

    // Récupérer les informations de l'emprunt mis à jour
    $updatedEmprunt = $db->getEmpruntById($emprunt->getId());
    var_dump($updatedEmprunt);


    //Récuperer l'identifiant de Historique à partir de celle de Emprunt
    $historiqueIdByEmprunt = $db->getHistoriqueByEmpruntId($emprunt->getId());

    //Puis les stocker sur l'objet historique
    $historique = new Historique();
    $historique->setDateEmprunt($updatedEmprunt->getDateEmprunt());
    $historique->setDateRetour($updatedEmprunt->getDateRetour());
    $historique->setUserId($updatedEmprunt->getUserId());
    $historique->setLivreId($updatedEmprunt->getLivreId());
    $historique->setEmpruntId($updatedEmprunt->getId());

    //DEFINIR L'IDENTIFIANT
    $historique->setId($historiqueIdByEmprunt->getId());

    $historiqueUpdated = $db->updateHistorique($historique);
 */




    /**
     * ===============> delete OBJECT <======================
     */

     /* $delUser = new User();

     $userDeleted = $db->deleteUsers($delUser->setId(6)); */

     /* $livre = new Livre();
     $deletedLivre = $db->deleteLivre($livre->setId(7)); */

     /* $delEmprunt = new Emprunt();
     $deletedEmpr = $db->deleteEmprunt($delEmprunt->setId(26)); */

     /* $delEmprunt = new  Historique();

     $delHist = $db->deleteHistorique($delEmprunt->setId(6)); */

    //  var_dump($delHist);
    

    /**
     * ===============> AUTHENTIFIER OBJECT <======================
     */


     /* $user = new User();
     $user->setLogin("fama@gmail.com");
     $user->setPassword("passer");

     $auth = $db->authentifier($user);

     var_dump($auth); */









     


 


    



