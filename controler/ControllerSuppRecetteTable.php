<?php
session_start();
//include('../view/viewSignUp
//include('./model/User.php');
//include ('ControllerSignUpAction.php');
error_reporting(E_ALL);
ini_set('display-errors','on');

/**
 * Class ControllerSuppRecetteTable
 */
class ControllerSuppRecetteTable
{
    private $test;
    public function __construct()
    {
        $this->verif();
    }

    /**
     * Permet de supprimer la recette passé dans l'url de la BDD
     * Seulemet accessible pour l'admin
     */
    public function verif()
    {
        $_SESSION['profilASup'] = substr(strrchr($_SERVER['REQUEST_URI'], '='), 1);
        $idPro = htmlspecialchars($_SESSION['profilASup']);
        $test = new RecetteModel();
        $test->suppRecette($idPro);
                
        header("Location:recetteTable");
        
            
    
        
    	
    	
    }
}

?>
