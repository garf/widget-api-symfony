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
    }

    /**
     * Tests that formatter creates correct format of data
     */
    public function testFactoryCreatesCorrectFormat()
    {
        $formatter = new XmlFormatter();

        $formatter->addParam('foo', 'bar');
        $formatter->addParam('bar', 'baz');

        $response = $this->createResponse();

        $this->assertEquals($formatter->getResponse(), $response);
    }

    /**
     * @return Response
     */
    private function createResponse()
    {
        $dto1 = new ParamDTO();

        $dto1->setCaption('foo');
        $dto1->setValue('bar');

        $dto2 = new ParamDTO();

        $dto2->setCaption('bar');
        $dto2->setValue('baz');

        $data = [
            $dto1,
            $dto2,
        ];

        $xml = new \SimpleXMLElement('<UserRating/>');

        foreach ($data as $param) {
            $xml->addChild($param->getCaption(), $param->getValue());
        }

        return new Response($xml->asXML(), 200, ['Content-Type' => 'text/xml']);
    }
}