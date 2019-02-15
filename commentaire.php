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
        <!-- BANNIER PROFIL UTILISATEUR  -->
 
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
        if (isset($_GET['id'])){
            $article=$bdd->selectArticleById($_GET['id']);
            $texte=$article["texte"];
            $cheminPhoto=$article["cheminPhoto"];
            $cheminPhoto = substr($cheminPhoto, -32);
            $datePublication=$article["datePublication"];
        echo '<div class="row ">';
        echo   '<div class="col-md-6 container-article">';
        echo        '<div class="card">';
        echo            '<img class="card-img-top" src='.$cheminPhoto.' alt="image article">';
        echo            '<div class="card-body">';
        echo                '<p class="card-text">'.$texte.'</p>';
        echo            '</div>';
        echo        '</div>';
        echo    '</div>';
        echo '</div>';

        echo '<hr>';
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
                    <div class="card gedf-card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab"
                                        aria-controls="posts" aria-selected="true">Make
                                        a publication</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                                    <div class="form-group">
                                        <label class="sr-only" for="message">post</label>
                                        <textarea class="form-control" id="message" rows="3" placeholder="What are you thinking?"></textarea>
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile">
                                            <label class="custom-file-label" for="customFile">Upload image</label>
                                        </div>
                                    </div>
                                    <div class="py-4"></div>
                                </div>
                            </div>
                            <div class="btn-toolbar justify-content-between">
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-primary">share</button>
                                </div>
                                <div class="btn-group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-link dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-globe"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item" href="#"><i class="fa fa-globe"></i> Public</a>
                                        <a class="dropdown-item" href="#"><i class="fa fa-users"></i> Friends</a>
                                        <a class="dropdown-item" href="#"><i class="fa fa-user"></i> Just me</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Post /////-->

                    <!--- \\\\\\\Post-->
                    <div class="card gedf-card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="mr-2">
                                        <img class="rounded-circle" width="45" src="https://picsum.photos/50/50" alt="">
                                    </div>
                                    <div class="ml-2">
                                        <div class="h5 m-0">@LeeCross</div>
                                        <div class="h7 text-muted">Miracles Lee Cross</div>
                                    </div>
                                </div>
                                <div>
                                    <div class="dropdown">
                                        <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-h"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                                            <div class="h6 dropdown-header">Configuration</div>
                                            <a class="dropdown-item" href="#">Save</a>
                                            <a class="dropdown-item" href="#">Hide</a>
                                            <a class="dropdown-item" href="#">Report</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i>10 min ago</div>
                            <a class="card-link" href="#">
                                <h5 class="card-title">Lorem ipsum dolor sit amet, consectetur adip.</h5>
                            </a>

                            <p class="card-text">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo recusandae nulla rem eos
                                ipsa praesentium esse magnam nemo dolor
                                sequi fuga quia quaerat cum, obcaecati hic, molestias minima iste voluptates.
                            </p>
                        </div>
                        <div class="card-footer">
                            <a href="#" class="card-link"><i class="fa fa-gittip"></i> Like</a>
                            <a href="#" class="card-link"><i class="fa fa-comment"></i> Comment</a>
                            <a href="#" class="card-link"><i class="fa fa-mail-forward"></i> Share</a>
                        </div>
                    </div>
                    <!-- Post /////-->


                    <!--- \\\\\\\Post-->
                    <div class="card gedf-card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="mr-2">
                                        <img class="rounded-circle" width="45" src="https://picsum.photos/50/50" alt="">
                                    </div>
                                    <div class="ml-2">
                                        <div class="h5 m-0">@LeeCross</div>
                                        <div class="h7 text-muted">Miracles Lee Cross</div>
                                    </div>
                                </div>
                                <div>
                                    <div class="dropdown">
                                        <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-h"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                                            <div class="h6 dropdown-header">Configuration</div>
                                            <a class="dropdown-item" href="#">Save</a>
                                            <a class="dropdown-item" href="#">Hide</a>
                                            <a class="dropdown-item" href="#">Report</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i> 10 min ago</div>
                            <a class="card-link" href="#">
                                <h5 class="card-title"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit
                                    consectetur
                                    deserunt illo esse distinctio.</h5>
                            </a>

                            <p class="card-text">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam omnis nihil, aliquam
                                est, voluptates officiis iure soluta
                                alias vel odit, placeat reiciendis ut libero! Quas aliquid natus cumque quae
                                repellendus. Lorem
                                ipsum dolor sit amet consectetur adipisicing elit. Ipsa, excepturi. Doloremque,
                                reprehenderit!
                                Quos in maiores, soluta doloremque molestiae reiciendis libero expedita assumenda fuga
                                quae.
                                Consectetur id molestias itaque facere? Hic!
                            </p>
                            <div>
                                <span class="badge badge-primary">JavaScript</span>
                                <span class="badge badge-primary">Android</span>
                                <span class="badge badge-primary">PHP</span>
                                <span class="badge badge-primary">Node.js</span>
                                <span class="badge badge-primary">Ruby</span>
                                <span class="badge badge-primary">Paython</span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="#" class="card-link"><i class="fa fa-gittip"></i> Like</a>
                            <a href="#" class="card-link"><i class="fa fa-comment"></i> Comment</a>
                            <a href="#" class="card-link"><i class="fa fa-mail-forward"></i> Share</a>
                        </div>
                    </div>
                    <!-- Post /////-->


                </div>
                <div class="col-md-3">
                 <!--   colonne de guache vide -->
                </div>
            </div>
        </div>
        <hr>

        <!-- PAGINATION OPTIONEL -->
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
        <!-- BUTTON RAJOUTE PLUS DE COMMENTAIRES DE LA LIST -->
        <button type="button" class="btn btn-primary btn-lg btn-block">
            <h1>VOIR PLUS DE COMMENTAIRES</h1>
        </button>
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
                    <a class="nav-link" href="profil_utilisateur.php<?php if(isset($_SESSION['id'])) { echo '?id='.$_SESSION['id'];} ?>">PROFIL</a>
                </li>

                <!-- <li class="nav-item">
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