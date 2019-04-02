<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Famille
 *
 * @ORM\Table(name="FAMILLE")
 * @ORM\Entity(readOnly=true)
 */
class Famille
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="code", type="integer")
     */
    private $code;

    /**
     * @var int
     *
     * @ORM\Column(name="code_s_famille", type="integer")
     */
    private $codeSFamille;

    /**
     * @var int
     *
     * @ORM\Column(name="code_ss_famille", type="integer")
     */
    private $codeSsFamille;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=512, nullable=false)
     */
    private $nom;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="App\Entity\Article", mappedBy="famille")
     * @Serializer\Exclude()
     */
    private $articles;

    /**
     * Get nom.
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
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
     * Get codeSFamille.
     *
     * @return int
     */
    public function getCodeSFamille()
    {
        return $this->codeSFamille;
    }

    /**
     * Get codeSsFamille.
     *
     * @return int
     */
    public function getCodeSsFamille()
    {
        return $this->codeSsFamille;
    }

    /**
     * @return Collection
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
