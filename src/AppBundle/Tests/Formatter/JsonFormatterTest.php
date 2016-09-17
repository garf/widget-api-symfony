<?php

namespace AppBundle\Tests\Factory;

use AppBundle\Formatter\JsonFormatter;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class JsonFormatterTest
 */
class JsonFormatterTest extends KernelTestCase
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     *
     */
    public function setUp()
    {
        parent::setUp();
        self::bootKernel();

        $this->container = self::$kernel->getContainer();
    }

    /**
     * Tests that formatter creates correct response
     */
    public function testFactoryReturnsCorrectResponse()
    {
        $formatter = new JsonFormatter();

        $formatter->addParam('foo', 'bar');
        $formatter->addParam('bar', 'baz');

        $this->assertInstanceOf(Response::class, $formatter->getResponse());
    }

    /**
     * Tests that formatter creates correct format of data
     */
    public function testFactoryCreatesCorrectFormat()
    {
        $formatter = new JsonFormatter();

        $formatter->addParam('foo', 'bar');
        $formatter->addParam('bar', 'baz');

        $response = $this->createResponse();

        $this->assertEquals($formatter->getResponse(), $response);
    }

    /**
     * @return JsonResponse
     */
    private function createResponse()
    {
        $data = [
            'foo' => 'bar',
            'bar' => 'baz',
        ];

        return new JsonResponse($data);
    }
}