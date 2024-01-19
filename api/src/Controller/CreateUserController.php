<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\User\InMemoryUser;

class CreateUserController extends AbstractController
{
    #[Route('/register/{email}/{password}', methods:['GET'])]
    public function register($email, $password, UserPasswordHasherInterface $hasher, EntityManagerInterface $manager)
    {
        $user = new User();
        $user->setEmail($email);
        $hashedPassword = $hasher->hashPassword($user, $password);
        $user->setPassword($hashedPassword);

        $manager->persist($user);
        $manager->flush();

        return new Response("J'ai créé le user $email");
    }

    #[Route('/hash/{username}/{password}', methods:['GET'])]
    public function hash($username, $password, UserPasswordHasherInterface $hasher)
    {
        $user = new InMemoryUser($username, $password);
        $hashedPassword = $hasher->hashPassword($user, $password);
        return new Response($hashedPassword);
    }
}