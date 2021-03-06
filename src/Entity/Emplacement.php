<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Emplacement
 *
 * @ORM\Table(name="EMPLACEMENT")
 * @ORM\Entity(readOnly=true)
 */
class Emplacement
{
    /**
     * Libelle
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", nullable=false)
     */
    private $libelle;

    /**
     * @var Article
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="App\Entity\Article", inversedBy="stocks")
     * @ORM\JoinColumn(name="code", referencedColumnName="code")
     */
    private $article;

    /**
     * @return string
     */
    public function getLibelle(): string
    {
        return $this->libelle;
    }

    /**
     * @return Article
     */
    public function getArticle(): Article
    {
        return $this->article;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

        return $this;
    }

}
