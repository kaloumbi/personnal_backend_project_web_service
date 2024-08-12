<?php


  
   // var_dump($_SERVER["REQUEST_URI"]);


   //decoupage de la chaine "/e-bestcommerce_mudey/backend/api/"
   $url = trim($_SERVER["REQUEST_URI"],"/"); //supprime le "/" au debut et à la fin de la chaine


   $url_clean = explode("/", $url);


   //var_dump($url_clean);


   if (sizeof($url_clean) < 4 ) {
      
       header("Location: ../index.php");
       exit();
   }else{
       //$action prend la valeur du dernier élément de $url_clean
       $action = $url_clean[sizeof($url_clean)-1 ];
       $pos = strpos($action, '?');
       if ($pos) {
           $temp = explode("?", $action);
           $action = $temp[0];
       }


       //verifier la methode que le user a utilisé pour envoyer la requette
       if ($_SERVER["REQUEST_METHOD"] === "GET") {
           require './get'.ucwords($action).".php";
       }elseif($_SERVER["REQUEST_METHOD"] ==="POST"){
        //    var_dump($action);
           require './post'.ucwords($action).".php";
       }elseif($_SERVER["REQUEST_METHOD"] ==="DELETE"){
           require './delete'.ucwords($action).".php";
       }elseif($_SERVER["REQUEST_METHOD"] ==="PUT"){
           require './update'.ucwords($action).".php";
       }
   }
