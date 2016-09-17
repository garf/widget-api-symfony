<?php

namespace AppBundle\Tests\Factory;

use AppBundle\DTO\ParamDTO;
use AppBundle\Formatter\PngFormatter;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PngFormatterTest
 */
class PngFormatterTest extends KernelTestCase
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
        $formatter = new PngFormatter();

        $formatter->addParam('foo', 'bar');
        $formatter->addParam('bar', 'baz');

        $this->assertInstanceOf(Response::class, $formatter->getResponse());
    }
//
    /**
     * Tests that formatter creates correct format of data
     */
    public function testFactoryCreatesCorrectFormat()
    {
        $formatter = new PngFormatter();

        $formatter->addParam('foo', 'bar');
        $formatter->addParam('bar', 'baz');

        $this->assertEquals('image/png', $formatter->getResponse()->headers->get('Content-type'));
    }
}
