<?php

namespace App\Controller;

use App\Entity\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiUserController extends AbstractController
{
//    /**
//     * @Route("/api/login", name="api_login")
//     */
//    public function index(): Response
//    {
//    }


    /**
     * @Route("/api/get-me", name="api_get_me", methods={"GET"})
     */
    public function getMe(): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        return $this->json([
            'lastname' => $user->getLastname(),
            'firstname' => $user->getFirstname(),
            'roles' => $user->getRoles(),
        ]);
    }
}
