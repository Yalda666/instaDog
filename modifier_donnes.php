
<?php
session_start();
require 'connexion.php';

$bdd = new Connexion;

if (isset($_SESSION['id'])) {
    $user = $bdd->searchPersonneById($_SESSION['id']);
    if (isset($_POST['newpseudo']) and !empty($_POST['newpseudo']) and $_POST['newpseudo'] != $user['pseudo']) {
        $newpseudo = htmlspecialchars($_POST['newpseudo']);
        $bdd->updatePseudo($newpseudo, $_SESSION['id']);
    }
    if (isset($_POST['newmail']) and !empty($_POST['newmail']) and $_POST['newmail'] != $user['email']) {
        $newmail = htmlspecialchars($_POST['newmail']);
        $bdd->updateEmail($newmail, $_SESSION['id']);
    }
    if (isset($_POST['newmdp1']) and !empty($_POST['newmdp1']) and isset($_POST['newmdp2']) and !empty($_POST['newmdp2'])) {
        $mdp1 = sha1($_POST['newmdp1']);
        $mdp2 = sha1($_POST['newmdp2']);
        if ($mdp1 == $mdp2) {
            $bdd->updateMdp($mdp1, $_SESSION['id']);
        } else {
            $msg = "Vos deux mdp ne correspondent pas !";
        }
        header('Location: profil_utilisateur.php?id=' . $_SESSION['id']);
    }
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
  <link rel="stylesheet" href="css/modifier_donness.css">

  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
  <title>modifier données</title>
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
          <a class="nav-link" href="profil_chien.php" inactive>PROFIL</a>
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

              <!-- Modal Header -->
              <div class="modal-header deja_loup">
                <h4 class="modal-title">Déjà loup?</h4>
                <button type="button" class="close" data-dismiss="modal">×</button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                <form enctype="multipart/form-data" method="POST" action="">
                  <label class="sr-only" for="usrname">Pseudo</label>
                  <p>Pseudo:</p>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" name="newpseudo" value="<?php echo $user['pseudo']; ?>" placeholder="Votre pseudo" aria-label="Username"
                      aria-describedby="basic-addon1">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Adresse email</label>
                    <input type="email" class="form-control" name="newmail" value="<?php echo $user['mail']; ?>" id="exampleInputEmail1" aria-describedby="emailHelp"
                      placeholder="Entrez votre adresse email">
                    <small id="emailHelp" class="form-text text-muted">Nous ne la partagerons avec personne...</small>
                  </div>


                  <label class="sr-only" for="Password">Mot de passe:</label>
                  <p>Nouveau mot de passe:</p>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon2"><i class="fa fa-key"></i></span>
                    </div>
                    <input id="Password" type="password" name="newmdp1" class="form-control" placeholder="Déposez votre empreinte de loup"
                      aria-label="Mot de passe" aria-describedby="basic-addon2">
                  </div>

                  <label class="sr-only" for="Password">Mot de passe:</label>
                  <p>Retaper votre nouveau mot de passe:</p>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon2"><i class="fa fa-key"></i></span>
                    </div>
                    <input id="Password" type="password" class="form-control" placeholder="Déposez votre empreinte de loup"
                      aria-label="Mot de passe" aria-describedby="basic-addon2">
                  </div>
                </form>
              </div>
              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Rejoindre la meute</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Pas maintenant</button>
              </div>

            </div>
          </div>
      </ul>
      <!--INPUT SEARCH -->
      <form class="form-inline container-search" method="GET" action="recherche.html">
        <input class="form-control mr-sm-2  input-search"  name="recherche" type="search" placeholder="Recherche" aria-label="Recherche">
        <button class="btn btn-outline-success my-2 my-sm-0 " href="recherche.html" type="submit">Recherche</button>
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

    <div class="container register">
      <div class="row">
        <div class="col-md-3 register-left">
          <img src="images/logo_final.png" alt="logo instawolf" />
          <h3>Données personnelles</h3>
          <p>Changer vos données regulièrement pour plus de sécurité </p>
          <!-- <input type="submit" name="" value="huuuuu..." /><br /> -->
        </div>
        <div class="col-md-9 register-right">
          <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
            <!--   <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                aria-selected="true">Employee</a>
            </li> -->

          </ul>

          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
              <h3 class="register-heading"><p>Information</p></h3>
              <div class="row register-form">
                <div class="col-md-6">
                <form method="POST" action="modifier_donnes.php" enctype="multipart/form-data">
                  <div class="form-group">
                    <input type="text" class="form-control" name="newpseudo" placeholder="Votre nouveaux nom *" value="<?php echo $user['pseudo']; ?>" required/>
                  </div>

                  <div class="form-group">
                    <input type="email" class="form-control" name="newmail" placeholder="Votre nouvel e-mail *" value="<?php echo $user['email']; ?>" required/>
                  </div>
              <div class="form-group">
                <div class="form-group">
                  <input type="password" class="form-control" name="newmdp1" placeholder="Nouveau mot de passe *" value="" required/>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="newmdp2" placeholder="Confirmation de votre nouveau mot de passe *" value="" required/>
                </div>
                  </div>
                  <input type="submit" class="btnRegister" value="Mettre à jour mon profil !" action="modifier_donnes.php"/>
                </div>
                <?php if (isset($msg)) {echo $msg;}?>
                </form>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

  </main><!-- ////////////  FIN  SECTION DE NOTRE CONTENT MAIN  /////////-->
  <footer class="container">
      <p class="float-right"><a href="#">Back to top</a></p>
      <p>© 2017-2018 Company, Inc. ·<!--  <a href="#">Privacy</a> · <a href="#">Terms</a> --></p>
    </footer>
  <!-- ////////////   SECTION DE NOTRE MENU FOOTER MENU  /////////-->
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
          <a class="nav-link" href="profil_utilisateur.php" inactive>PROFIL</a>
        </li>

     <!--    <li class="nav-item">
          <a class="nav-link" href="#">AGRANDIR LA MEUTE</a>
        </li> -->



      </ul>
      <!--INPUT SEARCH -->
      <form class="form-inline container-search" method="GET" action="recherche.html">
        <input class="form-control mr-sm-2  input-search"  name="recherche" type="search" placeholder="Recherche" aria-label="Recherche">
        <button class="btn btn-outline-success my-2 my-sm-0 " href="recherche.html" type="submit">Recherche</button>
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

<?php
} else {
    header("Location: hulule-avec_nous.php");
}
?>