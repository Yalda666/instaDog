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
  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
  <title>Accueil</title>
</head>

<body>
  <!-- ////////////  MENU DE NAVUGATION RESPONSIVE  /////////-->
  <nav class="navbar navbar-expand-lg navbar-light bg-warning col-sm-6 col-md-4 col-lg-6 col-xl-12">
    <a class="navbar-brand container-logo" href="accueil.php"></a>
    <img class="logo" src="images/logo_final.png" alt="Tete de loup" width="10%">
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
          <a class="nav-link" href="profil_utilisateur.php<?php if (isset($_SESSION['id'])) {echo '?id=' . $_SESSION['id'];}?>">PROFIL</a>
        </li>
        <li class="nav-item deja_loup">
          <a class="nav-link btn btn-primary text-white" type="button" href="deja_loup.php">Déjà
            loup?</a>
        </li>
        <li class="nav-item">
          <a class="nav-link btn btn-danger text-white hulule" type="button" href="hulule-avec_nous.php">Hurle
            avec nous!</a>
        </li>
        <div class="modal" id="myModal">
          <div class="modal-dialog">
            <div class="modal-content">
                </form>
            </div>
          </div>
      </ul>
      <!--INPUT SEARCH -->
      <form class="form-inline container-search" method="GET" action="recherche.php">
        <input class="form-control mr-sm-2  input-search"  name="recherche" type="search" placeholder="Recherche" aria-label="Recherche">
        <button class="btn btn-outline-success my-2 my-sm-0 " href="recherche.php" type="submit">Recherche</button>
      </form>
      <!--// FIN SEARCH-->
      <?php if (isset($_SESSION['id'])) {echo '
      <p>Bonjour ' . $bdd->searchPseudoById($_SESSION["id"]) . '<p>
    <li class="nav-item">
          <a class="nav-link btn btn-danger text-white hulule" type="button" href="deconnexion.php">Déconnexion</a>
    </li>
  ';}?>
    </div>

  </nav><!-- ////////////  FIN  MENU DE NAVUGATION RESPONSIVE  /////////-->
  <!-- ////////////   SECTION DE NOTRE CONTENT MAIN  /////////-->
  <main>
  <div class="container image_centre">
  <img src="images/logo_final.png" alt="Tete de loup">
      <a href="hulule-avec_nous.php" id="titre_centre">Rejoins la meute et hurle avec nous!</a>
  </div>
  <div class="container">
    <div class="row">
      <div class="row">
  <?php
$photos = $bdd->selectAllLoups();
foreach ($photos as $photo) {
// récupération de l'url de la photo et du texte
    $lien = $photo->getCheminPhoto();
    $lien = substr($lien, -32);
    echo '
        <form action="profil_chien.php" method="post">      
          <div class="col-lg-3 col-md-4 col-xs-6 thumb">
            
              <input type="hidden" name="idLoup" value="' . $photo->getId() . '"></input>
              <input type="image" class="img-thumbnail" src="' . $lien . '"
                alt="Another alt text">
            </a>
          </div> 
        </form>               
          ';
}
echo "</div>";
?>



        </div>
      </div>
    </div>
  </main><!-- ////////////  FIN  SECTION DE NOTRE CONTENT MAIN  /////////-->

  <!-- ////////////   SECTION DE NOTRE MENU FOOTER MENU  /////////-->
  <footer class="container">
    <p class="float-right"><a href="#">Back to top</a></p>
    <p>© 2019 InstaWolf, Inc. ·<!--  <a href="#">Privacy</a> · <a href="#">Terms</a></p> -->
  </footer>
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
          <a class="nav-link" href="profil_utilisateur.php<?php if (isset($_SESSION['id'])) {echo '?id=' . $_SESSION['id'];}?>">PROFIL</a>
        </li>
      </ul>
      <!--INPUT SEARCH -->
      <form class="form-inline container-search" method="GET" action="recherche.php">
        <input class="form-control mr-sm-2  input-search"  name="recherche" type="search" placeholder="Recherche" aria-label="Recherche">
        <button class="btn btn-outline-success my-2 my-sm-0 " href="recherche.php" type="submit">Recherche</button>
      </form>
      <!--// FIN SEARCH-->
      <?php if (isset($_SESSION['id'])) {echo '
      <p>Bonjour ' . $bdd->searchPseudoById($_SESSION["id"]) . '<p>
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
</body>

</html>