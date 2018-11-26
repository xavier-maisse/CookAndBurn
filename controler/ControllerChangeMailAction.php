<?php
//include('../view/viewSignUp
//include('./model/User.php');
//include ('ControllerSignUpAction.php');
session_start();
error_reporting(E_ALL);
ini_set('display-errors','on');

/**
 * Class ControllerChangeMailAction
 */
class ControllerChangeMailAction
{
    private $test;

    /**
     * ControllerChangeMailAction constructor.
     */
    public function __construct()
    {
        $this->changeMail();
    }

    /**
     * fonction pour changer son mail.
     */
    public function changeMail()
    {
        if(empty($_POST['oldMail']) || empty($_POST['newMail']) || empty($_POST['newMail2']))
        {
            echo "Vous n'avez pas rempli tous les champs.";
        }
        else{
            $mail1 = htmlspecialchars($_POST['oldMail']);
            $mail2 = htmlspecialchars($_POST['newMail']);
            $mail3 = htmlspecialchars($_POST['newMail2']);

            $test = new UserModel();
            if(!filter_var($mail2, FILTER_VALIDATE_EMAIL) || !filter_var($mail1, FILTER_VALIDATE_EMAIL))
            {
                echo "Ce n'est pas une adresse mail valide";
            }
            else if($mail2 == $mail3)
            {
                $test->mailChange($_SESSION['pseudo'],$mail1,$mail2);

            }
            else
            {
                echo "votre nouveau mail ne correspond pas";
            }

        }

    }
}

?>