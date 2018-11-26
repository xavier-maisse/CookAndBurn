<?php
require_once('view/View.php');
include('./model/User.php');
include ('./model/UserModel.php');
include('./model/Recette.php');
include ('./model/RecetteModel.php');
require_once ('./model/reCaptcha/autoload.php');
session_start();

/**
 * Class ControllerModifUserRecette
 */
class ControllerModifUserRecette
{
    /**
     * @var
     */
    private $_userModel;
    /**
     * @var
     */
    private $_recetteModel;
    /**
     * @var
     */
    private $_ingredientsModel;
    /**
     * @var
     */
    private $_view;

    /**
     * ControllerModifUserRecette constructor.
     * @throws Exception
     */
    public function __construct()
    {
        if(isset($url))
            throw new Exception('Page introuvable');
        else
            $this->modifTable();
    }

    /**
     * Affiche la vue pour modifier les recettes
     */
    public function modifTable()
    {

        $this->_userModel = new UserModel();
        $this->_recetteModel = new RecetteModel();
        $this->_ingredientsModel = new IngredientsModel();
        $categories = $this->_ingredientsModel->getCategories();
        $ingredients = $this->_ingredientsModel->getAll();
        if(isset($_SESSION['pseudo']) AND $_SESSION['pseudo']=='adm'){
           $this->_view = new View('ModifRecetteTable'); 
        }
        else{
            header('Location:Error');
        }
        $this->_view->generate(array("ingredients" => $ingredients,"uM" => $this->_userModel, "rM" => $this->_recetteModel,"iM" => $this->_ingredientsModel,"categories" => $categories));

    }
}


