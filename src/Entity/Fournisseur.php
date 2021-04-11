<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
     * @Serializer\Exclude
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
     * @Serializer\Exclude
     */
    private $addresse1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="addresse2", type="string", length=128, nullable=true)
     * @Serializer\Exclude
     */
    private $addresse2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ville", type="string", length=128, nullable=true)
     * @Serializer\Exclude
     */
    private $ville;

    /**
     * @var string|null
     *
     * @ORM\Column(name="code_postal", type="string", length=64, nullable=true)
     * @Serializer\Exclude
     */
    private $codePostal;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mt_franco", type="string", length=64, nullable=true)
     * @Serializer\Exclude
     */
    private $mtFranco;

    /**
     * @var string|null
     *
     * @ORM\Column(name="tva_intercommunautaire", type="string", length=64, nullable=true)
     * @Serializer\Exclude
     */
    private $tvaIntercommunautaire;

    /**
     * @var string|null
     *
     * @ORM\Column(name="delai", type="string", length=64, nullable=true)
     * @Serializer\Exclude
     */
    private $delai;

    /**
     * @var string|null
     *
     * @ORM\Column(name="remise", type="string", length=64, nullable=true)
     * @Serializer\Exclude
     */
    private $remise;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom_contact", type="string", length=64, nullable=true)
     * @Serializer\Exclude
     */
    private $nomContact;

    /**
     * @var string|null
     *
     * @ORM\Column(name="telephone", type="string", length=64, nullable=true)
     * @Serializer\Exclude
     */
    private $telephone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="portable", type="string", length=64, nullable=true)
     * @Serializer\Exclude
     */
    private $portable;

    /**
     * @var string|null
     *
     * @ORM\Column(name="fax", type="string", length=64, nullable=true)
     * @Serializer\Exclude
     */
    private $fax;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=64, nullable=true)
     * @Serializer\Exclude
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="site_internet", type="string", length=64, nullable=true)
     * @Serializer\Exclude
     */
    private $siteInternet;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="App\Entity\Article", mappedBy="fournisseur")
     * @Serializer\Exclude()
     */
    private $articles;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

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

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function setAddresse1(?string $addresse1): self
    {
        $this->addresse1 = $addresse1;

        return $this;
    }

    public function setAddresse2(?string $addresse2): self
    {
        $this->addresse2 = $addresse2;

        return $this;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function setCodePostal(?string $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function setMtFranco(?string $mtFranco): self
    {
        $this->mtFranco = $mtFranco;

        return $this;
    }

    public function setTvaIntercommunautaire(?string $tvaIntercommunautaire): self
    {
        $this->tvaIntercommunautaire = $tvaIntercommunautaire;

        return $this;
    }

    public function setDelai(?string $delai): self
    {
        $this->delai = $delai;

        return $this;
    }

    public function setRemise(?string $remise): self
    {
        $this->remise = $remise;

        return $this;
    }

    public function setNomContact(?string $nomContact): self
    {
        $this->nomContact = $nomContact;

        return $this;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function setPortable(?string $portable): self
    {
        $this->portable = $portable;

        return $this;
    }

    public function setFax(?string $fax): self
    {
        $this->fax = $fax;

        return $this;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function setSiteInternet(?string $siteInternet): self
    {
        $this->siteInternet = $siteInternet;

        return $this;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->setFournisseur($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->contains($article)) {
            $this->articles->removeElement($article);
            // set the owning side to null (unless already changed)
            if ($article->getFournisseur() === $this) {
                $article->setFournisseur(null);
            }
        }

        return $this;
    }
}
