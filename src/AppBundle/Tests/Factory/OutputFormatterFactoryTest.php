<?php

namespace AppBundle\Tests\Factory;

use AppBundle\Factory\OutputFormatterFactory;
use AppBundle\Formatter\HtmlFormatter;
use AppBundle\Formatter\JsonFormatter;
use AppBundle\Formatter\PngFormatter;
use AppBundle\Formatter\XmlFormatter;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class OutputFormatterFactoryTest
 */
class OutputFormatterFactoryTest extends KernelTestCase
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
     * Tests that factory creates correct instance of formatter
     */
    public function testFactoryReturnsCorrectFormatterName()
    {
        $this->assertInstanceOf(XmlFormatter::class, OutputFormatterFactory::factory($this->container, 'xml'));
        $this->assertInstanceOf(JsonFormatter::class, OutputFormatterFactory::factory($this->container, 'json'));
        $this->assertInstanceOf(HtmlFormatter::class, OutputFormatterFactory::factory($this->container, 'html'));
        $this->assertInstanceOf(PngFormatter::class, OutputFormatterFactory::factory($this->container, 'png'));
    }
}