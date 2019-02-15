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
  <link rel="stylesheet" href="css/profil_chien.css">
  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
  <title>Profil du chien</title>
</head>

<body>
  <!-- ////////////  MENU DE NAVUGATION RESPONSIVE  /////////-->
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


      </ul>
      <!--INPUT SEARCH -->
      <form class="form-inline container-search" method="GET" action="recherche.html">
        <input class="form-control mr-sm-2  input-search"  name="recherche" type="search" placeholder="Recherche" aria-label="Recherche">
        <button class="btn btn-outline-success my-2 my-sm-0 " href="recherche.html" type="submit">Recherche</button>
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
    <!-- BANNIER PROFIL UTILISATEUR  -->
<?php
if (isset($_POST['idLoup'])) {
    $loup = $bdd->selectLoupById($_POST['idLoup']);
    $nom = $loup["nom"];
    $surnom = $loup["surnom"];
    $nomElevage = $loup["nomElevage"];
    $cheminPhoto = $loup["cheminPhoto"];
    $dateNaissance = $loup["dateNaissance"];
    $sexe = $loup["sexe"];
    $race = $loup["race"];
    $cheminPhoto = substr($cheminPhoto, -32);
}

?>
  <!-- ////////////  BANNIER IMAGE   /////////-->
  <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12 col-md-6">
          <div class="bg bg-left">
            <!--  <h2>Create your snippet's HTML, CSS and Javascript in the editor tabs</h2> -->
            <div class="card-img-overlay">
              <div class="donnees-perso">
                <h3 class="card-title">Nom :<?php echo $nom; ?></h3>
                <h5 class="card-title">Surnom :<?php echo $surnom; ?></h5>
                <h5 class="card-title">Nom d'élevage :<?php echo $nomElevage; ?></h5>
                <h5 class="card-title">Sexe :<?php echo $sexe; ?></h5>
                <h5 class="card-title">Race :<?php echo $race; ?></h5>
                <h5 class="card-title">Née le :<?php echo $bdd->inverseDate($dateNaissance); ?></h5>
                <h4 class="card-text">Un nouveau loup ne remplace jamais
                  un vieux loup, il ne fait qu’agrandir le coeur.</h4>

               <!--    <span><a class="modif-donnees-utlisateur" href="modifier_donnes.html"><button>MODIFIER LES DONNES</button></a></span> -->
              </div>

            </div>
          </div>
        </div>
        <div class="col-xs-12 col-md-6">
          <img src="<?php echo $cheminPhoto; ?>" width="100%">

            <!-- 	<h2>Create your snippet's HTML, CSS and Javascript in the editor tabs</h2> -->
          </div>
        </div>
      </div>
    </div>
    <!-- ////////////  FIN ANNIER IMAGE   /////////-->
      <!-- SECTION 1 ARTICLE > -->
      <form method="GET" action="article.php">
      <div class="divInvisib">
      <input name="idLoup" value="<?php echo $_POST['idLoup']; ?>" class="divInvisib">
      <button type="submit" class="btn btn-primary btn-lg btn-block">
          <h1>ECRIRE UN ARTICLE</h1>
        </button>
        </form>
        </div>
        <?php
$articles = $bdd->selectArticlesById($_POST["idLoup"]);
echo "<div class='row'>";
foreach ($articles as $article) {
// récupération de l'url de la photo et du texte
    $lien = $article["cheminPhoto"];
    $lien = substr($lien, -32);
    $texte = $article["texte"];
    echo '
                    <div class="col-md-4">                
                      <div class="card">
                      <form action="commentaire.php" method="post">
                          <div class="divInvisib col-lg-4">
                              <input type="hidden" name="idArticle" value="' . $article["id"] . '"></input>
                              <input type="image" src=' . $lien . ' class="card-img-top" alt="' . $texte . '" width="140" height="140"></input>
                          </div>
                          <div class="card-body">
                            <p class="card-text">'.$texte.'</p>
                          </div>
                      </form>
                    </div>
                  </div>
          ';
}
echo "</div>";
?>
      
    </main><!-- ////////////  FIN  SECTION DE NOTRE CONTENT MAIN  /////////-->

    <!-- ////////////   SECTION DE NOTRE MENU FOOTER MENU  /////////-->
    <footer class="container">
        <p class="float-right"><a href="#">Back to top</a></p>
        <p>© 2019 InstaWolf, Inc.<!--  · <a href="#">Privacy</a> · <a href="#">Terms</a> --></p>
      </footer>
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
            <a class="nav-link" href="profil_utilisateur.php<?php if (isset($_SESSION['id'])) {echo '?id=' . $_SESSION['id'];}?>">PROFIL</a>
          </li>

         <!--  <li class="nav-item">
            <a class="nav-link" href="#">AGRANDIR LA MEUTE</a>
          </li> -->

        </ul>
        <!--INPUT SEARCH -->
        <form class="form-inline container-search" method="GET" action="recherche.html">
          <input class="form-control mr-sm-2  input-search"  name="recherche" type="search" placeholder="Recherche" aria-label="Recherche">
          <button class="btn btn-outline-success my-2 my-sm-0 " href="recherche.html" type="submit">Recherche</button>
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