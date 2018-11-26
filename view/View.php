<?php
class view
{
    private $_file;
    private $_t;

    public function __construct($action)
    {
        $this->_file='view/view'.$action.'.php';

    }
    //generation et affichage de la vue
    public function generate($data)
    {
        //partie specifique de la vue
        //permet de faire passer la vue qu'on veut afficher avec les données qu'on recupere
        $content = $this->generateFile($this->_file,$data);

        // template
        $view = $this->generateFile('view/template.php', array('t' => $this->_t, 'content' => $content));

        echo $view;
    }

    //generation d'un fichier vu et renvoie le resultat produit
    private function generateFile($file, $data)
    {
        if(file_exists($file))
        {
            extract($data);
            //TEMPORISATION
            //MISE EN TAMPON
            ob_start();

            //on inclut le fichier vue
            require $file;
            //renvoie le tempo de sortie
            return ob_get_clean();
        }
        else
            throw new Exception('Fichier '.$file.' introuvable');


    }
}