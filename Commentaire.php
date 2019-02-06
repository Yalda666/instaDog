<?php
    class Commentaire{
        private $idArticle;
        private $pseudo;
        private $texte;
        private $datePublication;
        
        public function __construct($idArticle,$pseudo,$texte,$listCom,$datePublication){
            $this->idArticle=$idArticle;
            $this->pseudo=$pseudo;
            $this->texte=$texte;
            $this->datePublication=$datePublication;
        }

        /**
         * Get the value of pseudo
         */ 
        public function getpseudo()
        {
                return $this->pseudo;
        }

        /**
         * Get the value of texte
         */ 
        public function getTexte()
        {
                return $this->texte;
        }

        /**
         * Get the value of datePublication
         */ 
        public function getDatePublication()
        {
                return $this->datePublication;
        }


        /**
         * Set the value of texte
         *
         * @return  self
         */ 
        public function setTexte($texte)
        {
                $this->texte = $texte;

                return $this;
        }

        /**
         * Set the value of datePublication
         *
         * @return  self
         */ 
        public function setDatePublication($datePublication)
        {
                $this->datePublication = $datePublication;

                return $this;
        }
    } 
?>