<?php
require_once('view/View.php');
include('./model/User.php');
include ('./model/UserModel.php');
require_once ('./model/reCaptcha/autoload.php');
session_start();

/**
 * Class ControllerTuto
 */
class ControllerTuto
{
    private $_view;
    public function __construct()
    {
        if(isset($url))
            throw new Exception('Page introuvable');
        else
            $this->tuto();
    }

    public function tuto()
    {
        $this->_view = new View('tuto');
        $this->_view->generate(array());

    }
}