
<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
<script type="text/javascript" src="./js/pagination.js"></script>
<script type="text/javascript" src="./js/affichageLettre.js"></script>
<script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<?php
session_start();
$this->_t = 'Cook And Burn';
//$fM = new  RecetteModel();
//$bestRec = $fM->getBestRec();

?>
<div class="banner-info">
    <h2><p id="lien"></p></h2>
    <p> Suite à l'achat de votre barbecue votre compte sera automatiquement créée, c'est fou n'est-ce pas ? <br/>
    Cook and Burn sera votre meilleur ami pour profiter pleinement de votre nouvelle acquisition !<br/>
    Comment ça marche ? Cela est très simple, vous et tous les autres possesseurs du barbecue, pourrez partager <br/>
    vos meilleures recettes, y laisser des commentaires mais aussi y ajouter un petit burn !<br/>
    Et qui sait ? Avec un peu de chance votre recette possèdera plus de 15 burns et sera affichée sur l'accueil !</p>
</div>
<div class="banner-grads">
    <div class="col-md-4 banner-grad">
        <div class="banner-grad-img">
            <img src="images/b1.jpg" alt="" />
            <h4>Délicieux</h4>
        </div>
    </div>
    <div class="col-md-4 banner-grad">
      <div class="banner-grad-img">
            <img src="images/b2.jpg" alt="" />
            <h4>Raffinée</h4>
       </div>
    </div>
    <div class="col-md-4 banner-grad">
        <div class="banner-grad-img">
        <img src="images/b3.jpg" alt="" />
        <h4>À point</h4>
        </div>
    </div>
    <div class="clearfix"> </div>
</div>
</div>
</div>
</div>


<!--<div class="special">
    <div class="container">
        <div class="special-heading">
            <h3>La meilleure recette !</h3>
        </div>
            <div class="special-heading" >
                <a href="ContenuRecette?id=<?php echo (urlencode($bestRec->getTitre()));?>" >
                <img  height="300" width="250"src="./files/<?php echo $bestRec->getImage();?>" alt="" ></a>
            <h4> <?php echo $bestRec->getTitre();?> </h4>
            </div>
            </div>

    </div>
</div>-->

<div class="special">
    <div class="container">
        <div class="special-heading">
            <h3>La meilleure recette !</h3>
        </div>
        <div class="w3ls-menu-grids">
            <div class="menu-top-grids agileinfo">
                <div class="col-md-8 col-md-offset-4">
                        <div class="col-md-6 menu-grid">
                            <div class="agile-menu-grid img-rounded">
                                <a href="ContenuRecette?id=<?php echo (urlencode($bestRec->getTitre()));?>" />
                                <img src="./files/<?php echo $bestRec->getImage();?>" alt="" width ="170em" height ="270em" />
                                <div class="agileits-caption">
                                    <h4><?php echo $bestRec->getTitre();?> </h4>
                                </div>
                                </a>
                            </div>
                        </div>
                </div>
            </div>

        </div>
    </div>
</div>




<div class="container">
        <div class="special-heading">
        <h3>Toutes les recettes</h3>
    </div>


    <div class="container">
        <h2><font color="white">Recettes</font></h2>
    </div>
    <table id="myTable" class="table table-striped" >
    <thead>
    <tr>
    <th>Recette</th>
    <th>Informations</th>
    </tr>
    </thead>
    <tbody>
<?php
if(isset($_SESSION['pseudo']))
{


foreach($recette as $rec) :
?>
<tr>
<td width="800em">
<a href="ContenuRecette?id=<?php print_r(urlencode($rec->getTitre()));?>"> <img src="./files/<?php echo $rec->getImage();?>" alt="" width ="170em" height ="200em"  /></a>
    <h1><?php echo $rec->getTitre(); ?></h1><br/>
    <p><?php echo $rec->getDescription();?> </p> <br/> <br/>

</td>
<td>
    
    <p style="color: red"><?php echo $rec->getIngredientBr();?></p> <br/>
    <button type="button" class="btn btn-danger btn-lg" disabled="disabled"><?php echo $rec->getNombreBurn();?> burns</button>

</td>
</tr>


<?php endforeach;
}
else
{
    foreach($recForInvit as $rec) :
?>
<tr>
<td width="800em" ><a href="ContenuRecette?id=<?php print_r(urlencode($rec->getTitre()));?>"> <img src="./files/<?php echo $rec->getImage();?>" alt="" width ="170em" height ="200em"  /></a>
    <h1><?php echo $rec->getTitre(); ?></h1><br/>
    <p><?php echo $rec->getDescription();?></p><br/> <br/><br/>


</td>
<td width="400em">
    <p style="color: red;"><?php echo $rec->getIngredientBr();?></p> <br/>
    <button type="button" class="btn btn-danger btn-lg" disabled="disabled"><?php echo $rec->getNombreBurn();?> burns</button>

</td>
</tr>

<?php
    endforeach;
}
?>
</tbody>
</table>
 </tbody>
   </table>
     </div>
       </body>
         <script>
         $(document).ready(function(){
$('#myTable').dataTable({
"lengthMenu": [[2, 5, 10, -1], [2, 5, 10, "Toutes"]]
})

});
</script>
</div>

</html>

