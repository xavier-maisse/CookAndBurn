<?php
//include('../view/viewSignUp
//include('./model/User.php');
//include ('ControllerSignUpAction.php');
session_start();
error_reporting(E_ALL);
ini_set('display-errors','on');

/**
 * Class ControllerChangeMdpAction
 */
class ControllerChangeMdpAction
{
    public function __construct()
    {
        $this->changeMdp();
    }

    /**
     * fonction pour changer de mdp
     */
    public function changeMdp()
    {
        if(empty($_POST['oldMdp']) || empty($_POST['newMdp']) || empty($_POST['confirmMdp']))
        {
            echo "Champs non remplie";
        }
        else
        {
            if($_POST['newMdp'] == $_POST['confirmMdp'] )
            {
                $oldMdp = sha1($_POST['oldMdp']);
                $newMdp = sha1($_POST['newMdp']);

                $test = new UserModel();
                $test->mdpChange($_SESSION['pseudo'], $oldMdp, $newMdp);
            }
            else
            {
                echo "pas egal";
            }
        }

    }
}

?>