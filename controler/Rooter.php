<?php

/**
 * Class Rooter
 */
class Rooter
{
	private $_ctrl;
	private $_view;

    /**
     * fonction routereq
     */
	public function routeReq()
	{
		try
		{
			//CHARGEMENT AUTOMATIQUE DES CLASSES
			spl_autoload_register(function($class){
			    if(strpos($class, "Controller") === true)
			        require_once ('controler/'.$class.'.php');
			    else if(strpos($class,"Captcha") == true) {
                    $class = str_replace('\\', '/', $class);
                    require_once('model/reCaptcha/' . $class . '.php');
                }
			    else
				    require_once('model/'.$class.'.php');
			});
			$url='';

			//LE CONTROLER EST INCLUS SELON L'ACTION DE L'UTILISATEUR
			if(isset($_GET['url']))
			{
				$url = explode('/', filter_var($_GET['url'],	FILTER_SANITIZE_URL));

				$controller = ucfirst($url[0]);
				$controlerClass = "Controller".$controller;
				$controllerFile = 	"controler/".$controlerClass.".php";

				if(file_exists($controllerFile))
				{
					require_once($controllerFile);
					$this->_ctrl = new $controlerClass($url);
				}
				else
					throw new Exception('Page introuvable ' . $controllerFile .
					' ');
			}
			else
			{
				require_once('controler/ControllerIndex.php');
				$this->_ctrl = new ControllerIndex($url);
			}
		}
		//GESTION DES EXCEPTIONS
		catch(Exception $e)
		{
			$errorMsg = $e->getMessage();
			require_once('view/viewError.php');
		}
	}
}
