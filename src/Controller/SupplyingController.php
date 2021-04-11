<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Supplying;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\Model;
use phpDocumentor\Reflection\Types\Integer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
/**
 * @Rest\Route("/supplying")
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
class SupplyingController extends AbstractFOSRestController
{
    /**
     * @var array
     */
    private $recipients;

    public function __construct(array $recipients)
    {
        $this->recipients = $recipients;
    }

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
    public function getSupplying(EntityManagerInterface $em)
    {
        $supplyings = $em->getRepository(Supplying::class)->findAll();
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
    public function createSupplying($articleCode, $quantity, EntityManagerInterface $em)
    {
        $article = $em->getRepository(Article::class)->findOneByCode($articleCode);

        $supplying = new Supplying();
        $supplying->setArticle($article);
        $supplying->setCreationDate(new \DateTime());
        $supplying->setQuantity($quantity);

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
    public function updateSupplying(int $id, Supplying $updates, EntityManagerInterface $em)
    {
        $supplying = $em->getRepository(Supplying::class)->findOneById($id);
        $supplying->setQuantity($updates->getQuantity());

        $em->flush();

        return $this->view(
            null,
            Response::HTTP_NO_CONTENT
        );
    }

    /**
     * @Rest\Delete("/{id}")
     * @Rest\QueryParam(name="out_of_stock")
     *
     * @SWG\Response(
     *     response=204,
     *     description="Delete supplying"
     * )
     *
     * @SWG\Tag(name="supplying")
     */
    public function deleteSupplying(int $id, $out_of_stock, EntityManagerInterface $em, MailerInterface $mailer)
    {
        $supplying = $em->getRepository(Supplying::class)->findOneById($id);
        if (empty($supplying)) {
            return new View("Supplying not found", Response::HTTP_NOT_FOUND);
        } else {
            if ($out_of_stock === 'true' and $supplying->getArticle()->getStocks()->getQteStocks() > 0) {
                $email = (new TemplatedEmail())
                    ->to(...$this->recipients)
                    ->subject('Outch, problème de stock sur '.$supplying->getArticle()->getDesignation())
                    ->htmlTemplate('emails/supplying.html.twig')
                    ->context([
                        'article' => $supplying->getArticle()
                    ])
                ;
                $mailer->send($email);
            }
            $em->remove($supplying);
            $em->flush();
        }
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
