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

        $ip = $this->container->get('request_stack')->getCurrentRequest()->getClientIp();
        $ips = '127.0.0.1,78.209.62.101,193.33.56.47';
        $ips = explode(',',$ips);
        $locationOk =  (isset($ip) and in_array($ip,$ips));

        $response = [
            'logged' => $user !== null || $locationOk,
            'ip' => $ip,
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