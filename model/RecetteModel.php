<?php
class RecetteModel extends Model{
    /**
     * @param $_recette
     * @return bool
     */
    public function insertRecette($_recette)
    {
        try{
            $query = 'INSERT INTO recettes (titre,description, descriptionDet,etapes,auteur,ingredients,image, nombre_personne,burns) VALUES(?,?,?,?,?,?,?,?,?)';
            $stmt = $this->getBdd()->prepare($query);
            $stmt->bindValue(1, $_recette->getTitre(), PDO::PARAM_STR);
            $stmt->bindValue(2, $_recette->getDescription(), PDO::PARAM_STR);
            $stmt->bindValue(3, $_recette->getDescriptionDet(), PDO::PARAM_STR);
            $stmt->bindValue(4, $_recette->getEtapesNl(), PDO::PARAM_STR);
            $stmt->bindValue(5, $_recette->getAuteur(), PDO::PARAM_STR);
            $stmt->bindValue(6, $_recette->getIngredientNl(), PDO::PARAM_STR);
            $stmt->bindValue(7, $_recette->getImage(), PDO::PARAM_STR);
            $stmt->bindValue(8, $_recette->getNombrePersonne(), PDO::PARAM_STR);
            $stmt->bindValue(9, $_recette->getNombreBurn(), PDO::PARAM_STR);
            
            $ret =$stmt->execute();
        }
        catch (Exception $e)
        {
            echo $e;
        }
        return true;
    }
    /**
     * @param $_recette
     * recette que l'on veut supprimer
     *
     *
     */
    public function deleteRecette($_recette)
    {
        $query = "DELETE FROM recettes WHERE id=".$_recette->getId();
        $this->getBdd()->exec($query);
        $query2 = "DELETE FROM favoris WHERE id_rec=".$_recette->getId();
        $this->getBdd()->exec($query2);
    }
    /**
     * @return array
     * tableau contenant toutes les recettes
     */
    public function getAllRecette()
    {
        $var = [];
        $req = $this->getBdd()->prepare('SELECT * FROM recettes ORDER BY id asc');
        $req->execute();
        while($data = $req->fetch())
        {
            $var[] = new Recette($data['titre'], $data['description'],$data['descriptionDet'],$data['etapes'], $data['auteur'], $data['ingredients'],$data['image'], $data['nombre_de_personne'],$data['burns']);
        }
        return $var;
//        $req->closeCursor();
    }
    /**
     * @return array
     * tableau contenant les recettes ayant plus de 10 burns (pour les non-membres)
     */
    public function getRecetteForInvit()
    {
        $var = [];
        $req = $this->getBdd()->prepare('SELECT * FROM recettes WHERE burns >= 10 ORDER BY id asc');
        $req->execute();
        while($data = $req->fetch())
        {
            $var[] = new Recette($data['titre'], $data['description'],$data['descriptionDet'],$data['etapes'], $data['auteur'], $data['ingredients'],$data['image'], $data['nombre_de_personne'],$data['burns']);
        }
        return $var;
//        $req->closeCursor();
    }
    /**
     * @param $_recette
     * recette que l'on souhaite modifier
     */
    public function updateRec($_recette)
    {
        //ADDSLASHES PERMET DE NE PAS POSER DE PROBLEME SI UN DES ATTRIBUTS CONTIENT "'"
        $query = "UPDATE recettes SET titre ='". addslashes($_recette->getTitre())
                                               ."', description ='". addslashes($_recette->getDescription())."',
                                               descriptionDet ='". addslashes($_recette->getDescriptionDet()) ."',
                                               etapes = '".addslashes($_recette->getEtapesNl())."',
                                               ingredients='". addslashes($_recette->getIngredientNl()) ."',image='".addslashes($_recette->getImage())."',
                                               nombre_personne=".$_recette->getNombrePersonne()." WHERE id=".$_recette->getId();
       echo $_recette->getIngredient();
        $this->getBdd()->exec($query);
        $query2 = "UPDATE favoris SET nom_recette='".addslashes($_recette->getTitre()) ."', image_rec='". addslashes($_recette->getImage())."' WHERE nom_recette='".$_SESSION['recette']."'";
        $this->getBdd()->exec($query2);
    }
    /**
     * @param $_titre
     * titre de la recette que l'on souhaite recuperer
     * @return null|Recette
     *  null si la recette n'existe pas
     *  sinon renvoie la recette
     */
    public function getByTitre($_titre)
    {
        $titreDecodee = str_replace('+', ' ', urldecode($_titre));
        try{
            $query = 'SELECT * FROM recettes WHERE titre ="'.$titreDecodee.'"';
            $stmt = $this->getBdd()->query($query);
            if($rec = $stmt->fetch())
            {
                $aRec = new Recette($rec['titre'], $rec['description'],$rec['descriptionDet'],$rec['etapes'], $rec['auteur'], $rec['ingredients'], $rec['image'],$rec['nombre_personne'],$rec['burns']);
                $aRec->setId($rec['id']);
            }
            else{
                echo "pas de recette de ce nom";
                echo $titreDecodee;
                return null;
            }
            return $aRec;
        }
        catch(Exception $e)
        {
            echo $e;
        }
    }
    /**
     * @param $commentaire
     * le commentaire que l'on veut inserer
     * @param $auteur
     * l'auteur du commentaire
     * @param $recette
     * la recette ou le commentaire est ajouté
     * @return bool
     */
    public function postCommentaire($commentaire,$auteur,$recette)
    {
        try{
            print_r($commentaire);
            print_r($auteur);
            print_r($recette);
            $query = 'INSERT INTO commentaire (commentaire,auteur, id_recette) VALUES(?,?,?)';
            $stmt = $this->getBdd()->prepare($query);
            $ret =$stmt->execute(array($commentaire,$auteur,$recette));
            
        }
        catch (Exception $e)
        {
            echo $e;
        }
        return true;
    }
    /**
     * @param $titre
     * titre de la recette dont on veut recuperer les commentaires
     * @return string
     */
    public function getCommentaire($titre)
    {
        try{
            $query = 'SELECT * FROM commentaire WHERE id_recette = "'.$titre.'"';
            $stmt = $this->getBdd()->query($query);
            //$ret =$stmt->execute(array($titre));
            $commentaire = "";
            while($c = $stmt->fetch()){
                $commentaire = $commentaire . $c['auteur'].' : '.$c['commentaire'] .'<br/>';
            }
            return $commentaire;
                
        }
        catch(Exception $e){
            echo $e;
        }
    }

    public function deleteCommentaire($titre)
    {
        $query = 'DELETE FROM commentaire WHERE id_recette = "'.$titre.'"';
        $this->getBdd()->exec($query);
    }
    /**
     * @return null|Recette
     * la meilleure recette (celle avec le plus de burns
     */
    public function getBestRec()
    {
        $query = "SELECT * FROM recettes where burns in (SELECT MAX(burns) FROM recettes)";
        $stmt = $this->getBdd()->query($query);
        if($rec = $stmt->fetch())
        {
            $aRec = new Recette($rec['titre'], $rec['description'],$rec['descriptionDet'],$rec['etapes'], $rec['auteur'], $rec['ingredients'], $rec['image'],$rec['nombre_personne'],$rec['burns']);
            $aRec->setId($rec['id']);
            return $aRec;
        }
        return null;
    }
    /**
     * @param $rec
     * recette a laquelle on veut rajouter un burn
     */
    public function addOneBurn($rec)
    {
        $query = "UPDATE recettes SET burns =".$rec->getNombreBurn()." + 1 WHERE id =".$rec->getId();
        print_r($rec->getNombreBurn(),$rec->getId());
        $this->getBdd()->exec($query);
    }
    /**
     * @param $rec
     * recette a laquelle on veut supprimer un burn
     */
    public function RemoveOneBurn($rec)
    {
        $query = "UPDATE recettes SET burns =".$rec->getNombreBurn()." - 1 WHERE id =".$rec->getId();
        $this->getBdd()->exec($query);
    }
    /**
     * @return mixed
     * le nombre de recettes
     */
    public function nbRecettes(){
       /* $query = 'SELECT count(*) FROM recettes';
        $sth = $this->getBdd()->exec($query);
        print_r($sth->fetchAll(PDO::FETCH_OBJ));*/
        return $this->getBdd()->query("SELECT COUNT(*) FROM recettes")->fetchColumn();
    }
    /**
     * @return mixed
     * le nombre de commentaire
     */
    public function nbCom(){
       /* $query = 'SELECT count(*) FROM recettes';
        $sth = $this->getBdd()->exec($query);
        print_r($sth->fetchAll(PDO::FETCH_OBJ));*/
        return $this->getBdd()->query("SELECT COUNT(*) FROM commentaire")->fetchColumn();
        
    }
    /**
     * affichage des recettes pour le pannel
     */
    public function affichageRecette(){
        $req= $this->getBdd()->query("SELECT * FROM recettes")->fetchAll();
            ?>
        <table id="myTable" class="table table-striped" >  
        <thead>  
          <tr>  
            <th>ID</th>  
            <th>Titre</th>

            <th>Description</th>
            <th>Détails</th>
            <th>Etapes</th>
            <th>Auteur</th>
            <th>Ingrédients</th>
            <th>Personne</th> 
            <th>Burns</th> 
            <th>Action</th>  
          </tr>  
        </thead>  
        <tbody> 
           <?php foreach ($req as $q): ?>
            <tr>

                    <td><?php echo $q['id'] ?></td>
                    <td><?php echo $q['titre'] ?></td>

                    <td><?php echo $q['description'] ?></td>
                    <td><?php echo $q['descriptionDet'] ?></td>
                    <td><?php echo $q['etapes'] ?></td>
                    <td><?php echo $q['auteur'] ?></td>
                    <td><?php echo $q['ingredients'] ?></td>
                    <td><?php echo $q['nombre_personne'] ?></td>
                    <td><?php echo $q['burns'] ?></td>
                    <td><a href="ModifUserRecette?id=<?php echo $q['id']?>">Editer</a> / <a href="SuppRecetteTable?id=<?php echo $q['id']?>">Supp</a></td>
                </tr>


        <?php endforeach; ?>
        </tbody>
                </table>
        </tbody>  
      </table>  
      </div>
      <?php  
    }
    /**
     * @param $user
     * utilisateur dont on veut recuperer les recettes qu'il a crée
     * @return array
     * tableau des recettes crées par l'utilisateur passé en paramètre
     */
    public function getCreatedRecByUser($user)
    {
        $query = "SELECT * FROM recettes WHERE auteur ='".$user->getNameUser()."'";
        $stmt = $this->getBdd()->query($query);
        $var = [];
        while($rec =  $stmt->fetch())
        {
            $var[] = new Recette($rec['titre'], $rec['description'],$rec['descriptionDet'],$rec['etapes'], $rec['auteur'], $rec['ingredients'], $rec['image'],$rec['nombre_personne'],$rec['burns']);
        }
        return $var;
    }
    /**
     * @param $id
     * @param $nom
     * @param $description
     * @param $descriptiondet
     * @param $etapes
     * @param $auteur
     * @param $ingredients
     * @param $nombre
     */
    public function updateRecette($id,$nom,$description,$descriptiondet,$etapes,$auteur,$ingredients,$nombre)
    {
        $query = "UPDATE recettes SET titre ='".$nom
                                               ."', description ='".$description."',
                                               descriptionDet ='".$descriptiondet."',
                                               etapes='".$etapes."',
                                               auteur = '".$auteur."',
                                               ingredients='".$ingredients."',
                                               nombre_personne=".$nombre." WHERE id=". $id;
        $stmt2 = $this->getBdd()->prepare($query);
        $stmt2->execute();
    }
    public function suppRecette($id)
    {
        $query2 = ('DELETE  FROM recettes WHERE id = "'. $id  .'"');
        $stmt2 = $this->getBdd()->prepare($query2);
        $stmt2->execute();
    }
    //inverse de nl2br
}
    

