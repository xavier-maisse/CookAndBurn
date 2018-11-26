<?php
require_once('view/View.php');
include('./model/Recette.php');
include ('./model/RecetteModel.php');
require_once ('./model/reCaptcha/autoload.php');
session_start();

/**
 * Class ControllerCreationRecette
 */
class ControllerCreationRecette
{
    private $_userModel;
    private $_ingredientsModel;
    private $_view;
    public function __construct()
    {
        if(isset($url))
            throw new Exception('Page introuvable');
        else
            $this->creationRecette();
    }

    /**
     * On genere la vue de Creation de recette
     * On passe dans un tableau , tous les ingrédients et toutes les catégories
     */
    public function creationRecette()
    {

        $this->_userModel = new UserModel();
        $this->_ingredientsModel = new IngredientsModel();
        $categories = $this->_ingredientsModel->getCategories();
        $ingredients = $this->_ingredientsModel->getAll();
        if(isset($_SESSION['pseudo'])){
           $this->_view = new View('CreationRecette'); 
        }
        else{
            header('Location:Error');
        }
        $this->_view->generate(array("ingredients" => $ingredients, "iM" => $this->_ingredientsModel, "categories" => $categories));

    }
}

