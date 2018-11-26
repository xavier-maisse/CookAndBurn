<?php
//include('../view/viewSignUp
//include('./model/User.php');
//include ('ControllerSignUpAction.php');
session_start();
error_reporting(E_ALL);
ini_set('display-errors','on');

/**
 * Class ControllerModifierRecAction
 */
class ControllerModifierRecAction
{
    private $test;
    public function __construct()
    {
        $this->ModifRec();
    }


    /**
     * Fonction qui permet de modifier chaque attribut de la recette
     */
    public function ModifRec()
    {

        $rM = new RecetteModel();
        $ancienneRec = $rM->getByTitre($_SESSION['recette']);
        print_r($_POST['nameRecette']);
        echo "<br/>";

        print_r($_POST['descriptionRecette']);
        echo "<br/>";

        print_r($_POST['descriptionRecette2']);
        echo "<br/>";


        print_r($_FILES['imageRecette']);
        echo "<br/>";

        var_dump($_POST['descriptionRecette2']);
        if(empty($_POST['nameRecette']) || empty($_POST['descriptionRecette']) || empty($_POST['descriptionRecette2']) || empty($_POST['nombrePersonne']))
        {
            $_SESSION['erreur'] = 'Un des champs est vide';
            header('Location:ModifierRec');
        }
        else
        {
            $nombreEtape =  count(explode ("\n", $ancienneRec->getEtapesNl()));
            $ingredientEtQuantite='';
            $quantiteIng = [];
            $i = 0;

            if(empty($_POST['ingredients']))
            {
                $ingredientEtQuantite = $ancienneRec->getIngredient();
            }
            else {
                foreach ($_POST['ingredients'] as $ing) :
                    //en faisant var_dump($_POST), rendu compte que pour cote de porc -> $_POST['cote_de_porc']
                    $ing2 = str_replace(' ', '_', $ing);
                    if (!empty($_POST[$ing2])) {

                        $quantiteIng[] = $_POST[$ing2] . ' ' . $_POST['mesure' . $i] . ' - ' . $ing;

                    } else {
                        $quantiteIng = array();
                        break;
                    }
                    ++$i;
                endforeach;


                if (empty($quantiteIng)) {
                    $_SESSION['erreur'] = 'Vous n\'avez pas précisez la quantité';
                    header('Location:ModifierRec');
                    exit();
                } else {
                    foreach ($quantiteIng as $quantite) :
                        $ingredientEtQuantite .= $quantite;
                    endforeach;
                }
            }

            $lesEtapes = "";
            if(empty($_POST['etapes'])) {

                $lesEtapes= $ancienneRec->getEtapes();

            }
            else {
                $etapes = [];

                $i = $nombreEtape +1;
                foreach($_POST['etapes'] as $etape):
                    $etape_ = str_replace(' ','_',$etape);
                    // on verifie si une etape n'a pas été sauté exemple : etape 1 , etape 3
                    if($etape != 'etape '.$i)
                    {
                        $_SESSION['erreur'] = 'Vous avez oublié une étape.';
                        header('Location:ModifierRec');
                        exit();
                    }
                    else
                    {
                        //on verifie si l'etape est vide, pour ce cas on vide le tableau et on sort du foreach
                        if(empty($_POST[$etape_]))
                        {
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
                /* etapes deja écrite */
                //on compte le nombre d'etape, chaque saut de ligne correspond a une nouvelle etape

                //on recupere les valeurs des text area
                for($j = 1; $j <= $nombreEtape; ++$j)
                {
                    echo "for";
                    if(empty($_POST['etape_'.$j]))
                    {
                        echo "empty";
                        continue;
                    }


                    $lesEtapes.= preg_replace( "/\r|\n/"," ",$_POST['etape_'.$j]). "<br/>";
                }
                echo $lesEtapes;

                //on enleve le dernier <br/> pour que on ai pas un textarea en plus dans modifier recette

                /* les nouvelles etapes, s'il y a */
                if(!empty($_POST['etapes']))
                {
                    foreach($_POST['etapes'] as $etape):
                        $etape_ = str_replace(' ','_',$etape);
                        // on verifie si une etape n'a pas été sauté exemple : etape 1 , etape 3
                        if($etape != 'etape '.$j)
                        {
                            break;
                        }
                        else
                        {
                            //on verifie si l'etape est vide, pour ce cas on vide le tableau et on sort du foreach
                            if(empty($_POST[$etape_]))
                            {
                                $_SESSION['erreur'] = 'Une ou plusieurs étapes sont vides';
                                header('Location:ModifierRec');
                                exit();
                                $etapes = array();
                                break;
                            }
                            else
                            {
                                if(!ctype_alnum($_POST[$etape_])) continue;
                                //supprimer tous les retours a la ligne et retours chariots et remplacer par ' '
                                $lesEtapes .= preg_replace( "/\r|\n/", " ", $_POST['etape_'.$j]). "<br/>";
                                ++$j;
                            }
                        }
                    endforeach;
                }
                $lesEtapes = substr($lesEtapes, 0,-5);


            }
            if(empty($_FILES['imageRecette']['name']))
            {
                $rec = new Recette($_POST['nameRecette'],$_POST['descriptionRecette'],
                    $_POST['descriptionRecette2'], $lesEtapes, $_SESSION['pseudo'],
                    $ingredientEtQuantite, $ancienneRec->getImage(),
                    $_POST['nombrePersonne'],$ancienneRec->getNombreBurn());


            }
            else
            {
                $rec = new Recette($_POST['nameRecette'],$_POST['descriptionRecette'],
                    $_POST['descriptionRecette2'],$lesEtapes, $_SESSION['pseudo'],
                    $ingredientEtQuantite, $_FILES['imageRecette']['name'],
                    $_POST['nombrePersonne'],$ancienneRec->getNombreBurn());
                echo $ingredientEtQuantite;

                move_uploaded_file($_FILES['imageRecette']['tmp_name'], './files/'.$rec->getImage());
                unlink('./files/'.$ancienneRec->getImage());
            }
            $rec->setId($ancienneRec->getId());
            echo $rec->getIngredient();
            $rM->updateRec($rec);
            header("location:ContenuRecette?id=".urlencode($rec->getTitre()));

        }

    }
}

?>