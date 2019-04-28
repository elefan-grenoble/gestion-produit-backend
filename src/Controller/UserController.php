<?php

namespace App\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;

class UserController extends AbstractFOSRestController
{
    /**
     *  @SWG\Response(
     *     response=200,
     *     description="Returns the status of the user",
     *     @SWG\Schema(
     *        type="object",
     *        @SWG\Property(property="logged", type="boolean", description="If the user is connected or not"),
     *        @SWG\Property(property="oauth_url", type="string", description="The OAuth connection URL"),
     *        @SWG\Property(property="user", type="object", description="The user object", @SWG\Property(property="username", type="string", description="The username of the user"))
     *     )
     * )
     *
     * @Route("/user/status", name="user_status", methods={"GET"})
     */
    public function loginStatus()
    {
        $user = $this->getUser();

        $response = [
            'logged' => $this->isGranted('ROLE_USER'),
            'vip_ip' => $this->isGranted('ROLE_VIP_IP'),
            'user' => null,
            'oauth_url' => $this->generateUrl('hwi_oauth_service_redirect', ['service' => 'custom'])
        ];

        if ($user) {
            $response['user'] = [
                'username' => $user->getUsername()
            ];
        }

        return $this->json($response);
    }
}
