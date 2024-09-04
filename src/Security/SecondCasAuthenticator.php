<?php

namespace App\Security;

use App\lib\CasCuardBundle\Security\CasAuthenticator as CustomCasAuthenticator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;

class SecondCasAuthenticator extends AbstractAuthenticator
{
    private $customCasAuthenticator;

    public function __construct(CustomCasAuthenticator $customCasAuthenticator)
    {
        $this->customCasAuthenticator = $customCasAuthenticator;
    }

    public function supports(Request $request): ?bool
    {
        return $this->customCasAuthenticator->supports($request);
    }

    public function authenticate(Request $request): Passport
    {
        return $this->customCasAuthenticator->authenticate($request);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return $this->customCasAuthenticator->onAuthenticationSuccess($request, $token, $firewallName);
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        return $this->customCasAuthenticator->onAuthenticationFailure($request, $exception);
    }
}
