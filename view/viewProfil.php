<?php
	session_start();
    $this->_t = "Profil";
//    $user = $uM->getByNom($_SESSION['pseudo']);

    if(isset($_POST['deco'])){
    	session_destroy();
    	header("Location: index");
    }

    if(isset($_POST['changeMail']))
    {
        header("Location:ChangeMail");
    }

    if(isset($_POST['changeMdp']))
    {
        header("Location:ChangeMdp");
    }

    if(isset($_POST['favRec']))
    {
        header("Location:RecetteFav");
    }

    if(isset($_POST['createdRec']))
    {
        header("Location:CreatedRec");
    }
    ?>

</div>
</div>
</div>
</div>

<?php 
	echo '<center><h1>'. 'Profil de : ' .$_SESSION['pseudo'] . '</h1></center>';
?>
<div class="contact-form">
	<form action="" method="post">

        <center/>
        <input type="submit" name="createdRec" value="Voir mes recettes">
        <input type="submit" name="favRec" value="Mes recettes favorites">
        <input type="submit" name="changeMail" value="Changer mon adresse mail">
        <input type="submit" name="changeMdp" value="Changer mon mot de passe">

    <br/><br/>
        <div class="container">
            <div class="alert alert-info" role="alert">
                Nous ne sommes pas en mesure d'afficher votre mot de passe car nous ne le stockons pas pour des raisons de sécurité.
            </div>
        </div>

        <p> Votre pseudo :</p>
        <input type="text" value="<?php echo $user->getNameUser();?>" readOnly="readonly">
        <p> Votre adresse mail :</p>
        <input type="text" value="<?php echo $user->getMailAdress();?>" readOnly="readonly"><br/>



        <input type="submit" name="deco" value="Me Déconnecter"></center>
	</form>
</div>