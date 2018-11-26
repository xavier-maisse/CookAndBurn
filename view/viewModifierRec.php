<?php
//    $rM = new RecetteModel();
//    $recToUpdate = $rM->getByTitre($_SESSION['recette']);
?>

</div>
</div>
</div>
</div>

<form action="ModifierRecAction" enctype="multipart/form-data" method="post">
    <div class="contact-form">
        <h3>Modifier ma recette</h3>
        <br/>
        <div class="container">
        <?php if(isset($_SESSION['erreur'])){
        ?>
        <div class="alert alert-danger" role="alert">
        <?php
            echo '<center><p>'.$_SESSION['erreur'].'</p></center>';
            unset($_SESSION['erreur']);
        ?>
        </div>
        <?php
        } ?>
        </div>

        <div class="blog">
            <div class="container">
                <div class="col-md-8 blog-top-left-grid">
                    <div class="left-blog left-single">
                        <div class="blog-left">
                            <div class="single-left-left">
                                <center>
                                    <h3> Modifier</h3>
                                    <img src="./files/<?php echo $recToUpdate->getImage();?>" width = "250em" height="250em">
                                    <input style="display:inline" type="file" name="imageRecette" placeholder="Description de la recette"/>
                                    <h3> Titre de la recette </h3>
                                    <input type="text" name="nameRecette" value ="<?php echo $recToUpdate->getTitre()?>" />
                                    <h3> Description brève de la recette </h3>
                                    <textarea class="form-control" name="descriptionRecette"><?php echo $recToUpdate->getDescription()?></textarea>
                                    <h3> Description complète de la recette</h3>
                                    <textarea class="form-control" name="descriptionRecette2"><?php echo $recToUpdate->getDescriptionDet()?></textarea>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 blog-top-right-grid">
                    <div class="categories">
                        <div class="alert alert-info" role="alert">
                            <p> Veuillez ré-inserer vos ingrédients si vous voulez modifiez ces derniers.</p>
                        </div>
                        <h3> Choix des ingredients </h3>
                        <br/>
                        <select name="ingredients[]" onchange='affiche();' id="lesIngredients" multiple >
                            <?php
                            $i = 0;
                            foreach ($categories as $categorie) :?>

                                <optgroup  label="<?php echo $categorie;?>">
                                    <?php foreach($iM->getIngredientByCat($categorie) as $ingredient) :
                                        ?>

                                        <option name="<?php echo $ingredient;?>"><?php echo $ingredient;?> </option>
                                        <?php ++$i;
                                    endforeach; ?>
                                </optgroup>


                            <?php
                            endforeach;
                            ?>

                        </select>
                        <br/><br/>
                        <script type="text/javascript">
                            $(document).ready(function() {
                                $('#lesIngredients').multiselect({ enableFiltering: true,
                                    includeSelectAllOption: false,
                                    nonSelectedText: 'Veuillez selectionner des ingredients',
                                    filterPlaceholder:'Recherche',
                                    maxHeight:200,
                                    buttonWidth:"100%"});

                            });

                            function affiche() {
                                var selectBox =document.getElementById("lesIngredients"),i, span = document.getElementById('affichage');
                                span.innerHTML=''
                                var j=0
                                for (i=0; i < selectBox.length; i++)
                                {
                                    if (selectBox[i].selected)
                                    {

                                        //trim permet d'enlever les espaces au debut et a la fin
                                        span.innerHTML += selectBox[i].innerHTML.trim() + '<br/>'+
                                            '<input type="number" min="0" name="'+selectBox[i].innerHTML.trim()+'"/>' +
                                            //post incrementation pour incrementer apres avoir mis la mesure actuel
                                            '<select name="mesure'+ j++ +'">' +
                                            '<option value ="gramme"> gramme </option>'+
                                            '<option value ="litre"> litre </option>'+
                                            '<option value ="millilitre"> millilitre </option>'+
                                            '<option value ="cuillère à café"> cuillère à café </option>'+
                                            '<option value ="cuillère"> cuillère </option>'+
                                            '<option value ="cuillère à soupe"> cuillère à soupe </option>'+
                                            '</select> <br><br>'


                                        ;


                                        ;
                                    }
                                }
                            }
                        </script>
                        <div id="affichage"> </div>
                        <br/><br/>

                    </div>
                    <div class="clearfix"> </div>
                    <div class="categories">
                        <center>
                            <h3> Selectionnez les étapes</h3>
                            <br/>

                            <?php
                            $i=1;
                            foreach(preg_split("/((\r?\n)|(\r\n?))/", $recToUpdate->getEtapesNl()) as $line){
                                ?>

                                <p>Etape <?php echo $i;?> : </p>
                                <textarea name="etape <?php echo $i++;?>"><?php echo trim($line); ?></textarea>
                                </br>

                                <?php
                            }
                            ?>
                            <select name="etapes[]" onchange='affiche2();' id="lesEtapes" multiple>
                                <?php
                                for($i; $i <= 30; ++$i)
                                {
                                    ?>
                                    <option value="etape <?php echo $i;?>"> etape <?php echo $i;?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <br/> <br/>
                            <script type="text/javascript">
                                $(document).ready(function() {
                                    $('#lesEtapes').multiselect({ enableFiltering: false,
                                        includeSelectAllOption: false,
                                        nonSelectedText: 'Selectionner les étapes que vous voulez rajouter',
                                        maxHeight:200,
                                        buttonWidth:"100%"});

                                });

                                function affiche2() {
                                    var selectBox =document.getElementById("lesEtapes"),i, span = document.getElementById('affichageEtapes');
                                    span.innerHTML=''
                                    var j=0
                                    for (i=0; i < selectBox.length; i++)
                                    {
                                        if (selectBox[i].selected)
                                        {
                                            //trim permet d'enlever les espaces au debut et a la fin
                                            span.innerHTML += selectBox[i].innerHTML.trim() +
                                                '<textarea name="'+selectBox[i].innerHTML.trim()+'"></textarea><br/><br/>';
                                            //post incrementation pour incrementer apres avoir mis la mesure actuel

                                        }
                                    }
                                }
                            </script>
                            <div id="affichageEtapes"></div>
                            </center>
                    </div>
                    <div class="clearfix"> </div>
                    <div class="categories">
                        <h3>Nombre de personnes</h3> <br/>
                        <input  type="number" min="0" name="nombrePersonne" value="<?php echo $recToUpdate->getNombrePersonne();?>"/>
                    </div>
                    <div class="categories">
                        <input text-align="center" type="submit"  rows="10" cols="50" name="action" value="Modifier !"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

