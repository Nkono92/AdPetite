<?php

//require_once 'App_Start/Modele.php';

// src/Modeles/TypePieceJointe.php

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="TypePieceJointe")
 */
class TypePieceJointe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="bigint")
     */
    protected $IdTypePieceJointe;

    /**
     * @ORM\Column(type="string", length=250, name="Libelle")
     */
    protected $Libelle;

    /**
     * Get idTypePieceJointe.
     *
     * @return int
     */
    public function getIdTypePieceJointe()
    {
        return $this->IdTypePieceJointe;
    }

    /**
     * Set libelle.
     *
     * @param string $libelle
     *
     * @return TypePieceJointe
     */
    public function setLibelle($libelle)
    {
        $this->Libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle.
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->Libelle;
    }
}
