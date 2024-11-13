<?php

namespace App\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Ldap\Ldap;
//use App\EventListener\Request;
use Symfony\Component\HttpFoundation\Request;
use App\Security\LdapChecker;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\ErrorHandler\Error\UndefinedMethodError;

class AccessDeniedListener extends AbstractController implements EventSubscriberInterface, AccessDeniedHandlerInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            // the priority must be greater than the Security HTTP
            // ExceptionListener, to make sure it's called before
            // the default exception listener
            KernelEvents::EXCEPTION => ['onKernelException', 2],
        ];
    }

    public function onKernelException(ExceptionEvent $event)
    {   

        $exception = $event->getThrowable();
        if (!$exception instanceof AccessDeniedException  ) {
            return;
        }

    }

    /**
     * Handles an access denied failure.
     *
     * @return Response|null
     */

    public function handle(Request $request, AccessDeniedException $accessDeniedException): ?Response
    {
        if ($accessDeniedException->getMessage() == "Access Denied.") {
            // Render the template content and wrap it in a Response
            $content = $this->renderView('error/denied.html.twig');
            return new Response($content);
        } elseif (str_contains($accessDeniedException->getMessage(), 'SQL')) {
            dd($accessDeniedException);
            $content = $this->renderView('error/denied.html.twig');
            return new Response($content);
        } else {
            return null;
        }
    }

}
