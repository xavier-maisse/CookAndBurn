
<?php
session_start();
if(strpos($_SERVER['REQUEST_URI'], "fbclid"))
    $_SESSION['recette'] = strstr(substr(strstr($_SERVER['REQUEST_URI'], '='), 1),'&', true);
else
    $_SESSION['recette'] = substr(strstr($_SERVER['REQUEST_URI'], '='), 1);


$titre = substr(strstr($_SERVER['REQUEST_URI'], '='), 1);

$marec = $rM->getByTitre(urldecode($_SESSION['recette']));
$mescom = $rM->getCommentaire($_SESSION['recette']);
$this->_t = $marec->getTitre();


?>
    </div>
    </div>
    </div>
    </div>

<!--Facebook -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v3.1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class = "container">
    <?php
//    $rM = new RecetteModel();
//    $uM = new UserModel();
//    $bM = new BurnModel();
//    $fM = new FavorisModel();

//    $marec = $rM->getByTitre($titre);
    if(isset($_SESSION['pseudo']))
//        $user = $uM->getByNom($_SESSION['pseudo']);

    ;?>
    <center>
        <div class="contact-form">
            <span>

                <?php

                    if(!isset($_SESSION['pseudo']))
                    {

                ?>
            <form style="display :inline" method="post" action="MettreFavorisAction">
                <input type="submit" name="actionFav" value="Mettre en favoris"/>
            </form>
            <form style="display :inline" method="post" action="BurnAction">
                <input type="submit" action="BurnAction" value="Ajouter un burn"/>
            </form>
                <?php

                    }
                    else
                    {
                        if(!$bM->verifAlreadyBurn($user,$marec))
                        {

                ?>

            <form style="display :inline" method="post" action="BurnAction">
                <input type="submit" name="BurnAction" value="Mettre un burn"/>
            </form>

                <?php
                        }
                        else {
                ?>
            <form style="display :inline" method="post" action="BurnAction">
                <input type="submit" name="BurnAction" value="Enlever un burn"/>
            </form>
                <?php
                        }

                        if(!$fM->verifAlreadyFav($user, $marec))
                        {
                ?>

            <form style="display :inline" method="post" action="MettreFavorisAction">
                <input type="submit" name="actionFav" value="Mettre en favoris"/>
            </form>
                <?php
                        }
                        else
                        {
                ?>
            <form style="display :inline" method="post" action="MettreFavorisAction">
                <input type="submit" name="actionFav" value="Enlever des favoris"/>
            </form>
            <?php
                        }
                        if($_SESSION['pseudo'] == $marec->getAuteur() || $_SESSION['pseudo'] == 'adm')
                        {
            ?>
            <form style="display :inline" method="post" action="SupprimerRecAction">
                <input type="submit" name="actionFav" value="Supprimer votre recette"/>
            </form>
            <form style="display :inline" method="post" action="ModifierRec">
                <input type="submit" name="actionFav" value="Modifier votre recette"/>
            </form>
          
            <?php

                        }
                    }

            ?>



            </span>
            <button type="button" class="btn btn-danger btn-lg"><?php echo $marec->getNombreBurn();?> burns</button>
            <?php if(isset($_SESSION['erreur']))
            {
                echo ' <br/> <br/><p><span class="label label-danger">'.$_SESSION['erreur'].'</span>';
                unset($_SESSION['erreur']);
            }
            ?>


         </div>
<!--        <h1> --><?php //echo $marec->getTitre();?><!-- </h1> </br>-->
<!--        <img src='./files/--><?php //echo $marec->getImage();?><!--' height ="10%" width="10%"/><br/>-->
<!--        <h2> Description </h2>-->
<!--        <p> --><?php //echo $marec->getDescription();?><!--</p> <br/>-->
<!--        <h2> Description détaillée </h2>-->
<!--        <p> --><?php //echo $marec->getDescriptionDet();?><!--</p> <br/>-->
<!--        <h2> Ingredients pour --><?php //echo $marec->getNombrePersonne();?><!-- personnes </h2>-->
<!--        <p> --><?php //echo $marec->getIngredient();?><!--</p> <br/><br/><br/>-->
<!--        <h1>Commentaires :</h1>-->
<!--        <div class="contact-form">-->
<!--            <div class="customer-info">-->
<!--                <p>--><?php //echo $rM->getCommentaire($titre);?><!--</p>-->
<!--            </div>-->
<!--        <form method="post" action="CommentaireRecette">-->
<!--            <textarea class="form-control" name="commentaireRecette">Ecrivez un commentaire</textarea>-->
<!--            <input class="btn" type="submit" name="action" value="Poster"/>-->
<!--        </form>-->
<!--        </div>-->


        <div class="blog">
            <div class="container">
                <div class="col-md-8 blog-top-left-grid">
                    <div class="left-blog left-single">
                        <div class="blog-left">
                            <div class="single-left-left">
                                <h3 style="color: #fd5c63;"> <?php echo $marec->getTitre();?> - Écrit par <?php echo $marec->getAuteur();?></h3>
                                <img src='./files/<?php echo $marec->getImage();?>'/><br/>
                            </div>
                            <div class="blog-left-bottom">
                                <p>
                                    <?php echo $marec->getDescriptionDet();?>
                                </p>
                            </div>
                        </div>
                    <div class="response">
                        <h3>Commentaires</h3>
                        <div class="media response-info">
                            <div class="media-body response-text-right">
                                <p><?php echo $mescom;?></p>

                            </div>
                            <div class="clearfix"> </div>
                        </div>
                    </div>

                    <div class ="opinion">
                        <h2> Ecrivez un commentaire </h2>
                        <form method="post" action="CommentaireRecette">
                            <textarea class="form-control" name="commentaireRecette">Ecrivez un commentaire</textarea><br/>
                            <?php if(isset($_SESSION['erreur2'])){
                            echo '<p><span class="label label-danger">'.$_SESSION['erreur2'].'</span>';
                            unset($_SESSION['erreur2']);
                            } ?>
                            <br/>
                            <input class="btn" type="submit" name="action" value="Poster"/>
                        </form>
                    </div>
                    <br/>


                </div>
                </div>

                <div class="col-md-4 blog-top-right-grid">
                    <div class="categories">
                        <h3> Description </h3> <br/>
                        <p><?php echo $marec->getDescription();?></p>
                    </div>
                    <div class="clearfix"> </div>
                    <div class="categories">
                        <h3> Ingredients - <?php echo $marec->getNombrePersonne()?> personnes</h3>
                        <p> <?php echo $marec->getIngredientBr();?> </p>
                    </div>
                    <div class="clearfix"> </div>
                    <div class="categories">
                        <h3> Les étapes</h3> <br/>
                        <p> <?php
                            $i = 1;
                            foreach(preg_split("/((\r?\n)|(\r\n?))/", $marec->getEtapesNl()) as $line):

                                echo 'Etape '.$i++.' : '.$line.'<br/> <br/>';
                            endforeach;

                            ?>
                        </p>
                    </div>
                    <div class="categories">
                        <h3> Partagez </h3><br/>
                        <div class="fb-share-button" data-size="large" data-href="http://cookandburn-gxaj.alwaysdata.net/ContenuRecette?id=<?php echo $_SESSION['recette']?>" data-layout="box_count" data-size="small" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fcookandburn-gxaj.alwaysdata.net%2FContenuRecette%3Fid%3D<?php echo $_SESSION['recette']?>&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Partager</a></div>
                    </div>
                </div>

            </div>
        </div>




    </center>

</div>