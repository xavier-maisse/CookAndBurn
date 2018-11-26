<?php
session_start();
//include('../view/viewSignUp
//include('./model/User.php');
//include ('ControllerSignUpAction.php');
error_reporting(E_ALL);
ini_set('display-errors','on');

/**
 * Class ControllerSuppIngredientTable
 */
class ControllerSuppIngredientTable
{
    private $test;
    public function __construct()
    {
        $this->verif();
    }

    /**
     * Permet de supprimer un ingrédient de la BDD
     * Seulement accessible pour l'admin
     */
    public function verif()
    {
        echo 'coucuo';
        $_SESSION['ingredientASup'] = substr(strrchr($_SERVER['REQUEST_URI'], '='), 1);
        $idPro = htmlspecialchars($_SESSION['ingredientASup']);
        $test = new IngredientsModel();
        $test->suppIngredient($idPro);     
        header("Location:ingredientTable");
        
            
    
        
    	
    	
    }
}

?>
