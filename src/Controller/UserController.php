<?php

namespace App\Controller;

use App\Dto\UserDto;
use App\Form\UserType;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(Request $request, UserService $userService): Response
    {
        $form = $this->createForm(UserType::class, new UserDto());
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $user = $form->getData();
            $userService->create($user);
        }

        return $this->render('user/index.html.twig', [
            'form' => $form,
        ]);
    }
}
