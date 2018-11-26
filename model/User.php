<?php

class User
{
    private $_id;
    private $_nameUser;
    private $_password;
    private $_mailAdress;
    //private $_hashValidation;
    private $_inscriptionDate;
    private $_avatar;
    private $_confirmkey;

    /**
     * User constructor.
     * @param $nom
     * @param $mdp
     * @param $mail
     * @param null $confirmkey
     */
    public function __construct($nom, $mdp,$mail,$confirmkey = null)
    {
        $this->_nameUser =$nom;
        $this->_mailAdress = $mail;
        $this->_password = $mdp;
        $this->_confirmkey = $confirmkey;
        //$this->hydrate($data);
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
     * @return mixed
     */
    public function getNameUser()
    {
        return $this->_nameUser;
    }

    /**
     * @param $number
     */
    public function setId($number)
    {
        $this->_id = $number;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }
    /**
     * @param mixed $nameUser
     */
    public function setNameUser($nameUser)
    {
        if(is_string($nameUser))
            $this->_nameUser = $nameUser;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * @param mixed $passord
     */
    public function setPassord($password)
    {

        $this->_passord = $password;
    }

    /**
     * @return mixed
     */
    public function getMailAdress()
    {
        return $this->_mailAdress;
    }

    /**
     * @param mixed $mailAdress
     */
    public function setMailAdress($mailAdress)
    {
        if(is_string($mailAdress))
            $this->_mailAdress = $mailAdress;
    }

    public function getConfirmKey()
    {
        return $this->_confirmkey;
    }

    /**
     * @param mixed $mailAdress
     */
    public function setConfirmKey($mailAdress)
    {
        if(is_numeric($mailAdress))
            $this->_confirmkey = $mailAdress;
    }

    /**
     * @return mixed
     */
    public function getInscriptionDate()
    {
        return $this->_inscriptionDate;
    }

    /**
     * @param mixed $inscriptionDate
     */
    public function setInscriptionDate($inscriptionDate)
    {
        $this->_inscriptionDate = $inscriptionDate;
    }

    /**
     * @return mixed
     */
    public function getAvatar()
    {
        return $this->_avatar;
    }

    /**
     * @param mixed $avatar
     */
    public function setAvatar($avatar)
    {
        $this->_avatar = $avatar;
    }


}