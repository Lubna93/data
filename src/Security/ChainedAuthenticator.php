<?php
namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use L3\Bundle\CasGuardBundle\Security\CasAuthenticator as FirstCasAuthenticator; // Import the correct CasAuthenticator
use App\lib\CasCuardBundle\Security\CasAuthenticator as SecondCasAuthenticator; // Import the second CasAuthenticator

class ChainedAuthenticator extends AbstractAuthenticator
{
    private $firstCasAuthenticator;
    private $secondCasAuthenticator;

    public function __construct(
        FirstCasAuthenticator $firstCasAuthenticator,
        SecondCasAuthenticator $secondCasAuthenticator
    ) {
        $this->firstCasAuthenticator = $firstCasAuthenticator;
        $this->secondCasAuthenticator = $secondCasAuthenticator;
    }

    public function supports(Request $request): ?bool
    {
        return $this->firstCasAuthenticator->supports($request) || $this->secondCasAuthenticator->supports($request);
    }

    public function authenticate(Request $request): Passport
    {
        if ($this->firstCasAuthenticator->supports($request)) {
            return $this->firstCasAuthenticator->authenticate($request);
        }

        return $this->secondCasAuthenticator->authenticate($request);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        if ($this->firstCasAuthenticator->supports($request)) {
            return $this->firstCasAuthenticator->onAuthenticationSuccess($request, $token, $firewallName);
        }

        return $this->secondCasAuthenticator->onAuthenticationSuccess($request, $token, $firewallName);
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        return new Response('Authentication Failed', 403);
    }
}

