<?php


   require 'commun_services.php';


   try {
       //Verifie et Récupère l'ID depuis l'URL et le convertit en entier avec intval(), ou 0 si absent  
       $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
       
       if ($id > 0) {
            $detailHistorique = $db->getHistoriqueById($id);

            //tester si tout se passe très bien
            if ($detailHistorique) {
                produceResult(clearData($detailHistorique)); //transforme des obets metiers
            }else{
                produceError("Problemes de Recuperation des données !");
            }
       } else {
        produceError("L'identifiant fourni est invalid !");
       }
    
       
    } catch (\Exception $ex) {
       produceError("Echec de Recuperation des products !");
    }