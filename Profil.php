<?php
    class Profil{
        private $listeChien;
        
        public function __construct($listeChien){
            $this->listeChien=$listeChien;
        }

        

        /**
         * Get the value of listeChien
         */ 
        public function getListeChien()
        {
                return $this->listeChien;
        }
    } 
?>