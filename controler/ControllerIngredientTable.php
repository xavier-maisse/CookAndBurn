<?php
require_once('view/View.php');
include('./model/User.php');
include ('./model/UserModel.php');
require_once ('./model/reCaptcha/autoload.php');
session_start();

/**
 * Class ControllerIngredientTable
 */
class ControllerIngredientTable
{
    /**
     * @var
     */
    private $_userModel;
    /**
     * @var
     */
    private $_view;
    /**
     * @var
     */
    private $_recetteModel;

    /**
     * ControllerIngredientTable constructor.
     * @throws Exception
     */
    public function __construct()
    {
        if(isset($url))
            throw new Exception('Page introuvable');
        else
            $this->ingredientTable();
    }

    /**
     * Affiche la vue pour gérer les ingrédients
     * On verifie que l'utilisateur connecté soit bien l'administrateur
     */
    public function ingredientTable()
    {
        $this->_userModel = new UserModel();
        $this->_recetteModel = new RecetteModel();

        $this->_ingredientModel = new IngredientsModel();
        if(isset($_SESSION['pseudo']) AND $_SESSION['pseudo']=='adm'){
           $this->_view = new View('ingredientsTable'); 
        }
        else{
            header('Location:Error');
        }
        $this->_view->generate(array("uM" => $this->_userModel, "rM" => $this->_recetteModel, "in"=> $this->_ingredientModel));



    }
}