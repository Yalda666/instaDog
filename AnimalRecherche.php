<?php
    class AnimalRecherche {
        private $id;
        private $idUtilisateur;
        private $nom;
        private $surnom;
        private $cheminPhoto;
        private $nomElevage;
        private $dateNaissance;
        private $sexe;
        private $race;

        
       

        /**
         * Get the value of cheminPhoto
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Get the value of nom
         */ 
        public function getNom()
        {
                return $this->nom;
        }

        /**
         * Get the value of surnom
         */ 
        public function getSurnom()
        {
                return $this->surnom;
        }


        public function getCheminPhoto()
        {
            return $this->cheminPhoto;
        }

        /**
         * Get the value of nomElevage
         */ 
        public function getNomElevage()
        {
                return $this->nomElevage;
        }

        /**
         * Get the value of dateNaissance
         */ 
        public function getDateNaissance()
        {
                return $this->dateNaissance;
        }

        

        /**
         * Get the value of sexe
         */ 
        public function getSexe()
        {
                return $this->sexe;
        }

        /**
         * Get the value of race
         */ 
        public function getRace()
        {
                return $this->race;
        }
    } 
?>