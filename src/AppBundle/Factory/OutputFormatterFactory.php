<?php

namespace AppBundle\Factory;

use AppBundle\Formatter\FormatterInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class OutputFormatterFactory
 */
class OutputFormatterFactory
{
    /**
     * @param ContainerInterface $container
     * @param string             $format
     * @return FormatterInterface
     */
    public static function factory(ContainerInterface $container, $format)
    {
        return $container->get('app.formatter.'.$format);
    }
}