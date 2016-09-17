<?php

namespace AppBundle\Formatter;

use Symfony\Component\HttpFoundation\Response;

/**
 * Class XmlFormatter
 */
class XmlFormatter extends AbstractFormatter
{
    /**
     * @return Response
     */
    public function getResponse()
    {
        $xml = new \SimpleXMLElement('<ratingWidget/>');

        foreach ($this->params as $param) {
            $xml->addChild($param->getCaption(), $param->getValue());
        }

        return new Response($xml->asXML(), 200, ['Content-Type' => 'text/xml']);
    }
}
