<?php

namespace AppBundle\Tests\DTO;

use AppBundle\DTO\ParamDTO;

/**
 * Class ParamDTOTest
 */
class ParamDTOTest extends \PHPUnit_Framework_TestCase
{
    public function testArrayReturnsFields()
    {
        $dto = new ParamDTO();

        $fields = [
            'caption',
            'value',
        ];

        $this->assertTrue(
            count(array_intersect_key(array_flip($fields), $dto->toArray())) === count($fields)
        );
    }
}