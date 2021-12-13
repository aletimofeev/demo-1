<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controller\Api;

use App\Service\Employee\EmployeeRequestHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/employees")
 */
class EmployeeController extends AbstractController
{
    /**
     * @Route("/email-employees", name="api_employees_email", methods={"POST"})
     */
    public function listEmployees(Request $request, EmployeeRequestHandler $handler): Response
    {
        $dto = $handler->handleEmailRequest($request);
        return $this->json($dto->getData(), $dto->getCode());
    }
}
