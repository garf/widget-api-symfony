<?php

namespace AppBundle\DTO;

/**
 * Class ParamDTO
 */
class ParamDTO
{
    /**
     * @var string
     */
    private $caption = '';

    /**
     * @var int|float|string
     */
    private $value = '';

    /**
     * @return string
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * @param string $caption
     *
     * @return ParamDTO
     */
    public function setCaption($caption)
    {
        $this->caption = $caption;

        return $this;
    }

    /**
     * @return float|int|string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param float|int|string $value
     *
     * @return ParamDTO
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return get_object_vars($this);
    }
}
