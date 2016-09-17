<?php

namespace AppBundle\Formatter;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class JsonFormatter
 */
class JsonFormatter extends AbstractFormatter
{
    /**
     * @return JsonResponse
     */
    public function getResponse()
    {
        $result = [];
        
        foreach ($this->params as $param) {
            $result[$param->getCaption()] = $param->getValue();
        }

        return new JsonResponse($result);
    }
}
