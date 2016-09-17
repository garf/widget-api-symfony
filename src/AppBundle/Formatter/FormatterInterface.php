<?php

namespace AppBundle\Formatter;

use Symfony\Component\HttpFoundation\Response;

/**
 * Interface FormatterInterface
 */
interface FormatterInterface
{
    /**
     * @param string           $caption
     * @param string|int|float $value
     * 
     * @return $this
     */
    public function addParam($caption, $value);

    /**
     * @return Response
     */
    public function getResponse();
}