<?php

namespace AppBundle\Tests\Controller;

use AppBundle\Controller\WidgetController;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class WidgetControllerTest
 */
class WidgetControllerTest extends KernelTestCase
{
    /**
     *
     */
    public function setUp()
    {
        parent::setUp();
        self::bootKernel();
    }

    /**
     *
     */
    public function testIndexAction()
    {
        $controller = new WidgetController(self::$kernel->getContainer());

        $this->markTestIncomplete('Action tests need to be implemented');
    }
}