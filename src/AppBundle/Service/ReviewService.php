<?php

namespace AppBundle\Service;

use AppBundle\Entity\Review;
use AppBundle\Entity\User;
use AppBundle\Exception\UserNotFoundException;
use AppBundle\Repository\UserRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;

/**
 * Class ReviewService
 */
class ReviewService
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * ReviewService constructor.
     *
     * @param ObjectManager $entityManager
     */
    public function __construct(ObjectManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param string $uuid
     * @return float
     * @throws UserNotFoundException
     */
    public function getUsersAverageRating($uuid)
    {
        /** @var User $user */
        $user = $this->getUserRepository()->find($uuid);

        if (is_null($user)) {
            throw new UserNotFoundException('No such user. Did you seeded the database? Because you can.');
        }

        $reviewsList = [];
        foreach ($user->getReviews() as $review) {
            $reviewsList[] = $review->getRating();
        }

        return $this->countAverage($reviewsList);
    }

    public function seedDatabase()
    {
        //This is just to create some records. Not an example of a good code. Just fast solution :)
        $user = new User();
        $user->setUsername('Arnold');
        $this->entityManager->persist($user);
        $this->entityManager->flush($user);

        $review = new Review();
        $review->setRating(30);
        $review->setUser($user);
        $this->entityManager->persist($review);
        $this->entityManager->flush($review);

        $review = new Review();
        $review->setRating(87);
        $review->setUser($user);
        $this->entityManager->persist($review);
        $this->entityManager->flush($review);

        $review = new Review();
        $review->setRating(12);
        $review->setUser($user);
        $this->entityManager->persist($review);
        $this->entityManager->flush($review);

    }

    /**
     * @param array $records
     * @return float
     */
    private function countAverage(array $records)
    {
        $totalCount = count($records);

        if ($totalCount == 0) {
            return 0;
        }

        $totalAmount = array_sum($records);

        return $totalAmount / $totalCount;
    }

    /**
     * @return UserRepository
     */
    private function getUserRepository()
    {
        return $this->entityManager->getRepository('AppBundle:User');
    }
}
