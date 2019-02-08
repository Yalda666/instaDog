
<?php
require_once "connexion.php";

// On arrive ici suite à l'envoie du formulaire nouvelle promenade

// Pour commencer on va récupérer toutes les valeurs envoyées par le formulaire
$nom = $_POST["nom"];
$surnom =$_POST["surnom"];
$race=$_POST["race"];
$elevage = $_POST["elevage"];
$sexe = $_POST["gender"];
$$dateNaissance = $_POST["dateNaissance"];

/* $utilisateurId = $_POST["id"]; */

// Ensuite on crée la connexion à la base de données
$appliBD=new Connexion;

//on savegarde la photo sur le serveur dans le dossier img
//Chaque photo aura pour nom photo DDMMYYYHHmmss. jpeg par exemple;
//on ajoute un timestamp au nom pour le rendre unique 
// On sauvegarde la photo sur le serveur dans le dossier img
// Chaque photo aura pour nom photo-DDMMYYYYHHmmss.jpeg par exemple ; 
//  on ajoute un timestamp au nom pour le rendre unique
$suffixe = date("YmdHis");
$uploadedFileName = $_FILES["photo"]["name"];
$uploadedFile = new SplFileInfo(image);
$fileExtension = $uploadedFile->getExtension();
$destinationFolder = $_SERVER['DOCUMENT_ROOT']."/projets/instaDog/";
$destinationName = "img/photo".$suffixe.".".$fileExtension;

// On insère la promenade
// Si l'insertion s'est bien passée, on récupère l'id de la promenade
$id = $appli->insertAnimal( $nom, $surnom, $cheminPhoto, $nomElevage, $dateNaissance, $sexe, $race, $idUtilisateur);

// Puis on redirige vers la page particulière de cette promenade
header('Location: promenade.php?id='.$id);
 


?>