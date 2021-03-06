<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;

/**
 * @Rest\Route("/articles")
 */
class ArticleController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("")
     * @Rest\View(statusCode = 200)
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns the list of available articles in the kaso database",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Article::class))
     *     )
     * )
     *
     * @SWG\Tag(name="articles")
     */
    public function getArticles(EntityManagerInterface $em)
    {
        $articles = $em->getRepository(Article::class)->getActive();
        return $this->view($articles)->setContext($this->getContext());
    }

    /**
     * @Rest\Get("/{id}")
     * @Rest\View(statusCode = 200)
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns the specified article",
     *     @Model(type=Article::class)
     * )
     *
     * @SWG\Tag(name="articles")
     */
    public function getArticle(Article $article)
    {
        return $this->view($article)->setContext($this->getContext());
    }

    private function getContext()
    {
        $context = new Context();
        $context->setGroups(['Default']);
        if ($this->isGranted(['ROLE_USER'])) {
            $context->addGroup('privilegied');
        }
        return $context;
    }
}
