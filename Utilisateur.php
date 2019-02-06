<?php
    class Utilisateur{
        private $pseudo;
        private $motPasse;
        private $derniereConnexion;
        private $email;
        
        public function __construct($pseudo,$motPasse,$email){
            $this->pseudo=$pseudo;
            $this->motPasse=$motPasse;
            $this->derniereConnexion=date();
            $this->email=$email;
        }

        public function checkMotPasse(){
            
        }

        /**
         * Get the value of pseudo
         */ 
        public function getPseudo()
        {
                return $this->pseudo;
        }

        /**
         * Get the value of derniereConnexion
         */ 
        public function getDerniereConnexion()
        {
                return $this->derniereConnexion;
        }

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }
    } 
?>