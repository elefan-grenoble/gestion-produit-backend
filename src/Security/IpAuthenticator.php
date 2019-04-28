<?php

namespace App\Security;

use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthUser;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\Security\Guard\Token\PostAuthenticationGuardToken;

class IpAuthenticator extends AbstractGuardAuthenticator
{
    private $vipIps;

    public function __construct(?string $vipIps)
    {
        $this->vipIps = $vipIps;
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        $data = [
            // you might translate this message
            'message' => 'Authentication Required'
        ];

        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }

    public function supports(Request $request)
    {
        $ip = $request->getClientIp();

        $vipIpArray = explode(',', $this->vipIps);
        return  (isset($ip) && in_array($ip, $vipIpArray));
    }


    public function getCredentials(Request $request)
    {
        return [
            'ip' => $request->getClientIp()
        ];
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        return new OAuthUser('anonymous');
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        return true;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        return null;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        return null;
    }

    public function supportsRememberMe()
    {
        return false;
    }

    public function createAuthenticatedToken(UserInterface $user, $providerKey)
    {
        $roles = $user->getRoles();
        $roles[] = 'ROLE_VIP_IP';

        return new PostAuthenticationGuardToken(
            $user,
            $providerKey,
            $roles
        );
    }
}
