<?php

class IngredientsModel extends Model
{
    /**Permet d'obtenir la liste de tous les ingrédients
     * @return array
     */
    public function getAll()
    {
        $query = 'SELECT * FROM ingredients ORDER BY idL asc';
        $var = [];
        $req = $this->getBdd()->prepare($query);
        $req->execute();

        while($data = $req->fetch())
        {

            $var[] = new Ingredients($data['idL'], $data['nom_ingredient'],$data['categories']);

        }

        return $var;
//        $req->closeCursor();
    }

    /**
     * @return array
     *      Un tableau contenant les categoris des ingrédients.
     */
    public function getCategories()
    {
        $query = "SELECT distinct categorie FROM ingredients";
        $var = [];

        $req = $this->getBdd()->prepare($query);
        $req ->execute();

        while($data = $req->fetch())
        {
            $var[] = $data['categorie'];
        }
        return $var;
    }


    /**
     * @param $categorie
     *  catégorie dont on veut les ingrédients
     * @return array
     *  Tableau contenant le nom des ingrédients de la catégories passé en paramètre.
     */
    public function getIngredientByCat($categorie)
    {
        $query = "SELECT nom_ingredient FROM ingredients where categorie ='".$categorie."'";
        $var = [];

        $req = $this->getBdd()->prepare($query);
        $req->execute();

        while($data = $req->fetch())
        {
            $var[] = $data['nom_ingredient'];
        }
        return $var;
    }


    /**
     * Affichage sur forme de table de tous les ingrédients pour l'administrateur
     */
    public function affichageIngredients(){
        $req= $this->getBdd()->query("SELECT * FROM ingredients")->fetchAll();
            ?>
        <table id="myTable" class="table table-striped" >  
        <thead>  
          <tr>  
            <th>ID</th>  
            <th>nom_ingredient</th>

            <th>categorie</th>
            <th>Action</th>
          </tr>  
        </thead>  
        <tbody> 
           <?php foreach ($req as $q): ?>
            <tr>
                    <td><?php echo $q['idL'] ?></td>
                    <td><?php echo $q['nom_ingredient'] ?></td>

                    <td><?php echo $q['categorie'] ?></td>
                    <td><a href="SuppIngredientTable?id=<?php echo $q['idL']?>">Supp</a></td>
                </tr>


        <?php endforeach; ?>
        </tbody>
                </table>
        </tbody>  
      </table>  
      </div>
      <?php  
    }

    /**Supprime l'ingrédient passé en parametre
     * @param $id
     *  id de l'ingredient que l'on souhaite supprimé
     */
    public function suppIngredient($id)
    {
        $query2 = ('DELETE  FROM ingredients WHERE idL = "'. $id  .'"');
        $stmt2 = $this->getBdd()->prepare($query2);

        $stmt2->execute();
           
    }

    /**Créé un nouvel ingrédient
     * @param $nom
     */
    public function addIngredient($nom){
        $query = ('INSERT INTO ingredients(nom_ingredient,categorie) VALUES (?,?)');

            $stmt = $this->getBdd()->prepare($query);

            $stmt->execute(array($nom,""));
    }
}