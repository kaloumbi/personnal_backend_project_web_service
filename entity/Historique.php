<?php 

    class Historique
    {
        protected ?int $id;
        protected ?DateTime $dateEmprunt;
        protected ?DateTime $dateRetour;
        protected ?int $userId;
        protected ?int $livreId;
        protected ?int $empruntId;

        /**
         * Get the value of id
         *
         * @return ?int
         */
        public function getId(): ?int
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @param ?int $id
         *
         * @return self
         */
        public function setId(?int $id): self
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of dateEmprunt
         *
         * @return ?DateTime
         */
        public function getDateEmprunt(): ?DateTime
        {
                return $this->dateEmprunt;
        }

        /**
         * Set the value of dateEmprunt
         *
         * @param ?DateTime $dateEmprunt
         *
         * @return self
         */
        public function setDateEmprunt(?DateTime $dateEmprunt): self
        {
                $this->dateEmprunt = $dateEmprunt;

                return $this;
        }

        /**
         * Get the value of dateRetour
         *
         * @return ?DateTime
         */
        public function getDateRetour(): ?DateTime
        {
                return $this->dateRetour;
        }

        /**
         * Set the value of dateRetour
         *
         * @param ?DateTime $dateRetour
         *
         * @return self
         */
        public function setDateRetour(?DateTime $dateRetour): self
        {
                $this->dateRetour = $dateRetour;

                return $this;
        }

        /**
         * Get the value of userId
         *
         * @return ?int
         */
        public function getUserId(): ?int
        {
                return $this->userId;
        }

        /**
         * Set the value of userId
         *
         * @param ?int $userId
         *
         * @return self
         */
        public function setUserId(?int $userId): self
        {
                $this->userId = $userId;

                return $this;
        }

        /**
         * Get the value of livreId
         *
         * @return ?int
         */
        public function getLivreId(): ?int
        {
                return $this->livreId;
        }

        /**
         * Set the value of livreId
         *
         * @param ?int $livreId
         *
         * @return self
         */
        public function setLivreId(?int $livreId): self
        {
                $this->livreId = $livreId;

                return $this;
        }

        /**
         * Get the value of empruntId
         *
         * @return ?int
         */
        public function getEmpruntId(): ?int
        {
                return $this->empruntId;
        }

        /**
         * Set the value of empruntId
         *
         * @param ?int $empruntId
         *
         * @return self
         */
        public function setEmpruntId(?int $empruntId): self
        {
                $this->empruntId = $empruntId;

                return $this;
        }
    }
    