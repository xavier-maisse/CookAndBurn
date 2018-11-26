<?php
class UserModel extends Model{

    /**Insertion d'un utilisateur dans la BD
     * @param $_user
     * @return bool
     */
    public function insertUser($_user)
    {
        if($_user->getNameUser() == "ab")
            header('location:deede');
        try{
            $query = 'INSERT INTO user(nom_utilisateur,mot_de_passe, adresse_email, confirmkey) VALUES(:nameUserQ,:passwordQ,:mailAdressQ, :confirmkeyQ)';

            $stmt = $this->getBdd()->prepare($query);

            $_confirmkeyQ = $_user->getConfirmKey();
            $_nameUserQ = $_user->getNameUser();
            $_passwordQ = $_user->getPassword();
            $_mailAdressQ = $_user->getMailAdress();

            $stmt->bindValue('nameUserQ', $_nameUserQ, PDO::PARAM_STR);
            $stmt->bindValue('passwordQ', $_passwordQ, PDO::PARAM_STR);
            $stmt->bindValue('mailAdressQ', $_mailAdressQ, PDO::PARAM_STR);
            $stmt->bindValue('confirmkeyQ', $_confirmkeyQ, PDO::PARAM_STR);


            $stmt->execute();
        }
        catch (SQLiteException $e)
        {
            echo $e;
        }

        return true;
    }

    /**Permet de verifier si un le nom d'un utilisateur est déjà utilisé dans la table
     * @param $_user
     * @return bool
     */
    public function verifUser($_user)
    {
        if($_user->getNameUser() == "ab")
            header('location:deede');
        try{
            $query = ('SELECT nom_utilisateur FROM user WHERE nom_utilisateur = ?');

            $stmt = $this->getBdd()->prepare($query);

            $_nameUserQ = $_user->getNameUser();
            $stmt->execute(array($_nameUserQ));
            if($stmt->fetch()== true){
                return true;
            }

        }
        catch (SQLiteException $e)
        {
            echo $e;
        }

        return false;
    }

    /**Permet de verifier si un le mail d'un utilisateur est déjà utilisé dans la table
     * @param $_user
     * @return bool
     */
    public function verifUserEmail($_user)
    {
        if($_user->getNameUser() == "ab")
            header('location:deede');
        try{
            $query = ('SELECT adresse_email FROM user WHERE adresse_email = ?');

            $stmt = $this->getBdd()->prepare($query);

            
            $_mailAdressQ = $_user->getMailAdress();
            $stmt->execute(array($_mailAdressQ));
            if($stmt->fetch()== true){
                return true;
            }

        }
        catch (SQLiteException $e)
        {
            echo $e;
        }

        return false;
    }

    /**Permet l'activation du compte apres reception du mail
     * @param $_user
     * @return bool
     */
    public function verifUserValid($_user)
    {
        if($_user->getNameUser() == "ab")
            header('location:deede');
        try{
            $query = ('SELECT nom_utilisateur FROM user WHERE nom_utilisateur = ? AND confirmkey = ?');

            $stmt = $this->getBdd()->prepare($query);
            $_confirmkeyQ = $_user->getConfirmKey();
            $_nameUserQ = $_user->getNameUser();
            $stmt->execute(array($_nameUserQ, $_confirmkeyQ));
            if($stmt->fetch()== true){
                return true;
            }

        }
        catch (SQLiteException $e)
        {
            echo $e;
        }

        return false;
    }

    /**Permet de valider le compte
     * @param $_user
     * @return bool
     */
    public function confirmUser($_user)
    {
        if($_user->getNameUser() == "ab")
            header('location:deede');
        try{
            $query = ('UPDATE user SET confirme = 1 WHERE nom_utilisateur = ? AND confirmkey = ? ');

            $stmt = $this->getBdd()->prepare($query);
            $_confirmkeyQ = $_user->getConfirmKey();
            $_nameUserQ = $_user->getNameUser();
            $stmt->execute(array($_nameUserQ, $_confirmkeyQ));
            if($stmt->fetch()== true){
                return true;
            }

        }
        catch (SQLiteException $e)
        {
            echo $e;
        }

        return false;
    }

    /**Vérifie si le couple nom et mdp correspond
     * @param $_user
     * @return bool
     */
    public function connexion($_user)
    {
        if($_user->getNameUser() == "ab")
            header('location:deede');
        try{
            $query = ('SELECT * FROM user WHERE nom_utilisateur = ? AND mot_de_passe = ?');

            $stmt = $this->getBdd()->prepare($query);
            $_passwordQ = $_user->getPassword();
            $_nameUserQ = $_user->getNameUser();
            $stmt->execute(array($_nameUserQ, $_passwordQ));
            $userexist = $stmt->rowCount();
            if($userexist == 1){
                return true;
            }

        }
        catch (SQLiteException $e)
        {
            echo $e;
        }

        return false;
    }

    /**Renvoi vrai si le compte de l'utilisateut est confirmé , sinon faux
     * @param $_user
     * @return bool
     */
     public function userConfirm($_user)
    {
        if($_user->getNameUser() == "ab")
            header('location:deede');
        try{
            $query = ('SELECT * FROM user WHERE nom_utilisateur = ? AND confirme = 1');

            $stmt = $this->getBdd()->prepare($query);
            $_nameUserQ = $_user->getNameUser();
            $stmt->execute(array($_nameUserQ));
            $userexist = $stmt->rowCount();
            if($userexist == 1){
                return true;
            }

        }
        catch (SQLiteException $e)
        {
            echo $e;
        }

        return false;
    }


    /**Permet de changer de mail
     * @param $name
     * @param $oldmail
     * @param $Newmail
     * @return bool
     */
    public function mailChange($name,$oldmail,$Newmail)
    {
        try{
            $query = 'SELECT nom_utilisateur FROM user WHERE adresse_email = "'.$oldmail.'" AND nom_utilisateur="'.$name.'"';
            $response = $this->getBdd()->query($query);

            if(($response->fetch()))
            {
                    $query2 = ('UPDATE user SET adresse_email = "'.$Newmail.'" WHERE adresse_email= ? AND nom_utilisateur = "'. $name  .'"');
                    $stmt2 = $this->getBdd()->prepare($query2);

                    $stmt2->execute(array($oldmail));
            }
            else{
                echo "c'est pas toi";
            }




        }
        catch (SQLiteException $e)
        {
            echo $e;
        }

        return false;
    }

    /**Permet de changer de mdp
     * @param $name
     * @param $oldMdp
     * @param $newMdp
     */
    public function mdpChange($name, $oldMdp, $newMdp)
    {
        try{
            $query = 'SELECT nom_utilisateur FROM user WHERE nom_utilisateur ="'.$name . '" AND mot_de_passe ="'.$oldMdp.'"';
            $response = $this->getBdd()->query($query);

            if($response->fetch())
            {
                $query2 = ('UPDATE user SET mot_de_passe = "'.$newMdp.'" WHERE nom_utilisateur = "'. $name  .'"');
                $stmt2 = $this->getBdd()->prepare($query2);

                $stmt2->execute();
            }
            else
            {
                echo "Mauvais mot de passe";
            }
        }
        catch (SQLiteException $e)
        {
            echo $e;
        }
    }

    /** Retourne les informations d'un utilisateur à partir de son nom
     * @param $name
     * @return null|User
     */
    public function getByNom($name)
    {
        try{
        $query = 'SELECT * FROM user WHERE nom_utilisateur ="'.$name.'"';

        $stmt = $this->getBdd()->query($query);

        if($resp = $stmt->fetch())
        {

            $aUser = new User($resp['nom_utilisateur'], $resp['mot_de_passe'],$resp['adresse_email']);
            $aUser->setId($resp['id']);
        }
        else{

            return null;
        }
        return $aUser;
    }
    catch(Exception $e)
    {
        echo $e;
    }}

    /**Retourne le nombre d'utilisateur confirmé
     * @return mixed
     */
    public function nbUsers(){
       /* $query = 'SELECT count(*) FROM recettes';
        $sth = $this->getBdd()->exec($query);
        print_r($sth->fetchAll(PDO::FETCH_OBJ));*/
        return $this->getBdd()->query("SELECT COUNT(*) FROM user WHERE confirme= 1")->fetchColumn();

        
    }

    /**Permet l'affichage de tous les utilisateurs dans une table pour le panel admin
     *
     */
     public function affichageUser(){
        $req= $this->getBdd()->query("SELECT * FROM user WHERE confirme= 1")->fetchAll();
            ?>
        <table id="myTable" class="table table-striped" >  
        <thead>  
          <tr>  
            <th>ID</th>  
            <th>nom_utilisateur</th>

            <th>adresse_email</th>
            <th>confirmkey</th>
            <th>Action</th>  
          </tr>  
        </thead>  
        <tbody> 
           <?php foreach ($req as $q): ?>
            <tr>
                    <td><?php echo $q['id'] ?></td>
                    <td><?php echo $q['nom_utilisateur'] ?></td>

                    <td><?php echo $q['adresse_email'] ?></td>
                    <td><?php echo $q['confirmkey'] ?></td>
                    <td><a href="ModifUserTable?id=<?php echo $q['id']?>">Editer</a> / <a href="SuppUserTable?id=<?php echo $q['id']?>">Supp</a></td>
                </tr>


        <?php endforeach; ?>
        </tbody>
                </table>
        </tbody>  
      </table>  
      </div>
      <?php  
    }

    /**Met à jour l'user
     * @param $id
     * @param $mail
     * @param $nom
     */
    public function UpdateUser($id, $mail, $nom)
    {
        $query2 = ('UPDATE user SET adresse_email = "'.$mail.'" , nom_utilisateur = "'.$nom.'" WHERE id = "'. $id  .'"');
        $stmt2 = $this->getBdd()->prepare($query2);

        $stmt2->execute();
           
    }

    /**Supprime un user de la base
     * @param $id
     */
    public function deleteUser($id)
    {
        $query2 = ('DELETE  FROM user WHERE id = "'. $id  .'"');
        $stmt2 = $this->getBdd()->prepare($query2);

        $stmt2->execute();
           
    }

    /**Verifie si l'adresse mail en parametre est déjà prise
     * @param $mail
     * @return bool
     */
    public function validMail($mail)
    {
        try{
            $query = ('SELECT * FROM user WHERE adresse_email = ?');

            $stmt = $this->getBdd()->prepare($query);

            $stmt->execute(array($mail));
            if($stmt->fetch()== true){
                return true;
            }

        }
        catch (SQLiteException $e)
        {
            echo $e;
        }

        return false;
    }

    /**Permet de changer de mot de passe 
     * @param $mail
     * @param $newMdp
     */
    public function newMdp($mail,$newMdp)
    {
        $query2 = ('UPDATE user SET mot_de_passe = "'.$newMdp.'" WHERE adresse_email = "'. $mail  .'"');
        $stmt2 = $this->getBdd()->prepare($query2);

        $stmt2->execute();
    }


}

?>