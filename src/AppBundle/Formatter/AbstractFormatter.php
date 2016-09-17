<?php

namespace AppBundle\Formatter;
use AppBundle\DTO\ParamDTO;

/**
 * Class AbstractFormatter
 */
abstract class AbstractFormatter implements FormatterInterface
{
    /**
     * @var ParamDTO[]
     */
    protected $params = [];

    /**
     * @param string           $caption
     * @param string|int|float $value
     *
     * @return $this
     */
    public function addParam($caption, $value)
    {
        $dto = new ParamDTO();
        $dto->setCaption($caption);
        $dto->setValue($value);
        
        $this->params[] = $dto;

        return $this;
    }
}
