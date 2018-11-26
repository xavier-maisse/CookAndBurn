<?php
require_once('view/View.php');
include('./model/User.php');
include ('./model/UserModel.php');
require_once ('./model/reCaptcha/autoload.php');
session_start();

/**
 * Class ControllerModifierRec
 */
class ControllerModifierRec
{
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
    private $_userModel;
    /**
     * @var
     */
    private $_view;

    /**
     * ControllerModifierRec constructor.
     * @throws Exception
     */
    public function __construct()
    {
        if(isset($url))
            throw new Exception('Page introuvable');
        else
            $this->ModifRec();
    }

    /**
     * Génére la vue pour modifier une recette
     */
    public function ModifRec()
    {

        $this->_recetteModel = new RecetteModel();
        $this->_ingredientsModel = new IngredientsModel();

        $recToUpdate = $this->_recetteModel->getByTitre($_SESSION['recette']);
        $ingredients = $this->_ingredientsModel->getAll();
        $categories = $this->_ingredientsModel->getCategories();
        if(isset($_SESSION['pseudo']) and !empty($_SESSION['recette']) ){
           $this->_view = new View('ModifierRec'); 
        }
        else{
            header('Location:Error');
        }
        
        $this->_view->generate(array("categories" => $categories, "iM"=>$this->_ingredientsModel,"recToUpdate" => $recToUpdate,"ingredients" => $ingredients));

    }
}