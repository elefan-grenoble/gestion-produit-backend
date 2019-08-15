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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
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
        $supplyings = $em->getRepository(Supplying::class)->getOngoing();
        return $this->view($supplyings)->setContext($this->getContext());
    }

    /**
     * @Rest\Post("")
     * @Rest\QueryParam(name="articleCode")
     * @Rest\QueryParam(name="quantity")
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
    public function createSupplying($articleCode, $quantity)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $article = $em->getRepository(Article::class)->findOneByCode($articleCode);

        $supplying = new Supplying();
        $supplying->setArticle($article);
        $supplying->setCreationDate(new \DateTime());
        $supplying->setQuantity($quantity);
        $supplying->setOutOfStock(false);

        $em->persist($supplying);
        $em->flush();

        return $this->view(
            $supplying,
            Response::HTTP_CREATED
        );
    }

    /**
     * @Rest\Put("/{id}")
     * @Rest\View(statusCode = 204)
     *
     * @ParamConverter("updates", converter="fos_rest.request_body")
     *
     * @SWG\Response(
     *     response=204,
     *     description="Supplying updated",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Supplying::class))
     *     )
     * )
     *
     * @SWG\Tag(name="supplying")
     */
    public function updateSupplying(int $id, Supplying $updates)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $supplying = $em->getRepository(Supplying::class)->findOneById($id);

        $supplying->setQuantity($updates->getQuantity());
        $supplying->setOutOfStock($updates->getOutOfStock());
        $supplying->setSupplyDate($updates->getSupplyDate());

        $em->flush();

        return $this->view(
            null,
            Response::HTTP_NO_CONTENT
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