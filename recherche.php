<?php
session_start();
require 'connexion.php';
$bdd=new Connexion;



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
  <title>Recherche de loup</title>
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
                <form>
                  <label class="sr-only" for="usrname">Pseudo</label>
                  <p>Pseudo:</p>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Votre surnom" aria-label="Username"
                      aria-describedby="basic-addon1">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Adresse email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                      placeholder="Entrer adresse email">
                    <small id="emailHelp" class="form-text text-muted">Nous ne la partagerons avec personne...</small>
                  </div>


                  <label class="sr-only" for="Password">Mot de passe:</label>
                  <p>Mot de passe:</p>
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

    <div class="container-search texte_centre">
        <h1>Recherche de loups</h1>
        <form action="recherche.php" method="post">
        <input type=text id=recherche name="recherche" placeholder="Veuillez taper votre recherche de profils ici" autofocus>
        <br>
        <br>

        <input id="submit_chrch" type="submit" value="Rechercher" style=font-size:150%;border-radius:45%;height:3em;>
        </form>

        
    </div>
<div class="container">
	<div class="row">
		<div class="row">

        <?php
          if(isset($_POST["recherche"])){

            $resultat = $bdd->selectAnimalByPatern($_POST["recherche"]);

              foreach($resultat as $animal){
                $lien = $animal->getCheminPhoto();
                $lien = substr($lien, -32);
                  echo '<div class="col-lg-3 col-md-4 col-xs-6 thumb">
                          <p>Surnom: '.$animal->getSurnom().'</p>
                          <p>NomElevage: '.$animal->getNomElevage().'</p>
                          <p>Race: '.$animal->getRace().'</p>
                          <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                            data-image="'.$lien.'"
                            data-target="#image-gallery">
                              <img class="img-thumbnail"
                                  src="'.$lien.'"
                                  alt="Another alt text">
                          </a>
                       </div>';

              }
          
        }else {


          $resultat = $bdd->selectAllLoups();

                foreach($resultat as $animal){

                  echo '<div class="col-lg-3 col-md-4 col-xs-6 thumb">
                          <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                            data-image="'.$animal->getCheminPhoto().'"
                            data-target="#image-gallery">
                              <img class="img-thumbnail"
                                  src="'.$animal->getCheminPhoto().'"
                                  alt="Another alt text">
                          </a>
                      </div>';

              }


        }
        ?>
            
            <!-- <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                   data-image="https://images.pexels.com/photos/853168/pexels-photo-853168.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                   data-target="#image-gallery">
                    <img class="img-thumbnail"
                         src="https://images.pexels.com/photos/853168/pexels-photo-853168.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                         alt="Another alt text">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                   data-image="https://images.pexels.com/photos/158971/pexels-photo-158971.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                   data-target="#image-gallery">
                    <img class="img-thumbnail"
                         src="https://images.pexels.com/photos/158971/pexels-photo-158971.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                         alt="Another alt text">
                </a>
            </div>

            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                   data-image="https://images.pexels.com/photos/305070/pexels-photo-305070.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                   data-target="#image-gallery">
                    <img class="img-thumbnail"
                         src="https://images.pexels.com/photos/305070/pexels-photo-305070.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                         alt="Another alt text">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Test1"
                   data-image="https://images.pexels.com/photos/853168/pexels-photo-853168.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                   data-target="#image-gallery">
                    <img class="img-thumbnail"
                         src="https://images.pexels.com/photos/853168/pexels-photo-853168.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                         alt="Another alt text">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Im so nice"
                   data-image="https://images.pexels.com/photos/158971/pexels-photo-158971.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                   data-target="#image-gallery">
                    <img class="img-thumbnail"
                         src="https://images.pexels.com/photos/158971/pexels-photo-158971.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                         alt="Another alt text">
                </a>
            </div>



            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Im so nice"
                   data-image="https://images.pexels.com/photos/305070/pexels-photo-305070.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                   data-target="#image-gallery">
                    <img class="img-thumbnail"
                         src="https://images.pexels.com/photos/305070/pexels-photo-305070.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                         alt="Another alt text">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Im so nice"
                   data-image="https://images.pexels.com/photos/853168/pexels-photo-853168.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                   data-target="#image-gallery">
                    <img class="img-thumbnail"
                         src="https://images.pexels.com/photos/853168/pexels-photo-853168.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                         alt="Another alt text">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Im so nice"
                   data-image="https://images.pexels.com/photos/158971/pexels-photo-158971.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                   data-target="#image-gallery">
                    <img class="img-thumbnail"
                         src="https://images.pexels.com/photos/158971/pexels-photo-158971.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                         alt="Another alt text">
                </a>
            </div>



            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Im so nice"
                   data-image="https://images.pexels.com/photos/305070/pexels-photo-305070.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                   data-target="#image-gallery">
                    <img class="img-thumbnail"
                         src="https://images.pexels.com/photos/305070/pexels-photo-305070.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                         alt="Another alt text">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Im so nice"
                   data-image="https://images.pexels.com/photos/853168/pexels-photo-853168.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                   data-target="#image-gallery">
                    <img class="img-thumbnail"
                         src="https://images.pexels.com/photos/853168/pexels-photo-853168.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                         alt="Another alt text">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="Im so nice"
                   data-image="https://images.pexels.com/photos/158971/pexels-photo-158971.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                   data-target="#image-gallery">
                    <img class="img-thumbnail"
                         src="https://images.pexels.com/photos/158971/pexels-photo-158971.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                         alt="Another alt text">
                </a>
            </div>
        </div>


        <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="image-gallery-title"></h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img id="image-gallery-image" class="img-responsive col-md-12" src="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary float-left" id="show-previous-image"><i class="fa fa-arrow-left"></i>
                        </button>

                        <button type="button" id="show-next-image" class="btn btn-secondary float-right"><i class="fa fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div> -->
	</div>
</div>
  </main><!-- ////////////  FIN  SECTION DE NOTRE CONTENT MAIN  /////////-->



  <!-- ////////////   SECTION DE NOTRE MENU FOOTER MENU  /////////-->
  <footer class="container">
      <p class="float-right"><a href="#">Back to top</a></p>
      <p>© 2017-2018 Company, Inc.<!--  · <a href="#">Privacy</a> · <a href="#">Terms</a> --></p>
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
          <a class="nav-link" href="profil_utilisateur.php<?php if(isset($_SESSION['id'])) { echo '?id='.$_SESSION['id'];} ?>">PROFIL</a>
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
</body>

</html>