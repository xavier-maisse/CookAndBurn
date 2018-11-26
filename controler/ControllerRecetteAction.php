<?php
//include('../view/viewSignUp
//include('./model/User.php');
//include ('ControllerSignUpAction.php');
session_start();
error_reporting(E_ALL);
ini_set('display-errors','on');

/**
 * Class ControllerRecetteAction
 */
class ControllerRecetteAction
{
    /**
     * ControllerRecetteAction constructor.
     */
    public function __construct()
    {
        $this->ajoutRecette();
    }

    /**
     * Fonction AjoutRecette
     * Recuperation de tous les champs recuperer dans la vue Ajouter une recette
     */
    public function ajoutRecette()
    {
        if(!empty($_FILES))
        {
            if(empty($_POST['nameRecette']) || empty($_POST['descriptionRecette']) || empty($_POST['descriptionRecette2']) || empty($_POST['ingredients'])
               || empty($_POST['etapes']) || empty($_POST['nombrePersonne']))
            {
                echo 'Remplir les champs';
                echo 'Nom : '. $_POST['nameRecette'];
                echo 'Desc : '. $_POST['descriptionRecette'];
                echo 'Ing : '. $_POST['ingredients'];

                echo 'Nbr : '.$_POST['nombrePersonne'];
            }
            else
            {
                $quantiteIng = [];
                $i = 0;
                foreach ($_POST['ingredients'] as $ing) :
                    //en faisant var_dump($_POST), rendu compte que pour cote de porc -> $_POST['cote_de_porc']
                    $ing2 = str_replace(' ','_',$ing);
                    if(isset($_POST[$ing2]))
                    {
                        $quantiteIng[] = $_POST[$ing2].' '.$_POST['mesure'.$i].' - '.$ing ;

                    }
                    else
                    {
                        $quantiteIng = array();
                        break;
                    }
                    ++$i;
                endforeach;



                if(empty($quantiteIng))
                {
                    echo "un champ oublié";
                }
                else
                {
                    $ingredientEtQuantite='';
                    foreach($quantiteIng as $quantite) :
                        $ingredientEtQuantite .= $quantite. "\n";
                    endforeach;

                    $etapes = [];
                    $i = 1;
                    foreach($_POST['etapes'] as $etape):
                        $etape_ = str_replace(' ','_',$etape);
                        // on verifie si une etape n'a pas été sauté exemple : etape 1 , etape 3
                        if($etape != 'etape '.$i)
                        {
                            echo 'y a un pb';
                            echo 'etape '.$i;
                            echo $etape;
                            break;
                        }
                        else
                        {
                            //on verifie si l'etape est vide, pour ce cas on vide le tableau et on sort du foreach
                            if(empty($_POST[$etape_]))
                            {
                                echo "break";
                                $etapes = array();
                                break;
                            }
                            else
                            {
                                //supprimer tous les retours a la ligne et retours chariots et remplacer par ' '
                                $etapes[] = preg_replace( "/\r|\n/", " ", $_POST[$etape_]);

                                ++$i;
                            }
                        }
                    endforeach;
                }

                $lesEtapes = "";
                foreach($etapes as $etape) :
                    $lesEtapes .= $etape . "<br/>";
                endforeach;

                //on enleve le dernier br;
                $lesEtapes = substr($lesEtapes, 0,-5);


                $file_name = $_FILES['imageRecette']['name'];
                $file_extension = strrchr($file_name, "."); //Derniere itération du point

                $file_tmp_name = $_FILES['imageRecette']['tmp_name'];
                $destination ='./files/'.$file_name;

                $extensions_autorisees = array('.png', '.jpg');


 

                $nomRecette = htmlspecialchars($_POST['nameRecette']);
                $descriptionRecette = htmlspecialchars($_POST['descriptionRecette']);
                $descriptionRecetteDet = htmlspecialchars($_POST['descriptionRecette2']);
//              $ingredientRecette = htmlspecialchars($_POST['ingredientRecette']);



                //$imageRecette = htmlspecialchars($_POST['imageRecette']);
                $nombrePersonne = htmlspecialchars($_POST['nombrePersonne']);
                $rM = new RecetteModel();
                $aRecette = new Recette($nomRecette,$descriptionRecette, $descriptionRecetteDet, $lesEtapes, $_SESSION['pseudo'], $ingredientEtQuantite, $file_name, $nombrePersonne,0);
                echo $lesEtapes;

                if($nombrePersonne <= 0 )
                {
                    echo 'Le nombre de personne doit au moins être égale à 1';
                }
                else
                {
                    if(in_array($file_extension, $extensions_autorisees))
                    {
                    move_uploaded_file($file_tmp_name, $destination);
                    $rM->insertRecette($aRecette);
                    header("location:ContenuRecette?id=".urlencode($aRecette->getTitre()));


                    }
                    else{
                        echo 'Extension autorisé : png et jpg';
                    }
                }
            }
        }
        else{
            echo 'pas vide';
        }
        

    }
}

?>