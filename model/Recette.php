<?php
class Recette
{
	// TOUS LES CHAMPS DE LA TABLE
	private $_id;
	private $_titre;
	private $_description;
	private $_descriptionDet;
	private $_etapes;
	private $_auteur;
	private $_ingredient;
	private $_image;
	private $_nombrePersonne;
	private $_nombreBurn;

	//CONSTRUCTEUR
	public function __construct($titre,$description,
                                $descriptionDet,$etapes,$auteur,
                                $ingredient,$image,$nombrePersonne,$nombreBurn)
	{
		$this->_titre = $titre;
		$this->_description = $description;
		$this->_descriptionDet= $descriptionDet;
		$this->_etapes = $etapes;
		$this->_auteur = $auteur;
		$this->_ingredient = $ingredient;
		$this->_image = $image;
		$this->_nombrePersonne = $nombrePersonne;
		$this->_nombreBurn = $nombreBurn;
	}

	//HYDRATION CE QUI CORRESPOND A APPORTER AU OBJET CE QU'ILS ONT BESOIN
	//POUR EXISTER
	public function hydrate(array $data)
	{
		foreach($data as $key => $value)
		{
			$method = 'set'.ucfirst($key);

			if(method_exists($this, $method))
				$this->$method($value);
		}
	}


    /**
     * @param $number
     */
    public function setId($number)
    {

        if(is_numeric($number))
        {
            $this->_id = $number;
        }
    }

    /**
     * @param $name
     */
	public function setTitre($name)
	{
		if(is_string($name))
			$this->_titre = $name;
	}

    /**
     * @param $name
     */
	public function setDescription($name)
	{
		if(is_string($name))
			$this->_description = $name;

	}

    /**
     * @param $name
     */
	public function setDescriptionDet($name)
	{
		if(is_string($name))
			$this->_descriptionDet = $name;

	}

    /**
     * @param mixed $etapes
     */
    public function setEtapes($etapes)
    {
        $this->_etapes = $etapes;
    }


    /**
     * @param $name
     */
	public function setAuteur($name)
	{
		if(is_string($name))
			$this->_auteur = $name;

	}

    /**
     * @param $name
     */
	public function setIngredient($name)
	{
		if(is_string($name))
			$this->_ingredient = $name;

	}

    /**
     * @param $name
     */
	public function setImage($name)
	{
		if(is_file($name))
			$this->_image = $name;

	}

    /**
     * @param $number
     */
	public function setNombrePersonne($number)
    {

        if(is_numeric($number))
        {
            $this->_nombrePersonne = $number;
        }
    }

    /**
     * @param $number
     */
    public function setNombreBurn($number)
    {
        if(is_numeric($number))
        {
            $this->_nombreBurn = $number;
        }
    }

    /**
     * @return mixed
     */
	public function getId()
	{
		return $this->_id;
	}

    /**
     * @return mixed
     */
	public function getNombrePersonne()
	{
		return $this->_nombrePersonne;
	}

    /**
     * @return mixed
     */
	public function getTitre()
	{
		return $this->_titre;
	}

    /**
     * @return mixed
     */
	public function getImage()
	{
		return $this->_image;
	}

    /**
     * @return string
     */
	public function getIngredient()
	{
		return $this->_ingredient;
	}

    /**
     * @return null|string|string[]
     */
	public function getIngredientNl()
    {
        return preg_replace("/\<br\s*\/?\>/i", "\n", $this->_ingredient);
    }

    /**
     * @return string
     */
    public function getIngredientBr()
    {
        return nl2br($this->_ingredient);
    }

    /**
     * @return mixed
     */
	public function getDescription()
	{
		return $this->_description;
	}

    /**
     * @return mixed
     */
	public function getDescriptionDet()
	{
		return $this->_descriptionDet;
	}

    /**
     * @return mixed
     */
    //br to nl pour gestion des inputs etc
    public function getEtapesNl()
    {
        return preg_replace("/\<br\s*\/?\>/i", "\n", $this->_etapes);
    }
    //nl to br pour affichage sur le navigateur
    public function getEtapesBr()
    {
        return nl2br($this->_etapes);
    }

    /**
     * @return mixed
     */
    public function getEtapes()
    {
        return $this->_etapes;
    }


    /**
     * @return mixed
     */
	public function getAuteur()
	{
		return $this->_auteur;
	}

    /**
     * @return mixed
     */
	public function getNombreBurn()
    {
        return $this->_nombreBurn;
    }


    /**
     * @return string
     */
	public function __toString()
	{
		return $this->_id.','.$this->_nombrePersonne.','.$this->_titre.','.$this->_image.','.$this->_ingredient.','.$this->_description.','.$this->_auteur;
	}
}
