<?php
session_start();
//include('../view/viewSignUp
//include('./model/User.php');
//include ('ControllerSignUpAction.php');
error_reporting(E_ALL);
ini_set('display-errors','on');

/**
 * Class ControllerModifRecetteTableAction
 */
class ControllerModifRecetteTableAction
{
    private $test;
    public function __construct()
    {
        $this->verif();
    }

    /**
     * Permet de modifier une recette à partir du panel Admin
     */
    public function verif()
    {
        $idPro = $_SESSION['profilSup'];
        if(empty($_POST['nom']) or empty($_POST['description']) or empty($_POST['descriptiondet']) or empty($_POST['auteur']) or empty($_POST['ingredients']) or empty($_POST['nombre'] or empty($_POST['etapes'])))
        {

            $_SESSION['erreur'] = 'Remplir tout les champs !';
            header("Location:ModifUserRecette?id=$idPro");
        }
        else
        {
            $etapes = htmlspecialchars($_POST['etapes']);
            $nom = htmlspecialchars($_POST['nom']);
            $description = htmlspecialchars($_POST['description']);
            $descriptiondet = htmlspecialchars($_POST['descriptiondet']);
            $auteur = htmlspecialchars($_POST['auteur']);
            $ingredients = htmlspecialchars($_POST['ingredients']);
            $nombre = htmlspecialchars($_POST['nombre']);
            $test = new RecetteModel();
            if($nombre > 0)
            {

                //Tout est bon
                $test->UpdateRecette($idPro,$nom,$description,$descriptiondet,$etapes,$auteur,$ingredients,$nombre);
                $_SESSION['reussi'] = 'Modifié !';
                header("Location:ModifUserRecette?id=$idPro");
            }
            else
            {
                $_SESSION['erreur'] = 'Le nombre de personne doit être positif!';
                header("Location:ModifUserRecette?id=$idPro");
            }
            
        }
        
    	
    	
    }
}

?>

