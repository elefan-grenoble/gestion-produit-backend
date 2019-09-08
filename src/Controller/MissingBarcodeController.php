<?php


namespace App\Controller;

use App\Entity\MissingBarcode;
use App\Form\MissingBarcodeType;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Rest\Route("/missing_barcodes")
 */
class MissingBarcodeController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("")
     * @Rest\View(statusCode = 200)
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns the list of missing barcode",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=MissingBarcode::class))
     *     )
     * )
     *
     * @SWG\Tag(name="missing_barcode")
     */
    public function getMissingBarcodes()
    {
        $em = $this->getDoctrine();
        $missingBarcodes = $em->getRepository(MissingBarcode::class)->findAll();
        return $this->view($missingBarcodes)->setContext($this->getContext());
    }

    /**
     * @Rest\Post("")
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns the created missing barcode",
     *     @Model(type=MissingBarcode::class)
     * )
     *
     * @SWG\Tag(name="missing_barcode")
     * @param Request $request
     * @return View|FormInterface
     */
    public function postMissingBarcode(Request $request)
    {
        $missingBarcode = new MissingBarcode();
        $form = $this->createForm(MissingBarcodeType::class, $missingBarcode);

        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($missingBarcode);
            $em->flush();

            $view = $this->view($missingBarcode);
            $view->setContext($this->getContext());

            return $view;
        }

        return $form;
    }

    /**
     * @Rest\Delete("/{id}")
     *
     * @SWG\Response(
     *     response=204,
     *     description="Delete a missing barcode entry"
     * )
     *
     * @SWG\Tag(name="missing_barcode")
     * @param MissingBarcode $missingBarcode
     * @return \FOS\RestBundle\View\View
     */
    public function deleteMissingBarcode(MissingBarcode $missingBarcode)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($missingBarcode);
        $em->flush();

        return $this->view(null, Response::HTTP_NO_CONTENT);
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
