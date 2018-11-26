<?php

class Burn {
    private $_idB;
    private $_idU;
    private $_idR;

    /**
     * Burn constructor.
     * @param $_idB qui correspond à l'id du burn
     * @param $_idU qui correspond à qui a mis le burn
     * @param $_idR correspond sur quelle recette le burn est
     */
    public function __construct($_idU, $_idR)
    {
        $this->_idU = $_idU;
        $this->_idR = $_idR;
    }

    /**
     * @return l'id du burn
     */
    public function getIdB()
    {
        return $this->_idB;
    }

    /**
     * @param mixed $idB
     * Permet de définir l'id du burn
     */
    public function setIdB($idB)
    {
        if(is_numeric($idB))
            $this->_idB = $idB;
    }

    /**
     * @return celui qui a mis le burn
     */
    public function getIdU()
    {
        return $this->_idU;
    }

    /**
     * @param mixed $idU
     * Définis qui a mis le burn
     */
    public function setIdU($idU)
    {
        if(is_numeric($idU))
            $this->_idU = $idU;
    }

    /**
     * @return sur quelle recette le burn est
     */
    public function getIdR()
    {
        return $this->_idR;
    }

    /**
     * @param mixed $idR
     * Permet de fixer le burn a une recette
     */
    public function setIdR($idR)
    {
        if(is_numeric($idR))
            $this->_idR = $idR;
    }




}