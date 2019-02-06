<?php
    class Animal{
        private $cheminPhoto;
        private $nom;
        private $surnom;
        private $nomElevage;
        private $dateNaissance;
        private $sexe;
        private $race;
        private $listeArticleId;
        
        public function __construct($cheminPhoto,$nom,$surnom,$listCom,$dateNaissance,$sexe,$race,$listeArticleId){
            $this->cheminPhoto=$cheminPhoto;
            $this->nom=$nom;
            $this->surnom=$surnom;
            $this->dateNaissance=$dateNaissance;
            $this->sexe=$sexe;
            $this->race=$race;
            $this->listeArticleId=$listeArticleId;
        }

        /**
         * Get the value of cheminPhoto
         */ 
        public function getCheminPhoto()
        {
                return $this->cheminPhoto;
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