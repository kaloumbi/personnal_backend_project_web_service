<?php
require 'config/config.php';

// Définir la constante BASE_URL
define("BASE_URL", dirname($_SERVER['SCRIPT_NAME']));
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>API JSTORE Documentation</title>

  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container">
    <h1>Documentation API LIBRARY</h1>

    <?php
    // Ouverture du dossier API
    foreach ($_ROUTES as $key => $entity) {
        echo "<div id='$entity' class='api-section'>
                <h4>" . ucwords($entity) . "</h4>";
        foreach ($METHODS as $methode => $description) {
            echo "<div class='endpoint'>
                    <span class='method method-$methode'>" . strtoupper($methode) . "</span> 
                    <div class='url'>
                      <a href='" . BASE_URL . "/api/$entity' target='_blank'>/api/$entity</a>
                    </div> 
                    <span class='description'>" . $description['description'] . "</span>
                  </div>";
        }
        echo '</div>';
    }
    ?>
  </div>
</body>
</html>
