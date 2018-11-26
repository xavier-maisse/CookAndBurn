<?php
session_start();
//include('../view/viewSignUp
//include('./model/User.php');
//include ('ControllerSignUpAction.php');
error_reporting(E_ALL);
ini_set('display-errors','on');

/**
 * Class ControllerSuppUserTable
 */
class ControllerSuppUserTable
{
    private $test;
    public function __construct()
    {
        $this->verif();
    }

    /**
     * Permet la suppression de l'utilisateur passé en parametre
     * Accessible seulement pour l'admin
     */
    public function verif()
    {
        $_SESSION['profilASup'] = substr(strrchr($_SERVER['REQUEST_URI'], '='), 1);
        $idPro = htmlspecialchars($_SESSION['profilASup']);
        echo $idPro;
        $test = new UserModel();
        $test->deleteUser($idPro);
        header("Location:userTable");
        
    	
    	
    }
}

?>

