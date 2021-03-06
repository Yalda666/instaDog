<?php
session_start();
require 'connexion.php';
$bdd = new Connexion;
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
    crossorigin="anonymous">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/inscription-chien.css">

  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
  <title>Agrandir la meute</title>
</head>

<body>
  <!-- ////////////  MENU DE NAVUGATION RESPONSIVE  /////////-->
  <nav class="navbar navbar-expand-lg navbar-light bg-warning col-sm-6 col-md-4 col-lg-6 col-xl-12">
    <a class="navbar-brand container-logo" href="accueil.php"></a>
    <img class="logo" src="images/logo_final.png" alt="Tete de loup" width="10%"></a>
    <a class="navbar-brand" href="accueil.php">InstaWolf</a>

    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse menu-nav" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="accueil.php">ACCUEIL <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="profil_utilisateur.php<?php if(isset($_SESSION['id'])) { echo '?id='.$_SESSION['id'];} ?>">PROFIL</a>
        </li>
        <li class="nav-item deja_loup">
          <a class="nav-link btn btn-primary text-white" type="button" href="deja_loup.php">Déjà
            loup?</a>
        </li>
        <li class="nav-item">
          <a class="nav-link btn btn-danger text-white hulule" type="button" href="hulule-avec_nous.php">Hurle
            avec nous!</a>
        </li>

        
      </ul>
      <!--INPUT SEARCH -->
      <form class="form-inline container-search" method="GET" action="recherche.php">
        <input class="form-control mr-sm-2  input-search"  name="recherche" type="search" placeholder="Recherche" aria-label="Recherche">
        <button class="btn btn-outline-success my-2 my-sm-0 " href="recherche.php" type="submit">Recherche</button>
      </form>
      <!--// FIN SEARCH-->
      <?php if(isset($_SESSION['id'])) { echo '
      <p>Bonjour '.$bdd->searchPseudoById($_SESSION["id"]).'<p>
    <li class="nav-item">
          <a class="nav-link btn btn-danger text-white hulule" type="button" href="deconnexion.php">Déconnexion</a>
    </li>
  ';}?>
    </div>
  </nav><!-- ////////////  FIN  MENU DE NAVUGATION RESPONSIVE  /////////-->

  <!-- ////////////   SECTION DE NOTRE CONTENT MAIN  /////////-->
  <main>

  <?php

$bdd = new Connexion;
if (isset($_POST['forminscription'])) {
    $idUtilisateur = $_SESSION['id'];
    $nom = htmlspecialchars($_POST['nom']);
    $surnom = htmlspecialchars($_POST['surnom']);
    $race = htmlspecialchars($_POST['race']);
    $elevage = htmlspecialchars($_POST['elevage']);
    $sexe = htmlspecialchars($_POST['sexe']);
    $date = $_POST['dateNaissance'];
    $suffixe = date("YmdHis");
    $uploadedFileName = $_FILES["photo-promenade"]["name"];
    $uploadedFile = new SplFileInfo($uploadedFileName);
    $fileExtension = $uploadedFile->getExtension();
    $destinationFolder = $_SERVER['DOCUMENT_ROOT'] . "/instaWolf/Photos/";
    $destinationName = "photo-" . $suffixe . "." . $fileExtension;

    echo $_FILES["photo-promenade"]["error"];

    if (move_uploaded_file($_FILES["photo-promenade"]["tmp_name"], $destinationFolder . $destinationName)) {
        echo "<br/> fichier enregistré avec succes";
    }

    if (!empty($_POST['nom']) and !empty($_FILES['photo-promenade']) and !empty($_POST['surnom']) and !empty($_POST['race']) and !empty($_POST['elevage']) and !empty($_POST['sexe']) and !empty($_POST['dateNaissance'])) {

        $bdd->insertAnimal($idUtilisateur, $nom, $surnom, $destinationFolder . $destinationName, $elevage, $date, $sexe, $race);
        $erreur = "Votre loup a bien été ajouté ! <a href=\"profil_chien.php?id=" . $_SESSION['id'] . "\">Me connecter</a>";

    } else {
        $erreur = "Tous les champs doivent être complétés !";
    }
}
?>

      <form action="inscription_chien.php" method="post" enctype="multipart/form-data">
    <div class="container register">
      <div class="row">
        <div class="col-md-3 register-left">
          <img src="images/logo_final.png" alt="logo instawolf" />
          <h3>Rejoint la meute</h3>
          <p>Partage la vie de ta meute avec notre meute mondiale </p>
        </div>
        <div class="col-md-9 register-right">
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
              <h3 class="register-heading">Agrandir la meute</h3>
              <div class="row register-form">
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="text" class="form-control" name="nom" placeholder="Votre nom *" value="" required/>
                  </div>
                  <div class="form-group">
                      <input type="text" class="form-control" name="surnom" placeholder="Votre surnom *" value="" required/>
                    </div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="race" placeholder="Votre race *" value="" required/>
                  </div>
                  <div class="form-group">
                      <input type="text" class="form-control" name="elevage" placeholder="Votre nom d'élevage *" value="" required/>
                    </div>

                  <div class="form-group">
                    <div class="maxl">
                      <label class="radio inline">
                        <input type="radio" name="sexe" value="male" checked>
                        <span> Male </span>
                      </label>
                      <label class="radio inline">
                        <input type="radio"  name="sexe" value="female">
                        <span>Femelle </span>
                      </label>

                      <div id="container">
                        <input type="hidden" name="MAX_FILE_SIZE" value="300000000" />
                          <p><input type="file" name="photo-promenade" onchange="change(this)" id="form-file"></p>
                          <p><img id="image" src="" alt="Votre image"></p>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                      <label for="input-StartDate-1">Date d'anniversaire</label>
                      <input type="date" class="form-control" name="dateNaissance" id="input-StartDate-1" placeholder="시작일">
                    </div>


                  </div>
                  <input type="submit" name="forminscription" class="btnRegister" value="Valider" />
                  <?php
if (isset($erreur)) {
    echo '<font color="red">' . $erreur . "</font>";
}
?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <h1>Rejoint la Meute</h1>
        <h5>Et rajoute ton loup dans notre meute internationale afin de célébrer la lune en hurlant avec nous.</h5>
      </div>
    </div>
    </form>
  </main><!-- ////////////  FIN  SECTION DE NOTRE CONTENT MAIN  /////////-->
  <footer class="container">
      <p class="float-right"><a href="#">Back to top</a></p>
      <p>© 2019 InstaWolf, Inc. <!--  <a href="#">Privacy</a> · <a href="#">Terms</a> --></p>
    </footer>
  <!-- ////////////   SECTION DE NOTRE MENU FOOTER MENU  /////////-->
  <nav class="navbar navbar-expand-lg navbar-light bg-warning col-sm-6 col-md-4 col-lg-6 col-xl-12">
    <a class="navbar-brand container-logo" href="accueil.php"></a>
    <img class="logo" src="images/logo_final.png" alt="Tete de loup" width="10%"></img></a>
    <a class="navbar-brand" href="accueil.php">InstaWolf</a>

    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse menu-nav" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="accueil.php">ACCUEIL <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="profil_utilisateur.php<?php if(isset($_SESSION['id'])) { echo '?id='.$_SESSION['id'];} ?>">PROFIL</a>
        </li>

     <!--    <li class="nav-item">
          <a class="nav-link" href="#">AGRANDIR LA MEUTE</a>
        </li> -->



      </ul>
      <!--INPUT SEARCH -->
      <form class="form-inline container-search" method="GET" action="recherche.php">
        <input class="form-control mr-sm-2  input-search"  name="recherche" type="search" placeholder="Recherche" aria-label="Recherche">
        <button class="btn btn-outline-success my-2 my-sm-0 " href="recherche.php" type="submit">Recherche</button>
      </form>
      <!--// FIN SEARCH-->
      <?php if(isset($_SESSION['id'])) { echo '
      <p>Bonjour '.$bdd->searchPseudoById($_SESSION["id"]).'<p>
    <li class="nav-item">
          <a class="nav-link btn btn-danger text-white hulule" type="button" href="deconnexion.php">Déconnexion</a>
    </li>
  ';}?>
    </div>
  </nav>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
    crossorigin="anonymous"></script>

  <script src="js/bootstrap.js"></script>
  <script src="js/javascript.js"></script>
</body>

</html>