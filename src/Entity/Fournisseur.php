<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Fournisseur
 *
 * @ORM\Table(name="FOURNISSEUR")
 * @ORM\Entity(readOnly=true)
 */
class Fournisseur
{
    /**
     * @var int
     *
     * @ORM\Column(name="code", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=128, nullable=false)
     */
    private $nom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="addresse1", type="string", length=128, nullable=true)
     */
    private $addresse1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="addresse2", type="string", length=128, nullable=true)
     */
    private $addresse2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ville", type="string", length=128, nullable=true)
     */
    private $ville;

    /**
     * @var string|null
     *
     * @ORM\Column(name="code_postal", type="string", length=64, nullable=true)
     */
    private $codePostal;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mt_franco", type="string", length=64, nullable=true)
     */
    private $mtFranco;

    /**
     * @var string|null
     *
     * @ORM\Column(name="tva_intercommunautaire", type="string", length=64, nullable=true)
     */
    private $tvaIntercommunautaire;

    /**
     * @var string|null
     *
     * @ORM\Column(name="delai", type="string", length=64, nullable=true)
     */
    private $delai;

    /**
     * @var string|null
     *
     * @ORM\Column(name="remise", type="string", length=64, nullable=true)
     */
    private $remise;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom_contact", type="string", length=64, nullable=true)
     */
    private $nomContact;

    /**
     * @var string|null
     *
     * @ORM\Column(name="telephone", type="string", length=64, nullable=true)
     */
    private $telephone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="portable", type="string", length=64, nullable=true)
     */
    private $portable;

    /**
     * @var string|null
     *
     * @ORM\Column(name="fax", type="string", length=64, nullable=true)
     */
    private $fax;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=64, nullable=true)
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="site_internet", type="string", length=64, nullable=true)
     */
    private $siteInternet;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="App\Entity\Article", mappedBy="fournisseur")
     * @Serializer\Exclude()
     */
    private $articles;

    /**
     * Get code.
     *
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Get nom.
     *
     * @return string|null
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Get addresse1.
     *
     * @return string|null
     */
    public function getAddresse1()
    {
        return $this->addresse1;
    }

    /**
     * Get addresse2.
     *
     * @return string|null
     */
    public function getAddresse2()
    {
        return $this->addresse2;
    }

    /**
     * Get ville.
     *
     * @return string|null
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Get codePostal.
     *
     * @return string|null
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Get mtFranco.
     *
     * @return string|null
     */
    public function getMtFranco()
    {
        return $this->mtFranco;
    }


    /**
     * Get tvaIntercommunautaire.
     *
     * @return string|null
     */
    public function getTvaIntercommunautaire()
    {
        return $this->tvaIntercommunautaire;
    }

    /**
     * Get delai.
     *
     * @return string|null
     */
    public function getDelai()
    {
        return $this->delai;
    }

    /**
     * Get remise.
     *
     * @return string|null
     */
    public function getRemise()
    {
        return $this->remise;
    }

    /**
     * Get nomContact.
     *
     * @return string|null
     */
    public function getNomContact()
    {
        return $this->nomContact;
    }

    /**
     * Get telephone.
     *
     * @return string|null
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Get portable.
     *
     * @return string|null
     */
    public function getPortable()
    {
        return $this->portable;
    }

    /**
     * Get fax.
     *
     * @return string|null
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Get email.
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get siteInternet.
     *
     * @return string|null
     */
    public function getSiteInternet()
    {
        return $this->siteInternet;
    }

    /**
     * @return Collection
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }
}
