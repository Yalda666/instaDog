<?php
session_start();
require 'connexion.php';
$bdd = new Connexion;

if (isset($_GET['id']) and $_GET['id'] > 0) {
    $getid = intval($_GET['id']);
    $requser = $bdd->selectUtilisateurById($getid);

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
  <link rel="stylesheet" href="css/profil_utilisateur.css">
  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
  <title>Profil Utilisateur</title>
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
          <a class="nav-link" href="profil_utilisateur.php" inactive>PROFIL</a>
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
  </nav>
  <!-- ////////////  FIN MENU DE NAVUGATION RESPONSIVE  /////////-->




  <!-- ////////////  BANNIER IMAGE   /////////-->


  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12 col-md-6">
        <div class="bg bg-left">
          <!--  <h2>Create your snippet's HTML, CSS and Javascript in the editor tabs</h2> -->
          <div class="card-img-overlay">
            <div class="donnees-perso">
              <h3 class="card-title">Nom : <?php echo $requser['pseudo']; ?></h3>
              <h5 class="card-title">Email : <?php echo $requser['email']; ?></h5>
              <!-- <h5 class="card-title">Race :</h5>
              <h5 class="card-title">Elevage :</h5>
              <h5 class="card-title">Née le :</h5>
              <h4 class="card-text">Les loups entrent dans notre vie pour nous enseigner l’amour,
                ils partentpour nous apprendre à perdre.Un nouveau loup ne remplace jamais
                un vieux loup,il ne fait qu’agrandirle coeur.</h4> -->
                <br />
                <?php
if (isset($_SESSION['id']) and $requser['id'] == $_SESSION['id']) {
        ?>
                <br />
                <a href="modifier_donnes.php">Editer mon profil</a>
                <a href="deconnexion.php">Se déconnecter</a>
                <?php
}
    ?>
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
  <?php
} else {
    header("Location: deja_loup.php");
    exit;
}
?>
  <!-- ////////////  FIN BANNIERE IMAGE   /////////-->
    <main role="main">

        <a href="inscription_chien.php"> <button type="button" class="btn btn-primary btn-lg btn-block">
            <h1>Agrandir la meute</h1>
          </button></a>
          <?php
$loups = $bdd->selectLoupsById($_GET["id"]);
echo "<div class='container marketing'>";
echo "<div class='row'>";
// Début du parcours du tableau d'ids retourné par la fonction search_personne
foreach ($loups as $loup) {
// récupération de l'url de la photo, du nom et du prénom
    $lien = $loup["cheminPhoto"];
    $lien = substr($lien, -32);
    $nom = $loup["nom"];
    $surnom = $loup["surnom"];
    echo '
                    <form action="profil_chien.php" method="post">
                        <div class="divInvisib col-lg-4">
                            <input type="hidden" name="idLoup" value="' . $loup["id"] . '"></input>
                            <input type="image" src=' . $lien . ' class="rounded-circle" alt="' . $nom . '" width="140" height="140"></input>
                        </div>
                        <p class="rounded-circle">' . $nom . '-> "' . $surnom . '"</p>
                    </td>
                    </form>
          ';
}
echo "</div>";
echo "</div>";
?>


    </main>

    <!-- FOOTER -->
    <!-- FOOTER -->
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
            <a class="nav-link" href="profil_utilisateur.php" inactive>PROFIL</a>
          </li>

        <!--   <li class="nav-item">
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