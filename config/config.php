<?php 

    define("DB_USER", "root");
    define("DB_PASSWORD", "");
    define("HOST", "localhost");
    define("DB_NAME", "library_ws_db");



    //declaration des constantes pour la documentation de notre api d
    //les prefixes s’enlèvent de nos noms de fichiers et dans l’url.
    //exemple: getProduits.php => prodruits sur l’url
    $METHODS =[
        "get" => ["description" => "Lire les données", "prefixe" => "get"],
        "post" => ["description" => "Créer une donnée", "prefixe" => "create"],
        "put" => ["description" => "Mettre à jour une donnée", "prefixe" => "update"],
        "delete" => ["description" => "Supprimer une donnée", "prefixe" => "delete"]
    ];
 
 
    //déclaration des constantes routes de notre api
    $_ROUTES = ["livres", "emprunts", "historiques", "users"];
 