<?php

namespace App\Controller;

use App\Repository\EmployeeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/test")
 */
class EmployeeController extends AbstractController
{
    /**
     * @Route("", name="employees")
     */
    public function index(EmployeeRepository $repository): Response
    {
        $data = $repository->findAll();
        return $this->json($data);
    }
}
