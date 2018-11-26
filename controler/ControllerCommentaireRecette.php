<?php
session_start();
//include('../view/viewSignUp
//include('./model/User.php');
//include ('ControllerSignUpAction.php');
error_reporting(E_ALL);
ini_set('display-errors','on');

/**
 * Class ControllerCommentaireRecette
 */
class ControllerCommentaireRecette
{
    private $test;
    public function __construct()
    {
        $this->verif();
    }

    /**
     * Ajout du commentaire si tout est ok
     */
    public function verif()
    {;
        if(empty($_SESSION['pseudo']))
        {
            $_SESSION['erreur2'] = "Vous devez vous connecter !";
            header('Location:ContenuRecette?id='.$_SESSION['recette']);
        }
        else
        {
            if(empty($_POST['commentaireRecette']))
            {
            echo 'vide';
            }
            else
            {
                $commentaire = htmlspecialchars($_POST['commentaireRecette']);
                $test = new RecetteModel();
                $test->postCommentaire($commentaire,$_SESSION['pseudo'],$_SESSION['recette']);
                header('Location:ContenuRecette?id='.$_SESSION['recette']);
            }
        }
    	
    }
}
?>