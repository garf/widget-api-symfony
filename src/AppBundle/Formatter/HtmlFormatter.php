<?php

namespace AppBundle\Formatter;

use Symfony\Bundle\TwigBundle\TwigEngine;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class HtmlFormatter
 */
class HtmlFormatter extends AbstractFormatter
{
    /**
     * @var TwigEngine
     */
    private $twig;

    /**
     * HtmlFormatter constructor.
     *
     * @param TwigEngine $twig
     */
    public function __construct(TwigEngine $twig)
    {
        $this->twig = $twig;
    }
    
    /**
     * @return Response
     */
    public function getResponse()
    {
        return $this->twig->renderResponse('average-rating.twig', ['params' => $this->params]);
    }
}
