<?php

namespace App\Controller;

use App\Dto\UserDto;
use App\Form\UserType;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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

    #[Route('/userFromJson', name: 'app_user_Json')]
    public function indexJson(Request $request, UserService $userService, ValidatorInterface $validator, SerializerInterface $serializer): Response
    {
        $user = $serializer->deserialize($request->getContent(), UserDto::class, 'json');
        $errors = $validator->validate($user);

        if (count($errors) > 0) {
            return $this->json($errors, 400);
        }
        $userService->create($user);

        return $this->render('user/index.html.twig', [
            'form' => $user,
        ]);
    }
}
