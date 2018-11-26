<?php
    $this->_t = "Création recette";
    ?>

</div>
</div>
</div>
</div>

<form name="t" action="RecetteAction" enctype="multipart/form-data" method="post">
    <div class="contact-form">
        <h3>Création de ma recette</h3>
        <div class="blog">
            <div class="container">
                <div class="col-md-8 blog-top-left-grid">
                    <div class="left-blog left-single">
                        <div class="blog-left">
                            <div class="single-left-left">
                                <center>
                                    <h3> Inserez une image</h3>
                                    <input style="display:inline" type="file" name="imageRecette" placeholder="Description de la recette"/>
                                    <h3> Titre de la recette </h3>
                                    <input type="text" name="nameRecette" placeholder ="Titre de la recette" />
                                    <h3> Description brève de la recette </h3>
                                    <textarea class="form-control" name="descriptionRecette" placeholder="Description de la recette"></textarea>
                                    <h3> Description complète de la recette</h3>
                                    <textarea class="form-control" name="descriptionRecette2" placeholder="Description de la recette plus longue"></textarea>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 blog-top-right-grid">
                    <div class="categories">
                        <h3> Choix des ingredients </h3>
                        <br/>
                            <select  name="ingredients[]" onchange='affiche();' id="lesIngredients" multiple >
                                <?php
                                $i = 0;
                                foreach ($categories as $categorie) :?>

                                    <optgroup  label="<?php echo $categorie;?>">
                                    <?php foreach($iM->getIngredientByCat($categorie) as $ingredient) :
                                    ?>

                                    <option name="<?php echo $ingredient;?>"> <?php echo $ingredient;?> </option>
                                    <?php ++$i;
                                    endforeach; ?>
                                    </optgroup>


                                <?php
                                endforeach;
                                ?>








                            </select>
                            <br/>
                            <script type="text/javascript">
                                $(document).ready(function() {
                                    $('#lesIngredients').multiselect({ enableFiltering: true,
                                        includeSelectAllOption: false,
                                        nonSelectedText: 'Veuillez selectionner des ingredients',
                                        filterPlaceholder:'Recherche',
                                        maxHeight:200,
                                        optgroup:false,
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
                                            span.innerHTML += "<br/> <p>" +selectBox[i].innerHTML.trim()+ "</p>"+
                                                '<input type="number" min="0" name="'+selectBox[i].innerHTML.trim()+'"/>' +
                                                //post incrementation pour incrementer apres avoir mis la mesure actuel
                                                '<select name="mesure'+ j++ +'">' +
                                                '<option value ="gramme"> gramme </option>'+
                                                '<option value ="litre"> litre </option>'+
                                                '<option value ="centilitre"> centilitre </option>'+
                                                '<option value =""> unité </option>'+
                                                '<option value ="millilitre"> millilitre </option>'+
                                                '<option value ="cuillère a café"> cuillère à café </option>'+
                                                '<option value ="cuillère"> cuillère </option>'+
                                                '<option value ="cuillère a soupe"> cuillère à soupe </option>'+
                                                '</select> <br><br>';
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
                        <select class ="form-control" name="etapes[]" onchange='affiche2();' id="lesEtapes" multiple>
                            <?php
                            for($i = 1; $i <= 30; ++$i)
                            {
                                ?>
                                <option class="form-control" value="etape <?php echo $i;?>">etape <?php echo $i;?></option>
                                <?php
                            }
                            ?>

                        </select>

                        <script type="text/javascript">
                            $(document).ready(function() {
                                $('#lesEtapes').multiselect({ enableFiltering: false,
                                    includeSelectAllOption: false,
                                    nonSelectedText: 'Selectionnez les étapes que vous souhaitez écrire',
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
                                        span.innerHTML += "<p>" +selectBox[i].innerHTML.trim() +"</p>" +
                                            '<textarea name="'+selectBox[i].innerHTML.trim()+'"> </textarea> <br/> <br/>';
                                        //post incrementation pour incrementer apres avoir mis la mesure actuel

                                    }
                                }
                            }
                        </script>
                        <br/> <br/>
                        <div id="affichageEtapes"></div> </center>
                    </div>
                    <div class="clearfix"> </div>
                    <div class="categories">
                        <h3>Nombre de personnes</h3> <br/>
                        <input  type="number" min="0" name="nombrePersonne" />
                    </div>
                    <div class="categories">
                        <input text-align="center" type="submit"  rows="10" cols="50" name="action" value="Créer !"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>





