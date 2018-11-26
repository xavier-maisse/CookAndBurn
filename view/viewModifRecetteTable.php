<?php
session_start();
$_SESSION['profilSup'] = substr(strrchr($_SERVER['REQUEST_URI'], '='), 1); 
    $this->_t = "Panel";
//    $rM = new RecetteModel();
//    $uM = new UserModel();
    ?>

</div>
</div>
</div>
</div>




<link href="./css/admin/style.css" rel='stylesheet' type='text/css' />
<link href="./css/admin/style-responsive.css" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

<script src="./admin/js/jquery2.0.3.min.js"></script>
<script src="./admin/js/raphael-min.js"></script>
<script src="./admin/js/morris.js"></script>

<body>
<section id="container">

<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="Panel">
                        <i class="fa fa-dashboard"></i>
                        <span>Tableau de bord</span>
                    </a>
                </li>
            
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-th"></i>
                        <span>Les tables</span>
                    </a>
                    <ul class="sub">
                        <li><a href="userTable">User Table</a></li>
                        <li><a href="recetteTable">Recette Table</a></li>
                    </ul>
                </li>
                
            </ul>            </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		<!-- //market-->
		<div class="market-updates">
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-2">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-eye"> </i>
					</div>
					 <div class="col-md-8 market-update-left">
					 <h4>Recettes</h4>
					<h3><?php echo $rM->nbRecettes() ?></h3>
					<p>postées</p>
				  </div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-1">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-users" ></i>
					</div>
					<div class="col-md-8 market-update-left">
					<h4>Utilisateurs</h4>
						<h3><?php echo $uM->nbUsers() ?></h3>
						<p>créés</p>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-3">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-usd"></i>
					</div>
					<div class="col-md-8 market-update-left">
						<h4>Commentaires</h4>
						<h3><?php echo $rM->nbCom() ?></h3>
						<p>publiés</p>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-4">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-shopping-cart" aria-hidden="true"></i>
					</div>
					<div class="col-md-8 market-update-left">
						<h4>Partage</h4>
						<h3>1,500</h3>
						<p>sur les réseaux</p>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
		   <div class="clearfix"> </div>
		</div>	
		<!-- //market-->
		<div class="row">
			<div class="panel-body">
				<div class="col-md-12 w3ls-graph">
					<!--agileinfo-grap-->
						<div class="agileinfo-grap">
							<div class="agileits-box">
								<header class="agileits-box-header clearfix">
									<h3>Modification : </h3>
										<div class="toolbar">
											
											
										</div>
								</header>
								<div class="agileits-box-body clearfix">
									<div id="hero-area"></div>
								</div>
							</div>
						</div>

						<div class="agileinfo-grap">
							<div class="agileits-box">
								<header class="agileits-box-header clearfix">
										<div class="toolbar">
											
											<form action="ModifRecetteTableAction" method="post">
												<label>Nom recette</label><br/>
												<input type="text" name="nom" placeholder="name"><br/><br/>

												<label>Description</label><br/>
												<input type="textarea" name="description" placeholder="name"><br/><br/>

												<label>Description détaillée</label><br/>
												<input type="textarea" name="descriptiondet" placeholder="name"><br/><br/>

												<label>Auteur</label><br/>
												<input type="text" name="auteur" placeholder="name"><br/><br/>

												<label>Ingredients</label><br/>
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

												<label>Etapes</label><br/>
												<textarea class="form-control" name="etapes" placeholder="Description de la recette"></textarea>
												<p> Aller à la ligne pour chaque étapes ! </p><br/><br/>

												<label>Nombre de personne</label><br/>
												<input type="number" name="nombre" placeholder="name"><br/><br/>
												<?php if(isset($_SESSION['erreur'])){
                									echo '<p><span class="label label-danger">'.$_SESSION['erreur'].'</span>';
               										 unset($_SESSION['erreur']);
           										 } ?>
           										 <?php if(isset($_SESSION['reussi'])){
                									echo '<p><span class="label label-success">'.$_SESSION['reussi'].'</span>';
               										 unset($_SESSION['reussi']);
           										 } ?>
												<p><br/>
                									<input type="submit" name="action" value="Modifier"/>
            									</p>
											</form>
											
										</div>
								</header>
								<div class="agileits-box-body clearfix">
									<div id="hero-area"></div>
								</div>
							</div>

	
</section>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/scripts.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="js/jquery.scrollTo.js"></script>
<!-- morris JavaScript -->	
