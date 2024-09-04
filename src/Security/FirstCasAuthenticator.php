<?php

namespace App\Security;

use L3\Bundle\CasGuardBundle\Security\CasAuthenticator as VendorCasAuthenticator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;

class FirstCasAuthenticator extends AbstractAuthenticator
{
    private $vendorCasAuthenticator;

    public function __construct(VendorCasAuthenticator $vendorCasAuthenticator)
    {
        $this->vendorCasAuthenticator = $vendorCasAuthenticator;
    }

    public function supports(Request $request): ?bool
    {
        return $this->vendorCasAuthenticator->supports($request);
    }

    public function authenticate(Request $request): Passport
    {
        return $this->vendorCasAuthenticator->authenticate($request);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return $this->vendorCasAuthenticator->onAuthenticationSuccess($request, $token, $firewallName);
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        return $this->vendorCasAuthenticator->onAuthenticationFailure($request, $exception);
    }
}
