<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    /**
     * @param \Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface $passwordHasher
     */
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }


    public function load(ObjectManager $manager): void
    {

        $user = new User();
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            'user@example.com'
        );
        $user
            ->setLastname('Андреев')
            ->setFirstname('Андрей')
            ->setEmail('user@example.com')
            ->setPassword($hashedPassword);
        $manager->persist($user);

        $editor = new User();
        $hashedPassword = $this->passwordHasher->hashPassword(
            $editor,
            'editor@example.com'
        );
        $editor
            ->setLastname('Сергеев')
            ->setFirstname('Сергей')
            ->setEmail('editor@example.com')
            ->setPassword($hashedPassword);
        $manager->persist($editor);


        $manager->flush();
    }
}
