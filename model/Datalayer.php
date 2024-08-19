<?php

class Datalayer
{
    private $connexion;

    function __construct()
    {
        $var = "mysql:=" . HOST . ",db_name=" . DB_NAME;

        try {
            $this->connexion = new PDO($var, DB_USER, DB_PASSWORD);

            //echo "Connexion reussie !";
        } catch (\PDOException $ex) {
            //throw $th;

            //echo "Connexion echoué avec ce message ==> ";
        }
    }



    /**
     * ================== CREATE ENTITY FUNCTION ====================
     */


    /**
     * Methode permettant d'authentifier un utilisateur
     * @param //UserEntity $user Objet metier decrivant un utilisateur
     * @return //UserEntity $user Objet métier décrivant l'utilisateur authentifié
     * @return //FALSE En cas d'échec d'authentification
     * @return //NULL Exception déclanchée
     */
    function authentifier(User $user)
    {
        $sql = "SELECT * FROM `library_ws_db`.`users` WHERE login= :login";


        try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute(
                array(
                    ':login' => $user->getLogin()
                )
            );


            //On recupère les données de l'utilisateur
            $data = $result->fetch(PDO::FETCH_OBJ);


            //tester si les données sont recuperées et verifier la conformité des mots de passe (renseigné et celui haché)
            if ($data && ($data->password == sha1($user->getPassword()))) {
                //authentification reussie: mise à jour des données
                $user->setId($data->id);
                $user->setPrenom($data->prenom);
                $user->setNom($data->nom);
                $user->setPassword(null);


                return $user;
            } else {
                //authentification échouée !
                return false;
            }
        } catch (\PDOException $ex) {
            echo "Error de : " . $ex->getMessage();
            return null;
        }
    }


    public function creatUser(User $user)
    {

        $sql = "INSERT INTO `library_ws_db`.`users`(`prenom`, `nom`, `login`, `password`) 
                                VALUES (:prenom, :nom, :login, :password)";

        try {
            $result = $this->connexion->prepare($sql);

            $data = $result->execute(
                array(
                    ':prenom' => $user->getPrenom(),
                    ':nom' => $user->getNom(),
                    ':login' => $user->getLogin(),
                    ':password' => sha1($user->getPassword()),
                )
            );

            if ($data) {
                return true;
            } else {
                return false;
            }


        } catch (\PDOException $ex) {
            echo "Erreur de : " . $ex->getMessage();
            return null;
        }
    }

    public function creatLivre(Livre $livre)
    {

        $sql = "INSERT INTO `library_ws_db`.`livre`(`titre`, `autheur`, `isbn`, `datePub`, `disponibilite`)
                                VALUES (:titre, :autheur, :isbn, :datePub, :disponibilite)";

        // var_dump($sql);
        $datePub = new DateTime();
        try {
            $result = $this->connexion->prepare($sql);

            $data = $result->execute(
                array(
                    ':titre' => $livre->getTitre(),
                    ':autheur' => $livre->getAutheur(),
                    ':isbn' => $livre->getIsbn(),
                    ':datePub' => $datePub->format("Y-m-d"),
                    ':disponibilite' => $livre->getDisponibilite(),
                )
            );

            if ($data) {
                return true;
            } else {
                return false;
            }


        } catch (\PDOException $ex) {
            echo "Erreur de : " . $ex->getMessage();
            // return null;
        }
    }



    public function createEmprunt(Emprunt $emprunt)
    {

        $sql = "INSERT INTO `library_ws_db`.`emprunt`(`date_emprunt`, `date_retour`, `user_id`, `livre_id`)
                                VALUES (:date_emprunt, :date_retour, :user_id, :livre_id)";


        try {
            $result = $this->connexion->prepare($sql);

            $data = $result->execute(
                array(
                    ':date_emprunt' => $emprunt->getDateEmprunt()->format("Y-m-d H:i:s"),
                    ':date_retour' => $emprunt->getDateRetour()->format("Y-m-d H:i:s"),
                    ':user_id' => $emprunt->getUserId(),
                    ':livre_id' => $emprunt->getLivreId()
                )
            );

            // var_dump($emprunt);
            if ($data) {
                return $data;
            } else {
                return false;
            }


        } catch (\PDOException $ex) {
            echo "Erreur de : " . $ex->getMessage();
            // return null;
        }
    }


    //Methode me permettant de recuperer le dernier id de l'emprunt c-a-d l'objet qui vient de s'ajouter
    public function getLastEmpruntId(): ?int
    {
        $sql = "SELECT id FROM `library_ws_db`.`emprunt` ORDER BY id DESC LIMIT 1";

        try {
            $result = $this->connexion->prepare($sql);
            $result->execute();

            if ($data = $result->fetch(PDO::FETCH_OBJ)) {
                return (int) $data->id + 1;
            }

            return null;
        } catch (\PDOException $ex) {
            throw new \Exception("Erreur lors de la récupération du dernier ID d'emprunt : " . $ex->getMessage());
        }
    }

    public function createHistorique(Historique $historique)
    {

        $sql = "INSERT INTO `library_ws_db`.`historique`(`date_emprunt`, `date_retour`, `user_id`, `livre_id`, `emprunt_id`)
                                VALUES (:date_emprunt, :date_retour, :user_id, :livre_id, :emprunt_id)";


        try {
            $result = $this->connexion->prepare($sql);

            $data = $result->execute(
                array(
                    ':date_emprunt' => $historique->getDateEmprunt()->format("Y-m-d H:i:s"),
                    ':date_retour' => $historique->getDateRetour()->format("Y-m-d H:i:s"),
                    ':user_id' => $historique->getUserId(),
                    ':livre_id' => $historique->getLivreId(),
                    ':emprunt_id' => $historique->getEmpruntId()
                )
            );


            if ($data) {
                return true;
            } else {
                return false;
            }


        } catch (\PDOException $ex) {
            echo "Erreur de : " . $ex->getMessage();
            // return null;
        }
    }





    /**
     * ====================== READ FONCTIONS ===========================
     */

    //recuperer les donnees depuis la BD puis les stocker champs par champs dans un tabbleau et renvoi le tableau
    function getAllUsers()
    {

        $sql = "SELECT * FROM `library_ws_db`.`users` ";

        try {

            $result = $this->connexion->prepare($sql);
            $var = $result->execute();

            $users = [];

            while ($data = $result->fetch(PDO::FETCH_OBJ)) {
                $user = new User();
                $user->setId($data->id);
                $user->setPrenom($data->prenom);
                $user->setNom($data->nom);
                $user->setLogin($data->login);

                $users[] = $user;
            }

            if ($users) {
                return $users;
            } else {
                return false;
            }


        } catch (\PDOException $ex) {
            echo $ex->getMessage();
            return null;
        }
    }

    function getAllLivres()
    {

        $sql = "SELECT * FROM `library_ws_db`.`livre` ";

        try {

            $result = $this->connexion->prepare($sql);
            $var = $result->execute();

            $livres = [];
            while ($data = $result->fetch(PDO::FETCH_OBJ)) {
                $livre = new Livre();
                $livre->setId($data->id);
                $livre->setTitre($data->titre);
                $livre->setAutheur($data->autheur);
                $livre->setIsbn($data->isbn);

                //convertir la chaine caractère en objet DateTime
                $datePub = new DateTime($data->datePub);
                $livre->setDatePub($datePub);
                $livre->setDisponibilite($data->disponibilite);
                $livre->setCreatedAt(new DateTime($data->created_at));

                $livres[] = $livre;
            }

            if ($livres) {
                return $livres;
            } else {
                return false;
            }


        } catch (\PDOException $ex) {
            echo $ex->getMessage();
            return null;
        }
    }

    function getAllEmprunts()
    {

        $sql = "SELECT * FROM `library_ws_db`.`emprunt` ";

        try {

            $result = $this->connexion->prepare($sql);
            $var = $result->execute();

            $emprunts = [];
            while ($data = $result->fetch(PDO::FETCH_OBJ)) {
                $emprunt = new Emprunt();
                $emprunt->setId($data->id);

                //convertir la chaine caractère en objet DateTime
                $dateEmprunt = new DateTime($data->date_emprunt);
                $dateRetour = new DateTime($data->date_retour);

                $emprunt->setDateEmprunt($dateEmprunt);
                $emprunt->setDateRetour($dateRetour);

                $emprunt->setUserId($data->user_id);
                $emprunt->setLivreId($data->livre_id);



                $emprunts[] = $emprunt;
            }

            if ($emprunts) {
                return $emprunts;
            } else {
                return false;
            }


        } catch (\PDOException $ex) {
            echo $ex->getMessage();
            return null;
        }
    }

    function getAllHistoriques()
    {

        $sql = "SELECT * FROM `library_ws_db`.`historique` ";

        try {

            $result = $this->connexion->prepare($sql);
            $var = $result->execute();

            $historiques = [];
            while ($data = $result->fetch(PDO::FETCH_OBJ)) {
                $historique = new Historique();
                $historique->setId($data->id);

                //convertir la chaine caractère en objet DateTime
                $dateEmprunt = new DateTime($data->date_emprunt);
                $dateRetour = new DateTime($data->date_retour);

                $historique->setDateEmprunt($dateEmprunt);
                $historique->setDateRetour($dateRetour);

                $historique->setUserId($data->user_id);
                $historique->setLivreId($data->livre_id);
                $historique->setEmpruntId($data->emprunt_id);



                $historiques[] = $historique;
            }

            if ($historiques) {
                return $historiques;
            } else {
                return false;
            }


        } catch (\PDOException $ex) {
            echo $ex->getMessage();
            return null;
        }
    }




    /**
     * ====================== UPDATE FONCTIONS ===========================
     */

    function updateUser(User $user)
    {

        $sql = "UPDATE `library_ws_db`.`users` SET";

        try {
            $sql .= " prenom = '" . $user->getPrenom() . "',";
            $sql .= " nom = '" . $user->getNom() . "',";
            $sql .= " login = '" . $user->getLogin() . "'";


            $sql .= " WHERE id=" . $user->getId();


            $result = $this->connexion->prepare($sql);
            $var = $result->execute();

            if ($var) {
                return true;
            } else {
                return false;
            }


        } catch (\PDOException $ex) {

            echo $ex->getMessage();
            return null;
        }
    }


    function updateLivre(Livre $livre)
    {

        $sql = "UPDATE `library_ws_db`.`livre` SET";

        try {
            $sql .= " titre = '" . $livre->getTitre() . "',";
            $sql .= " autheur = '" . $livre->getAutheur() . "',";
            $sql .= " isbn = '" . $livre->getIsbn() . "',";
            $sql .= " datePub = '" . $livre->getDatePub()->format('Y-m-d') . "',";
            $sql .= " disponibilite = '" . (int) $livre->getDisponibilite() . "'";


            $sql .= " WHERE id=" . $livre->getId();


            $result = $this->connexion->prepare($sql);
            $var = $result->execute();

            if ($var) {
                return true;
            } else {
                return false;
            }


        } catch (\PDOException $ex) {

            echo $ex->getMessage();
            return null;
        }
    }


    function updateEmprunt(Emprunt $emprunt)
    {

        $sql = "UPDATE `library_ws_db`.`emprunt` SET";

        try {
            $sql .= " date_emprunt = '" . $emprunt->getDateEmprunt()->format('Y-m-d') . "',";
            $sql .= " date_retour = '" . $emprunt->getDateRetour()->format('Y-m-d') . "',";
            $sql .= " user_id = '" . $emprunt->getUserId() . "',";
            $sql .= " livre_id = '" . $emprunt->getLivreId() . "'";


            $sql .= " WHERE id=" . $emprunt->getId();


            $result = $this->connexion->prepare($sql);
            $var = $result->execute();

            if ($var) {
                return true;
            } else {
                return false;
            }


        } catch (\PDOException $ex) {

            echo $ex->getMessage();
            return null;
        }
    }

    function updateHistorique(Historique $historique)
    {

        $sql = "UPDATE `library_ws_db`.`historique` SET";

        try {
            $sql .= " date_emprunt = '" . $historique->getDateEmprunt()->format('Y-m-d') . "',";
            $sql .= " date_retour = '" . $historique->getDateRetour()->format('Y-m-d') . "',";
            $sql .= " user_id = '" . $historique->getUserId() . "',";
            $sql .= " livre_id = '" . $historique->getLivreId() . "'";


            $sql .= " WHERE id=" . $historique->getId();


            $result = $this->connexion->prepare($sql);

            $var = $result->execute();

            if ($var) {
                return true;
            } else {
                return false;
            }


        } catch (\PDOException $ex) {

            echo $ex->getMessage();
            return null;
        }
    }


    /**
     * ====================== DELETE FONCTIONS ===========================
    */

    function deleteUsers(User $user)
    {
        $sql = "DELETE FROM `library_ws_db`.`users` WHERE id=" . $user->getId();


        try {


            $result = $this->connexion->prepare($sql);
            $var = $result->execute();



        } catch (\PDOException $e) {
            return null;
        }
    }

    function deleteLivre(Livre $livre)
    {
        $sql = "DELETE FROM `library_ws_db`.`livre` WHERE id=" . $livre->getId();


        try {


            $result = $this->connexion->prepare($sql);
            $var = $result->execute();



        } catch (\PDOException $e) {
            return null;
        }
    }


    function deleteEmprunt(Emprunt $emprunt)
    {
        $sql = "DELETE FROM `library_ws_db`.`emprunt` WHERE id=" . $emprunt->getId();


        try {


            $result = $this->connexion->prepare($sql);
            $var = $result->execute();



        } catch (\PDOException $e) {
            return null;
        }
    }

    function deleteHistorique(Historique $historique)
    {
        $sql = "DELETE FROM `library_ws_db`.`historique` WHERE id=" . $historique->getId();


        try {


            $result = $this->connexion->prepare($sql);
            $var = $result->execute();



        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }




    /**
     * =============================> DYNAMISER LA FONCTION DETAIL =============================> 
    */

    //Methode me permettant de un element de la table emprunt
    public function getEmpruntById(int $id): ?Emprunt
    {
        $sql = "SELECT * FROM `library_ws_db`.`emprunt` WHERE id = ?";

        try {
            $result = $this->connexion->prepare($sql);
            $result->execute([$id]);

            if ($data = $result->fetch(PDO::FETCH_OBJ)) {
                $emprunt = new Emprunt();
                $emprunt->setId($data->id);
                $emprunt->setDateEmprunt(new \DateTime($data->date_emprunt));
                $emprunt->setDateRetour(new \DateTime($data->date_retour));
                $emprunt->setUserId($data->user_id);
                $emprunt->setLivreId($data->livre_id);

                return $emprunt;
            }

            return null;
        } catch (\PDOException $ex) {
            throw new \Exception("Erreur lors de la récupération de l'emprunt : " . $ex->getMessage());
        }
    }


    public function getHistoriqueById(int $id): ?Historique
    {
        $sql = "SELECT * FROM `library_ws_db`.`historique` WHERE id = ?";

        try {
            $result = $this->connexion->prepare($sql);
            $result->execute([$id]);

            if ($data = $result->fetch(PDO::FETCH_OBJ)) {
                $historique = new Historique();
                $historique->setId($data->id);
                $historique->setDateEmprunt(new \DateTime($data->date_emprunt));
                $historique->setDateRetour(new \DateTime($data->date_retour));
                $historique->setUserId($data->user_id);
                $historique->setLivreId($data->livre_id);
                $historique->setEmpruntId($data->emprunt_id);

                return $historique;
            }

            return null;
        } catch (\PDOException $ex) {
            throw new \Exception("Erreur lors de la récupération de l'emprunt : " . $ex->getMessage());
        }
    }


    public function getLivreById(int $id): ?Livre
    {
        $sql = "SELECT * FROM `library_ws_db`.`livre` WHERE id = ?";

        try {
            $result = $this->connexion->prepare($sql);
            $result->execute([$id]);

            if ($data = $result->fetch(PDO::FETCH_OBJ)) {
                $livre = new Livre();
                $livre->setId($data->id);
                $livre->setTitre($data->titre);
                $livre->setAutheur($data->autheur);
                $livre->setIsbn($data->isbn);
                $livre->setDatePub(new DateTime($data->datePub));
                $livre->setDisponibilite($data->datePub);

                return $livre;
            }

            return null;
        } catch (\PDOException $ex) {
            throw new \Exception("Erreur lors de la récupération de l'emprunt : " . $ex->getMessage());
        }
    }

    
    public function getUserById(int $id): ?User
    {
        $sql = "SELECT * FROM `library_ws_db`.`users` WHERE id = ?";

        try {
            $result = $this->connexion->prepare($sql);
            $result->execute([$id]);

            if ($data = $result->fetch(PDO::FETCH_OBJ)) {
                $user = new User();
                $user->setId($data->id);
                $user->setPrenom($data->prenom);
                $user->setNom($data->nom);
                $user->setLogin($data->login);

                return $user;
            }

            return null;
        } catch (\PDOException $ex) {
            throw new \Exception("Erreur lors de la récupération de l'emprunt : " . $ex->getMessage());
        }
    }





    public function getHistoriqueByEmpruntId(int $empruntId): ?Historique
    {
        $sql = "SELECT * FROM `library_ws_db`.`historique` WHERE emprunt_id = ?";

        try {
            $result = $this->connexion->prepare($sql);
            $result->execute([$empruntId]);

            if ($data = $result->fetch(PDO::FETCH_OBJ)) {
                $historique = new Historique();
                $historique->setId($data->id);
                $historique->setDateEmprunt(new \DateTime($data->date_emprunt));
                $historique->setDateRetour(new \DateTime($data->date_retour));
                $historique->setUserId($data->user_id);
                $historique->setLivreId($data->livre_id);
                $historique->setEmpruntId($data->emprunt_id);

                return $historique;
            }

            return null;
        } catch (\PDOException $ex) {
            throw new \Exception("Erreur lors de la récupération de l'historique : " . $ex->getMessage());
        }
    }

   








}
