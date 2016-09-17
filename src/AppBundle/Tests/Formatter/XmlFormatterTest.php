<?php

namespace AppBundle\Tests\Factory;

use AppBundle\DTO\ParamDTO;
use AppBundle\Formatter\XmlFormatter;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class XmlFormatterTest
 */
class XmlFormatterTest extends KernelTestCase
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
        $formatter = new XmlFormatter();

        $formatter->addParam('foo', 'bar');
        $formatter->addParam('bar', 'baz');

        $this->assertInstanceOf(Response::class, $formatter->getResponse());
        $this->assertEquals('text/xml', $formatter->getResponse()->headers->get('Content-type'));
    }

    /**
     * Tests that formatter creates correct format of data
     */
    public function testFactoryCreatesCorrectFormat()
    {
        $formatter = new XmlFormatter();

        $formatter->addParam('foo', 'bar');
        $formatter->addParam('bar', 'baz');

        $formatterDom = new \SimpleXMLElement($formatter->getResponse()->getContent());

        $this->assertEquals('bar', $formatterDom->foo);
        $this->assertEquals('baz', $formatterDom->bar);
    }
}
