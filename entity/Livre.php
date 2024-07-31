<?php

    class Livre
    {
        protected ?int $id;
        protected ?string $titre;
        protected ?string $autheur;
        protected ?string $isbn;
        protected ?DateTime $datePub;
        protected ?bool $disponibilite;
        protected ?DateTime $createdAt;

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
         * Get the value of titre
         *
         * @return ?string
         */
        public function getTitre(): ?string
        {
                return $this->titre;
        }

        /**
         * Set the value of titre
         *
         * @param ?string $titre
         *
         * @return self
         */
        public function setTitre(?string $titre): self
        {
                $this->titre = $titre;

                return $this;
        }

        /**
         * Get the value of autheur
         *
         * @return ?string
         */
        public function getAutheur(): ?string
        {
                return $this->autheur;
        }

        /**
         * Set the value of autheur
         *
         * @param ?string $autheur
         *
         * @return self
         */
        public function setAutheur(?string $autheur): self
        {
                $this->autheur = $autheur;

                return $this;
        }

        /**
         * Get the value of isbn
         *
         * @return ?string
         */
        public function getIsbn(): ?string
        {
                return $this->isbn;
        }

        /**
         * Set the value of isbn
         *
         * @param ?string $isbn
         *
         * @return self
         */
        public function setIsbn(?string $isbn): self
        {
                $this->isbn = $isbn;

                return $this;
        }

        /**
         * Get the value of datePub
         *
         * @return ?DateTime
         */
        public function getDatePub(): ?DateTime
        {
                return $this->datePub;
        }

        /**
         * Set the value of datePub
         *
         * @param ?DateTime $datePub
         *
         * @return self
         */
        public function setDatePub(?DateTime $datePub): self
        {
                $this->datePub = $datePub;

                return $this;
        }

        /**
         * Get the value of disponibilite
         *
         * @return ?bool
         */
        public function getDisponibilite(): ?bool
        {
                return $this->disponibilite;
        }

        /**
         * Set the value of disponibilite
         *
         * @param ?bool $disponibilite
         *
         * @return self
         */
        public function setDisponibilite(?bool $disponibilite): self
        {
                $this->disponibilite = $disponibilite;

                return $this;
        }

        /**
         * Get the value of createdAt
         *
         * @return ?DateTime
         */
        public function getCreatedAt(): ?DateTime
        {
                return $this->createdAt;
        }

        /**
         * Set the value of createdAt
         *
         * @param ?DateTime $createdAt
         *
         * @return self
         */
        public function setCreatedAt(?DateTime $createdAt): self
        {
                $this->createdAt = $createdAt;

                return $this;
        }
    }
    