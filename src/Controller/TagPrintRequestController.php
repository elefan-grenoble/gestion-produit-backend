<?php

namespace App\Controller;

use App\Entity\TagPrintRequest;
use App\Form\TagPrintRequestType;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Swagger\Annotations as SWG;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Rest\Route("/tag_print_requests")
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
class TagPrintRequestController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("")
     * @Rest\View(statusCode = 200)
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns the list of tag print requests",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=TagPrintRequest::class))
     *     )
     * )
     *
     * @SWG\Tag(name="tag_print_request")
     */
    public function getTagPrintRequests()
    {
        $em = $this->getDoctrine();
        $tagPrintRequests = $em->getRepository(TagPrintRequest::class)->findAll();
        return $this->view($tagPrintRequests)->setContext($this->getContext());
    }

    /**
     * @Rest\Post("")
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns the created tag print request",
     *     @Model(type=TagPrintRequest::class)
     * )
     *
     * @SWG\Tag(name="tag_print_request")
     * @param Request $request
     * @return View|FormInterface
     */
    public function postTagPrintRequest(Request $request)
    {
        $tagPrintRequest = new TagPrintRequest();
        $form = $this->createForm(TagPrintRequestType::class, $tagPrintRequest);

        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($tagPrintRequest);
            $em->flush();

            $view = $this->view($tagPrintRequest);
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
     *     description="Delete a tag print request"
     * )
     *
     * @SWG\Tag(name="tag_print_request")
     * @param TagPrintRequest $tagPrintRequest
     * @return \FOS\RestBundle\View\View
     */
    public function deleteTagPrintRequest(TagPrintRequest $tagPrintRequest)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($tagPrintRequest);
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
