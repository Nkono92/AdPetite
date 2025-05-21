<?php

//require_once 'App_Start/Modele.php';

// src/Modeles/TypeAnnonce.php

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="TypeAnnonce")
 */
class TypeAnnonce
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="bigint")
     */
    protected $IdTypeAnnonce;

    /**
     * @ORM\Column(type="string", length=250, name="Libelle")
     */
    protected $Libelle;


    /**
     * Get idTypeAnnonce.
     *
     * @return int
     */
    public function getIdTypeAnnonce()
    {
        return $this->IdTypeAnnonce;
    }

    /**
     * Set libelle.
     *
     * @param string $libelle
     *
     * @return TypeAnnonce
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
