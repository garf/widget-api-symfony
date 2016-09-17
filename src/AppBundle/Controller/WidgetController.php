<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Factory\OutputFormatterFactory;
use AppBundle\Repository\UserRepository;
use AppBundle\Service\ReviewService;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class WidgetController
 */
class WidgetController
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * WidgetController constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    /**
     * @return Response
     */
    public function indexAction()
    {
        $this->getReviewService()->seedDatabase();

        return new Response('Database seeded!');
    }

    /**
     * @param string $uuid
     * @param string $format
     *
     * @return Response
     */
    public function ratingAction($uuid, $format)
    {
        $rating = $this->getReviewService()->getUsersAverageRating($uuid);

        /** @var User $user */
        $user = $this->getUserRepository()->find($uuid);


        $formatter = OutputFormatterFactory::factory($this->container, $format);
        $formatter->addParam('UUID', $user->getId());
        $formatter->addParam('Name', $user->getUsername());
        $formatter->addParam('Rating', $rating);

        return $formatter->getResponse();
    }

    /**
     * @return ReviewService
     */
    private function getReviewService()
    {
        return $this->container->get('app.service.review');
    }

    /**
     * @return UserRepository
     */
    private function getUserRepository()
    {
        return $this->container->get('app.repositories.user');
    }
}
