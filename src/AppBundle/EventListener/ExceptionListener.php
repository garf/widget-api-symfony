<?php

namespace AppBundle\EventListener;

use AppBundle\Exception\UserNotFoundException;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
/**
 * Class ExceptionListener
 */
class ExceptionListener
{
    /**
     * @param GetResponseForExceptionEvent $event
     */
    public function onKernelResponse(GetResponseForExceptionEvent $event)
    {
        $e = $event->getException();
        if ($e instanceof UserNotFoundException) {
            $response = new Response($e->getMessage(), 404);
            $event->setResponse($response);
        }

        if ($e instanceof ServiceNotFoundException) {
            $response = new Response('We don\'t have such format. Wish we could. :(', 404);
            $event->setResponse($response);
        }
    }
}