<?php

namespace App\pc\Entity;

class pcs
{
    protected $id;

    protected $nom;

    protected $marque;

    protected $os;

    protected $idUser;

    public function __construct($id, $nom, $marque, $os, $idUser)
    {
        $this->id = $id;
        $this->marque = $marque;
        $this->nom = $nom;
        $this->os = $os;
        $this->idUser = $idUser;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }

    public function setOs($os)
    {
        $this->os = $os;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function setMarque($marque)
    {
        $this->marque = $marque;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getOs()
    {
        return $this->os;
    }

    public function getMarque()
    {
        return $this->marque;
    }

    public function getIdUser()
    {
        return $this->idUser;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function toArray()
    {
        $array = array();
        $array['id'] = $this->id;
        $array['nom'] = $this->nom;
        $array['marque'] = $this->marque;
        $array['os'] = $this->os;

        return $array;
    }
}
