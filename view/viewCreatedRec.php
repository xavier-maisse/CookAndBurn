<?php
session_start();
include("viewProfil.php");
?>

<div class="special">
    <div class="container">
        <?php
            if(empty($createdRec))
                {
        ?>
        <div class="special-heading">
            <h3>Vous n'avez pas encore créée de recette !</h3>
        </div>
        <?php
                }
                else
                {

        ?>

        <div class="special-heading">
            <h3>Voici vos recettes !</h3>
        </div>

        <?php
                }
        ?>
        <div class="w3ls-menu-grids">
            <div class="menu-top-grids agileinfo">
                <?php
                if(isset($_SESSION['pseudo']))
                {
                    foreach($createdRec as $favRe) :

                        ?>


                        <div class="col-md-3 menu-grid">
                            <div class="agile-menu-grid img-rounded">
                                <a href="ContenuRecette?id=<?php echo (urlencode($favRe->getTitre()));?>" />
                                <img src="./files/<?php echo $favRe->getImage();?>" alt="" width ="170em" height ="270em" />
                                <div class="agileits-caption">
                                    <h4><?php echo $favRe->getTitre();?> </h4>
                                    <!--                        <p> par --><?php //echo $favRec->getAuteur();?><!--</p>-->
                                </div>
                                </a>
                            </div>
                        </div>

                    <?php
                    endforeach;
                }
                ?>
            </div>

        </div>
    </div>
</div>

