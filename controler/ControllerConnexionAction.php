<?php
session_start();
//include('../view/viewSignUp
//include('./model/User.php');
//include ('ControllerSignUpAction.php');
error_reporting(E_ALL);
ini_set('display-errors','on');

/**
 * Class ControllerConnexionAction
 */
class ControllerConnexionAction
{
    private $test;
    public function __construct()
    {
        $this->verif();
    }

    /**
     * Dans cette fonction on vérifie le couple mdp/pseudo
     * Et si le captcha est bon
     * Ensuite on redirige l'utilisateur sur la page d'Acceuil
     */
    public function verif()
    {
    	if(empty($_POST['name']) || empty($_POST['password'])){
    		$_SESSION['erreur'] = 'Remplir les champs !';
          header('Location:Connexion');
    	}
    	else{
        $recaptcha = new \ReCaptcha\ReCaptcha('6Lcy3XMUAAAAADkAvu0vbHEM8GURkxLbYOGCoWnh');

        $resp = $recaptcha->verify($_POST['g-recaptcha-response']);
    		$nameconect = htmlspecialchars($_POST['name']);
   			$mdpconnect = sha1($_POST['password']);
   			$aUser = new User($nameconect,$mdpconnect, "", "");
   			$test = new UserModel();
   			if($test->connexion($aUser) == true){
          if ($resp->isSuccess() === true){
            if($test->userConfirm($aUser) == true){
              echo 'Vous êtes connecté en tant que :'.'<br/>';
            $_SESSION['pseudo'] = $nameconect;

           header("location:index");
           $_SESSION['burn'] = array();
         }else{
          $_SESSION['erreur'] = 'Compte non confrimé !';
          header('Location:Connexion');
         }
            
          }else{
            $_SESSION['erreur'] = 'Captcha erreur !';
          header('Location:Connexion');
          }


   			}
   			else{
          $_SESSION['erreur'] = 'Mauvais identifiant !';
   				header('Location:Connexion');
   			}
    	}
    }
}
?>