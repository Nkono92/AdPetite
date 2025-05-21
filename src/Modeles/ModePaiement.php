<?php

// src/Modeles/ModePaiement.php

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="ModePaiement")
 */
class ModePaiement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="bigint")
     */
    protected $IdModePaiement;

    /**
     * @ORM\Column(type="string", length=10, name="CodeMode", unique=true)
     */
    protected  $CodeMode;

    /**
     * @ORM\Column(type="string", length=250, name="Libelle")
     */
    protected $Libelle;


    /**
     * Get idModePaiement.
     *
     * @return int
     */
    public function getIdModePaiement()
    {
        return $this->IdModePaiement;
    }

    /**
     * Set codeMode.
     *
     * @param string $codeMode
     *
     * @return ModePaiement
     */
    public function setCodeMode($codeMode)
    {
        $this->CodeMode = $codeMode;

        return $this;
    }

    /**
     * Get codeMode.
     *
     * @return string
     */
    public function getCodeMode()
    {
        return $this->CodeMode;
    }

    /**
     * Set libelle.
     *
     * @param string $libelle
     *
     * @return ModePaiement
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
