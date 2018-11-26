<?php
class FavorisModel extends Model
{

    /**Insert dans la bdd une recette en favori pour un utilisateur
     * @param $aFavoris
     */
    public function insertFavoris($aFavoris)
    {
        try{
            $query = 'INSERT INTO favoris(id_rec, id_user, nom_user,nom_recette,image_rec)  VALUES(:idRecQ, :idUserQ, :nomUserQ,:nomRecQ,:imageRecQ)';
            $stmt = $this->getBdd()->prepare($query);

            $_idRecQ = $aFavoris->getIdRec();
            $_idUserQ = $aFavoris->getIdUser();
            $_nomRecQ = $aFavoris->getNomRecette();
            $_nomUserQ = $aFavoris->getNomUser();
            $_imageRecQ = $aFavoris->getImageRec();

            $stmt->bindValue('idRecQ', $_idRecQ, PDO::PARAM_STR);
            $stmt->bindValue('idUserQ',$_idUserQ, PDO::PARAM_STR);
            $stmt->bindValue('nomRecQ', $_nomRecQ, PDO::PARAM_STR);
            $stmt->bindValue('nomUserQ', $_nomUserQ, PDO::PARAM_STR);
            $stmt->bindValue('imageRecQ', $_imageRecQ, PDO::PARAM_STR);

            $stmt->execute();
        }
        catch(Exception $e)
        {
            print_r($e);
        }
    }

    /**Supprime dans la bdd une recette en favori pour un utilisateur
     * @param $aFav
     */
    public function DeleteFav($aFav)
    {
        try{
            $query = 'DELETE FROM favoris WHERE id_user ='.$aFav->getIdUser(). ' AND id_rec='.$aFav->getIdRec();
            $this->getBdd()->exec($query);
        }
        catch(Exception $e)
        {
            print_r($e);
        }
    }

    /**Permet d'obtenir tout les favoris d'un utilisateur
     * @return array
     */
    public function getFavorisForUser()
    {
        $var = [];
        try
        {
            $query = 'SELECT * FROM favoris WHERE nom_user ="'.$_SESSION['pseudo'].'"';
            $stmt = $this->getBdd()->query($query);
            while($resp = $stmt->fetch())
            {

                $var[] = new Favoris($resp['id_rec'], $resp['id_user'],$resp['nom_recette'], $resp['nom_user'],$resp['image_rec']);

            }
        }
        catch (Exception $exception)
        {
            echo $exception;
        }

        return $var;

    }

    /**Permet de verifier si la recette passé en parametre est deja dans les favoris de l'user en parametre
     * @param $user
     * @param $rec
     * @return bool
     */
    public function verifAlreadyFav($user,$rec)
    {
        try {
            $query = 'SELECT * FROM favoris WHERE id_user ='.$user->getId().' AND id_rec='.$rec->getId();
            $stmt = $this->getBdd()->query($query);

            if($stmt->fetch())

                return true;

            return false;
        }
        catch(Exception $e)
        {
            print_r($e);
        }
    }




}