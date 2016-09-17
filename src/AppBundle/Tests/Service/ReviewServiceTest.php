<?php

namespace AppBundle\Tests\Service;

/**
 * Class ReviewServiceTest
 */
use AppBundle\Entity\Review;
use AppBundle\Entity\User;
use AppBundle\Service\ReviewService;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * Class ReviewServiceTest
 */
class ReviewServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var ReviewService
     */
    private $reviewService;

    /**
     *
     */
    public function setUp()
    {
        parent::setUp();
        
        $this->createUserWithReviews();
        $this->instantiateService();
    }

    /**
     *
     */
    public function testAverageCount()
    {
        $rating = $this->reviewService->getUsersAverageRating('1');

        $this->assertEquals(40, $rating);
    }

    /**
     *
     */
    private function createUserWithReviews()
    {
        $user = new User();
        $user->setId('1');
        $user->setUsername('foo');

        $reviews = [];

        $review = new Review();
        $review->setId(1);
        $review->setRating(60);
        $review->setUser($user);
        $reviews[] = $review;

        $review = new Review();
        $review->setId(1);
        $review->setRating(50);
        $review->setUser($user);
        $reviews[] = $review;

        $review = new Review();
        $review->setId(1);
        $review->setRating(10);
        $review->setUser($user);
        $reviews[] = $review;

        $user->setReviews($reviews);

        $this->user = $user;
    }

    private function instantiateService()
    {
        $userRepository = $this
            ->getMockBuilder(EntityRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $userRepository->expects($this->once())
            ->method('find')
            ->will($this->returnValue($this->user));

        $entityManager = $this
            ->getMockBuilder(ObjectManager::class)
            ->disableOriginalConstructor()
            ->getMock();
        $entityManager->expects($this->once())
            ->method('getRepository')
            ->will($this->returnValue($userRepository));

        $this->reviewService = new ReviewService($entityManager);
    }
}