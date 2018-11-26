<?php
class Favoris{

    private $_idRec;
    private $_idUser;
    private $_nomRecette;
    private $_nomUser;
    private $_imageRec;

    /**Ajoute une recette en favori pour un utilisateur donné
     * Favoris constructor.
     * @param $idRec
     * @param $idUser
     * @param $nomRec
     * @param $nomUser
     * @param $imgRec
     */
    public function __construct($idRec, $idUser, $nomRec, $nomUser, $imgRec)
    {
        $this->_idRec = $idRec;
        $this->_idUser = $idUser;
        $this->_nomRecette = $nomRec;
        $this->_nomUser = $nomUser;
        $this->_imageRec = $imgRec;
    }

    /**
     * @return mixed
     */
    public function getIdRec()
    {
        return $this->_idRec;
    }

    /**
     * @param mixed $idRec
     */
    public function setIdRec($idRec)
    {
        if(is_numeric($idRec))
            $this->_idRec = $idRec;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->_idUser;
    }

    /**
     * @param mixed $idUser
     */
    public function setIdUser($idUser)
    {
        if(is_numeric($$idUser))
            $this->_idUser = $idUser;
    }

    /**
     * @return mixed
     */
    public function getNomRecette()
    {
        return $this->_nomRecette;
    }

    /**
     * @param mixed $nomRecette
     */
    public function setNomRecette($nomRecette)
    {
        if(is_string($nomRecette))
            $this->_nomRecette = $nomRecette;

    }

    /**
     * @return mixed
     */
    public function getNomUser()
    {
        return $this->_nomUser;
    }

    /**
     * @param mixed $nomUser
     */
    public function setNomUser($nomUser)
    {
        if(is_string($nomUser))
            $this->_nomUser = $nomUser;
    }

    /**
     * @return mixed
     */
    public function getImageRec()
    {
        return $this->_imageRec;
    }
    

}