<?php
//include('../view/viewSignUp
//include('./model/User.php');
//include ('ControllerSignUpAction.php');
session_start();
error_reporting(E_ALL);
ini_set('display-errors','on');

/**
 * Class ControllerAjoutIngredient
 * Permet l'ajout d'un ingrédient dans la BDD
 *
 */

class ControllerAjoutIngredient
{
    public function __construct()
    {
        $this->ajoutIngredient();
    }

    public function ajoutIngredient()
    {
        if(empty($_POST['nomIngredient']))
        {
            $_SESSION['erreur'] = "Donne un nom d'ingrédient";
            header("Location:ingredientTable");
        }
        else
        {
            $nomIngredient = htmlspecialchars($_POST['nomIngredient']);
            $test = new IngredientsModel();
            $test->addIngredient($nomIngredient);
            $_SESSION['reussi'] = "Ingrédients ajouté";
            header("Location:ingredientTable");
        }

    }
}

?>