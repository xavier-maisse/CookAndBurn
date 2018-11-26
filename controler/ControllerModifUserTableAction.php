<?php
session_start();
//include('../view/viewSignUp
//include('./model/User.php');
//include ('ControllerSignUpAction.php');
error_reporting(E_ALL);
ini_set('display-errors','on');

/**
 * Class ControllerModifUserTableAction
 */
class ControllerModifUserTableAction
{
    /**
     * @var
     */
    private $test;

    /**
     * ControllerModifUserTableAction constructor.
     */
    public function __construct()
    {
        $this->verif();
    }

    /**
     * Permet de modifier les informations d'un utilisateur
     */
    public function verif()
    {
        $idPro = $_SESSION['profilSup'];
        if(empty($_POST['nom']) or empty($_POST['mail']))
        {

            $_SESSION['erreur'] = 'Remplir tout les champs !';
            header("Location:ModifUserTable?id=$idPro");
        }
        else
        {
            $nom = htmlspecialchars($_POST['nom']);
            $mail = htmlspecialchars($_POST['mail']);
            $id = htmlspecialchars($_SESSION['profilSup']);
            $test = new UserModel();
            if(filter_var($mail, FILTER_VALIDATE_EMAIL))
            {
                //Tout est bon
                $test->UpdateUser($id,$mail,$nom);
                $_SESSION['reussi'] = 'Modifié !';
                header("Location:ModifUserTable?id=$idPro");
            }
            else
            {
                $_SESSION['erreur'] = 'Mail non valide !';
                header("Location:ModifUserTable?id=$idPro");
            }
            
        }
        
    	
    	
    }
}

?>

