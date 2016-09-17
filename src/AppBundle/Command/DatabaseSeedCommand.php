<?php

namespace AppBundle\Command;

use AppBundle\Entity\Review;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DatabaseSeedCommand extends ContainerAwareCommand
{
    /**
     *
     */
    protected function configure()
    {
        $this->setName('database:seed')
            ->setDescription('Creates necessary records in database');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->seedDatabase();

        $output->writeln('Command result.');

        return 0;
    }

    /**
     * Create database records
     */
    private function seedDatabase()
    {
        //This is just to create some records. Not an example of a good code. Just fast solution :)
        $user = new User();
        $user->setUsername('Arnold');
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush($user);

        $review = new Review();
        $review->setRating(30);
        $review->setUser($user);
        $this->getEntityManager()->persist($review);
        $this->getEntityManager()->flush($review);

        $review = new Review();
        $review->setRating(87);
        $review->setUser($user);
        $this->getEntityManager()->persist($review);
        $this->getEntityManager()->flush($review);

        $review = new Review();
        $review->setRating(12);
        $review->setUser($user);
        $this->getEntityManager()->persist($review);
        $this->getEntityManager()->flush($review);

    }

    /**
     * @return EntityManager
     */
    private function getEntityManager()
    {
        return $this->getContainer()->get('doctrine')->getEntityManager();
    }
}
