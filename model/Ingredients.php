<?php

class Ingredients
{
    private $_idL;
    private $_nomIngredient;
    private $_categorie;
    /**
    * Ingredients constructor.
    * @param $_idL
    * @param $_nomIngredient
     * @param $_categorie
    */
    public function __construct($_idL, $_nomIngredient, $_categorie)
    {
    $this->_idL = $_idL;
    $this->_nomIngredient = $_nomIngredient;
    $this->_categorie = $_categorie;
    }/**
     * @return mixed
     */
    public function getIdL()
    {
        return $this->_idL;
    }/**
     * @param mixed $idL
     */
    public function setIdL($idL)
    {
        $this->_idL = $idL;
    }/**
     * @return mixed
     */
    public function getNomIngredient()
    {
        return $this->_nomIngredient;
    }/**
     * @param mixed $nomIngredient
     */
    public function setNomIngredient($nomIngredient)
    {
        $this->_nomIngredient = $nomIngredient;
    }

    /**
     * @return mixed
     */
    public function getCategorie()
    {
        return $this->_categorie;
    }

    /**
     * @param mixed $categorie
     */
    public function setCategorie($categorie)
    {
        $this->_categorie = $categorie;
    }




}