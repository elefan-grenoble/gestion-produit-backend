<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Fournisseur;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;

/**
 * @Rest\Route("/api/fournisseurs")
 */
class FournisseurController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("")
     * @Rest\View(statusCode = 200)
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns the list of available suppliers in the kaso database",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Fournisseur::class))
     *     )
     * )
     *
     * @SWG\Tag(name="fournisseurs")
     */
    public function getFournisseurs()
    {
        $em = $this->getDoctrine();
        $articles = $em->getRepository(Fournisseur::class)->findAll();
        return $articles;
    }

    /**
     *
     * @Rest\Get("/{id}")
     * @Rest\View(statusCode = 200)
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns the specified supplier",
     *     @Model(type=Fournisseur::class)
     * )
     *
     * @SWG\Tag(name="fournisseurs")
     *
     */
    public function getFournisseur(Fournisseur $fournisseur)
    {
        return $fournisseur;
    }

    /**
     * @Rest\Get("/{id}/articles")
     * @Rest\View(statusCode = 200)
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns the list of articles for a specified suuplier",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Article::class))
     *     )
     * )
     *
     * @SWG\Tag(name="fournisseurs")
     */
    public function getFournisseurArticles(Fournisseur $fournisseur)
    {
        return $fournisseur->getArticles();
    }
}