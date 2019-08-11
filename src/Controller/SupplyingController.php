<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Supplying;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\Model;
use phpDocumentor\Reflection\Types\Integer;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Rest\Route("/supplying")
 */
class SupplyingController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("")
     * @Rest\View(statusCode = 200)
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns the supplying list from kaso database",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Supplying::class))
     *     )
     * )
     *
     * @SWG\Tag(name="supplying")
     */
    public function getSupplying()
    {
        $em = $this->getDoctrine();
        $supplyings = $em->getRepository(Supplying::class)->findAll();
        return $this->view($supplyings)->setContext($this->getContext());
    }

    /**
     * @Rest\Post("/{id}/quantity/{quantity}")
     * @Rest\View(statusCode = 201)
     *
     * @SWG\Response(
     *     response=201,
     *     description="Returns the supplying created",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Supplying::class))
     *     )
     * )
     *
     * @SWG\Tag(name="supplying")
     */
    public function createSupplying(Article $article, int $quantity)
    {
        $supplying = new Supplying();
        $supplying->setArticle($article);
        $supplying->setCreationDate(new \DateTime());
        $supplying->setQuantity($quantity);

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($supplying);
        $em->flush();

        return $this->view(
            $supplying,
            Response::HTTP_CREATED
        );
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