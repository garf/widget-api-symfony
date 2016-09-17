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

        $response = $this->createResponse();

        $this->assertEquals($formatter->getResponse(), $response);
    }

    /**
     * @return JsonResponse
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

        $image = imagecreate(800, 200);
        imagecolorallocate($image, 200, 200, 255);
        $textcolor = imagecolorallocate($image, 0, 0, 255);


        foreach ($data as $index => $param) {
            $string = $param->getCaption().': '.$param->getValue();

            imagestring($image, 5, 50, ($index + 1) * 30, $string, $textcolor);
        }

        imagepng($image, '/tmp/1.png');
        imagedestroy($image);

        return new Response(file_get_contents('/tmp/1.png'), 200, ['Content-Type' => 'image/png', '']);
    }
}