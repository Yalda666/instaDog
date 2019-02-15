<?php
require 'Animal.php';
require 'Article.php';
require 'Profil.php';
require 'Utilisateur.php';

// Début de la classe Connexion

class Connexion
{

// Déclaration de la variable privée connexion qui fait la relation avec la base de données

    private $connexion;

// Constructeur de la classe qui initialise la connexion avec la base de données avec les paramètres interne à notre serveur phpmyadmin

    public function __construct()
    {
        try {

            $PARAM_hote = 'localhost';

            $PARAM_port = '3306';

            $PARAM_nom_bd = 'InstaDog';

            $PARAM_utilisateur = 'adminInstaDog';

            $PARAM_mot_passe = 'Inst@D0g';

            $this->connexion = new PDO(
                'mysql:host=' . $PARAM_hote . ';dbname=' . $PARAM_nom_bd,
                $PARAM_utilisateur,
                $PARAM_mot_passe
            );
            $this->connexion->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");
            // var_dump("connexion ok");
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage() . '<br />';
            echo 'N° : ' . $e->getCode();
            var_dump("connexion pas ok");
        }
    }

// Fonction inverseDate qui formate la date de naissance sous un format plus intelligible et digérable pour nous Européens

    public function inverseDate($naissance)
    {
        $mot = str_split($naissance);
        $res = $mot[8] . $mot[9];
        switch ($mot[5] . $mot[6]) {
            case "01":
                $res = $res . " Janvier ";
                break;
            case "02":
                $res = $res . " Février ";
                break;
            case "03":
                $res = $res . " Mars ";
                break;
            case "04":
                $res = $res . " Avril ";
                break;
            case "05":
                $res = $res . " Mai ";
                break;
            case "06":
                $res = $res . " Juin ";
                break;
            case "07":
                $res = $res . " Juillet ";
                break;
            case "08":
                $res = $res . " Août ";
                break;
            case "09":
                $res = $res . " Septembre ";
                break;
            case "10":
                $res = $res . " Octobre ";
                break;
            case "11":
                $res = $res . " Novembre ";
                break;
            case "12":
                $res = $res . " Décembre ";
                break;
        }
        $res = $res . $mot[0] . $mot[1] . $mot[2] . $mot[3];
        return $res;
    }

// Fonction insertUtilisateur qui insère un utilisateur dans la base de données

    public function insertUtilisateur($pseudo, $motPasse, $email)
    {
        try {
            $requete_prepare = $this->connexion->prepare(
                "INSERT INTO Utilisateur (pseudo, motPasse, derniereConnexion, email) values (:pseudo, :motPasse, CURRENT_TIMESTAMP, :email)"
            );
            $requete_prepare->execute(
                array('pseudo' => $pseudo, 'motPasse' => $motPasse, 'email' => $email)
            );
            echo "Inséré! <br />";
            return true;
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage() . '<br />';
            echo 'N° : ' . $e->getCode();
            echo "Pas inséré! <br />";
            return false;
        }
    }

// Fonction insertAnimal qui insère un loup dans la base de données

    public function insertAnimal($idUtilisateur, $nom, $surnom, $cheminPhoto, $nomElevage, $dateNaissance, $sexe, $race)
    {
        try {
            $requete_prepare = $this->connexion->prepare(
                "INSERT INTO Animal (idUtilisateur, nom, surnom, cheminPhoto, nomElevage, dateNaissance, sexe, race) values (:idUtilisateur, :nom, :surnom, :cheminPhoto, :nomElevage, :dateNaissance, :sexe, :race)"
            );
            $requete_prepare->execute(
                array('idUtilisateur' => $idUtilisateur, 'nom' => $nom, 'surnom' => $surnom, 'cheminPhoto' => $cheminPhoto, 'nomElevage' => $nomElevage, 'dateNaissance' => $dateNaissance, 'sexe' => $sexe, 'race' => $race)
            );
            echo "Inséré! <br />";
            return true;
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage() . '<br />';
            echo 'N° : ' . $e->getCode();
            echo "Pas inséré! <br />";
            return false;
        }
    }

// Fonction insertArticle qui insère un article dans la base de données

    public function insertArticle($idAnimal, $texte, $cheminPhoto, $datePublication)
    {
        try {
            $requete_prepare = $this->connexion->prepare(
                'INSERT INTO Article (idAnimal, texte, cheminPhoto, datePublication) values (:idAnimal,:texte,:cheminPhoto,:datePublication)'
            );
            $requete_prepare->execute(
                array('idAnimal' => $idAnimal, 'texte' => $texte, 'cheminPhoto' => $cheminPhoto, 'datePublication' => $datePublication)
            );
            echo "Inséré! <br />";
            return true;
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage() . '<br />';
            echo 'N° : ' . $e->getCode();
            echo "Pas inséré! <br />";
            return false;
        }
    }

// Fonction insertCommentaire qui insère un commentaire dans la base de données

    public function insertCommentaire($idUtilisateur, $idAnimal, $texte, $datePublication)
    {
        try {
            $requete_prepare = $this->connexion->prepare(
                'INSERT INTO Commentaire (idUtilisateur, idAnimal, texte, datePublication) values (:idUtilisateur, :idAnimal, :texte, :datePublication)'
            );
            $requete_prepare->execute(
                array('idUtilisateur' => $idUtilisateur, 'idAnimal' => $idAnimal, 'texte' => $texte, 'datePublication' => $datePublication)
            );
            echo "Inséré! <br />";
            return true;
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage() . '<br />';
            echo 'N° : ' . $e->getCode();
            echo "Pas inséré! <br />";
            return false;
        }
    }

// Fonction selectAllLoups qui sélectionne la liste des loups dans la base de données

    public function selectAllLoups()
    {
        try {
            $requete_prepare = $this->connexion->prepare(
                'SELECT * FROM Animal'
            );
            $requete_prepare->execute();
            $resultat = $requete_prepare->fetchAll();
            return $resultat;
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage() . '<br />';
            echo 'N° : ' . $e->getCode();
            return false;
        }
    }

// Fonction selectAllUtilisateurs qui sélectionne la liste des utilisateurs dans la base de données

    public function selectAllUtilisateurs()
    {
        try {
            $requete_prepare = $this->connexion->prepare(
                'SELECT * FROM Utilisateur'
            );
            $requete_prepare->execute();
            $resultat = $requete_prepare->fetchAll();
            return $resultat;
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage() . '<br />';
            echo 'N° : ' . $e->getCode();
            return false;
        }
    }

// Fonction selectLoupsById qui sélectionne les loups dans la base de données qui ont l'identifiant user passé en paramètre et retourne l'utilisateur

    public function selectLoupsById($idUtilisateur)
    {
        try {
            $requete_prepare = $this->connexion->prepare(
                'SELECT * FROM Animal WHERE idUtilisateur = :id'
            );
            $requete_prepare->execute(array("id" => $id));
            $resultat = $requete_prepare->fetchAll();
            return $resultat;
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage() . '<br />';
            echo 'N° : ' . $e->getCode();
            return false;
        }
    }

// Fonction selectUtilisateurById qui sélectionne l'utilisateur dans la base de données qui a l'identifiant passé en paramètre et retourne l'utilisateur

    public function selectUtilisateurById($id)
    {
        try {
            $requete_prepare = $this->connexion->prepare(
                'SELECT * FROM Utilisateur WHERE id = :id'
            );
            $requete_prepare->execute(array("id" => $id));
            $resultat = $requete_prepare->fetch();
            return $resultat;
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage() . '<br />';
            echo 'N° : ' . $e->getCode();
            return false;
        }
    }

// Fonction selectUtilisateurByMail qui sélectionne l'utilisateur dans la base de données qui a l'email passé en paramètre et retourne l'utilisateur

    public function selectUtilisateurByMail($mail)
    {
        try {
            $requete_prepare = $this->connexion->prepare(
                'SELECT * FROM Utilisateur WHERE email = :mail'
            );
            $requete_prepare->execute(array("mail" => $mail));
            $resultat = $requete_prepare;
            return $resultat;
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage() . '<br />';
            echo 'N° : ' . $e->getCode();
            return false;
        }
    }

// Fonction selectArticlesById qui sélectionne les articles dans la base de données qui ont l'identifiant du loup passé en paramètre et retourne tous ses articles

    public function selectArticlesById($id)
    {
        try {
            $requete_prepare = $this->connexion->prepare(
                'SELECT * FROM Article WHERE idChien = :id'
            );
            $requete_prepare->execute(array("id" => $id));
            $resultat = $requete_prepare->fetchAll();
            return $resultat;
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage() . '<br />';
            echo 'N° : ' . $e->getCode();
            return false;
        }
    }

// Fonction selectCommentairesById qui sélectionne les commentaires dans la base de données qui ont l'identifiant de l'article passé en paramètre et retourne tous ses commentaires

    public function selectCommentairesById($id)
    {
        try {
            $requete_prepare = $this->connexion->prepare(
                'SELECT * FROM Commentaire WHERE idArticle = :id'
            );
            $requete_prepare->execute(array("id" => $id));
            $resultat = $requete_prepare->fetchAll();
            return $resultat;
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage() . '<br />';
            echo 'N° : ' . $e->getCode();
            return false;
        }
    }

// Fonction searchPersonneId qui sélectionne l'identifiant dans la base de données qu'a la personne qui a le nom ou l'email qui contient les lettres passées en paramètres

    public function searchPersonneId($nom, $email, $mdp)
    {
        $query = "SELECT * FROM Utilisateur WHERE pseudo = :nom AND email = :email AND motPasse = :mdp";
        $stmt = $this->connexion->prepare($query);
        $result = $stmt->execute(array("nom" => $nom, "email" => $email, "mdp" => $mdp));
        $row = $stmt->fetch();
        return $row;
    }
// Fonction searchPersonneIdByNom qui sélectionne l'identifiant dans la base de données qu'a la personne qui a le nom qui contient les lettres passées en paramètres

    public function searchPersonneIdByNom($nom)
    {
        $query = "SELECT * FROM Utilisateur WHERE pseudo = :nom";
        $stmt = $this->connexion->prepare($query);
        $result = $stmt->execute(array("nom" => $nom));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

// Fonction searchPersonneIdByNom qui sélectionne l'identifiant dans la base de données qu'a la personne qui a le nom qui contient les lettres passées en paramètres

    public function searchPersonneById($id)
    {
        $query = "SELECT * FROM Utilisateur WHERE id = :id";
        $stmt = $this->connexion->prepare($query);
        $result = $stmt->execute(array("id" => $id));
        $row = $stmt->fetch();
        return $row;
    }

// Fonction searchPseudo qui cherche si une personne a le pseudo passé en paramètre

    public function searchPseudo($nom)
    {
        $query = "SELECT * FROM Utilisateur WHERE pseudo = :nom";
        $stmt = $this->connexion->prepare($query);
        $result = $stmt->execute(array("nom" => "%" . $nom . "%"));
        $row = $stmt->fetch();
        return $row;
    }

// Fonction searchPseudoById qui cherche le pseudo de la personne qui a l'id passé en paramètre et le retourne

public function searchPseudoById($id)
{
    $query = "SELECT pseudo FROM Utilisateur WHERE id = :id";
    $stmt = $this->connexion->prepare($query);
    $result = $stmt->execute(array("id" => $id));
    $row = $stmt->fetch();
    return $row["pseudo"];
}

// Fonction searchAnimalId qui sélectionne l'identifiant dans la base de données qu'a le loup qui a le nom, le surnom, le nom d'élevage ou la race qui contient les lettres passées en paramètres

    public function searchAnimalId($nom)
    {
        $query = "SELECT * FROM Animal WHERE nom like :nom or surnom like :nom or nomElevage like :nom or race like :nom";
        $stmt = $this->connexion->prepare($query);
        $result = $stmt->execute(array("nom" => "%" . $nom . "%"));
        $row = $stmt->fetchAll();
        return $row;
    }

// Fonction getPersonneHobby qui sélectionne les hobbies associés à une personne dont l'identifiant est passé en paramètre

    public function getPersonneLoups($personneId)
    {
        try {
            $requete_prepare = $this->connexion->prepare(
                "SELECT * FROM Animal
                    INNER JOIN Utilisateur ON idUtilisateur = :id"
            );
            $requete_prepare->execute(array("id" => $personneId));
            $hobbies = $requete_prepare->fetchAll();
            return $hobbies;
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage() . '<br />';
            echo 'N° : ' . $e->getCode();
            return false;
        }

    }

// Fonction updatePseudo qui met à jour le pseudo passé en paramètre par rapport à l'id passée en paramètre

    public function updatePseudo($nom, $id)
    {
        $query = "UPDATE Utilisateur SET pseudo = :nom WHERE id = :id";
        $stmt = $this->connexion->prepare($query);
        $result = $stmt->execute(array("nom" => $nom, "id" => $id));
    }

// Fonction updateEmail qui met à jour l'email passé en paramètre par rapport à l'id passée en paramètre

    public function updateEmail($email, $id)
    {
        $query = "UPDATE Utilisateur SET email = :email WHERE id = :id";
        $stmt = $this->connexion->prepare($query);
        $result = $stmt->execute(array("email" => $email, "id" => $id));
    }

// Fonction updateMdp qui met à jour le mot de passe passé en paramètre par rapport à l'id passée en paramètre

    public function updateMdp($mdp, $id)
    {
        $query = "UPDATE Utilisateur SET motPasse = :mdp WHERE id = :id";
        $stmt = $this->connexion->prepare($query);
        $result = $stmt->execute(array("mdp" => $mdp, "id" => $id));
    }

// Fonction comparePassword qui compare les deux mots de passe pour vérifier qu'ils sont bien pareils

    public function comparePassword($pass1, $pass2)
    {
        $password1 = str_split($pass1);
        $password2 = str_split($pass2);
        $i = 0;
        $res = false;
        foreach ($password1 as $p1) {
            if ($p1 === $password2[$i]) {
                $res = true;
            } else {
                $res = false;
                break;
            }
            $i++;
        }
        return $res;
    }
}
