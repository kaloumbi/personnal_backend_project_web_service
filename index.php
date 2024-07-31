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








