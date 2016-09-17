<?php

namespace AppBundle\Tests\Factory;

use AppBundle\DTO\ParamDTO;
use AppBundle\Formatter\HtmlFormatter;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class HtmlFormatterTest
 */
class HtmlFormatterTest extends KernelTestCase
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
        $formatter = new HtmlFormatter($this->container->get('templating'));

        $formatter->addParam('foo', 'bar');
        $formatter->addParam('bar', 'baz');

        $this->assertInstanceOf(Response::class, $formatter->getResponse());
    }

    /**
     * Tests that formatter creates correct format of data
     */
    public function testFactoryCreatesCorrectFormat()
    {
        $formatter = new HtmlFormatter($this->container->get('templating'));

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

        $params = [
            $dto1,
            $dto2,
        ];

        return $this->container->get('templating')->renderResponse('average-rating.twig', ['params' => $params]);
    }
}
