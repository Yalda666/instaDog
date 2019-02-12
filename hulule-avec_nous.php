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
  <link rel="stylesheet" href="css/hulule_avec_nous.css">

  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
  <title>Hulule avec nous</title>
</head>

<body>
  <?php
    require('connexion.php');
    $bdd = new Connexion;
    
    if(isset($_POST['forminscription'])) {
       $pseudo = htmlspecialchars($_POST['pseudo']);
       $mail = htmlspecialchars($_POST['mail']);
       $mail2 = htmlspecialchars($_POST['mail2']);
       $mdp = sha1($_POST['mdp']);
       $mdp2 = sha1($_POST['mdp2']);
       if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])) {
          $pseudolength = strlen($pseudo);
          if($pseudolength <= 255) {
             if(comparePassword($mail,$mail2)) {
                if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                   $reqmail = $bdd->prepare("SELECT * FROM Utilisateur WHERE email = ?");
                   $reqmail->execute(array($mail));
                   $mailexist = $reqmail->rowCount();
                   if($mailexist == 0) {
                      if(comparePassword($mdp,$mdp2)) {
                         $bdd->insertUtilisateur($pseudo, $mdp, $mail));
                         $erreur = "Votre compte a bien été créé ! <a href=\"connexion.php\">Me connecter</a>";
                      } else {
                         $erreur = "Vos mots de passes ne correspondent pas !";
                      }
                   } else {
                      $erreur = "Adresse mail déjà utilisée !";
                   }
                } else {
                   $erreur = "Votre adresse mail n'est pas valide !";
                }
             } else {
                $erreur = "Vos adresses mail ne correspondent pas !";
             }
          } else {
             $erreur = "Votre pseudo ne doit pas dépasser 255 caractères !";
          }
       } else {
          $erreur = "Tous les champs doivent être complétés !";
       }
    ?>
  <!-- ////////////  MENU DE NAVUGATION RESPONSIVE  /////////-->
  <nav class="navbar navbar-expand-lg navbar-light bg-warning col-sm-6 col-md-4 col-lg-6 col-xl-12">
    <a class="navbar-brand container-logo" href="accueil.html"></a>
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
          <a class="nav-link" href="accueil.html">ACCUEIL <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="profil_utilisateur.html">PROFIL</a>
        </li>
        <li class="nav-item deja_loup">
          <a class="nav-link btn btn-primary text-white" type="button" href="deja_loup.html">Déjà
            loup?</a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link btn btn-danger text-white hulule" type="button" href="hulule-avec_nous.html">Hulule
            avec nous!</a>
        </li> -->


      </ul>
      <!--INPUT SEARCH -->
      <form class="form-inline container-search" method="GET" action="recherche.html">
        <input class="form-control mr-sm-2  input-search" name="recherche" type="search" placeholder="Recherche"
          aria-label="Recherche">
        <button class="btn btn-outline-success my-2 my-sm-0 " href="recherche.html" type="submit">Recherche</button>
      </form>
      <!--// FIN SEARCH-->

    </div>
  </nav><!-- ////////////  FIN  MENU DE NAVUGATION RESPONSIVE  /////////-->

  <!-- ////////////   SECTION DE NOTRE CONTENT MAIN  /////////-->
  <main>
    <div class="container h-100">
      <div class="d-flex justify-content-center h-100">
        <div class="user_card">
          <div class="d-flex justify-content-center">
            <div class="brand_logo_container">
              <img src="images/logo_final.png" class="brand_logo" alt="Logo">
            </div>
          </div>
          <div class="d-flex justify-content-center form_container">
            <form method="POST" action="">
              <h2>Hurle avec nous!</h2>
              <div class="input-group mb-3">
                <div class="input-group-append">
                  <span class="input-group-text"><i class="fas fa-user" ;></i></span>
                </div>
                <input type="text" name="pseudo" id="pseudo" class="form-control input_user" value="<?php if(isset($pseudo)) { echo $pseudo; } ?>" placeholder="Votre pseudo">
              </div>

              <div class="input-group mb-3">
                <div class="input-group-append">
                  <span class="input-group-text"><i class="fas fa-user" ;></i></span>
                </div>
                <input type="email" name="email" id="mail" class="form-control input_user" value="<?php if(isset($mail)) { echo $mail; } ?>" placeholder="Votre email">
              </div>

              <div class="input-group mb-2">
                <div class="input-group-append">
                  <span class="input-group-text"><i class="fas fa-key"></i></span>
                </div>
                <input type="password" name="mdp" id=mdp class="form-control input_pass" value="" placeholder="Votre mot de passe">
              </div>

              <div class="input-group mb-2">
                <div class="input-group-append">
                  <span class="input-group-text"><i class="fas fa-key"></i></span>
                </div>
                <input type="password" name="mdp2" id="mdp2" class="form-control input_pass" value=""
                  placeholder="Confirmez votre mot de passe">
              </div>

              <!-- <div class="form-group">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="customControlInline">
                  <label class="custom-control-label" for="customControlInline">Remember me</label>
                </div>
              </div> -->

          </div>
          <div class="d-flex justify-content-center mt-3 login_container">
            <input id="submit_creer" name="forminscription" type="submit" value="Créer le compte!!!!"
              style=font-size:150%;border-radius:45%;height:3em;>
          </div>
          </form>
          <?php
         if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?>
          <div class="mt-4">
            <div class="d-flex justify-content-center links">
              Don't have an account? <a href="#" class="ml-2">Sign Up</a>
            </div>
            <div class="d-flex justify-content-center links">
              <a href="#">Forgot your password?</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main><!-- ////////////  FIN  SECTION DE NOTRE CONTENT MAIN  /////////-->

  <!-- ////////////   SECTION DE NOTRE MENU FOOTER MENU  /////////-->
  <nav class="navbar navbar-expand-lg navbar-light bg-warning col-sm-6 col-md-4 col-lg-6 col-xl-12">
    <a class="navbar-brand container-logo" href="accueil.html"></a>
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
          <a class="nav-link" href="accueil.html">ACCUEIL <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="profil_utilisateur.html">PROFIL</a>
        </li>

        <!-- <li class="nav-item">
          <a class="nav-link" href="inscription_chien.html">AGRANDIR LA MEUTE</a>
        </li> -->



      </ul>
      <!--INPUT SEARCH -->
      <form class="form-inline container-search" method="GET" action="recherche.html">
        <input class="form-control mr-sm-2  input-search" name="recherche" type="search" placeholder="Recherche"
          aria-label="Recherche">
        <button class="btn btn-outline-success my-2 my-sm-0 " href="recherche.html" type="submit">Recherche</button>
      </form>
      <!--// FIN SEARCH-->

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
</body>

</html>