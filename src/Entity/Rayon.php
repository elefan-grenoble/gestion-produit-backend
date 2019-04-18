<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rayon
 *
 * @ORM\Table(name="RAYON")
 * @ORM\Entity(readOnly=true)
 */
class Rayon
{

    /**
     * Code
     * @var int
     *
     * @ORM\Column(name="code", type="integer", nullable=false)
     */
    private $code;

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
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

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

}
