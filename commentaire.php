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
    <link rel="stylesheet" href="css/commentaire.css">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    <title>Article</title>
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
        <!-- BANNIER PROFIL UTILISATEUR  -->
        <?php
if (isset($_GET['id'])) {
    $temps = 3600;
    setcookie("idArticle", $_GET['id'], time() + $temps);
    $article = $bdd->selectArticleById($_GET['id']);
} elseif (isset($_POST["idArticle"])) {
    $temps = 3600;
    setcookie("idArticle", $_POST['idArticle'], time() + $temps);
    $article = $bdd->selectArticleById($_POST['idArticle']);
} else {
    $idArticle = $_COOKIE["idArticle"];
    $article = $bdd->selectArticleById($idArticle);
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
                  <h5 class="card-title">Lisez tous les commentaires de meute des loups </h5>
                  <h5 class="card-text">Un nouveau loup ne remplace jamais un vieux loup, il ne fait qu’agrandir le coeur.</h5>

                 <!--    <span><a class="modif-donnees-utlisateur" href="modifier_donnes.html"><button>MODIFIER LES DONNES</button></a></span> -->
                </div>

              </div>
            </div>
          </div>
          <div class="col-xs-12 col-md-6">
            <div class="bg bg-right">

              <!-- 	<h2>Create your snippet's HTML, CSS and Javascript in the editor tabs</h2> -->
            </div>
          </div>
        </div>
      </div>
      <!-- ////////////  FIN ANNIER IMAGE   /////////-->
     <!--  <a href="article.html"> <button type="button" class="btn btn-primary btn-lg btn-block">
            <h1>ECRIRE UN ARTICLE</h1>
          </button></a> -->

        <!-- SECTION 1 ARTICLE RECUPERER DE LA PAGE PROFIL CHIEN -->
        <h3 class="mt-3 pb-3 mb-4 font-italic border-bottom">
           <!--  DERNIERS ARTICLES -->
        </h3>
        <?php

$idAnimal = $article["idAnimal"];
$idUtilisateur = $_SESSION["id"];
$texteArticle = $article["texte"];
$cheminPhoto = $article["cheminPhoto"];
$cheminPhoto = substr($cheminPhoto, -32);


$datePublication = $article["datePublication"];
$date = substr($datePublication, 0, 10);
$date = $bdd->inverseDate($date);
$heure = substr($datePublication, -8);
echo '<div class="row ">';
echo '<div class="col-md-6 container-article">';
echo '<div class="card">';
echo '<img class="card-img-top" src=' . $cheminPhoto . ' alt="image article">';
echo '<div class="card-body">';
echo '<p class="card-text">' . $texteArticle . '</p>';
echo '</div>';
echo '</div>';
echo '<p> Publié le ' . $date . ' à ' . $heure . '</p>';
echo '</div>';
echo '</div>';

echo '<hr>';

if (isset($_POST["texte"])) {
    $texteCommentaire = $_POST["texte"];
    $bdd->insertCommentaire($idUtilisateur, $idAnimal, $texteCommentaire, date('Y-m-d h-i-s'));
}
?>
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
            integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
            crossorigin="anonymous"></script>



        <div class="container-fluid gedf-wrapper">
            <div class="row">
                <div class="col-md-3">
                   <!--  c'est la colonne de droit vide -->
                </div>
                <div class="col-md-6 gedf-main">

                    <!--- \\\\\\\Post-->
                    <form method="post" action="commentaire.php">
                    <div class="card gedf-card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab"
                                        aria-controls="posts" aria-selected="true">Rédiger
                                        un commentaire</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                                    <div class="form-group">
                                        <label class="sr-only" for="message">post</label>
                                        <textarea class="form-control" name="texte" id="message" rows="3" placeholder="Qu'en pensez-vous?" value=""></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-toolbar justify-content-between">
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-primary">Partager</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>


                    <?php
$commentaires = $bdd->selectCommentairesById($idUtilisateur,$idAnimal);
// var_dump($commentaires);
echo "<div class='row'>";
foreach ($commentaires as $commentaire) {
// Récupération du texte
    $pseudo = $bdd->searchPseudoById($_SESSION["id"]);
    $texteC = $commentaire["texte"];
    $datePub = $commentaire["datePublication"];
    echo '
    <div class="card gedf-card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex justify-content-between align-items-center">
                <div class="ml-2">
                    <div class="h5 m-0">@'.$pseudo.'</div>
                    <div class="h7 text-muted">'.$pseudo.'</div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i>'.$bdd->TimeToJourJ($datePub).'</div>
        <p class="card-text">
            '.$texteC.'
        </p>
    </div>
    <div class="card-footer">
        <a href="#" class="card-link"><i class="fa fa-gittip"></i> Like</a>
        <a href="#" class="card-link"><i class="fa fa-comment"></i> Comment</a>
        <a href="#" class="card-link"><i class="fa fa-mail-forward"></i> Share</a>
    </div>
</div>
</div>
';
}
?>

                    <!--- \\\\\\\Post-->

                <div class="col-md-3">
                 <!--   colonne de guache vide -->
                </div>
            </div>
        </div>
        <hr>

    </main><!-- ////////////  FIN  SECTION DE NOTRE CONTENT MAIN  /////////-->
    <footer class="container">
            <p class="float-right"><a href="#">Back to top</a></p>
            <p>© 2019 InstaWolf, Inc.<!--  <a href="#">Privacy</a> · <a href="#">Terms</a></p> -->
          </footer>
    <!-- ///////////////////////////////////////////////////////////////////// -->
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
                    <a class="nav-link" href="profil_utilisateur.php<?php if (isset($_SESSION['id'])) {echo '?id=' . $_SESSION['id'];}?>">PROFIL</a>
                </li>

                <!-- <li class="nav-item">
                    <a class="nav-link" href="#">AGRANDIR LA MEUTE</a>
                </li> -->

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