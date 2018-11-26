<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->

<?php
include ('./controler/ControllerConnexionAction.php');?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $t; ?></title>
    <link rel="icon" type="image/gif" href="./images/favicon.png" />

	<meta name="httpcs-site-verification" content="HTTPCS4303HTTPCS" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Tasty Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- bootstrap-css -->
    <link href="./css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <!--// bootstrap-css -->
    <!-- css -->
    <link rel="stylesheet" href="./css/style.css" type="text/css" media="all" />
    <link rel="stylesheet" href="./css/halloween.css" type="text/css" media="all" />
    <!--// css -->
    <!-- font-awesome icons -->
    <link href="./css/font-awesome.css" rel="stylesheet">
    <link href="./css/squelette.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap-multiselect.css" type="text/css"/>
    <!-- //font-awesome icons -->
    <!-- font -->
    <link href='//fonts.googleapis.com/css?family=Francois+One' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Cinzel+Decorative:400,700,900' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700italic,700,400italic,300italic,300' rel='stylesheet' type='text/css'>
    <!-- //font -->
    <script src="./js/jquery-1.11.1.min.js"></script>
    <script src="./js/bootstrap.js"></script>
    <script src="./js/SmoothScroll.min.js"></script>
    <script src="js/bootstrap-multiselect.js"></script>
</head>
<body>
<script src="./js/jquery.vide.min.js"></script>
<div style="background: url('../view/video/cook.jpg') bottom fixed; background-size : 100%;">
    <!-- banner -->

    <div class="banner">
        <div class="container">
            <div class="header">
                <div class="logo">
                    <h1><a href="index">Cook And Burn</a></h1>
                </div>
            <?php
            if(isset($_SESSION['pseudo']) and $_SESSION['pseudo']== "adm")
            {
                ?>
                <div class="top-nav">

                    <nav class="navbar navbar-default">

                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">Menu
                        </button>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                            <ul class="nav navbar-nav">

                                <li><a class="<?php if($t == "Cook And Burn") echo "active";?>" href="index">Accueil</a></li>
                                <li><a class="<?php if($t == "Panel") echo "active";?>" href="panel">Panel</a></li>
                                <li><a class="<?php if($t == "Profil") echo "active";?>" href="profil">Mon profil</a></li>
                                <li><a class="<?php if($t == "Création recette") echo "active";?>" href="creationRecette">Créer une recette</a></li>
                                <li><a class="<?php if($t == "Tutos") echo "active";?>" href="tuto">Les tutos</a></li>
                                <li><form method ="post" class = "contact-form">
                                        <a><input type="submit" style="margin-top:-15%" type="submit" name="deco" value ="Déconnexion"/></a>
                                    </form></li>
                                <br/>
                            </ul>
                            <?php
                                if(isset($_POST['deco'])) {session_destroy(); header('location:index');}
                            ?>
                        </div>
                    </nav>
                </div>
            <?php
            }
            elseif(isset($_SESSION['pseudo']))
            {
                ?>
                <div class="top-nav">

                    <nav class="navbar navbar-default">

                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">Menu
                        </button>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                            <ul class="nav navbar-nav">

                                <li><a class="<?php if($t == "Cook And Burn") echo "active";?>" href="index">Accueil</a></li>
                                <li><a class="<?php if($t == "Profil") echo "active";?>" href="profil">Mon profil</a></li>
                                <li><a class="<?php if($t == "Création recette") echo "active";?>" href="creationRecette">Créer une recette</a></li>
                                <li><a class="<?php if($t == "Tutos") echo "active";?>" href="tuto">Les tutos</a></li>
                                <li><form method ="post" class = "contact-form">
                                        <a><input type="submit" style="margin-top:-15%" type="submit" name="deco" value ="Déconnexion"/></a>
                                    </form></li>
                                <br/>
                            </ul>
                            <?php
                                if(isset($_POST['deco'])) {session_destroy(); header('location:index');}
                            ?>
                        </div>
                    </nav>
                </div>
            <?php
            }
            else
            {
            ?>
                <div class="top-nav">
                    <nav class="navbar navbar-default">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">Menu
                        </button>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li><a class="<?php if($t == "Cook And Burn") echo "active";?>" href="index">Accueil</a></li>
                                <li><a class="<?php if($t == "Connexion") echo "active";?>" href="Connexion">Connexion</a></li>
                                <li><a class="<?php if($t == "Tutos") echo "active";?>" href="tuto">Les Tutos</a></li>
                                <br/>
                            </ul>
                        </div>
                    </nav>
                </div>
            <?php
            }
            ?>
                <div class="clearfix"> </div>



    <!-- //banner -->
</div>
<!-- special -->
<?php echo $content; ?>
<!-- //special -->


<!-- footer -->
<div class="footer">
    <div class="container">
        <div class="footer-grids">
            <div class="footer-heading">
                <h3>Suivez-nous aussi sur les réseaux !</h3>
            </div>
            <div class="footer-icons">
                <ul>
                    <li><a href="https://twitter.com/CookandB?fbclid=IwAR0htnL8MQmsfBhMSna2R76Cbddg4dMNcEmAwuU_enuG0R49SpalgXAvWZY" target=_blank class="twitter"><i class="fa fa-twitter"></i></a><span>Twitter</span></li>
                    <li><a href="https://www.facebook.com/Cook-And-Burn-2083965681934223/" target=_blank class="twitter facebook"><i class="fa fa-facebook"></i></a><span>Facebook</span></li>
                    <li><a href="https://plus.google.com/collection/sY-HPF" target=_blank class="twitter chrome"><i class="fa fa-google-plus"></i></a><span>Google +</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- //footer -->
<!-- copyright -->
<div class="copyright">
    <div class="container">
        <div class="w3agile-list">
            <ul>
                <?php
                    if(isset($_SESSION['pseudo']) and $_SESSION['pseudo']== "adm")
                    {
                ?>
                        <li><a class="<?php if($t == "Cook And Burn") echo "active";?>" href="index">Accueil</a></li>
                        <li><a class="<?php if($t == "Panel") echo "active";?>" href="panel">Panel</a></li>
                        <li><a class="<?php if($t == "Profil") echo "active";?>" href="profil">Mon profil</a></li>
                        <li><a class="<?php if($t == "Création recette") echo "active";?>" href="creationRecette">Créer une recette</a></li>
                        <li><a class="<?php if($t == "Tutos") echo "active";?>" href="tuto">Les tutos</a></li>
                <?php
                    }
                    elseif(isset($_SESSION['pseudo']))
                    {
                ?>
                        <li><a class="<?php if($t == "Cook And Burn") echo "active";?>" href="index">Accueil</a></li>
                        <li><a class="<?php if($t == "Profil") echo "active";?>" href="profil">Mon profil</a></li>
                        <li><a class="<?php if($t == "Création recette") echo "active";?>" href="creationRecette">Créer une recette</a></li>
                        <li><a class="<?php if($t == "Tutos") echo "active";?>" href="tuto">Les tutos</a></li>
                <?php
                    }
                    else
                    {
                    ?>
                        <li><a class="<?php if($t == "Cook And Burn") echo "active";?>" href="index">Accueil</a></li>
                        <li><a class="<?php if($t == "Connexion") echo "active";?>" href="Connexion">Connexion</a></li>
                        <li><a class="<?php if($t == "Tutos") echo "active";?>" href="tuto">Les tutos</a></li>
                <?php
                    }
                    ?>

            </ul>
            
        </div>
        <div class="agileinfo">
            <p>© 2018 Cook And Burn . Design by <a href="http://w3layouts.com/">W3layouts</a></p>
        </div>
    </div>
    
    <div class="wrapper">
    <div class="skeleton">
      <div class="head">
        <div class="head-hemispheres"></div>
        <div class="eye-shadow eye-shadow-left"></div>
        <div class="eye eye-left"></div>
        <div class="eye-shadow eye-shadow-right"></div>
        <div class="eye eye-right"></div>
        <div class="nose"></div>
        <div class="nose-shadow"></div>
        <div class="mouth">
          <div class="teeth teeth-left"></div>
          <div class="teeth teeth-right"></div>
        </div>
      </div>
      <div class="below-head-container">
        <div class="backbone"></div>
        <div class="body">
          <div class="body-inner">
            <div class="main-bone"></div>
            <div class="shoulder"></div>
            <div class="rib-cage rib-cage-1"></div>
            <div class="rib-cage rib-cage-2"></div>
            <div class="kidney-cover"></div>
            <div class="kidney kidney-left"></div>
            <div class="kidney kidney-right"></div>
            <div class="hand hand-left">
              <div class="hand-top"></div>
              <div class="arm"></div>
              <div class="arm-below-container">
                <div class="forearm"></div>
                <div class="wrist"></div>
                <div class="finger finger-pinky"></div>
                <div class="finger finger-thumb"></div>
                <div class="finger finger-ring"></div>
                <div class="finger finger-index"></div>
              </div>
            </div>
            <div class="hand hand-right">
              <div class="hand-top"></div>
              <div class="arm"></div>
              <div class="arm-below-container">
                <div class="forearm"></div>
                <div class="wrist"></div>
                <div class="finger finger-pinky"></div>
                <div class="finger finger-thumb"></div>
                <div class="finger finger-ring"></div>
                <div class="finger finger-index"></div>
              </div>
            </div>
          </div>
          <div class="feet-container">
            <div class="foot foot-left">
              <div class="thigh"></div>
              <div class="leg leg-left"></div>
              <div class="shoe"></div>
            </div>
            <div class="foot foot-right">
              <div class="thigh"></div>
              <div class="leg leg-right"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="shadow"></div>
    </div>
  </div>

</div>

<!-- //copyright -->
</body>
</html>
