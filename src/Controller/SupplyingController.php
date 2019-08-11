<?php

namespace App\Controller;

use App\Entity\Supplying;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;

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
        $reappros = $em->getRepository(Supplying::class)->findAll();
        return $this->view($reappros)->setContext($this->getContext());
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