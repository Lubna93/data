<?php

namespace App\Handler;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;

class AuthenticationHandler implements LogoutSuccessHandlerInterface
{
    protected $cas_logout_target;

    public function __construct($cas_logout_target)
    {
        $this->cas_logout_target = $cas_logout_target;
    }

    public function onLogoutSuccess(Request $request) : Response
    {
        if(!empty($this->cas_logout_target)) {
            \phpCAS::logoutWithRedirectService($this->cas_logout_target);
        } else {
            \phpCAS::logout();
        }
    }
}