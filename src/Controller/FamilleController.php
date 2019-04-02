<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Famille;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Model;

/**
 * @Rest\Route("/api/familles")
 */
class FamilleController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("")
     * @Rest\View(statusCode = 200)
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns the list of available families in the kaso database",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Famille::class))
     *     )
     * )
     *
     * @SWG\Tag(name="familles")
     */
    public function getFamilles()
    {
        $em = $this->getDoctrine();
        $articles = $em->getRepository(Famille::class)->findAll();
        return $articles;
    }

    /**
     * @Rest\Get("/{id}")
     * @Rest\View(statusCode = 200)
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns the specified family",
     *     @Model(type=Famille::class)
     * )
     *
     * @SWG\Tag(name="familles")
     */
    public function getFamille(Famille $famille)
    {
        return $famille;
    }

    /**
     * @Rest\Get("/{id}/articles")
     * @Rest\View(statusCode = 200)
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns the list of articles for a specified family",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Article::class))
     *     )
     * )
     *
     * @SWG\Tag(name="familles")
     */
    public function getFamilleArticles(Famille $famille)
    {
        return $famille->getArticles();
    }
}