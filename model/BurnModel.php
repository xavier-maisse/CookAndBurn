<?php

class BurnModel extends Model
{
    /**
     * @param $aBurn
     * Insertion du burn dans la BD par rapport à la personne et à la recette
     */
    public function insertBurn($aBurn)
    {
        try{
            $query = 'INSERT INTO burn(idU,idR)  VALUES(:idUQ, :idRQ)';
            $stmt = $this->getBdd()->prepare($query);

            $_idUQ = $aBurn->getIdU();
            $_idRQ = $aBurn->getIdR();

            $stmt->bindValue('idUQ',$_idUQ, PDO::PARAM_STR);
            $stmt->bindValue('idRQ', $_idRQ, PDO::PARAM_STR);

            $stmt->execute();
        }
        catch(Exception $e)
        {
            print_r($e);
        }
    }

    /**
     * @param $aBurn
     * Suppresion du burn dans la BD par rapport à la personne et à la recette
     */
    public function DeleteBurn($aBurn)
    {
        try{
            $query = 'DELETE FROM burn WHERE idU ='.$aBurn->getIdU(). ' AND idR='.$aBurn->getIdR();
            $this->getBdd()->exec($query);
        }
        catch(Exception $e)
        {
            print_r($e);
        }
    }

    /**Permet de savoir si oui ou non un utilisateur à déjà mis un burn sur une recette
     * @param $user
     * @param $rec
     * @return bool
     */
    public function verifAlreadyBurn($user,$rec)
    {
        try {
            $query = 'SELECT * FROM burn WHERE idU ='.$user->getId().' AND idR='.$rec->getId();
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