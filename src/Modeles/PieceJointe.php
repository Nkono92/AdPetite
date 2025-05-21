<?php

//require_once 'App_Start/Modele.php';

// src/Modeles/PieceJointe.php

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="PieceJointe")
 */
class PieceJointe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="bigint")
     */
    protected $IdPieceJointe;

    /**
     * @ORM\Column(type="string", length=250, name="Libelle")
     */
    protected $Libelle;

    /**
     * @ORM\Column(type="string", length=256, name="Url")
     */
    protected $Url;

    // Relation Many to One vers TypePieceJointe
    /**
     * @ORM\ManyToOne(targetEntity="TypePieceJointe")
     * @ORM\JoinColumn(name="IdTypePieceJointe", referencedColumnName="IdTypePieceJointe", nullable=false)
     */
    protected $TypePieceJointe;

    // Relation Many to One vers Annonce
    /**
     * @ORM\ManyToOne(targetEntity="Annonce", inversedBy="$LesPiecesJointes")
     * @ORM\JoinColumn(name="IdAnnonce", referencedColumnName="IdAnnonce", nullable=false)
     */
    protected $Annonce;


    /**
     * Get idPieceJointe.
     *
     * @return int
     */
    public function getIdPieceJointe()
    {
        return $this->IdPieceJointe;
    }

    /**
     * Set libelle.
     *
     * @param string $libelle
     *
     * @return PieceJointe
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

    /**
     * Set url.
     *
     * @param string $url
     *
     * @return PieceJointe
     */
    public function setUrl($url)
    {
        $this->Url = $url;

        return $this;
    }

    /**
     * Get url.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->Url;
    }

    /**
     * Set typePieceJointe.
     *
     * @param \TypePieceJointe $typePieceJointe
     *
     * @return PieceJointe
     */
    public function setTypePieceJointe(\TypePieceJointe $typePieceJointe)
    {
        $this->TypePieceJointe = $typePieceJointe;

        return $this;
    }

    /**
     * Get typePieceJointe.
     *
     * @return \TypePieceJointe
     */
    public function getTypePieceJointe()
    {
        return $this->TypePieceJointe;
    }

    /**
     * Set annonce.
     *
     * @param \Annonce $annonce
     *
     * @return PieceJointe
     */
    public function setAnnonce(\Annonce $annonce)
    {
        $this->Annonce = $annonce;

        return $this;
    }

    /**
     * Get annonce.
     *
     * @return \Annonce
     */
    public function getAnnonce()
    {
        return $this->Annonce;
    }
}
