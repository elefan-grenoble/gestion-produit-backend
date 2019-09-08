<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vente
 *
 * @ORM\Table(name="VENTE")
 * @ORM\Entity(readOnly=true)
 */
class Vente
{
    /**
     * @var string
     *
     * @ORM\Column(name="designation_article", type="string", length=56, nullable=false)
     */
    private $designationArticle;

    /**
     * @var string
     *
     * @ORM\Column(name="quantite", type="decimal", precision=40, scale=30, nullable=false)
     */
    private $quantite;

    /**
     * @var string
     *
     * @ORM\Column(name="ca_ht", type="decimal", precision=10, scale=3, nullable=false)
     */
    private $caHt;

    /**
     * @var string
     *
     * @ORM\Column(name="ca_ttc", type="decimal", precision=10, scale=3, nullable=false)
     */
    private $caTtc;

    /**
     * @var Article
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="App\Entity\Article")
     * @ORM\JoinColumn(name="code_article", referencedColumnName="code")
     */
    private $article;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $date;

    /**
     * Get designationArticle.
     *
     * @return string
     */
    public function getDesignationArticle()
    {
        return $this->designationArticle;
    }

    /**
     * Get quantite.
     *
     * @return string
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Get caHt.
     *
     * @return string
     */
    public function getCaHt()
    {
        return $this->caHt;
    }

    /**
     * Get caTtc.
     *
     * @return string
     */
    public function getCaTtc()
    {
        return $this->caTtc;
    }

    /**
     * Get date.
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return Article
     */
    public function getArticle(): Article
    {
        return $this->article;
    }

    public function setDesignationArticle(string $designationArticle): self
    {
        $this->designationArticle = $designationArticle;

        return $this;
    }

    public function setQuantite($quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function setCaHt($caHt): self
    {
        $this->caHt = $caHt;

        return $this;
    }

    public function setCaTtc($caTtc): self
    {
        $this->caTtc = $caTtc;

        return $this;
    }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

        return $this;
    }
}
