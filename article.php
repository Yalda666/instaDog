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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
    integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/article.css">
  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
  <title>Créer article</title>
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
        <input class="form-control mr-sm-2  input-search" name="recherche" type="search" placeholder="Recherche"
          aria-label="Recherche">
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
  <?php
if (isset($_GET['idLoup'])) {
    $temps = 3600;
    setcookie("idLoup", $_GET['idLoup'], time() + $temps);
}
if (isset($_POST['forminscription'])) {
    // var_dump($_POST);
    // var_dump($_GET);
    $idAnimal = $_COOKIE['idLoup'];
    $suffixe = date("YmdHis");
    $newMessage = htmlspecialchars($_POST['new_message']);
    $uploadedFileName = $_FILES["photo-promenade"]["name"];
    $uploadedFile = new SplFileInfo($uploadedFileName);
    $fileExtension = $uploadedFile->getExtension();
    $destinationFolder = $_SERVER['DOCUMENT_ROOT'] . "/instaWolf/Photos/";
    $destinationName = "photo-" . $suffixe . "." . $fileExtension;
    // var_dump($idAnimal);
    // var_dump($newMessage);
    // var_dump($destinationFolder . $destinationName);
    // var_dump(date('Y-m-d h-i-s'));


    echo $_FILES["photo-promenade"]["error"];

    if (move_uploaded_file($_FILES["photo-promenade"]["tmp_name"], $destinationFolder . $destinationName)) {
        echo "<br/> fichier enregistré avec succes";
    }

    if (!empty($_POST['new_message'])) {
        $messageLength = strlen($newMessage);
        if ($messageLength <= 320) {
            $bdd->insertArticle($idAnimal, $newMessage, $destinationFolder.$destinationName, date('Y-m-d h-i-s'));
            $id=$bdd->selectArticleByText($newMessage);
            $erreur = "Votre article a bien été créé !";
            header("Location: commentaire.php?id=" . $id);
        } else {
            $erreur = "Votre texte est trop long !";
        }
    } else {
        $erreur = "Tous les champs doivent être complétés !";
    }
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
                <h5 class="card-title">Postez votre article sur InstaWolf</h5>
                <p class="card-text">Il semble que l’univers nous a donné trois choses pour rendre la vie
                  supportable: l’espoir, les blagues et les loups.
                  Mais le plus grand de ces cadeaux c’est les LOUPS.</p>
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

    <button type="button" class="btn btn-primary btn-lg btn-block">
      <h1>Ecrivez votre article</h1>
    </button>

    <div class="text-article">
      <div class="row">
        <div class="span4 well" style="padding-bottom:0">

        </div>

        <form class="textarea" accept-charset="UTF-8" action="article.php" method="POST" enctype="multipart/form-data">

          <textarea class="span4" id="new_message" name="new_message" placeholder="Ecrivez ici votre article"
            rows="5"></textarea>
          <div id="container-upload-article">
            <input type="hidden" name="MAX_FILE_SIZE" value="300000000" />
            <p><input type="file" name="photo-promenade" onchange="change(this)" id="form-file"></p>
            <p><img id="image" src="" alt="Votre image"></p>
          </div>
      </div>

      <h6 class="pull-right">Maximum 320 caractères</h6>
      <button class="btn btn-info registre-article" name="forminscription" type="submit">Enregistrer l'article</button>
      </form>
      <?php
if (isset($erreur)) {
    echo '<font color="red">' . $erreur . "</font>";
}
?>
    </div>
    </div>
    </div>
  </main><!-- ////////////  FIN  SECTION DE NOTRE CONTENT MAIN  /////////-->

  <!-- ////////////   SECTION DE NOTRE MENU FOOTER MENU  /////////-->
  <footer class="container">
    <p class="float-right"><a href="#">Back to top</a></p>
    <p>© 2019 InstaWolf, Inc.
      <!--  <a href="#">Privacy</a> · <a href="#">Terms</a></p> -->
  </footer>
  <nav class="navbar navbar-expand-lg navbar-light bg-warning col-sm-6 col-md-4 col-lg-6 col-xl-12">
    <a class="navbar-brand container-logo" href="accueil.php"></a>
    <img class="logo" src="images/logo_final.png" alt="Tete de loup" width="10%"></img></a>
    <a class="navbar-brand" href="#">InstaWolf</a>

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
      <form class="form-inline container-search" method="GET" action="recherche.html">
        <input class="form-control mr-sm-2  input-search" name="recherche" type="search" placeholder="Recherche"
          aria-label="Recherche">
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
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
    integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
    crossorigin="anonymous"></script>

  <script src="js/bootstrap.js"></script>
  <script src="js/javascript.js"></script>
</body>

</html>