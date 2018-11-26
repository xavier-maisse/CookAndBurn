<?php
require_once('view/View.php');
include('./model/User.php');
include ('./model/UserModel.php');
require_once ('./model/reCaptcha/autoload.php');
session_start();

/**
 * Class ControllerRecetteFav
 */
class ControllerRecetteFav
{
    /**
     * @var FavorisModel
     */
    private $_favorisModel;
    /**
     * @var UserModel
     */
    private $_userModel;
    /**
     * @var View
     */
    private $_view;

    /**
     * ControllerRecetteFav constructor.
     * @throws Exception
     * appel de recFav
     */
    public function __construct()
    {
        if(isset($url))
            throw new Exception('Page introuvable');
        else
            $this->recFav();
    }

    /**
     * @fonction recFav
     * Initialisation de favorisModel, userModel
     * Generation de la vue
     */
    public function recFav()
    {

        $this->_favorisModel = new FavorisModel();
        $this->_userModel = new UserModel();
        $user = $this->_userModel->getByNom($_SESSION['pseudo']);
//        $favRec = $this->_favorisModel->getFavorisForUser();

        $this->_view = new View('RecetteFav');
        $this->_view->generate(array("fM" => $this->_favorisModel, "user" => $user));

    }
}